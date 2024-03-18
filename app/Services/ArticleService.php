<?php

namespace App\Services;

use App\Helpers\LocalizationHelper;
use App\Models\{Post, Term};
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class ArticleService
{    
        
    /**
     * Query
     *
     * @return object
     */
    public function query()
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();
        
        $posts = Post::article()->publish();

        if (Auth::check()) {
            if ($currentUser->hasRole('super-admin')) {
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
                if ($currentUser->can('read-private-post')) {
                    if ($currentUser->hasRole('admin')) {
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
                    if($currentUser->hasRole('author')) {
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
     * currentLanguage
     *
     * @return object
     */
    public function currentLanguage($localeId=null)
    {
        return $this->query()->wherePostLanguage($localeId);
    }


    /**
     * @param $q
     * @return mixed|void
     */
    public function qryDataTable($q)
    {
        /** @var object User */
        $currentUser = Auth::user();

        if ($currentUser->can('read-private-post')) {
            if ($currentUser->hasRole('admin')) {
                return $q->where(function($query) {
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
                })->latest()->newQuery();
            }else{
                return $q->latest()->newQuery();
            }
        } else {
            if($currentUser->hasRole('author')) {
                return $q->where(function ($query) {
                    $query->public()
                        ->orWhere(function($r){
                            $r->whereHas('user.roles', function(Builder $p){
                                $p->whereName('author');
                            })->private()->where('post_author', Auth::id());
                        });
                })->latest()->newQuery();
            }
        }
    }


    /**
     * @param $language
     * @return mixed
     */
    public function dynamicLanguage($language,$postType=null)
    {
        /** @var object Post */
        $post = $this->query($postType);

        return $post->wherePostLanguage($language);
    }
    
    /**
     * dynamicQuery
     *
     * @param  mixed $page
     * @param  mixed $layout
     * @param  mixed $widgetName
     * @param  mixed $widgetData
     * @return void
     */
    public function dynamicQuery($page, $layout, $widgetName, $widgetData, $localeId)
    {
        $query = $this->currentLanguage($localeId);

        $postType     = $widgetData['post_type'];
        $category     = $widgetData['category'];
        $popularBased = $widgetData['popular_based'];
        $order        = $widgetData['order'];
        $numOfPosts   = $widgetData['number_of_posts'];

        if ($postType == 'post') {
            $query1 = $query;
        } else {
            $term = Term::category()->where('slug', $category)->first();
            $query1 = $term ? $term->posts()->where('post_language', $localeId) : null;
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
            $query3 = $query2->orderBy('post_hits', 'DESC');
        } else {
            $query3 = $query2->inRandomOrder();
        }

        return $query3->limit($numOfPosts)->get();
    }
    
    /**
     * dynamicQueryWidget
     *
     * @param  mixed $theme
     * @param  mixed $type
     * @param  mixed $section
     * @param  mixed $side
     * @param  mixed $postType
     * @return void
     */
    public function dynamicQueryWidget($theme, $type, $section, $side, $postType=null)
    {
        $languageId = LocalizationHelper::getCurrentLocaleId();
        $query = $this->currentLanguage($postType);

        $arrSetting = $theme->first()->setting;

        $postType = Arr::get($arrSetting, $type.'.'.$section.'.'.$side.'.post_type');
        $category = Arr::get($arrSetting, $type.'.'.$section.'.'.$side.'.category');
        $order = Arr::get($arrSetting, $type.'.'.$section.'.'.$side.'.order');
        $numOfPosts = Arr::get($arrSetting, $type.'.'.$section.'.'.$side.'.number_of_posts');

        if ($postType == 'post') {
            $query1 = (clone $query);
        } else {
            $term = Term::category()->where('slug', $category)->first();
            $query1 = $term->posts()->where('post_language', $languageId);
        }

        if ($order == 'latest') {
            $query2 = $query1->latest();
        } else if ($order == 'oldest') {
            $query2 = $query1->oldest();
        } else if ($order == 'popular') {
            $query2 = $query1->orderBy('post_hits', 'desc');
        } else {
            $query2 = $query1->inRandomOrder();
        }

        return $query2->limit($numOfPosts)->get();
    }
    
    /**
     * getContent
     *
     * @param  mixed $arrSetting
     * @param  mixed $location
     * @param  mixed $widget
     * @param  mixed $postType
     * @return void
     */
    public function getContent($arrSetting, $location, $widget, $postType=null)
    {
        $languageId = LocalizationHelper::getCurrentLocaleId();
        $query = $this->currentLanguage($postType);

        $postType = Arr::get($arrSetting, $location . '.' . $widget . '.post_type');
        $category = Arr::get($arrSetting, $location . '.' . $widget . '.category');;
        $order = Arr::get($arrSetting, $location . '.' . $widget . '.order');;
        $popularBased  = Arr::get($arrSetting, $location . '.' . $widget . '.popular_based');
        $numberOfPosts = Arr::get($arrSetting, $location.'.'.$widget.'.number_of_posts');

        if ($postType == 'post') {
            $query1 = (clone $query);
        } else {
            $term = Term::category()->where('slug', $category)->first();
            $query1 = $term->posts()->where('post_language', $languageId);
        }

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

        return $query3->limit($numberOfPosts)->get();
    }
    
    /**
     * relatedPosts
     *
     * @param  mixed $post
     * @param  mixed $widgetData
     * @return void
     */
    public function relatedPosts($post, $widgetData)
    {
        $languageId = LocalizationHelper::getCurrentLocaleId();

        $popularBased = $widgetData['popular_based'];
        $order        = $widgetData['order'];
        $numOfPosts   = $widgetData['number_of_posts'];

        if ($post->terms()->category()->first()) {
            $term_id = $post->terms->first()->id;
            $query = Term::with('posts')->find($term_id);
            $query1 = $query->posts()->where('post_language', $languageId);
        } else {
            /** @var \App\Models\L */
            $query = $this->currentLanguage();
            $query1 = $query->with('terms')
                ->whereDoesnthave('terms', function ($query) {
                    $query->category();
            });
        }

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

}
