<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PagesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\{PageRequest, PostRequest};
use App\Models\{Language, Post};
use App\Services\PageService;
use App\Traits\ImageTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    /**
     * @var PageService
     */
    private $pageService;

    use ImageTrait;

    /**
     * CategoryController constructor.
     */
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;

        $this->middleware('permission:read-pages', ['only' => ['index']]);
        $this->middleware('permission:add-pages', ['only' => ['create', 'createTranslate', 'store']]);
        $this->middleware('permission:update-pages', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PagesDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $languages = Language::active()->pluck('name', 'id');
        return view('admin.pages.create', compact('languages'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function createTranslate(Request $request, $id)
    {
        $language = Language::firstWhere('language', $request->lang);
        $page     = Post::with('translations')->findOrFail($id);
        $image    = $this->showImage('images', $page->post_image);
        $transId  = $page->translations->first()->id;
        return view('admin.pages.create-translate', compact('language', 'page', 'image', 'transId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageRequest $formRequest
     * @return Response
     */
    public function store(PageRequest $formRequest)
    {
        $formRequest->validated();
        $this->pageService->save(request());

        return redirect()->route('pages.index')
            ->withSuccess(__('message.saved_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $page       = Post::find($id);
        $visibility = $page->post_visibility;
        $image      = $this->showImage('images', $page->post_image);
        $language   = Language::find($page->post_language);

        return view('admin.pages.edit', compact(
            'page',
            'image',
            'visibility',
            'language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $formRequest
     * @param int $id
     * @return Response
     */
    public function update(PostRequest $formRequest, $id)
    {
        $formRequest->validated();
        $this->pageService->modify(request(), $id);

        return redirect()->route('pages.index')
            ->withSuccess(__('message.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if (! Gate::allows('delete-pages')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

        $this->pageService->remove($id);
        return response()->json(['success' => __('message.deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function massdestroy()
    {
        if (! Gate::allows('delete-pages')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

        $id = request('id');
        $pages = $this->pageService->massRemove($id);

        if($pages->delete()) {
            return response()->json(['success' => __('message.deleted_successfully')]);
        } else {
            return response()->json(['error' => __('message.deleted_not_successfully')]);
        }
    }
}
