<?php

namespace App\Traits;

use App\Models\Term;
use App\Models\Theme;
use Illuminate\Support\Arr;

trait WidgetTrait
{
    use ImageTrait, FormInputTrait;

    /**
     * @param $layout
     * @return string[]
     */
    public function about($layout=null)
    {
        return [
            'title' => '',
            'logo' => 'false',
            'link' => 'false',
            'active' => 'true'
        ];
    }

    /**
     * @param $layout
     * @return string[]
     */
    public function social_media_link($layout=null)
    {
        return [
            'title' => '',
            'description' => '',
            'active' => 'true'
        ];
    }

    /**
     * @param $layout
     * @return string[]
     */
    public function menu_link($layout=null)
    {
        return [
            'active' => 'true'
        ];
    }

    /**
     * @param $layout
     * @return array
     */
    public function term($layout=null)
    {
        return [
            'title' => '',
            'description' => '',
            'term_type' => 'category',
            'layout_type' => 'lists',
            'order' => 'latest',
            'popular_based' => 'all',
            'number_of_posts' => 5,
            'active' => 'true',
        ];
    }
    
    /**
     * list_label
     *
     * @return void
     */
    public function list_label()
    {
        return [
            'active'          => 'true',
            'term_type'       => 'category',
            'layout_type'     => 'ordered-lists',
            'layout_type'     => 'ordered-lists',
            'order'           => 'latest',
            'popular_based'   => 'all',
            'number_of_posts' => 5,
            'title'           => '',
            'description'     => '',
        ];
    }
    
    /**
     * box_label
     *
     * @return void
     */
    public function box_label()
    {
        return [
            'title' => '',
            'term_type' => 'category',
            'layout_type' => 'box',
            'order' => 'latest',
            'popular_based' => 'all',
            'number_of_posts' => 5,
            'active' => 'true',
        ];
    }

    /**
     * @param $layout
     * @return string[]
     */
    public function newsletter($layout=null)
    {
        return [
            'active' => 'true',
            'title' => '',
            'description' => '',
            'layout_type' => 'card'
        ];
    }

    /**
     * @param $layout
     * @return string[]
     */
    public function newsletter_sidebar($layout=null)
    {
        return [
            'active' => 'true',
            'title' => '',
            'description' => '',
            'layout_type' => 'card'
        ];
    }

    /**
     * @param $layout
     * @param $request
     * @return array
     */
    public function post($layout=null, $request=null)
    {
        return [
            'post_type'         => 'post',
            'category'          => 'none',
            'carousel'          => 'false',
            'carousel_autoplay' => 'none',
            'layout_type'       => 'one-column',
            'title'             => '',
            'description'       => '',
            'order'             => 'latest',
            'popular_based'     => 'none',
            'number_of_posts'   => 4,
            'active'            => 'true'
        ];
    }
    
    /**
     * mini_post
     *
     * @param  mixed $layout
     * @param  mixed $request
     * @return void
     */
    public function mini_post($layout = null, $request = null)
    {
        return [
            'post_type'         => 'post',
            'category'          => 'none',
            'carousel'          => 'true',
            'carousel_autoplay' => 'true',
            'layout_type'       => 'vertical-slider',
            'title'             => '',
            'description'       => '',
            'order'             => 'latest',
            'popular_based'     => 'none',
            'number_of_posts'   => 4,
            'active'            => 'true'
        ];
    }
    
    /**
     * video
     *
     * @return void
     */
    public function video()
    {
        return [
            'post_type'         => 'video',
            'category'          => 'none',
            'carousel'          => 'false',
            'carousel_autoplay' => 'none',
            'layout_type'       => 'one-column',
            'title'             => '',
            'description'       => '',
            'order'             => 'latest',
            'popular_based'     => 'none',
            'number_of_posts'   => 4,
            'active'            => 'true'
        ];
    }
    
    /**
     * audio
     *
     * @return void
     */
    public function audio()
    {
        return [
            'post_type'         => 'audio',
            'category'          => 'none',
            'carousel'          => 'false',
            'carousel_autoplay' => 'none',
            'layout_type'       => 'one-column',
            'title'             => '',
            'description'       => '',
            'order'             => 'latest',
            'popular_based'     => 'none',
            'number_of_posts'   => 4,
            'active'            => 'true'
        ];
    }
    
    /**
     * post_sidebar
     *
     * @return void
     */
    public function post_sidebar()
    {
        return [
            'post_type'         => 'post',
            'category'          => 'none',
            'carousel'          => 'false',
            'carousel_autoplay' => 'none',
            'layout_type'       => 'regular-list-posts',
            'title'             => '',
            'description'       => '',
            'order'             => 'latest',
            'popular_based'     => 'none',
            'number_of_posts'   => 4,
            'active'            => 'true'
        ];
    }
    
    /**
     * video_sidebar
     *
     * @return void
     */
    public function video_sidebar()
    {
        return [
            'post_type'         => 'video',
            'category'          => 'none',
            'carousel'          => 'false',
            'carousel_autoplay' => 'none',
            'layout_type'       => 'regular-list-posts',
            'title'             => '',
            'description'       => '',
            'order'             => 'latest',
            'popular_based'     => 'none',
            'number_of_posts'   => 4,
            'active'            => 'true'
        ];
    }
    
    /**
     * audio_sidebar
     *
     * @return void
     */
    public function audio_sidebar()
    {
        return [
            'post_type'         => 'audio',
            'category'          => 'none',
            'carousel'          => 'false',
            'carousel_autoplay' => 'none',
            'layout_type'       => 'regular-list-posts',
            'title'             => '',
            'description'       => '',
            'order'             => 'latest',
            'popular_based'     => 'none',
            'number_of_posts'   => 4,
            'active'            => 'true'
        ];
    }
    
    /**
     * post_footer
     *
     * @return void
     */
    public function post_footer()
    {
        return [
            'post_type'         => 'post',
            'category'          => 'none',
            'carousel'          => 'false',
            'carousel_autoplay' => 'none',
            'layout_type'       => 'list-post-with-link',
            'title'             => '',
            'description'       => '',
            'order'             => 'latest',
            'popular_based'     => 'none',
            'number_of_posts'   => 4,
            'active'            => 'true'
        ];
    }

    /**
     * @param $layout
     * @return array
     */
    public function post_carousel($layout=null)
    {
        return [
            'post_type'         => 'post',
            'category'          => 'none',
            'carousel'          => 'true',
            'carousel_autoplay' => 'true',
            'layout_type'       => 'vertical-slider',
            'title'             => '',
            'description'       => '',
            'order'             => 'latest',
            'popular_based'     => 'none',
            'number_of_posts'   => 4,
            'active'            => 'true'
        ];
    }

    /**
     * @param $layout
     * @return string[]
     */
    public function ads($layout=null)
    {
        return [
            'active'                   => 'true',
            'title'                    => '',
            'ad_type'                  => 'image',
            'ga_client'                => '',
            'ga_slot'                  => '',
            'ga_size'                  => '',
            'ga_format'                => '',
            'ga_full_width_responsive' => '',
            'ad_width'                 => '',
            'ad_height'                => '',
            'ad_image'                 => '',
            'ad_url'                   => '',
            'ad_script'                => ''
        ];
    }
    
    /**
     * ads_sidebar
     *
     * @param  mixed $layout
     * @return void
     */
    public function ads_sidebar($layout = null)
    {
        return $this->ads();
    }

     // UPDATE

    /**
     * @param $arrSetting
     * @param $layout
     * @param $locate
     * @param $request
     * @return mixed
     */
    public function postUpdate($arrSetting, $layout, $locate, $request)
    {
        $title      = count(array_filter($request->title)) > 0 ? $request->title : '';
        $postType   = $request->filled('post_type') ? $request->post_type : 'none';
        $category   = $request->filled('category') ? Term::find($request->category)->slug : 'none';
        $popular    = $request->filled('popular_based') ? $request->popular_based : 'none';
        $layoutType = $request->type == 'section' ? 'vertical-slider' : $request->layout_type;

        Arr::set($arrSetting, $locate.'.post_type', $postType);
        Arr::set($arrSetting, $locate.'.category', $category);
        Arr::set($arrSetting, $locate.'.layout_type', $layoutType);
        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.order', $request->order);
        Arr::set($arrSetting, $locate.'.popular_based', $popular);
        Arr::set($arrSetting, $locate.'.number_of_posts', $request->number_of_posts);

        return $arrSetting;
    }

        /**
     * @param $arrSetting
     * @param $layout
     * @param $locate
     * @param $request
     * @return mixed
     */
    public function postsUpdate($arrSetting, $layout, $locate, $request)
    {
        return $this->postUpdate($arrSetting, $layout, $locate, $request);
    }

    public function mini_postUpdate($arrSetting, $layout, $locate, $request)
    {
        $title      = count(array_filter($request->title)) > 0 ? $request->title : '';
        $postType   = $request->filled('post_type') ? $request->post_type : 'none';
        $category   = $request->filled('category') ? Term::find($request->category)->slug : 'none';
        $popular    = $request->filled('popular_based') ? $request->popular_based : 'none';
        $layoutType = $request->type == 'section' ? 'vertical-slider' : $request->layout_type;

        Arr::set($arrSetting, $locate . '.post_type', $postType);
        Arr::set($arrSetting, $locate . '.category', $category);
        Arr::set($arrSetting, $locate . '.layout_type', $layoutType);
        Arr::set($arrSetting, $locate . '.title', $title);
        Arr::set($arrSetting, $locate . '.order', $request->order);
        Arr::set($arrSetting, $locate . '.popular_based', $popular);
        Arr::set($arrSetting, $locate . '.number_of_posts', $request->number_of_posts);

        return $arrSetting;
    }
    
    /**
     * post_sidebarUpdate
     *
     * @param  mixed $arrSetting
     * @param  mixed $layout
     * @param  mixed $locate
     * @param  mixed $request
     * @return void
     */
    public function post_sidebarUpdate($arrSetting, $layout, $locate, $request)
    {
        $title      = count(array_filter($request->title)) > 0 ? $request->title : '';
        $postType   = $request->filled('post_type') ? $request->post_type : 'none';
        $category   = $request->filled('category') ? Term::find($request->category)->slug : 'none';
        $popular    = $request->filled('popular_based') ? $request->popular_based : 'none';
        $layoutType = $request->layout_type;

        Arr::set($arrSetting, $locate.'.post_type', $postType);
        Arr::set($arrSetting, $locate.'.category', $category);
        Arr::set($arrSetting, $locate.'.layout_type', $layoutType);
        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.order', $request->order);
        Arr::set($arrSetting, $locate.'.popular_based', $popular);
        Arr::set($arrSetting, $locate.'.number_of_posts', $request->number_of_posts);

        return $arrSetting;
    }
    
    /**
     * videoUpdate
     *
     * @param  mixed $arrSetting
     * @param  mixed $layout
     * @param  mixed $locate
     * @param  mixed $request
     * @return void
     */
    public function videoUpdate($arrSetting, $layout, $locate, $request)
    {
        $title      = count(array_filter($request->title)) > 0 ? $request->title : '';
        $postType   = $request->filled('post_type') ? $request->post_type : 'none';
        $category   = $request->filled('category') ? Term::find($request->category)->slug : 'none';
        $popular    = $request->filled('popular_based') ? $request->popular_based : 'none';
        $layoutType = $request->layout_type;

        Arr::set($arrSetting, $locate.'.post_type', $postType);
        Arr::set($arrSetting, $locate.'.category', $category);
        Arr::set($arrSetting, $locate.'.layout_type', $layoutType);
        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.order', $request->order);
        Arr::set($arrSetting, $locate.'.popular_based', $popular);
        Arr::set($arrSetting, $locate.'.number_of_posts', $request->number_of_posts);

        return $arrSetting;
    }
    
    /**
     * video_sidebarUpdate
     *
     * @param  mixed $arrSetting
     * @param  mixed $layout
     * @param  mixed $locate
     * @param  mixed $request
     * @return void
     */
    public function video_sidebarUpdate($arrSetting, $layout, $locate, $request)
    {
        $title      = count(array_filter($request->title)) > 0 ? $request->title : '';
        $postType   = $request->filled('post_type') ? $request->post_type : 'none';
        $category   = $request->filled('category') ? Term::find($request->category)->slug : 'none';
        $popular    = $request->filled('popular_based') ? $request->popular_based : 'none';
        $layoutType = $request->layout_type;

        Arr::set($arrSetting, $locate.'.post_type', $postType);
        Arr::set($arrSetting, $locate.'.category', $category);
        Arr::set($arrSetting, $locate.'.layout_type', $layoutType);
        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.order', $request->order);
        Arr::set($arrSetting, $locate.'.popular_based', $popular);
        Arr::set($arrSetting, $locate.'.number_of_posts', $request->number_of_posts);

        return $arrSetting;
    }
    
    /**
     * audioUpdate
     *
     * @param  mixed $arrSetting
     * @param  mixed $layout
     * @param  mixed $locate
     * @param  mixed $request
     * @return void
     */
    public function audioUpdate($arrSetting, $layout, $locate, $request)
    {
        return $this->videoUpdate($arrSetting, $layout, $locate, $request);
    }

    public function related_postUpdate($arrSetting, $layout, $locate, $request)
    {

        $title   = count(array_filter($request->title)) > 0 ? $request->title : '';
        $popular = $request->filled('popular_based') ? $request->popular_based : 'none';

        Arr::set($arrSetting, $locate . '.title', $title);
        Arr::set($arrSetting, $locate . '.order', $request->order);
        Arr::set($arrSetting, $locate . '.popular_based', $popular);
        Arr::set($arrSetting, $locate . '.number_of_posts', $request->number_of_posts);

        return $arrSetting;
    }
    
    /**
     * newsletter_sidebarUpdate
     *
     * @param  mixed $arrSetting
     * @param  mixed $layout
     * @param  mixed $locate
     * @param  mixed $request
     * @return void
     */
    public function newsletter_sidebarUpdate($arrSetting, $layout, $locate, $request)
    {
        $title       = count(array_filter($request->title)) > 0 ? $request->title : '';
        $description = count(array_filter($request->description)) > 0 ? $request->description : '';
       
        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.description', $description);

        return $arrSetting;
    }

    /**
     * @param $arrSetting
     * @param $layout
     * @param $locate
     * @param $request
     * @return mixed
     */
    public function headlineUpdate($arrSetting, $layout, $locate, $request)
    {
        if ($layout == 'sidebar') {
            $layoutTypeAlt = 'list-sidebar';
        } else if ($layout == 'footer') {
            $layoutTypeAlt = 'list-footer';
        } else {
            $layoutTypeAlt = 'lists';
        }

        if ($request->filled('title')) {
            $title = count(array_filter($request->title)) > 0 ? $request->title : '';
        } else {
            $title = '';
        }

        $postType   = $request->filled('post_type') ? $request->post_type : 'none';
        $category   = $request->filled('category') ? Term::find($request->category)->slug : 'none';
        $popular    = $request->filled('popular_based') ? $request->popular_based : 'none';
        $layoutType = $request->filled('layout_type') ? $request->popular_based : $layoutTypeAlt;

        Arr::set($arrSetting, $locate.'.carousel_autoplay', $request->carousel_autoplay);
        Arr::set($arrSetting, $locate.'.post_type', $postType);
        Arr::set($arrSetting, $locate.'.category', $category);
        Arr::set($arrSetting, $locate.'.layout_type', $layoutType);
        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.order', $request->order);
        Arr::set($arrSetting, $locate.'.popular_based', $popular);
        Arr::set($arrSetting, $locate.'.number_of_posts', $request->number_of_posts);

        return $arrSetting;
    }

    /**
     * @param $arrSetting
     * @param $layout
     * @param $locate
     * @param $request
     * @return mixed
     */
    public function featuredUpdate($arrSetting, $layout, $locate, $request)
    {
        return $this->headlineUpdate($arrSetting, $layout, $locate, $request);
    }

    /**
     * @param $arrSetting
     * @param $layout
     * @param $locate
     * @param $request
     * @return mixed
     */
    public function post_carouselUpdate($arrSetting, $layout, $locate, $request)
    {
        $title      = count(array_filter($request->title)) > 0 ? $request->title : '';
        $postType   = $request->filled('post_type') ? $request->post_type : 'post-carousel';
        $category   = $request->filled('category') ? Term::find($request->category)->slug : 'none';
        $popular    = $request->filled('popular_based') ? $request->popular_based : 'none';
        $layoutType = $request->filled('layout_type') ? $request->layout_type : 'none';

        Arr::set($arrSetting, $locate.'.carousel_autoplay', $request->carousel_autoplay);
        Arr::set($arrSetting, $locate.'.post_type', $postType);
        Arr::set($arrSetting, $locate.'.category', $category);
        Arr::set($arrSetting, $locate.'.layout_type', $layoutType);
        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.order', $request->order);
        Arr::set($arrSetting, $locate.'.popular_based', $popular);
        Arr::set($arrSetting, $locate.'.number_of_posts', $request->number_of_posts);

        return $arrSetting;
    }

    /**
     * @param $arrSetting
     * @param $layout
     * @param $locate
     * @param $request
     * @return mixed
     */
    public function bottom_postUpdate($arrSetting, $layout, $locate, $request)
    {
        return $this->post_carouselUpdate($arrSetting, $layout, $locate, $request);
    }

    public function post_footerUpdate($arrSetting, $layout, $locate, $request)
    {
        $title      = count(array_filter($request->title)) > 0 ? $request->title : '';
        $postType   = $request->filled('post_type') ? $request->post_type : 'none';
        $category   = $request->filled('category') ? Term::find($request->category)->slug : 'none';
        $popular    = $request->filled('popular_based') ? $request->popular_based : 'none';

        Arr::set($arrSetting, $locate.'.post_type', $postType);
        Arr::set($arrSetting, $locate.'.category', $category);
        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.order', $request->order);
        Arr::set($arrSetting, $locate.'.popular_based', $popular);
        Arr::set($arrSetting, $locate.'.number_of_posts', $request->number_of_posts);

        return $arrSetting;
    }
    
    /**
     * aboutUpdate
     *
     * @param  mixed $arrSetting
     * @param  mixed $layout
     * @param  mixed $locate
     * @param  mixed $request
     * @return void
     */
    public function aboutUpdate($arrSetting, $layout, $locate, $request)
    {
        $title = count(array_filter($request->title)) > 0 ? $request->title : '';

        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.logo', $request->logo);
        Arr::set($arrSetting, $locate.'.link', $request->link);

        return $arrSetting;
    }
    
    /**
     * linksUpdate
     *
     * @param  mixed $arrSetting
     * @param  mixed $layout
     * @param  mixed $locate
     * @param  mixed $request
     * @return void
     */
    public function linksUpdate($arrSetting, $layout, $locate, $request)
    {
        $title = count(array_filter($request->title)) > 0 ? $request->title : '';
        $description = count(array_filter($request->description)) > 0 ? $request->description : '';

        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.description', $description);

        return $arrSetting;
    }
    
    /**
     * box_labelUpdate
     *
     * @param  mixed $arrSetting
     * @param  mixed $layout
     * @param  mixed $locate
     * @param  mixed $request
     * @return void
     */
    public function box_labelUpdate($arrSetting, $layout, $locate, $request)
    {
        $title   = count(array_filter($request->title)) > 0 ? $request->title: '';
        $popular = $request->filled('popular_based') ? $request->popular_based : 'none';

        Arr::set($arrSetting, $locate.'.term_type', $request->term_type);
        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.order', $request->order);
        Arr::set($arrSetting, $locate.'.popular_based', $popular);
        Arr::set($arrSetting, $locate.'.number_of_posts', $request->number_of_posts);

        return $arrSetting;
    }
    
    /**
     * newsletter_footerUpdate
     *
     * @param  mixed $arrSetting
     * @param  mixed $layout
     * @param  mixed $locate
     * @param  mixed $request
     * @return void
     */
    public function newsletter_footerUpdate($arrSetting, $layout, $locate, $request)
    {
        $title = count(array_filter($request->title)) > 0 ? $request->title : '';
        $description = count(array_filter($request->description)) > 0 ? $request->description : '';

        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.description', $description);

        return $arrSetting;
    }

    /**
     * @param $arrSetting
     * @param $layout
     * @param $locate
     * @param $request
     * @return mixed
     */
    public function termUpdate($arrSetting, $layout, $locate, $request)
    {
        $title = count(array_filter($request->title)) > 0 ? $request->title : '';
        $popular = $request->filled('popular_based') ? $request->popular_based : 'none';

        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.term_type', $request->term_type);
        Arr::set($arrSetting, $locate.'.order', $request->order);
        Arr::set($arrSetting, $locate.'.popular_based', $popular);
        Arr::set($arrSetting, $locate.'.number_of_posts', $request->number_of_posts);

        return $arrSetting;
    }

    /**
     * @param $arrSetting
     * @param $layout
     * @param $locate
     * @param $request
     * @return mixed
     */
    public function disqusUpdate($arrSetting, $layout, $locate, $request)
    {
        $title = count(array_filter($request->title)) > 0 ? $request->title : '';

        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.disqus_short_name', $request->disqus_short_name);

        return $arrSetting;
    }
    
    /**
     * contactConfigUpdate
     *
     * @param  mixed $locate
     * @param  mixed $request
     * @return void
     */
    public function contactConfigUpdate($arrSetting, $locate, $request)
    {
        $title = count(array_filter($request->title)) > 0 ? $request->title : '';
        $url = count(array_filter($request->url)) > 0 ? $request->url : '';

        Arr::set($arrSetting, $locate . '.title', $title);
        Arr::set($arrSetting, $locate . '.url', $url);

        return $arrSetting;
    }

    /**
     * @param $arrSetting
     * @param $layout
     * @param $locate
     * @param $request
     * @return mixed
     */
    public function mapUpdate($arrSetting, $layout, $locate, $request)
    {
        Arr::set($arrSetting, $locate.'.google_map_code', $request->google_map_code);

        return $arrSetting;
    }

    /**
     * @param $arrSetting
     * @param $layout
     * @param $locate
     * @param $request
     * @return mixed
     */
    public function adsUpdate($arrSetting, $layout, $locate, $request)
    {
        $title = count(array_filter($request->title)) > 0 ? $request->title : '';

        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.ad_type', $request->ad_type ?: 'image');

        if ($request->ad_type == 'image') {
            Arr::set($arrSetting, $locate.'.ga_client', '');
            Arr::set($arrSetting, $locate.'.ga_slot', '');
            Arr::set($arrSetting, $locate.'.ga_size', '');
            Arr::set($arrSetting, $locate.'.ga_format', '');
            Arr::set($arrSetting, $locate.'.ga_full_width_responsive', '');
            Arr::set($arrSetting, $locate.'.ad_width', $request->ad_width ?: '');
            Arr::set($arrSetting, $locate.'.ad_height', $request->ad_height ?: '');
            Arr::set($arrSetting, $locate.'.ad_image', $request->image);
            Arr::set($arrSetting, $locate.'.ad_url', $request->ad_url ?: '');
            Arr::set($arrSetting, $locate.'.ad_script', '');
        }

        if ($request->ad_typ == 'google_adsense') {
            Arr::set($arrSetting, $locate.'.ga_client', $request->ga_client);
            Arr::set($arrSetting, $locate.'.ga_slot', $request->ga_slot);
            Arr::set($arrSetting, $locate.'.ga_size', $request->ga_size);
            Arr::set($arrSetting, $locate.'.ga_format', $request->ga_format);
            Arr::set($arrSetting, $locate.'.ga_full_width_responsive', $request->ga_full_width_responsive);
            Arr::set($arrSetting, $locate.'.ad_width', '');
            Arr::set($arrSetting, $locate.'.ad_height', '');
            Arr::set($arrSetting, $locate.'.ad_image', '');
            Arr::set($arrSetting, $locate.'.ad_url', '');
            Arr::set($arrSetting, $locate.'.ad_script', '');
        }

        if ($request->ad_type == 'script') {
            Arr::set($arrSetting, $locate.'.ga_client', '');
            Arr::set($arrSetting, $locate.'.ga_slot', '');
            Arr::set($arrSetting, $locate.'.ga_size', '');
            Arr::set($arrSetting, $locate.'.ga_format', '');
            Arr::set($arrSetting, $locate.'.ga_full_width_responsive', '');
            Arr::set($arrSetting, $locate.'.ad_width', '');
            Arr::set($arrSetting, $locate.'.ad_height', '');
            Arr::set($arrSetting, $locate.'.ad_image', '');
            Arr::set($arrSetting, $locate.'.ad_url', '');
            Arr::set($arrSetting, $locate.'.ad_script', $request->ad_script);
        }

        return $arrSetting;
    }
    
    /**
     * ads_sidebarUpdate
     *
     * @param  mixed $arrSetting
     * @param  mixed $layout
     * @param  mixed $locate
     * @param  mixed $request
     * @return void
     */
    public function ads_sidebarUpdate($arrSetting, $layout, $locate, $request) 
    {
        return $this->adsUpdate($arrSetting, $layout, $locate, $request);
    }

    // MODAL

    /**
     * @param $layout
     * @param $data
     * @return string
     */
    public function termModal($data)
    {
        $html = $this->termTypeInput($data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);


        $orders = [
            'latest' => 'Latest',
            'oldest' => 'Oldest',
            'popular' => 'Popular',
            'random' => 'Random'
        ];

        $populars = [
            'all' => 'All',
            'day' => 'Day',
            'week' => 'Week',
            'month' => 'Month',
            'year' => 'Year'
        ];

        $none = $data['order'] == 'popular' ?: 'd-none';


        $html .= '<div id="_wm_layout_type_el" class="form-group d-none">
            <label for="_wm_layout_type">'.__('form.layout_type').'</label>
            <select id="_wm_layout_type"
                    name="layout_type"
                    class="select2"
                    data-placeholder="'.__('form.select_layout_type').'"
                    style="width: 100%"></select>
        </div>
        <div id="_wm_title_el" class="form-group">
            <label for="_wm_title">'.__('form.title').'</label>
            <input id="_wm_title" type="text" class="form-control" name="title" value="'.$data['title'].'">
        </div>
        <div id="_wm_description_el" class="form-group d-none">
            <label for="_wm_description">'.__('form.description').'</label>
            <textarea name="description" id="_wm_description" class="form-control" rows="5"></textarea>
        </div>
        <div id="_wm_order_el" class="form-group">
            <label for="_wm_order">'.__('form.order').'</label>
            <select id="_wm_order" class="form-control" name="order">';
        foreach($orders as $index => $order) {
            if ($index == $data['order']) {
                $html .= '<option value="'.$index.'" selected>'.$order.'</option>';
            } else {
                $html .= '<option value="'.$index.'">'.$order.'</option>';
            }
        }
        $html .= '</select>
        </div>
        <div id="_wm_popular_based_el" class="form-group '.$none.'">
            <label for="_wm_popular_based">'.__('form.popular').'</label>
            <select id="_wm_popular_based" class="form-control" name="popular_based">';
        foreach($populars as $index => $popular) {
            if ($index == $data['popular_based']) {
                $html .= '<option value="'.$index.'" selected>'.$popular.'</option>';
            } else {
                $html .= '<option value="'.$index.'">'.$popular.'</option>';
            }
        }
        $html .= '</select>
        </div>
        <div id="_wm_number_of_posts_el" class="form-group">
            <label for="_wm_number_of_posts">'.__('form.number_of_posts').'</label>
            <input type="number" min="0" class="form-control" id="_wm_number_of_posts" name="number_of_posts" value="'.$data['number_of_posts'].'">
        </div>';

        return $html;
    }

    /**
     * @param $layout
     * @param $data
     * @return string
     */
    public function mapModal($data)
    {
        return $this->googleMapCodeInput($data);
    }

    /**
     * @param $layout
     * @param $data
     * @return string
     */
    public function disqusModal($data)
    {
        $html = $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->disqusInput($data);
        
        return $html;
    }
    
    /**
     * post_sidebarModal
     *
     * @param  mixed $data
     * @return void
     */
    public function post_sidebarModal($data)
    {
        $html = $this->postTypeInput('post', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->layoutTypeInput('post_sidebar', $data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);

        return $html;
    }
    
    /**
     * video_sidebarModal
     *
     * @param  mixed $data
     * @return void
     */
    public function video_sidebarModal($data)
    {
        $html = $this->postTypeInput('video', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->layoutTypeInput('video_sidebar', $data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);

        return $html;
    }
    
    /**
     * audio_sidebarModal
     *
     * @param  mixed $data
     * @return void
     */
    public function audio_sidebarModal($data)
    {
        
        $html = $this->postTypeInput('audio', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->layoutTypeInput('audio_sidebar', $data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);

        return $html;
    }
    
    /**
     * post_footerModal
     *
     * @param  mixed $data
     * @return void
     */
    public function post_footerModal($data)
    {
       
        $html = $this->postTypeInput('post', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);

        return $html;
    }
    
    /**
     * box_labelModal
     *
     * @param  mixed $data
     * @return void
     */
    public function box_labelModal($data)
    {
        $html = $this->termTypeInput($data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);

        return $html;
    }


    /**
     * @param $data
     * @return string
     */
    public function newsletter_sidebarModal($data)
    {
        $html = $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->descriptionInput($data);

        return $html;
    }

    /**
     * @param $data
     * @return string
     */
    public function newsletter_footerModal($data)
    {
        $html = $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->descriptionInput($data);

        return $html;
    }

    /**
     * @param $data
     * @return string
     */
    public function aboutModal($data)
    {
        $html = $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->logoAboutInput($data);
        $html .= $this->linkAboutInput($data);

        return $html;
    }

    /**
     * @param $data
     * @return string
     */
    public function linksModal($data)
    {
        $html = $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->descriptionInput($data);

        return $html;
    }

    /**
     * @param $widget
     * @param $data
     * @return string
     */
    public function carouselModal($widget, $data)
    {
        $html = $this->postTypeInput('post', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->layoutTypeInput($widget, $data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);
        $html .= $this->carouselAutoplayInput($data);

        return $html;
    }

    /**
     * @param $data
     * @return string
     */
    public function headlineModal($data)
    {
        $html = $this->postTypeInput('post', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);
        $html .= $this->carouselAutoplayInput($data);

        return $html;
    }

    /**
     * @param $data
     * @return string
     */
    public function featuredModal($data)
    {
       return $this->headlineModal($data);
    }

    /**
     * @param $widget
     * @return string
     */
    public function adsModal($widget)
    {
        $html = $this->languageSelect();
        $html .= $this->titleInput($widget);
        $html .= $this->adTypeInput($widget);
        $html .= $this->gaClientInput($widget);
        $html .= $this->gaSlotInput($widget);
        $html .= $this->gaSizeInput($widget);
        $html .= $this->gaFormatInput($widget);
        $html .= $this->gaFullWidthResponsiveInput($widget);
        $html .= $this->adImageInput($widget);
        $html .= $this->adSizeInput($widget);
        $html .= $this->adUrlInput($widget);
        $html .= $this->adScriptInput($widget);

        return $html;
    }

    /**
     * @param $widget
     * @return string
     */
    public function ads_sidebarModal($widget)
    {
        return $this->adsModal($widget);
    }
    
    /**
     * mini_postModal
     *
     * @param  mixed $data
     * @return void
     */
    public function mini_postModal($data) 
    {
        $html = $this->postTypeInput('post', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);
        $html .= $this->carouselInput($data);
        $html .= $this->carouselAutoplayInput($data);

        return $html;
    }
    
    /**
     * list_labelModal
     *
     * @param  mixed $data
     * @return void
     */
    public function list_labelModal($data)
    {
        $html = $this->termTypeInput($data);
        $html .= $this->layoutTypeInput('list_label', $data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);

        return $html;
    }

    /**
     * @param $widget
     * @return string
     */
    public function postsModal($data) 
    {    
        $html = $this->postTypeInput('post', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->layoutTypeInput('posts', $data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);

        return $html;
    }

    /**
     * @param $data
     * @return string
     */
    public function bottom_postModal($data)
    {
        $html = $this->postTypeInput('post', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);
        $html .= $this->carouselAutoplayInput($data);

        return $html;
    }

    /**
     * @param $data
     * @return string
     */
    public function postModal($data)
    {
        $html = $this->postTypeInput('post', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->layoutTypeInput('post', $data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);

        return $html;
    }

    /**
     * @param $data
     * @return string
     */
    public function videoModal($data)
    {
        $html = $this->postTypeInput('video', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->layoutTypeInput('video', $data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);

        return $html;
    }

    /**
     * @param $data
     * @return string
     */
    public function audioModal($data)
    {
        
        $html = $this->postTypeInput('audio', $data);
        $html .= $this->categoryInput($data);
        $html .= $this->layoutTypeInput('audio', $data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);

        return $html;
    }

    /**
     * @param $layout
     * @param $data
     * @return string
     */
    public function related_postModal($data)
    {
        $html = $this->carouselInput($data);
        $html .= $this->carouselAutoplayInput($data);
        $html .= $this->languageSelect();
        $html .= $this->titleInput($data);
        $html .= $this->oderInput($data);
        $html .= $this->popularBasedInput($data);
        $html .= $this->numberOfPostsInput($data);

        return $html;
    }

    /**
     * @param $arrSetting
     * @param $locate
     * @param $item
     * @return void
     */
    public function setPostCarousel($arrSetting, $locate, $item)
    {
        Arr::set($arrSetting, $locate.'.carousel_autoplay', $item->carouselAutoplay);
        Arr::set($arrSetting, $locate.'.post_type', $item->postType);
        Arr::set($arrSetting, $locate.'.category', $item->category);
        Arr::set($arrSetting, $locate.'.layout_type', 'list');
        Arr::set($arrSetting, $locate.'.title', $item->title);
        Arr::set($arrSetting, $locate.'.order', $item->order);
        Arr::set($arrSetting, $locate.'.popular_based', $item->popularBased);
        Arr::set($arrSetting, $locate.'.number_of_posts', $item->numberOfPosts);
    }

    /**
     * @param $arrSetting
     * @param $locate
     * @param $item
     * @return void
     */
    public function setTerm($arrSetting, $locate, $item)
    {
        Arr::set($arrSetting, $locate.'.title', $item->title);
        Arr::set($arrSetting, $locate.'.term_type', $item->termType);
        Arr::set($arrSetting, $locate.'.order', $item->order);
        Arr::set($arrSetting, $locate.'.popular_based', $item->popularBased);
        Arr::set($arrSetting, $locate.'.number_of_posts', $item->numberOfPosts);
    }

    /**
     * @param $theme
     * @param $slug
     * @param $layout
     * @param $request
     * @return mixed
     */
    public function updateMainPost($theme, $slug, $layout, $request)
    {
        $theme = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;

        $title    = $request->title ?: '';
        $postType = $request->filled('post_type') ? $request->post_type : 'none';
        $category = $request->filled('category') ? Term::find($request->category)->slug : 'none';
        $popular  = $request->filled('popular_based') ? $request->popular_based : 'none';

        $locate = $layout.'.widget.'.$request->widget;

        Arr::set($arrSetting, $layout.'.config.'.$request->widget.'.carousel_autoplay', $request->carousel_autoplay);
        Arr::set($arrSetting, $locate.'.post_type', $postType);
        Arr::set($arrSetting, $locate.'.category', $category);
        Arr::set($arrSetting, $locate.'.layout_type', 'list');
        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.order', $request->order);
        Arr::set($arrSetting, $locate.'.popular_based', $popular);
        Arr::set($arrSetting, $locate.'.number_of_posts', $request->number_of_posts);

        return $theme->update([
            'setting' => $arrSetting
        ]);
    }

    /**
     * @param $theme
     * @param $slug
     * @param $layout
     * @param $request
     * @return mixed
     */
    public function updatePostCarousel($theme, $slug, $layout, $request)
    {
        $theme = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;

        $title    = $request->title ?: '';
        $postType = $request->filled('post_type') ? $request->post_type : 'none';
        $category = $request->filled('category') ? Term::find($request->category)->slug: 'none';
        $popular  = $request->filled('popular_based') ? $request->popular_based : 'none';

        if ($request->additional === 'section') {
            $locate = $layout.'.widget.section.'.$request->widget;
        } else {
            $locate = $layout.'.widget.'.$request->widget;
        }

        Arr::set($arrSetting, $locate.'.carousel_autoplay', $request->carousel_autoplay);
        Arr::set($arrSetting, $locate.'.post_type', $postType);
        Arr::set($arrSetting, $locate.'.category', $category);
        Arr::set($arrSetting, $locate.'.layout_type', 'list');
        Arr::set($arrSetting, $locate.'.title', $title);
        Arr::set($arrSetting, $locate.'.order', $request->order);
        Arr::set($arrSetting, $locate.'.popular_based', $popular);
        Arr::set($arrSetting, $locate.'.number_of_posts', $request->number_of_posts);

        return $theme->update([
            'setting' => $arrSetting
        ]);
    }

}
