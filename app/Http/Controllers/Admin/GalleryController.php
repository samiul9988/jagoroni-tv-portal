<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\GalleriesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Post;
use App\Services\GalleryService;
use App\Traits\ImageTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Support\Facades\Gate;

class GalleryController extends Controller
{
    use ImageTrait;
    private $galleryService;

    /**
     * GalleryController constructor.
     */
    public function __construct(GalleryService $galleryService)
    {
        $this->middleware('permission:read-galleries', ['only' => ['index']]);
        $this->middleware('permission:add-galleries', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-galleries', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-galleries', ['only' => ['destroy']]);

        $this->galleryService = $galleryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function index(GalleriesDataTable $dataTable)
    {
        $this->authorize('read-galleries');
        return $dataTable->render('admin.galleries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GalleryRequest $request
     * @return Response
     */
    public function store(GalleryRequest $request)
    {
        $request->validated();
        $this->galleryService->save(request());

        return redirect()->route('galleries.index')
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
        $gallery = Post::findOrFail($id);
        $meta = json_decode($gallery->post_image_meta);
        $image = $this->showImage('images', json_decode($gallery->post_image_meta)->file);

        return view('admin.galleries.edit', compact('gallery', 'meta', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->galleryService->modify($request, $id);

        return redirect()->route('galleries.index')
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
        if (!Gate::allows('delete-galleries')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

        $this->galleryService->remove($id);

        return response()->json(['success' => __('message.deleted_successfully')]);
    }
}
