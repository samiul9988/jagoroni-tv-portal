<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TagsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\{Language, Term};
use App\Services\TermService;
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Support\Facades\{Auth, Gate, Validator};
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    private $termService;
    
    /**
     * __construct
     *
     * @param  mixed $termService
     * @return void
     */
    public function __construct(TermService $termService)
    {
        $this->termService = $termService;

        $this->middleware('permission:read-tags', ['except' => ['ajaxSearch']]);
        $this->middleware('permission:add-tags', ['only' => ['store']]);
        $this->middleware('permission:update-tags', ['only' => ['update']]);
    }
    
    /**
     * ajaxSearch
     *
     * @return void
     */
    public function ajaxSearch(){
        $language = request('lang');
        $data = $this->termService->showTermForSelectOption(10, $language, 'tag');
        return response()->json($data);
    }
    
    /**
     * ajaxCategorySearch
     *
     * @return void
     */
    public function ajaxCategorySearch()
    {
        if(request()->filled('q')) {
            $data = Term::select('name','id')->tag()->where('language_id', request('lang'))->searchName(request()->get('q'))->limit(5)->get();
        } else {
            $data = Term::select('name','id')->tag()->where('language_id', request('lang'))->limit(5)->get();
        }

        return response()->json($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(TagsDataTable $dataTable)
    {
        $language = Auth::user()->language;
        $languages = Language::whereActive('y')->get();
        return $dataTable->render( 'admin.tags.index', compact('language', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => ['required', 'min:3', Rule::unique('terms', 'name')->where(function ($query) use ($request) {
                return $query->whereTaxonomy('tag')->where('language_id', $request->language);
            })]
        ]);

        $resp = [];

        if ($validator->fails()) {
            $resp[] = ['trans' => $validator->errors()];
        }

        return $this->termService->save($request, 'tag', $resp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagRequest $request
     * @param Term $tag
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $term = Term::tag()->find($id);

        $validator = Validator::make(request()->all(), [
            'name' => ['required','min:3', Rule::unique('terms', 'name')->where(function ($query) use ($request) {
                return $query->whereTaxonomy('tag')->where('language_id', $request->language);
            })->ignore($term->id)]
        ]);

        $resp = [];

        if ($validator->fails()) {
            $resp[] = [ 'trans' => $validator->errors() ];
        }

        return $this->termService->modify($request, $term, 'tag', $resp);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Term $tag
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if (!Gate::allows('delete-tags')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

        $term = Term::category()->find($id);

        $this->termService->remove($term, 'tag');

        return response()->json(['success' => __('message.deleted_successfully')]);
    }
    
    /**
     * massdestroy
     *
     * @return void
     */
    public function massdestroy()
    {
        if (! Gate::allows('delete-tags')) {
            return response()->json(['error' =>  __('message.dont_have_permission')]);
        }

        $tags  = $this->termService->massRemove('tag');

        if($tags->delete()) {
            return response()->json(['success' =>  __('message.deleted_successfully')]);
        } else {
            return response()->json(['error' =>  __('message.deleted_not_successfully')]);
        }
    }
}
