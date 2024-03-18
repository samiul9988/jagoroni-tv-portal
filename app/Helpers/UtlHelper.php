<?php

namespace App\Helpers;

use App\Models\{Setting, Theme};
use App\Traits\SettingTrait;
use Illuminate\Support\{Arr, Carbon, Str};
use Illuminate\Support\Facades\{Auth, Cache};

class UtlHelper
{    
    /**
     * count
     *
     * @param  mixed $model
     * @return void
     */
    public static function count($model)
    {
        return (new class { use SettingTrait; })->getCount($model);
    }
    
    /**
     * checkDbPostSourceVideoExists
     *
     * @param  mixed $post
     * @return void
     */
    public static function checkDbPostSourceVideoExists($post)
    {
        if ($post->post_type == 'video_file') {
            if ($post->post_source) {
                return true;
            }
        }
    }
    
    /**
     * checkDbPostSourceAudioExists
     *
     * @param  mixed $post
     * @return void
     */
    public static function checkDbPostSourceAudioExists($post)
    {
        if ($post->post_type == 'audio_file') {
            if ($post->post_source) {
                return true;
            }
        }
    }

    /**
     * Resolve Post URL
     *
     * @param mixed $post
     * @return void
     */
    public static function resolvePostUrl($post)
    {
        if(config('settings.permalink')) {
            $year  = $post->created_at->format('Y');
            $month = $post->created_at->format('m');
            $day   = $post->created_at->format('d');
            
            if(config('settings.permalink') == "%year%/%month%/%day%"){
                return route('article.show.year-month-day', compact('post','year', 'month', 'day'));
            }elseif(config('settings.permalink') == "%year%/%month%"){
                return route('article.show.year-month', compact('post','year', 'month'));
            }elseif(config('settings.permalink') == "post_name"){
                return route('article.show', compact('post'));
            }else{
                $prefix = config('settings.permalink');
                return route('article.show.prefix', compact('prefix','post'));
            }
        }else{
            abort(404);
        }
    }
    
    /**
     * resolvePageUrl
     *
     * @param  mixed $url
     * @return void
     */
    public static function resolvePageUrl($url)
    {
        $getClearUrl     = $url;
        $countSegmentUrl = count(explode('/', $getClearUrl));
        $pageName        = last(request()->segments());

        if (config('settings.page_permalink_type') == 'with_prefix') {
            if ($countSegmentUrl == 4)
                return redirect('/page/' . $pageName);
        } else {
            if ($countSegmentUrl == 5)
                return redirect($pageName);
        }
    }
    
    /**
     * isContactUrl
     *
     * @param  mixed $url
     * @return void
     */
    public static function isContactUrl()
    {
        $pageName = last(request()->segments());
        $data     = ThemeHelper::getConfigContact('magz', 'contact', 'body')['config'];
        $key      = array_search('/' . $pageName, $data['url']);

        return $key;
    }
    
    
    /**
     * getDepth
     *
     * @param  mixed $items
     * @return void
     */
    public static function getDepth($items)
    {
        if (!is_array($items)) {
            return 0;
        }

        $maxDepth = 0;
        foreach ($items as $item) {
            $depth = self::getDepth($item->reply) + 1;
            if ($depth > $maxDepth) {
                $maxDepth = $depth;
            }
        }

        return $maxDepth;
    }
    
    
    /**
     * displayComment
     *
     * @param  mixed $comments
     * @param  mixed $level
     * @return void
     */
    public static function displayComment($comments, $level = 0) {
        $html = '';
    
        foreach ($comments as $key => $comment) {
            if ($comment->reply_id == 0) {
                $html .= '<div class="item" id="'.$comment->id.'">
                    <div class="user commentId'.$comment->id.'">                                
                        <figure>';
        
                if ($comment->avatar) {
                    $html .= '<img src="'.asset('storage/avatar/' . $comment->avatar) .'">';
                } else {
                    $html .= '<img src="'.asset('img/noavatar.png').'">';
                }
        
                $html .= '</figure>
                    <div class="details" data-id="'.$comment->id.'">
                        <h5 class="name">'.$comment->name.'</h5>
                        <div class="time">'.Carbon::parse($comment->created_at)->ago().'</div>
                        <div class="description">'.$comment->comment.'</div>
                        <footer>
                            <a class="reply">'.__('dhakawatch::magz.reply').'</a>';
        
                if(Auth::check() && Auth::id() == $comment->user_id) {
                    $html .= '<a class="edit-reply" data-edit-url="'.route('comment.edit', $comment->id).'">'. __('dhakawatch::magz.edit') .'</a>';
                    $html .= '<a class="delete-reply">'. __('dhakawatch::magz.delete') .'</a>';
                }
        
                $html .= '</footer>
                    </div>';
        
                if(count($comment->reply)){
                    $html .= '<div class="reply-list">';
                    $html .= self::displayNestedComment($comment->reply()->where('status', 'approved')->get(), $level + 1);
                    $html .= '</div>';
                }
        
                $html .= '</div>
                    </div>';
            }
        }
    
        return $html;
    }
    
    
    
    /**
     * displayNestedComment
     *
     * @param  mixed $comments
     * @param  mixed $level
     * @return void
     */
    public static function displayNestedComment($comments, $level) {
        $html = '';
        foreach ($comments as $key => $comment) {
            $html .= '<div class="item" id="'.$comment->id.'">
                <div class="user commentId'.$comment->id.'">                                
                    <figure>';
    
            if ($comment->avatar) {
                $html .= '<img src="'.asset('storage/avatar/' . $comment->avatar) .'">';
            } else {
                $html .= '<img src="'.asset('img/noavatar.png').'">';
            }
    
            $html .= '</figure>
                <div class="details" data-id="'.$comment->id.'">
                    <h5 class="name">'.$comment->name.'</h5>
                    <div class="time">'.Carbon::parse($comment->created_at)->ago().'</div>
                    <div class="description">'.$comment->comment.'</div>
                    <footer>';
                    if ($level < config('settings.number_nested_comments')) {
                        $html .= '<a class="reply">'.__('dhakawatch::magz.reply') .'</a>';
                    }
                        
                    if(Auth::check() && Auth::id() == $comment->user_id) {
                        $html .= '<a class="edit-reply">'. __('dhakawatch::magz.edit') .'</a>';
                        $html .= '<a class="delete-reply">'. __('dhakawatch::magz.delete') .'</a>';
                    }
            
                    $html .= '</footer>
                </div>';
    
            if(count($comment->reply)){
                $html .= '<div class="reply-list">';
                $html .= self::displayNestedComment($comment->reply()->where('status', 'approved')->get(), $level + 1);
                $html .= '</div>';
            }
    
            $html .= '</div>
                </div>';
        }
    
        return $html;
    }
    
    /**
     * headline
     *
     * @param  mixed $title
     * @return void
     */
    public static function headline($title)
    {
        return Str::headline($title);
    }

    /**
     * Update
     *
     * @param mixed $version
     * @return void
     */
    public static function update($version)
    {
        if (config('settings.version') != $version) {
            // GENERAL LAYOUT
            Theme::create([
                'theme' => 'magz',
                'page' => 'all',
                'url' => '',
                'title' => 'All',
                'slug' => 'all',
                'template' => '',
                'setting' => [
                    'sidebar' => [
                        'config' => [
                            'active' => 'true',
                            'position' => 'right'
                        ],
                        'widget' => [
                            'post_sidebar-zMsEVWBETfhZw2Ei' => [
                                'post_type'         => 'post',
                                'category'          => 'none',
                                'carousel'          => 'false',
                                'carousel_autoplay' => 'none',
                                'layout_type'       => 'list-post-with-link',
                                'title' => [
                                    'id' => 'Populer',
                                    'en' => 'Popular',
                                    'ar' => 'شائع'
                                ],
                                'description' => '',
                                'order' => 'popular',
                                'popular_based' => 'all',
                                'number_of_posts' => 4,
                                'active' => 'true'
                            ],
                            'newsletter_sidebar' => [
                                'active' => 'true',
                                'title' => [
                                    'id' => 'Berlangganan',
                                    'en' => 'Newsletter',
                                    'ar' => 'النشرة الإخبارية'
                                ],
                                'description' => [
                                    'id' => 'Dengan berlangganan Anda akan menerima artikel baru di email Anda.',
                                    'en' => 'By subscribing you will receive new articles in your email.',
                                    'ar' => 'بالاشتراك سوف تتلقى مقالات جديدة في بريدك الإلكتروني.'
                                ],
                                'layout_type' => 'card'
                            ],
                            'post_sidebar-82DEHGCnuLXWX3LK' => [
                                'post_type' => 'post',
                                'category' => 'none',
                                'carousel' => 'false',
                                'carousel_autoplay' => 'none',
                                'layout_type' => 'first-large-thumb',
                                'title' => [
                                    'id' => 'Direkomendasikan',
                                    'en' => 'Recommended',
                                    'ar' => 'مُستَحسَن'
                                ],
                                'description' => '',
                                'order' => 'popular',
                                'popular_based' => 'all',
                                'number_of_posts' => 4,
                                'active' => 'true'
                            ],
                            'ads_sidebar-veFRxP5K8IaYxwmk' => [
                                'active' => 'true',
                                'title' => [
                                    'id' => 'Disponsori',
                                    'en' => 'Sponsored',
                                    'ar' => 'برعاية'
                                ],
                                'ad_type' => 'image',
                                'ga_client' => '',
                                'ga_slot' => '',
                                'ga_size' => '',
                                'ga_format' => '',
                                'ga_full_width_responsive' => '',
                                'ad_width' => '',
                                'ad_height' => '',
                                'ad_image' => '',
                                'ad_url' => '',
                                'ad_script' => ''
                            ]
                        ]
                    ],
                    'footer' => [
                        'config' => [
                            'active' => 'true',
                            'exist' => ['about','links', 'menu_link', 'box_label', 'newsletter_footer', 'post_footer']
                        ],
                        'widget' => [
                            'section' => [
                                'left_column' => [
                                    'about' => [
                                        'active' => 'true',
                                        'title' => [
                                            'id' => 'Info perusahaan',
                                            'en' => 'Company Info',
                                            'ar' => 'معلومات الشركة'
                                        ],
                                        'logo' => 'true',
                                        'link' => 'true'
                                    ],
                                    'links' => [
                                        'active' => 'true',
                                        'title' => [
                                            'id' => 'Ikuti kami',
                                            'en' => 'Follow Us',
                                            'ar' => 'تابعنا'
                                        ],
                                        'description' => [
                                            'id' => 'Ikuti kami dan tetap berhubungan untuk mendapatkan berita terbaru',
                                            'en' => 'Follow us and stay in touch to get the latest news',
                                            'ar' => 'تابعنا وابق على اتصال للحصول على آخر الأخبار'
                                        ]
                                    ],
                                    'menu_link' => [
                                        'active' => 'true',
                                    ]
                                ],
                                'middle_column' => [
                                    'box_label' => [
                                        'active' => 'true',
                                        'term_type' => 'tags',
                                        'layout_type' => 'box',
                                        'title' => [
                                            'id' => 'Tag Populer',
                                            'en' => 'Popular Tags',
                                            'ar' => 'الكلمات الشعبية'
                                        ],
                                        'description' => '',
                                        'order' => 'popular',
                                        'popular_based' => 'all',
                                        'number_of_posts' => 10
                                    ],
                                    'newsletter_footer' => [
                                        'active' => 'true',
                                        'title' => [
                                            'id' => 'Langganan',
                                            'en' => 'Newsletter',
                                            'ar' => 'النشرة الإخبارية'
                                        ],
                                        'description' => [
                                            'id' => 'Ikuti kami dan tetap berhubungan untuk mendapatkan berita terbaru',
                                            'en' => 'Follow us and stay in touch to get the latest news',
                                            'ar' => 'تابعنا وابق على اتصال للحصول على آخر الأخبار'
                                        ],
                                        'layout_type' => 'form'
                                    ],
                                ],
                                'right_column' => [
                                    'post_footer' => [
                                        'post_type' => 'post',
                                        'category' => 'none',
                                        'carousel' => 'false',
                                        'carousel_autoplay' => 'none',
                                        'layout_type' => 'list-post-with-link',
                                        'title' => [
                                            'id' => 'Berita Terbaru',
                                            'en' => 'Latest News',
                                            'ar' => 'أحدث الأخبار'
                                        ],
                                        'description' => '',
                                        'order' => 'latest',
                                        'popular_based' => 'none',
                                        'number_of_posts' => 4,
                                        'active' => 'true'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]);

            Theme::where('slug', 'contact')->update([
                'setting' => [
                    'body' => [
                        'config' => [
                            'title' => [
                                'id' => 'Kontak',
                                'en' => 'Contact',
                                'ar' => 'اتصال'
                            ],
                            'url' => [
                                'id' => '/kontak',
                                'en' => '/contact',
                                'ar' => '/ts-l'
                            ]
                        ],
                        'widget' => [
                            'contact_information' => [
                                'active' => 'true'
                            ],
                            'captcha' => [
                                'active' => 'true'
                            ],
                            'map' => [
                                'active' => 'true',
                                'google_map_code' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387191.33750346623!2d-73.97968099999999!3d40.6974881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sKota%20New%20York%2C%20New%20York%2C%20Amerika%20Serikat!5e0!3m2!1sid!2sid!4v1702001456770!5m2!1sid!2sid',
                            ]
                        ]
                    ],
                    'footer' => [
                        'config' => [
                            'active' => 'true',
                            'exist' => ['about','links', 'menu_link', 'box_label', 'newsletter_footer', 'post_footer'],
                            'custom' => 'false',
                        ],
                        'widget' => [
                            'section' => [
                                'left_column' => [
                                    'about' => [
                                        'active' => 'true',
                                        'title' => [
                                            'id' => 'Info perusahaan',
                                            'en' => 'Company Info',
                                            'ar' => 'معلومات الشركة'
                                        ],
                                        'logo' => 'true',
                                        'link' => 'true'
                                    ],
                                    'links' => [
                                        'active' => 'true',
                                        'title' => [
                                            'id' => 'Ikuti kami',
                                            'en' => 'Follow Us',
                                            'ar' => 'تابعنا'
                                        ],
                                        'description' => [
                                            'id' => 'Ikuti kami dan tetap berhubungan untuk mendapatkan berita terbaru',
                                            'en' => 'Follow us and stay in touch to get the latest news',
                                            'ar' => 'تابعنا وابق على اتصال للحصول على آخر الأخبار'
                                        ]
                                    ],
                                    'menu_link' => [
                                        'active' => 'true',
                                    ]
                                ],
                                'middle_column' => [
                                    'box_label' => [
                                        'active' => 'true',
                                        'term_type' => 'tags',
                                        'layout_type' => 'box',
                                        'title' => [
                                            'id' => 'Tag Populer',
                                            'en' => 'Popular Tags',
                                            'ar' => 'الكلمات الشعبية'
                                        ],
                                        'description' => '',
                                        'order' => 'popular',
                                        'popular_based' => 'all',
                                        'number_of_posts' => 10
                                    ],
                                    'newsletter_footer' => [
                                        'active' => 'true',
                                        'title' => [
                                            'id' => 'Langganan',
                                            'en' => 'Newsletter',
                                            'ar' => 'النشرة الإخبارية'
                                        ],
                                        'description' => [
                                            'id' => 'Ikuti kami dan tetap berhubungan untuk mendapatkan berita terbaru',
                                            'en' => 'Follow us and stay in touch to get the latest news',
                                            'ar' => 'تابعنا وابق على اتصال للحصول على آخر الأخبار'
                                        ],
                                        'layout_type' => 'form'
                                    ],
                                ],
                                'right_column' => [
                                    'post_footer' => [
                                        'post_type' => 'post',
                                        'category' => 'none',
                                        'carousel' => 'false',
                                        'carousel_autoplay' => 'none',
                                        'layout_type' => 'list-post-with-link',
                                        'title' => [
                                            'id' => 'Berita Terbaru',
                                            'en' => 'Latest News',
                                            'ar' => 'أحدث الأخبار'
                                        ],
                                        'description' => '',
                                        'order' => 'latest',
                                        'popular_based' => 'none',
                                        'number_of_posts' => 4,
                                        'active' => 'true'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
    
            Cache::forget('settings');
            Setting::where('key', 'version')->update(['value' => $version]);

            //Home
            $home = Theme::whereSlug('home')->firstWhere('theme', 'magz');
            $data = $home->setting;
            Arr::set($data, 'sidebar.config.custom', 'false');
            Arr::set($data, 'footer.config.custom', 'false');
            $home->update(['setting' => $data]);

            //Page
            $page = Theme::whereSlug('page')->firstWhere('theme', 'magz');
            $data = $page->setting;
            Arr::set($data, 'sidebar.config.custom', 'false');
            Arr::set($data, 'footer.config.custom', 'false');
            $page->update(['setting' => $data]);

            //Posts
            $posts = Theme::whereSlug('posts')->firstWhere('theme', 'magz');
            $data = $posts->setting;
            Arr::set($data, 'sidebar.config.custom', 'false');
            Arr::set($data, 'footer.config.custom', 'false');
            $posts->update(['setting' => $data]);

            //Videos
            $videos = Theme::whereSlug('videos')->firstWhere('theme', 'magz');
            $data = $videos->setting;
            Arr::set($data, 'sidebar.config.custom', 'false');
            Arr::set($data, 'footer.config.custom', 'false');
            $videos->update(['setting' => $data]);

            //Audios
            $audios = Theme::whereSlug('audios')->firstWhere('theme', 'magz');
            $data = $audios->setting;
            Arr::set($data, 'sidebar.config.custom', 'false');
            Arr::set($data, 'footer.config.custom', 'false');
            $audios->update(['setting' => $data]);
            
            //Single Post
            $singlePost = Theme::whereSlug('single-post')->firstWhere('theme', 'magz');
            $data = $singlePost->setting;
            Arr::set($data, 'sidebar.config.custom', 'false');
            Arr::set($data, 'footer.config.custom', 'false');
            $singlePost->update(['setting' => $data]);

            //Contact
            $contact = Theme::whereSlug('contact')->firstWhere('theme', 'magz');
            $data = $contact->setting;
            Arr::set($data, 'footer.config.custom', 'false');
            $contact->update(['setting' => $data]);

            //Category
            $category = Theme::whereSlug('category')->firstWhere('theme', 'magz');
            $data = $category->setting;
            Arr::set($data, 'sidebar.config.custom', 'false');
            Arr::set($data, 'footer.config.custom', 'false');
            $category->update(['setting' => $data]);

            //Tag
            $tag = Theme::whereSlug('tag')->firstWhere('theme', 'magz');
            $data = $tag->setting;
            Arr::set($data, 'sidebar.config.custom', 'false');
            Arr::set($data, 'footer.config.custom', 'false');
            $tag->update(['setting' => $data]);

            //Popular Post
            $popularPost = Theme::whereSlug('popular-post')->firstWhere('theme', 'magz');
            $data = $popularPost->setting;
            Arr::set($data, 'sidebar.config.custom', 'false');
            Arr::set($data, 'footer.config.custom', 'false');
            $popularPost->update(['setting' => $data]);

            //Search
            $search = Theme::whereSlug('search')->firstWhere('theme', 'magz');
            $data = $search->setting;
            Arr::set($data, 'sidebar.config.custom', 'false');
            Arr::set($data, 'footer.config.custom', 'false');
            $search->update(['setting' => $data]);
        }
    }
}
