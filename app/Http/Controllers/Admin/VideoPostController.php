<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VideoPostsDataTable;
use App\Helpers\{ImageHelper, UtlHelper};
use App\Http\Controllers\Controller;
use App\Models\{Language, Post};
use App\Services\{PostService, TermService, VideoPostService};
use App\Traits\ImageTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\{JsonResponse, RedirectResponse, Response, Request};
use Illuminate\Support\Facades\{Gate, Validator};
use Illuminate\Validation\ValidationException;

class VideoPostController extends Controller
{
    private $videoPostService, $postService, $termService;
    use ImageTrait;

    public function __construct(VideoPostService $videoPostService, PostService $postService, TermService $termService)
    {
        $this->videoPostService = $videoPostService;
        $this->postService = $postService;
        $this->termService = $termService;

        $this->middleware('permission:read-posts', ['only' => ['index']]);
        $this->middleware('permission:add-posts', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-posts', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(VideoPostsDataTable $dataTable)
    {
        return $dataTable->render('admin.videos.index');
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $languages = Language::active()->pluck('name', 'id');
        return view('admin.videos.create', compact('languages'));
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
        $fileExists = ImageHelper::isExists('videos', $post->post_source);
        $dbExists = UtlHelper::checkDbPostSourceVideoExists($post);

        return view('admin.videos.create-translate', compact('language', 'post', 'image', 'transId', 'fileExists', 'dbExists'));
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $postSourceMsg = ($request->post_type == 'video_file')
            ? __('message.video_file_must_be_uploaded')
            : (($request->post_type == 'video_url')
                ? __('message.video_url_is_required')
                : __('message.embed_video_cannot_be_empty'));

        $validator = Validator::make($request->all(), [
            'post_source' => 'sometimes|required',
            'post_source.embed_id' => 'sometimes|required',
            'post_title' => 'required|min:3',
        ], [], [
            'post_source' => $postSourceMsg,
        ]);

        if ($validator->fails()) {
            return redirect()->to(url()->previous() . "#".$request->post_type)
                ->withErrors($validator)
                ->with(['serverid' => $request->post_source, 'posttype' => $request->post_type])
                ->withInput();
        }

        $this->videoPostService->save($request);

        return redirect()->route('videos.index')
            ->withSuccess(__('message.saved_successfully'));
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
        $fileExists = ImageHelper::isExists('videos', $post->post_source);
        $dbExists   = UtlHelper::checkDbPostSourceVideoExists($post);

        return view('admin.videos.edit', compact(
            'post',
            'categories',
            'tags',
            'image',
            'visibility',
            'language',
            'fileExists',
            'dbExists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $postSourceMsg = ($request->post_type == 'video_file') ? __('message.video_file_must_be_uploaded') : (($request->post_type == 'video_url') ? __('message.video_url_is_required') : __('message.embed_video_cannot_be_empty'));

        $validator = Validator::make($request->all(), [
            'post_source' => 'sometimes|required',
            'post_title' => 'required|min:3',
        ], [], [
            'post_source' => $postSourceMsg,
        ]);

        if ($validator->fails()) {
            return redirect()->to(url()->previous() . "#".$request->post_type)
                ->withErrors($validator)
                ->with(['serverid' => $request->post_source, 'posttype' => $request->post_type])
                ->withInput();
        }

        $this->videoPostService->modify($request, $id);

        return redirect()->route('videos.index')->withSuccess(__('message.updated_successfully'));
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
