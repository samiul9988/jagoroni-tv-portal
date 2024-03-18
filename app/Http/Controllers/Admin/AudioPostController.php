<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AudioPostsDataTable;
use App\Helpers\{ImageHelper, UtlHelper};
use App\Http\Controllers\Controller;
use App\Models\{Language,Post};
use App\Services\{AudioPostService,PostService,TermService};
use App\Traits\ImageTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory,View};
use Illuminate\Http\{JsonResponse,RedirectResponse,Request,Response};
use Illuminate\Support\Facades\{Gate,Validator};
use Illuminate\Validation\ValidationException;

class AudioPostController extends Controller
{
    private $audioPostService, $postService, $termService;
    use ImageTrait;

    /**
     * @param AudioPostService $audioPostService
     * @param PostService $postService
     * @param TermService $termService
     */
    public function __construct(AudioPostService $audioPostService, PostService $postService, TermService $termService)
    {
        $this->audioPostService = $audioPostService;
        $this->postService      = $postService;
        $this->termService      = $termService;

        $this->middleware('permission:read-posts', ['only' => ['index']]);
        $this->middleware('permission:add-posts', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-posts', ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(AudioPostsDataTable $dataTable)
    {
        return $dataTable->render('admin.audios.index');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $languages = Language::active()->pluck('name', 'id');
        return view('admin.audios.create', compact('languages'));
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
        $fileExists = ImageHelper::isExists('audios', $post->post_source);
        $dbExists   = UtlHelper::checkDbPostSourceAudioExists($post);

        return view('admin.audios.create-translate', compact('language', 'post', 'image', 'transId', 'fileExists', 'dbExists'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $postSourceMsg = ($request->post_type == 'audio_file') ?
            __('message.audio_file_must_be_uploaded') :
            ( ($request->post_type == 'audio_url')
                ? __('message.audio_url_is_required')
                : __('message.embed_audio_cannot_be_empty') );

        $validator = Validator::make($request->all(), [
            'post_source' => 'sometimes|required',
            'post_title' => 'required|min:3',
        ], [], [
            'post_source' => $postSourceMsg,
        ]);

        if ($validator->fails()) {
            return redirect()->to(url()->previous() . "#".$request->post_type)
                ->withErrors($validator)
                ->with('serverid', $request->post_source)
                ->withInput();
        }

        $this->audioPostService->save($request);

        return redirect()->route('audios.index')
            ->withSuccess(__('message.saved_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit($id)
    {
        $post       = Post::find($id);
        $categories = $this->postService->getPostCategories($post);
        $tags       = $this->postService->getPostTags($post);
        $visibility = $post->post_visibility;
        $image      = $this->showImage('images', $post->post_image);
        $language   = Language::find($post->post_language);
        $fileExists = ImageHelper::isExists('audios', $post->post_source);
        $dbExists   = UtlHelper::checkDbPostSourceAudioExists($post);

        return view('admin.audios.edit', compact(
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
        $postSourceMsg = ($request->post_type == 'audio_file') ? __('message.audio_file_must_be_uploaded') : (($request->post_type == 'audio_url') ? __('message.audio_url_is_required') : __('message.embed_audio_cannot_be_empty'));

        $validator = Validator::make($request->all(), [
            'post_source' => 'sometimes|required',
            'post_title' => 'required|min:3',
        ], [], [
            'post_source' => $postSourceMsg,
        ]);

        if ($validator->fails()) {
            return redirect()->to(url()->previous() . "#".$request->post_type)
                ->withErrors($validator)
                ->with('serverid', $request->post_source)
                ->withInput();
        }

        $this->audioPostService->modify($request, $id);

        return redirect()->route('audios.index')->withSuccess(__('message.updated_successfully'));
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
