<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PostsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\{CategoryRequest, PostRequest};
use App\Models\{Language, Post, Subscriber};
use App\Services\{PostService, TermService, EmailService};
use App\Traits\ImageTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    private $postService, $termService, $emailService;
    use ImageTrait;

    public function __construct(PostService $postService, TermService $termService, EmailService $emailService)
    {
        $this->postService = $postService;
        $this->termService = $termService;
        $this->emailService = $emailService;

        $this->middleware('permission:read-posts', ['only' => ['index']]);
        $this->middleware('permission:add-posts', ['only' => ['create', 'store', 'categoryStore']]);
        $this->middleware('permission:update-posts', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PostsDataTable $dataTable)
    {
        return $dataTable->render('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $languages = Language::active()->pluck('name', 'id');
        return view('admin.posts.create', compact('languages'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function createTranslate(Request $request, $id)
    {
        $language = Language::firstWhere('language', $request->lang);
        $post     = Post::with('translations')->findOrFail($id);
        $image    = $this->showImage('images', $post->post_image);
        $transId  = $post->translations->first()->id;
        $categories = $this->postService->getPostCategories($post);

        return view('admin.posts.create-translate', compact('language', 'post', 'image', 'transId', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $formRequest
     * @return Response
     */
    public function store(PostRequest $formRequest)
    {
        $formRequest->validated();
        $post = $this->postService->save(request());
        
        if (Subscriber::where('status','active')->count()) {
            $this->emailService->sendPostSubcription($post);
        }

        return redirect()->route('posts.index')
            ->withSuccess(__('message.saved_successfully'));
    }

    /**
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function categoryStore(CategoryRequest $request)
    {
        $request->validated();

        $this->termService->save(request(), 'category', null);

        return response()->json(['success' => __('message.saved_successfully')]);
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
        $post       = Post::find($id);
        $categories = $this->postService->getPostCategories($post);
        $tags       = $this->postService->getPostTags($post);
        $visibility = $post->post_visibility;
        $image      = $this->showImage('images', $post->post_image);
        $language   = Language::find($post->post_language);

        return view('admin.posts.edit', compact(
            'post',
            'categories',
            'tags',
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

        $this->postService->modify(request(), $id);

        return redirect()->route('posts.index')->withSuccess(__('message.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if (! Gate::allows('delete-posts')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

        $this->postService->remove($id);
        return response()->json(['success' => __('message.deleted_successfully')]);
    }

    /**
     * @return JsonResponse
     */
    public function massdestroy()
    {
        if (! Gate::allows('delete-posts')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

        $id = request('id');
        $post = $this->postService->massRemove($id);

        if($post->delete()) {
            return response()->json(['success' => __('message.deleted_successfully')]);
        } else {
            return response()->json(['error' => __('message.deleted_not_successfully')]);
        }
    }
}
