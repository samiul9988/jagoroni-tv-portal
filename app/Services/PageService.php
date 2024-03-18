<?php

namespace App\Services;

use App\Helpers\LocalizationHelper;
use App\Models\{Language, Post};
use App\Traits\{ImageTrait, PostTrait};
use Cocur\Slugify\Slugify;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\{Arr, Carbon, Str};
use Illuminate\Support\Facades\Auth;

Class PageService
{
    use ImageTrait, PostTrait;

    protected $page, $slugify;
    
    /**
     * __construct
     *
     * @param  mixed $page
     * @param  mixed $slugify
     * @return void
     */
    public function __construct(Post $page, Slugify $slugify)
    {
        $this->page = $page;
        $this->slugify = $slugify;
    }
    
    /**
     * save
     *
     * @param  mixed $request
     * @return void
     */
    public function save($request)
    {
        $page = new $this->page;

        if ($request->hasFile('post_image')) {
            $page->post_image = $this->storePostThumbAndGetFileName($request->post_image);
            $page->post_image_meta  = json_encode([
                'image_url' => null,
                'caption' => $request->thumb_caption
            ]);
        }

        if ($request->filled('image_url')) {
            $page->post_image_meta = json_encode([
                'image_url' => $request->image_url,
                'caption' => $request->thumb_caption
            ]);
        }

        $postContent = str_replace(['<iframe', '</iframe>'], ['<div class="ratio ratio-16x9"><iframe', '</iframe></div>'], $request->post_content);

        $page->post_title       = strip_tags($request->post_title);
        $page->post_summary     = $request->post_summary;
        $page->post_content     = $postContent;
        $page->meta_description = strip_tags($request->meta_description);
        $page->meta_keyword     = strip_tags($request->meta_keyword);
        $page->post_status      = $request->has('draft') ? 'draft' : 'publish';
        $page->post_visibility  = $request->post_visibility;
        $page->post_hits        = 0;
        $page->post_author      = Auth::id();
        $page->post_language    =  $request->integer('post_language');
        $page->post_type        = 'page';

        $page->save();

        $this->addTranslation($page, $request);
    }
    
    /**
     * getTransPostId
     *
     * @param  mixed $lang
     * @param  mixed $translations
     * @return void
     */
    public static function getTransPostId($lang, $translations)
    {
        $language = Language::find($lang)->language_code;
        return Arr::get(json_decode($translations, true), $language);
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
        $page             = $this->page->findOrFail($id);
        $page->post_title = strip_tags($request->post_title);
        
        if ($request->has('slug')) {
            if ($page->post_name != $request->slug) {
                $page->post_name = SlugService::createSlug(Post::class, 'post_name', $request->slug);
            }
        }

        $content = str_replace(['<div class="ratio ratio-16x9"><iframe', '</iframe></div>'], ['<iframe', '</iframe>'], $request->post_content);
        $postContent = str_replace(['<iframe', '</iframe>'], ['<div class="ratio ratio-16x9"><iframe', '</iframe></div>'], $content);
        $postContent = str_replace(['<div class="ratio ratio-16x9">&nbsp;</div>'], ['<p>&nbsp;</p>'], $postContent);

        $page->post_summary     = $request->post_summary;
        $page->post_content     = $postContent;
        $page->post_type        = 'page';
        $page->post_status      = $request->has('draft') ? 'draft' : ($request->has('publish') ? 'publish' : null);
        $page->meta_description = strip_tags($request->meta_description);
        $page->meta_keyword     = strip_tags($request->meta_keyword);
        $page->post_visibility  = $request->post_visibility;
        $page->updated_at       = Carbon::now();

        if (request('isimage') == 'true') {
            if($request->hasFile('post_image')) {
                if (!empty($page->post_image)) {
                    $this->deleteImage('images', $page->post_image);
                }

                $page->post_image = $this->storePostThumbAndGetFileName($request->post_image);
            }

            $page->post_image_meta = json_encode([
                'image_url' => null,
                'caption' => $request->thumb_caption
            ]);
        } else {
            if ($request->filled('image_url')) {
                if (!empty($page->post_image)) {
                    $this->deleteImage('images', $page->post_image);
                    $this->deleteImage('images', $page->post_image);
                    $this->deleteImage('images', $page->post_image);
                }
            }

            $page->post_image = null;
            $page->post_image_meta  = json_encode([
                'image_url' => $request->image_url,
                'caption' => $request->thumb_caption
            ]);
        }

        $page->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        $page = $this->page->findOrFail($id);

        $this->deletePost($page);
        return $page->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function massRemove($id)
    {
        $pages_id_array = $id;
        $pages = $this->page::whereIn('id', $pages_id_array)->get();

        foreach($pages as $item) {
            $this->deletePost($item);
        }

        return $this->page->whereIn('id', $pages_id_array);
    }
    
    /**
     * pageQuery
     *
     * @return void
     */
    public static function pageQuery() {
        $id = LocalizationHelper::getCurrentLocaleId();

        /** @var \App\Models\User */
        $currentUser = Auth::user();

        $query = Post::with(['user.roles', 'language'])
            ->page()
            ->where('post_language', $id)
            ->publish();

        if (Auth::check()) {
            if ($currentUser->hasRole('super-admin')) {
                return $query;
            } else {
                if ($currentUser->can('read-private-post')) {
                    if ($currentUser->hasRole('admin')) {
                        return $query->where(function($query_post){
                            foreach($query_post->with('user.roles')->get() as $post) {
                                if ($post->user->getRoleNames()->first()== 'admin') {
                                    $query_post->public()
                                        ->orWhere(function($q) {
                                            $q->private()->where('post_author', Auth::id());
                                        });
                                } else{
                                    $query_post->public();
                                }
                            }
                        });
                    }
                } else {
                    if($currentUser->hasRole(['author'])) {
                        return $query->where(function($query_post){
                            foreach($query_post->with('user.roles')->get() as $post) {
                                if ($post->user->getRoleNames()->first() == 'author') {
                                    $query_post->public()
                                        ->orWhere(function($q) {
                                            $q->private()->where('post_author', Auth::id());
                                        });
                                } else {
                                    $query_post->public();
                                }
                            }
                        });
                    } else{
                        return $query->public()
                            ->orWhere(function($query_post) {
                                $query_post->private()
                                    ->where('post_author', Auth::id());
                            });
                    }
                }
            }
        } else {
            return $query->public();
        }
    }
    
    /**
     * pageCount
     *
     * @return void
     */
    public function pageCount() 
    {
        /** @var object Post */
        $page = $this->pageQuery();

        return $page->count();
    }
}
