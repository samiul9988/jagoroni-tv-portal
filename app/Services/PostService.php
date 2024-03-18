<?php

namespace App\Services;

use App\Helpers\LocalizationHelper;
use App\Models\{Language, Post, Term};
use App\Traits\PostTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\{Arr, Carbon};
use Illuminate\Support\Facades\Auth;

Class PostService
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
        $postImageMeta = null;

        if ($request->hasFile('post_image')) {
            $request->merge([
                'image_name' => $this->storePostThumbAndGetFileName($request->post_image)
            ]);

            $postImageMeta = json_encode([
                'image_url' => $request->image_url,
                'caption' => $request->thumb_caption
            ]);
        }

       if ($request->filled('image_url')) {
            $postImageMeta = json_encode([
                'image_url' => $request->image_url,
                'caption' => $request->thumb_caption
            ]);
       }

        $postContent = str_replace(['<iframe', '</iframe>'], ['<div class="ratio ratio-16x9"><iframe', '</iframe></div>'], $request->post_content);
        
        $post = $this->post->create([
            'post_title'       => strip_tags($request->post_title),
            'post_summary'     => $request->post_summary,
            'post_content'     => $postContent,
            'meta_description' => strip_tags($request->meta_description),
            'meta_keyword'     => strip_tags($request->meta_keyword),
            'post_status'      => $request->has('draft') ? 'draft' : 'publish',
            'post_visibility'  => $request->post_visibility,
            'post_hits'        => 0,
            'post_author'      => Auth::id(),
            'post_language'    => $request->integer('post_language'),
            'post_type'        => 'post',
            'post_image'       => $request->image_name ?: null,
            'post_image_meta'  => $postImageMeta
        ]);

        $this->addTranslation($post, $request);
        $this->attachCategories($request, $post);
        $this->attachTags($request, $post);

        return $post;
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
        $post = $this->post->findOrFail($id);

        $post_name = $post->post_name;

        if ($request->has('slug')) {
            if ($post->post_name != $request->slug) {
                $post_name = SlugService::createSlug(Post::class, 'post_name', $request->slug);
            }
        }

        $content = str_replace(['<div class="ratio ratio-16x9"><iframe', '</iframe></div>'], ['<iframe', '</iframe>'], $request->post_content);
        $postContent = str_replace(['<iframe', '</iframe>'], ['<div class="ratio ratio-16x9"><iframe', '</iframe></div>'], $content);
        $postContent = str_replace(['<div class="ratio ratio-16x9">&nbsp;</div>'], ['<p>&nbsp;</p>'], $postContent);

        $data = array(
            'post_title'       => strip_tags($request->post_title),
            'post_name'        => $post_name,
            'post_summary'     => $request->post_summary,
            'post_content'     => $postContent,
            'post_type'        => 'post',
            'post_visibility'  => $request->post_visibility,
            'meta_description' => strip_tags($request->meta_description),
            'meta_keyword'     => strip_tags($request->meta_keyword),
            'created_at'       => $this->createDateTimeFromRequest($request),
            'updated_at'       => Carbon::now()
        );

        $data['post_status'] = $request->has('draft') ? 'draft' : 'publish';

        if (request('isimage') == 'true') {
            if($request->hasFile('post_image')) {
                if (!empty($post->post_image)) {
                    $this->deleteImage('images', $post->post_image);
                    $this->deleteImage('images/80', $post->post_image);
                    $this->deleteImage('images/300', $post->post_image);
                    $this->deleteImage('images/356', $post->post_image);
                }

                $data['post_image'] = $this->storePostThumbAndGetFileName($request->post_image);
            }

            $data['post_image_meta'] = json_encode([
                'image_url' => null,
                'caption' => $request->thumb_caption
            ]);
        } else {
            if ($request->filled('image_url')) {
                if (!empty($post->post_image)) {
                    $this->deleteImage('images', $post->post_image);
                    $this->deleteImage('images/80', $post->post_image);
                    $this->deleteImage('images/300', $post->post_image);
                    $this->deleteImage('images/356', $post->post_image);
                }
            }

            $data['post_image'] = null;
            $data['post_image_meta']  = json_encode([
                'image_url' => $request->image_url,
                'caption' => $request->thumb_caption
            ]);
        }

        $this->post->where('id', $id)->update($data);

        $terms = $this->syincTerms($request);

        if ($request->filled('categories')) {
            if ($request->filled('subcategories')) {
                $terms = array_merge($request->categories, $request->subcategories);
            } else {
                $terms = $request->categories;
            }
            $post->terms()->sync($terms);
        }
    }
    
    /**
     * getPostCategories
     *
     * @param  mixed $post
     * @return void
     */
    public function getPostCategories($post)
    {
        // check term_relationships category
        $isNullCategory = is_null( $post->terms()->where('taxonomy','category')->first() );

        $categories = array();

        if (!$isNullCategory) {
            // Get Categories
            foreach ($post->terms()->category()->get() as $category) {
                $taxonomyId = $category->id;
                $categories[] = Term::findOrFail($taxonomyId);
            }
        }

        return $categories;
    }
    
    /**
     * getPostTags
     *
     * @param  mixed $post
     * @return void
     */
    public function getPostTags($post)
    {
        $tagTerm =  $post->terms()->tag();

        $tags = array();
        if($tagTerm){
            foreach ($tagTerm->get() as $tag) {
                $tags[] = $tag->name;
            }
            $tags = implode(',', $tags);
        }

        return $tags;
    }
    
    /**
     * getTransPostId
     *
     * @param  mixed $lang
     * @param  mixed $translations
     * @return void
     */
    public function getTransPostId($lang, $translations)
    {
        $language = Language::find($lang)->language_code;
        return Arr::get(json_decode($translations, true), $language);
    }
    
    
    /**
     * postQuery
     *
     * @return void
     */
    public function postQuery() {
        $id = LocalizationHelper::getCurrentLocaleId();

        /** @var \App\Models\User */
        $currentUser = Auth::user();

        $query = Post::with(['terms', 'user.roles', 'language'])
            ->article()
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
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        $post = $this->post->findOrFail($id);

        $this->deletePost($post);
        return $post->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function massRemove($id)
    {
        $post_id_array = $id;

        $post = $this->post::whereIn('id', $post_id_array)->get();

        foreach($post as $item) {
            $this->deletePost($item);
        }

        return $this->post->whereIn('id', $post_id_array);
    }
    
    /**
     * postCount
     *
     * @return void
     */
    public function postCount() 
    {
        /** @var object Post */
        $post = $this->postQuery();

        return $post->count();
    }
    
    /**
     * galleryCount
     *
     * @return void
     */
    public function galleryCount()
    {
        return $this->post->ofType('gallery')->count();
    }
}
