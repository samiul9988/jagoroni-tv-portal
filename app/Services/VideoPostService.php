<?php

namespace App\Services;

use App\Helpers\LocalizationHelper;
use App\Models\{Post, Term};
use App\Traits\PostTrait;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\{Carbon, Str};
use Illuminate\Support\Facades\{Auth,Storage};
use Illuminate\Database\Eloquent\Builder;

Class VideoPostService
{
    use PostTrait;

    /**
     * @return mixed
     */
    public function query()
    {
        $posts = Post::video()->publish();

        if (Auth::check()) {
            if (Auth::user()->hasRole('super-admin')) {
                $posts->where(function($query) {
                    $query->public()
                        ->orWhere(function($r){
                            $r->whereHas('user.roles', function(Builder $p){
                                $p->whereName('super-admin');
                            })->private()->where('post_author', Auth::id());
                        })
                        ->orWhere(function($r){
                            $r->whereHas('user.roles', function(Builder $p){
                                $p->whereIn('name', ['admin','author']);
                            })->private();
                        });
                });
            } else {
                if (Auth::user()->can('read-private-post')) {
                    if (Auth::user()->hasRole('admin')) {
                        $posts->where(function($query) {
                            $query->public()
                                ->orWhere(function($r){
                                    $r->whereHas('user.roles', function(Builder $p){
                                        $p->whereName('admin');
                                    })->private()->where('post_author', Auth::id());
                                })
                                ->orWhere(function($r){
                                    $r->whereHas('user.roles', function(Builder $p){
                                        $p->whereName('author');
                                    })->private();
                                });
                        });
                    }
                } else {
                    if(Auth::user()->hasRole('author')) {
                        $posts->where(function($query) {
                            $query->public()
                                ->orWhere(function($r){
                                    $r->whereHas('user.roles', function(Builder $p){
                                        $p->whereName('author');
                                    })->private()->where('post_author', Auth::id());
                                });
                        });
                    }
                }
            }
        } else {
            $posts->public();
        }

        return $posts;
    }

    /**
     * @return mixed
     */
    public function currentLanguage($localeId)
    {
        return $this->query()->wherePostLanguage($localeId);
    }

    /**
     * dynamicQuery
     *
     * @param mixed $page
     * @param mixed $layout
     * @param mixed $widgetName
     * @param mixed $widgetData
     * @param mixed $localeId
     * @return void
     */
    public function dynamicQuery($page, $layout, $widgetName, $widgetData, $localeId)
    {
        $query = $this->query()->wherePostLanguage($localeId);

        $postType = $widgetData['post_type'];
        $category = $widgetData['category'];
        $popularBased = $widgetData['popular_based'];
        $order = $widgetData['order'];
        $numOfPosts = $widgetData['number_of_posts'];

        if ($postType == 'video') {
            $query1 = (clone $query);
        } elseif ($postType == 'video_by_category') {
            $term = Term::category()->where('slug', $category)->first();
            $query1 = $term ? $term->posts()->video()->where('post_language', $localeId) : null;  
        }

        if (!$query1) { return collect([]); }
            
        if ($popularBased == 'none') {
            $query2 = $query1;
        } else if ($popularBased == 'all') {
            $query2 = $query1;
        } else if ($popularBased == 'day') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subDay());
        } else if ($popularBased == 'week') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subWeek());
        } else if ($popularBased == 'month') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subMonth());
        } else if ($popularBased == 'year') {
            $query2 = $query1->whereDate('created_at', '>', \Carbon\Carbon::now()->subYear());
        }

        if ($order == 'latest') {
            $query3 = $query2->latest();
        } else if ($order == 'oldest') {
            $query3 = $query2->oldest();
        } else if ($order == 'popular') {
            $query3 = $query2->orderBy('post_hits', 'desc');
        } else {
            $query3 = $query2->inRandomOrder();
        }

        return $query3->limit($numOfPosts)->get();
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
            ]);
        }

        if ($request->filled('image_url')) {
            $postImageMeta = json_encode([
                'image_url' => $request->image_url,
            ]);
        }

        if ($request->has('post_source')) {
            if ($request->post_type == 'video_file') {
                
                $filepond = app(\Sopamo\LaravelFilepond\Filepond::class);
                $disk = config('filepond.temporary_files_disk');

                $path = $filepond->getPathFromServerId($request->post_source);

                $fullpath = Storage::disk($disk)->get($path);

                $string = Str::of($path)->explode('/');
                $filename = Str::random(10) . '-' . $string->last();

                $finalLocation = 'videos/' . $filename;

                $this->diskStorage()->put($finalLocation, $fullpath);
                $this->diskStorage()->deleteDirectory($string->first());

                $postSource = $filename;
            } else if ($request->post_type == 'video_embed') {
                $postSource = json_encode($request->post_source);
            } else {
                $postSource = $request->post_source;
            }
        } else {
            $postSource = '';
        }

        $post = Post::create([
            'post_title'       => strip_tags($request->post_title),
            'post_summary'     => $request->post_summary,
            'post_content'     => $request->post_content,
            'meta_description' => strip_tags($request->meta_description),
            'meta_keyword'     => strip_tags($request->meta_keyword),
            'post_status'      => $request->has('draft') ? 'draft' : 'publish',
            'post_visibility'  => $request->post_visibility,
            'post_hits'        => 0,
            'post_author'      => Auth::id(),
            'post_language'    => $request->integer('post_language'),
            'post_type'        => $request->post_type,
            'post_image'       => $request->image_name ?: null,
            'post_source'      => $postSource,
            'post_image_meta'  => $postImageMeta
        ]);

        $this->addTranslation($post, $request);
        $this->attachCategories($request, $post);
        $this->attachTags($request, $post);
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
        $post = Post::findOrFail($id);

        $post_name = $post->post_name;

        if ($post->post_name != $request->slug) {
            $post_name = SlugService::createSlug(Post::class, 'post_name', $request->slug);
        }

        $data = array(
            'post_title'       => strip_tags($request->post_title),
            'post_name'        => $post_name,
            'post_summary'     => $request->post_summary,
            'post_content'     => $request->post_content,
            'post_type'        => $request->post_type,
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
                'image_url' => null
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
                'image_url' => $request->image_url
            ]);
        }

        if ($request->has('post_source')) {
            if ($request->post_type == 'video_file') {
                $filepond = app(\Sopamo\LaravelFilepond\Filepond::class);
                $disk = config('filepond.temporary_files_disk');

                $path = $filepond->getPathFromServerId($request->post_source);

                $fullpath = Storage::disk($disk)->get($path);

                $string = Str::of($path)->explode('/');
                $filename = Str::random(10).'-'.$string->last();

                $finalLocation = 'videos/' . $filename;

                $this->diskStorage()->put($finalLocation, $fullpath);
                $this->diskStorage()->deleteDirectory($string->first());

                $data['post_source'] = $filename;

                $this->deleteFile('videos', $post->post_source);
            } else if ($request->post_type == 'video_embed') {
                $data['post_source'] = json_encode($request->post_source);
            } else {
                $data['post_source'] = $request->post_source;
            }
        }

        Post::where('id', $id)->update($data);

        $terms = $this->syincTerms($request);

        if ($request->filled('categories') OR $request->filled('tags')) {
            $post->terms()
                ->sync($terms);
        }
    }
}
