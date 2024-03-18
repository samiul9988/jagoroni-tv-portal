<?php

namespace App\Services;

use App\Helpers\LocalizationHelper;
use App\Models\Post;
use App\Traits\PostTrait;
use Carbon\Carbon;
use Illuminate\Support\{Arr, Str};
use Illuminate\Support\Facades\Auth;

class GalleryService
{
    use PostTrait;
    protected $post;
        
    /**
     * __construct
     *
     * @param  mixed $post
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    
    /**
     * save
     *
     * @param  mixed $request
     * @return void
     */
    public function save($request)
    {
        if ($request->hasFile('file')) {
            $data = $this->storeGalleryFileAndGetJson($request->file);
        }

        $this->post->create([
            'post_title'      => $request->title,
            'post_mime_type'  => $data['mimetype'],
            'post_type'       => 'gallery',
            'post_status'     => 'inherit',
            'post_author'     => Auth::id(),
            'post_language'   => LocalizationHelper::getDefaultLanguageId(),
            'post_guid'       => '/storage/images/' . $data['url'],
            'post_image_meta' => json_encode($data['meta'])
        ]);
    }
    
    /**
     * modify
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function modify($request, $id)
    {
        $gallery     = $this->post->findOrFail($id);
        $meta        = json_decode($gallery->post_image_meta, true);
        $update_meta = Arr::set($meta, 'attr_image_alt', strip_tags($request->alt_text));
        $newmeta     = json_encode($update_meta);

        $data = [
            'post_title'      => strip_tags(Str::title($request->title)),
            'post_content'    => $request->description,
            'post_summary'    => $request->caption,
            'post_image_meta' => $newmeta,
            'updated_at'      => Carbon::now()
        ];

        $this->post->where('id', $id)->update($data);
    }    

    /**
     * remove
     *
     * @param  mixed $id
     * @return void
     */
    public function remove($id)
    {
        $post = $this->post->findOrFail($id);

        $meta     = json_decode($post->post_image_meta);
        $filename = $meta->file;
        $this->deleteImage('images', $filename);

        return $post->delete();
    }
}
