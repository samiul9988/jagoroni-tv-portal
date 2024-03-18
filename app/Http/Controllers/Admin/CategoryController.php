<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\{Language,Term};
use App\Services\TermService;
use App\Traits\LanguageTrait;
use Illuminate\Http\{JsonResponse,Request,Response};
use Illuminate\Support\Facades\{Gate, Validator};
use Illuminate\Validation\Rule;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CategoryController extends Controller
{
    use LanguageTrait;

    /**
     * @var TermService
     */
    private $termService;

    /**
     * CategoryController constructor.
     */
    public function __construct(TermService $termService)
    {
        $this->termService = $termService;

        $this->middleware('permission:read-categories', ['except' => ['index', 'search', 'searchSubcategory', 'ajaxCategorySearch']]);
        $this->middleware('permission:add-categories', ['only' => ['store']]);
        $this->middleware('permission:update-categories', ['only' => ['update']]);
    }

    /**
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function search(){
        $data = $this->termService->showTermForSelectOption('category');
        return response()->json($data);
    }

    /**
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function searchSubcategory(){
        $language = request('lang');
        $parent = request('c');
        $data = $this->termService->showTermForSelectOption($language, 'category', $parent);
        return response()->json($data);
    }

    /**
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function ajaxCategorySearch()
    {
        if(request()->filled('q')) {
            $data = Term::select('name','id')->category()->where('language_id', request('lang'))->searchName(request()->get('q'))->get();
        } else {
            $data = Term::select('name','id')->category()->where('language_id', request('lang'))->get();
        }

        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(CategoriesDataTable $dataTable)
    {
        $languages = Language::whereActive('y')->get();
        return $dataTable->render( 'admin.categories.index', compact('languages'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => ['required', 'min:3', Rule::unique('terms', 'name')->where(function ($query) use ($request) {
                return $query->whereTaxonomy('category')->where('language_id', $request->language);
            })]
        ]);

        $resp = [];

        if ($validator->fails()) {
            $resp[] = ['trans' => $validator->errors()];
        }

        return $this->termService->save($request, 'category', $resp);
    }

    /**
     * @param Request $request
     * @param $category
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $term = Term::category()->find($id);

        $validator = Validator::make(request()->all(), [
            'name' => ['required','min:3', Rule::unique('terms', 'name')->where(function ($query) use ($request) {
                return $query->whereTaxonomy('category')->where('language_id', $request->language);
            })->ignore($term->id)]
        ]);

        $resp = [];

        if ($validator->fails()) {
            $resp[] = [ 'trans' => $validator->errors() ];
        }

        return $this->termService->modify($request, $term, 'category', $resp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Term $category
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if (!Gate::allows('delete-categories')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

        $term = Term::category()->find($id);

        $this->termService->remove($term, 'category');

        return response()->json(['success' => __('message.deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     * @var Term $categories
     */
    public function massdestroy()
    {
        if (! Gate::allows('delete-categories')) {
            return response()->json(['error' =>  __('message.dont_have_permission')]);
        }

        $categories  = $this->termService->massRemove('category');

        if($categories->delete()) {
            return response()->json(['success' =>  __('message.deleted_successfully')]);
        } else {
            return response()->json(['error' =>  __('message.deleted_not_successfully')]);
        }
    }
}
