<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // GENERAL LAYOUT
        Theme::create([
            'theme' => 'magz',
            'page' => 'all',
            'title' => 'All',
            'slug' => 'all',
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
        // Home
        Theme::create([
            'theme' => 'magz',
            'page' => 'home',
            'url' => '/',
            'title' => 'Home',
            'slug' => 'home',
            'template' => 'home',
            'setting' => [
                'body' => [
                    'widget' => [
                        'headline' => [
                            'post_type'         => 'post',
                            'category'          => 'none',
                            'carousel'          => 'true',
                            'carousel_autoplay' => 'true',
                            'layout_type'       => 'none',
                            'title'             => '',
                            'description'       => '',
                            'order'             => 'latest',
                            'popular_based'     => 'none',
                            'number_of_posts'   => 4,
                            'active'            => 'true',
                            'default'           => 'true'
                        ],
                        'featured' => [
                            'post_type'         => 'post',
                            'category'          => 'none',
                            'carousel'          => 'true',
                            'carousel_autoplay' => 'true',
                            'layout_type'       => 'none',
                            'title'             => '',
                            'description'       => '',
                            'order'             => 'latest',
                            'popular_based'     => 'none',
                            'number_of_posts'   => 4,
                            'active'            => 'true',
                            'default'           => 'true'
                        ],
                        'post-LE6uRpoqNFxZ8UFg' => [
                            'post_type'         => 'post',
                            'category'          => 'none',
                            'carousel'          => 'false',
                            'carousel_autoplay' => 'none',
                            'layout_type'       => 'two-column',
                            'title' => [
                                'id' => 'Berita Lain',
                                'en' => 'Just Another News',
                                'ar' => 'مجرد خبر آخر'
                            ],
                            'description'     => '',
                            'order'           => 'latest',
                            'popular_based'   => 'none',
                            'number_of_posts' => 4,
                            'active'          => 'true',
                            'default'         => 'false'
                        ],
                        'ads-tV0RBIG8d1ii0JsG' => [
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
                            'ad_script'                => '',
                            'active'                   => 'true',
                        ],
                        'video-8q0Dw1DvAzKlMSbm' => [
                            'post_type'         => 'video_by_category',
                            'category'          => 'technology',
                            'carousel'          => 'false',
                            'carousel_autoplay' => 'none',
                            'layout_type'       => 'one-column',
                            'title'             => [
                                'id' => 'Teknologi',
                                'en' => 'Technology',
                                'ar' => 'تقنية'
                            ],
                            'description'     => '',
                            'order'           => 'latest',
                            'popular_based'   => 'all',
                            'number_of_posts' => 4,
                            'active'          => 'true',
                        ],		
                        'section-Melwbi0YEpOdy9cQ' => [
                            'active' => 'true',
                            'widget' => [
                                'list_label-2X6GNu9ozi4TOqfq' => [
                                    'active' => 'true',
                                    'term_type' => 'tags',
                                    'layout_type' => 'ordered-lists',
                                    'order' => 'popular',
                                    'popular_based' => 'all',
                                    'number_of_posts' => 10,
                                    'title' => [
                                        'id' => 'Tag Tren',
                                        'en' => 'Trending Tags',
                                        'ar' => 'تتجه العلامات'
                                    ],
                                    'description' => ''
                                ],
                                'mini_post-iStrA3TcuGGndFl7' => [
                                    'post_type' => 'post',
                                    'category' => 'none',
                                    'carousel' => 'true',
                                    'carousel_autoplay' => 'true',
                                    'layout_type' => 'vertical-slider',
                                    'title' => [
                                        'id' => 'Berita Hangat',
                                        'en' => 'Hot News',
                                        'ar' => 'أخبار عاجلة'
                                    ],
                                    'description' => '',
                                    'order' => 'popular',
                                    'popular_based' => 'all',
                                    'number_of_posts' => 4,
                                    'active' => 'true',
                                ]
                            ]
                        ],
                        'audio-b7RqkJVW956l1LUc' => [
                            'post_type'	=>	'audio',
                            'category'	=>	'none',
                            'carousel'	=>	'false',
                            'carousel_autoplay'	=>	'none',
                            'layout_type'	=>	'two-column',
                            'title' => [
                                'id' => 'Suara',
                                'en' => 'Sound',
                                'ar' => 'صوت'
                            ],
                            'description' =>	'',
                            'order'	=>	'latest',
                            'popular_based'	=>	'all',
                            'number_of_posts' => 4,
                            'active'	=>	'true'
                        ],
                        'video-Jy2ux4tdghVKwyKz' => [
                            'post_type'         => 'video',
                            'category'          => 'none',
                            'carousel'          => 'false',
                            'carousel_autoplay' => 'none',
                            'layout_type'       => 'two-column',
                            'title' => [
                                'id' => 'Video Lain',
                                'en' => 'Just Another Video',
                                'ar' => 'مجرد فيديو آخر'
                            ],
                            'description'     => '',
                            'order'           => 'latest',
                            'popular_based'   => 'all',
                            'number_of_posts' => 4,
                            'active'          => 'true',

                        ],
                        'posts' => [
                            'post_type'         => 'post',
                            'category'          => 'none',
                            'carousel'          => 'false',
                            'carousel_autoplay' => 'none',
                            'layout_type'       => 'one-column',
                            'title' => [
                                'id' => 'Pos Terbaru',
                                'en' => 'Recent Post',
                                'ar' => 'المنشور الاخير'
                            ],
                            'description'     => '',
                            'order'           => 'latest',
                            'popular_based'   => 'none',
                            'number_of_posts' => 4,
                            'active'          => 'true',
                            'default'         => 'true'
                        ],
                        'bottom_post' => [
                            'post_type'         => 'post',
                            'category'          => 'none',
                            'carousel'          => 'true',
                            'carousel_autoplay' => 'true',
                            'layout_type'       => 'horizontal-slider',
                            'title' => [
                                'id' => 'Terbaik Minggu Ini',
                                'en' => 'Best of the Week',
                                'ar' => 'أفضل ما في الأسبوع'
                            ],
                            'description'     => '',
                            'order'           => 'popular',
                            'popular_based'   => 'week',
                            'number_of_posts' => 8,
                            'active'          => 'true',
                            'default'         => 'true'
                        ]
                    ]
                ],
                'sidebar' => [
                    'config' => [
                        'active' => 'true',
                        'position' => 'right',
                        'custom' => 'false',
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
                            'number_of_posts' => 5,
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

        // Page
        Theme::create([
            'theme' => 'magz',
            'page' => 'page',
            'url' => '/page/{title}',
            'title' => 'Page',
            'slug' => 'page',
            'template' => 'page',
            'setting' => [
                'sidebar' => [
                    'config' => [
                        'active' => 'true',
                        'position' => 'right',
                        'custom' => 'false',
                    ],
                    'widget' => [
                        'ads_sidebar-0cY7Lh6caYytrSbj' => [
                            'active' => 'true',
                            'title' => '',
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
                        ],
                        'post_sidebar-OR8Crs0d7rVO0zjs' => [
                            'post_type' => 'post',
                            'category' => 'none',
                            'carousel' => 'false',
                            'layout_type' => 'first-large-thumb',
                            'title' => [
                                'id' => 'Pos Terbaru',
                                'en' => 'Recent Post',
                                'ar' => 'المنشور الاخير'
                            ],
                            'description' => '',
                            'order' => 'popular',
                            'popular_based' => 'all',
                            'number_of_posts' => 5,
                            'active' => 'true',
                        ],
                        'newsletter_sidebar' => [
                            'active' => 'true',
                            'title' => [
                                'id' => 'Berlangganan',
                                'en' => 'Newsletter',
                                'ar' => 'النشرة الإخبارية'
                            ],
                            'description' => '',
                            'layout_type' => 'card'
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

        // Posts
        Theme::create([
            'theme' => 'magz',
            'page' => 'posts',
            'url' => '/news/latest',
            'title' => 'Posts',
            'slug' => 'posts',
            'template' => 'posts',
            'setting' => [
                'sidebar' => [
                    'config' => [
                        'active' => 'true',
                        'position' => 'right',
                        'custom' => 'false',
                    ],
                    'widget' => [
                        'ads_sidebar-0cY7Lh6caYytrSbj' => [
                            'active' => 'true',
                            'title' => '',
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
                        ],
                        'post_sidebar-OR8Crs0d7rVO0zjs' => [
                            'post_type' => 'post',
                            'category' => 'none',
                            'carousel' => 'false',
                            'layout_type' => 'first-large-thumb',
                            'title' => [
                                'id' => 'Pos Terbaru',
                                'en' => 'Recent Post',
                                'ar' => 'المنشور الاخير'
                            ],
                            'description' => '',
                            'order' => 'popular',
                            'popular_based' => 'all',
                            'number_of_posts' => 5,
                            'active' => 'true',
                        ],
                        'newsletter_sidebar' => [
                            'active' => 'true',
                            'title' => [
                                'id' => 'Berlangganan',
                                'en' => 'Newsletter',
                                'ar' => 'النشرة الإخبارية'
                            ],
                            'description' => '',
                            'layout_type' => 'card'
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

        // Videos
        Theme::create([
            'theme' => 'magz',
            'page' => 'videos',
            'url' => '/videos/latest',
            'title' => 'Videos',
            'slug' => 'videos',
            'template' => 'videos',
            'setting' => [
                'sidebar' => [
                    'config' => [
                        'active' => 'true',
                        'position' => 'right',
                        'custom' => 'false',
                    ],
                    'widget' => [
                        'ads_sidebar-N1Jn0twR6miuSvkV' => [
                            'active' => 'true',
                            'title' => '',
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
                        ],
                        'post_sidebar-gRWg9faVJU31qNO2' => [
                            'post_type' => 'post',
                            'category' => 'none',
                            'carousel' => 'false',
                            'layout_type' => 'first-large-thumb',
                            'title' => [
                                'id' => 'Pos Terbaru',
                                'en' => 'Recent Post',
                                'ar' => 'المنشور الاخير'
                            ],
                            'description' => '',
                            'order' => 'popular',
                            'popular_based' => 'all',
                            'number_of_posts' => 5,
                            'active' => 'true',
                        ],
                        'newsletter_sidebar' => [
                            'active' => 'true',
                            'title' => [
                                'id' => 'Berlangganan',
                                'en' => 'Newsletter',
                                'ar' => 'النشرة الإخبارية'
                            ],
                            'description' => '',
                            'layout_type' => 'card'
                        ]
                    ]
                ],
                'footer' => [
                    'config' => [
                        'active' => 'true',
                        'exist' => ['about', 'links', 'menu_link', 'box_label', 'newsletter_footer', 'post_footer'],
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

        // Audios
        Theme::create([
            'theme' => 'magz',
            'page' => 'audios',
            'url' => '/audios/latest',
            'title' => 'Audios',
            'slug' => 'audios',
            'template' => 'audios',
            'setting' => [
                'sidebar' => [
                    'config' => [
                        'active' => 'true',
                        'position' => 'right',
                        'custom' => 'false',
                    ],
                    'widget' => [
                        'ads_sidebar-N1Jn0twR6miuSvkV' => [
                            'active' => 'true',
                            'title' => '',
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
                        ],
                        'post_sidebar-gRWg9faVJU31qNO2' => [
                            'post_type' => 'post',
                            'category' => 'none',
                            'carousel' => 'false',
                            'layout_type' => 'first-large-thumb',
                            'title' => [
                                'id' => 'Pos Terbaru',
                                'en' => 'Recent Post',
                                'ar' => 'المنشور الاخير'
                            ],
                            'description' => '',
                            'order' => 'popular',
                            'popular_based' => 'all',
                            'number_of_posts' => 5,
                            'active' => 'true',
                        ],
                        'newsletter_sidebar' => [
                            'active' => 'true',
                            'title' => [
                                'id' => 'Berlangganan',
                                'en' => 'Newsletter',
                                'ar' => 'النشرة الإخبارية'
                            ],
                            'description' => '',
                            'layout_type' => 'card'
                        ]
                    ]
                ],
                'footer' => [
                    'config' => [
                        'active' => 'true',
                        'exist' => ['about', 'links', 'menu_link', 'box_label', 'newsletter_footer', 'post_footer'],
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

        // Single Post
        Theme::create([
            'theme' => 'magz',
            'page' => 'single-post',
            'url' => '/news/{postTitle}',
            'title' => 'Single Post',
            'slug' => 'single-post',
            'template' => 'default',
            'setting' => [
                'body' => [
                    'widget' => [
                        'related_post' => [
                            'carousel' => 'true',
                            'carousel_autoplay' => 'true',
                            'layout_type' => 'none',
                            'title' => [
                                'id' => 'Anda Mungkin Juga Menyukai',
                                'en' => 'You May Also Like',
                                'ar' => 'ربما يعجبك أيضا'
                            ],
                            'order' => 'random',
                            'popular_based' => 'all',
                            'number_of_posts' => 2,
                            'active' => 'true',
                            'default' => 'true'
                        ]
                    ]
                ],
                'sidebar' => [
                    'config' => [
                        'active' => 'true',
                        'position' => 'left',
                        'custom' => 'true',
                    ],
                    'widget' => [
                        'ads_sidebar-50qSTsOqn7y4XPc8' => [
                            'active' => 'true',
                            'title' => '',
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
                        ],
                        'post_sidebar-k7RgWwF6HFlU75ir' => [
                            'post_type' => 'post',
                            'category' => 'none',
                            'carousel' => 'false',
                            'layout_type' => 'first-large-thumb',
                            'title' => [
                                'id' => 'Pos Terbaru',
                                'en' => 'Recent Post',
                                'ar' => 'المنشور الاخير'
                            ],
                            'description' => '',
                            'order' => 'popular',
                            'popular_based' => 'all',
                            'number_of_posts' => 5,
                            'active' => 'true'
                        ],
                        'newsletter_sidebar' => [
                            'active' => 'true',
                            'title' => [
                                'id' => 'Berlangganan',
                                'en' => 'Newsletter',
                                'ar' => 'النشرة الإخبارية'
                            ],
                            'description' => '',
                            'layout_type' => 'card'
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

        // Contact
        Theme::create([
            'theme' => 'magz',
            'page' => 'contact',
            'url' => '/contact',
            'title' => 'Contact',
            'slug' => 'contact',
            'template' => 'default',
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

        // Category
        Theme::create([
            'theme' => 'magz',
            'page' => 'category',
            'url' => '/category/{categoryName}',
            'title' => 'Category',
            'slug' => 'category',
            'template' => 'default',
            'setting' => [
                'sidebar' => [
                    'config' => [
                        'active' => 'true',
                        'position' => 'right',
                        'custom' => 'false',
                    ],
                    'widget' => [
                        'ads_sidebar-zx0XOIvM5O9yt97q' => [
                            'active' => 'true',
                            'title' => '',
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
                        ],
                        'post_sidebar-sZtZ0RWnm6UOlaNX' => [
                            'post_type' => 'post',
                            'category' => 'none',
                            'carousel' => 'false',
                            'layout_type' => 'first-large-thumb',
                            'title' => [
                                'id' => 'Pos Terbaru',
                                'en' => 'Recent Post',
                                'ar' => 'المنشور الاخير'
                            ],
                            'description' => '',
                            'order' => 'popular',
                            'popular_based' => 'all',
                            'number_of_posts' => 5,
                            'active' => 'true',
                        ],
                        'newsletter_sidebar' => [
                            'active' => 'true',
                            'title' => [
                                'id' => 'Berlangganan',
                                'en' => 'Newsletter',
                                'ar' => 'النشرة الإخبارية'
                            ],
                            'description' => '',
                            'layout_type' => 'card'
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

        // Tag
        Theme::create([
            'theme' => 'magz',
            'page' => 'tag',
            'url' => '/tag/{TagName}',
            'title' => 'Tag',
            'slug' => 'tag',
            'template' => 'default',
            'setting' => [
                'sidebar' => [
                    'config' => [
                        'active' => 'true',
                        'position' => 'right',
                        'custom' => 'false',
                    ],
                    'widget' => [
                        'ads_sidebar-BetFLUqsgxnheK0M' => [
                            'active' => 'true',
                            'title' => '',
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
                        ],
                        'post_sidebar-6MWciqIpa2GnycLX' => [
                            'post_type' => 'post',
                            'category' => 'none',
                            'carousel' => 'false',
                            'layout_type' => 'first-large-thumb',
                            'title' => [
                                'id' => 'Pos Terbaru',
                                'en' => 'Recent Post',
                                'ar' => 'المنشور الاخير'
                            ],
                            'description' => '',
                            'order' => 'popular',
                            'popular_based' => 'all',
                            'number_of_posts' => 5,
                            'active' => 'true',
                        ],
                        'newsletter_sidebar' => [
                            'active' => 'true',
                            'title' => '',
                            'description' => '',
                            'layout_type' => 'card'
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

        // Popular
        Theme::create([
            'theme' => 'magz',
            'page' => 'popular',
            'url' => '/news/popular',
            'title' => 'Popular Post',
            'slug' => 'popular-post',
            'template' => 'default',
            'setting' => [
                'sidebar' => [
                    'config' => [
                        'active' => 'true',
                        'position' => 'right',
                        'custom' => 'false',
                    ],
                    'widget' => [
                        'ads_sidebar-g7FZH1zE2wcDSelA' => [
                            'active' => 'true',
                            'title' => '',
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
                        'newsletter_sidebar' => [
                            'active' => 'true',
                            'title' => [
                                'id' => 'Berlangganan',
                                'en' => 'Newsletter',
                                'ar' => 'النشرة الإخبارية'
                            ],
                            'description' => '',
                            'layout_type' => 'card'
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

        // Search
        Theme::create([
            'theme' => 'magz',
            'page' => 'search',
            'url' => '/search?q={keyword}',
            'title' => 'Search',
            'slug' => 'search',
            'template' => 'default',
            'setting' => [
                'sidebar' => [
                    'config' => [
                        'active' => 'true',
                        'position' => 'left',
                        'custom' => 'true',
                    ],
                    'widget' => [
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
    }
}
