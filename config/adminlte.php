<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => true,
    'use_custom_favicon' => false,
    'path_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Admin</b>LTE',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => '',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => 'nav-flat nav-legacy',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'admin/dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'build/assets/app-3ea8b221.css',
    'laravel_mix_js_path' => 'build/assets/app-d4b42df8.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        [
            'type'          => 'darkmode-widget',
            'icon_enabled'  => 'fas fa-moon',
            'icon_disabled' => 'fas fa-sun',
            'topnav_right'  => true,
        ],
        [
            'type'   => 'custom-link',
            'text'   => 'visit_site',
            'url'    => '/',
            'classes'  => '',
            'icon'   => 'fa-solid fa-display',
            'target' => '_blank',
            'topnav' => true,
        ],
        [
            'text' => 'dashboard',
            'url'  => 'admin/dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'active' => ['admin/manage/analytics'],
        ],
        ['header'   => 'manage_content', 'can'  => ['read-posts','read-pages']],
        [
            'text'    => 'posts',
            'icon'    => 'fas fa-book',
            'can'     => 'read-posts',
            'submenu' => [
                [
                    'text'   => 'all_posts',
                    'url'    => 'admin/manage/posts',
                    'can'    => 'read-posts',
                    'active' => ['admin/manage/posts/*'],
                ],
                [
                    'text'   => 'add_new_post',
                    'can'    => 'add-posts',
                    'url'    => 'admin/manage/posts/create',
                    'active' => ['admin/manage/posts/create/*'],
                ],
                [
                    'text'   => 'all_video_posts',
                    'url'    => 'admin/manage/posts/videos',
                    'can'    => 'read-posts',
                    'active' => ['admin/manage/posts/videos/*'],
                ],
                [
                    'text'   => 'all_audio_posts',
                    'url'    => 'admin/manage/posts/audios',
                    'can'    => 'read-posts',
                    'active' => ['admin/manage/posts/audios/*'],
                ],
                [
                    'text'   => 'categories',
                    'url'    => 'admin/manage/categories',
                    'can'    => 'read-categories',
                    'active' => ['admin/manage/categories'],
                ],
                [
                    'text'   => 'tags',
                    'url'    => 'admin/manage/tags',
                    'can'    => 'read-tags',
                    'active' => ['admin/manage/tags'],
                ]
            ]
        ],
        [
            'text'    => 'pages',
            'icon'    => 'fas fa-copy',
            'can'     => 'read-pages',
            'submenu' => [
                [
                    'text'   => 'all_pages',
                    'url'    => 'admin/manage/pages',
                    'can'    => 'read-pages',
                    'active' => ['admin/manage/pages'],
                ],
                [
                    'text'   => 'add_new',
                    'url'    => 'admin/manage/pages/create',
                    'can'    => 'add-pages',
                    'active' => ['admin/manage/pages/*']
                ]
            ]
        ],
        // [
        //     'text'    => 'PSI',
        //     'icon'    => 'fas fa-copy',
        //     'can'     => 'read-pages',
        //     'submenu' => [
        //         [
        //             'text'   => 'All PSI',
        //             'url'    => 'admin/manage/psi',
        //             'can'    => 'read-pages',
        //             'active' => ['admin/manage/psi*'], // Updated to include wildcard for any subpaths
        //         ],
        //         [
        //             'text'   => 'Add New',
        //             'url'    => 'admin/manage/psi/create',
        //             'can'    => 'add-pages',
        //             'active' => ['admin/manage/psi/create'], // Updated to match the exact URL
        //         ],
        //     ],
        // ],

        [
            'text' => 'comments',
            'url'  => 'admin/manage/comments',
            'icon' => 'fas fa-comment-alt',
            'can'  => 'read-comments',
            'active' => ['admin/manage/comments/*']
        ],

        [
            'text' => 'contacts',
            'url'  => 'admin/manage/contacts',
            'can'  => 'read-contacts',
            'icon' => 'fa fa-envelope',
            'active' => ['admin/manage/contacts/*']
        ],
        [
            'text' => 'Ads',
            'url'  => 'admin/manage/advertisements',
            'icon' => 'fas fa-bullhorn',
            'active' => ['admin/manage/advertisements*'],
        ],
        ['header' => 'manage_appearance', 'can'  => ['read-menus', 'read-themes']],
        [
            'text' => 'appearance',
            'icon' => 'fas fa-brush',
            'can'  => 'read-menus',
            'submenu'       => [
                [
                    'text'   => 'menu',
                    'url'    => 'admin/manage/menus',
                    'can'    => 'read-menus',
                    'active' => ['admin/manage/menus/*/lang/*']
                ],
                // [
                //     'text' => 'themes',
                //     'can'  => 'read-themes',
                //     'url'  => 'admin/manage/themes',
                //     'active' => ['admin/manage/themes/*']
                // ],
            ]
        ],
        [
            'text' => 'localization',
            'icon' => 'fas fa-language',
            'can'  => 'read-languages',
            'submenu' => [
                [
                    'text'   => 'languages',
                    'url'    => 'admin/manage/languages',
                    'can'    => 'read-languages',
                    'active' => ['admin/manage/languages/*'],
                ],
                [
                    'text'   => 'translations',
                    'url'    => 'admin/manage/translations',
                    'can'    => 'read-translations',
                    'active' => ['admin/manage/translations/*'],
                ],
            ]
        ],
        ['header' => 'manage_files', 'can'  => 'read-galleries'],
        [
            'text' => 'media',
            'icon' => 'fas fa-hdd',
            'can'  => 'read-galleries',
            'submenu'     => [
                [
                    'text'   => 'gallery',
                    'url'    => 'admin/manage/galleries',
                    'can'    => 'read-galleries',
                    'active' => ['admin/manage/galleries', 'admin/manage/galleries/*/edit'],
                ],
                [
                    'text' => 'filemanager',
                    'can'  => 'read-file-manager',
                    'url'  => 'admin/manage/filemanager',
                ],
            ]
        ],
        ['header' => 'account_settings', 'can'  => 'read-profile'],
        [
            'text'   => 'profile',
            'icon'   => 'fas fa-fw fa-user',
            'url'    => 'admin/profile',
            'can'    => 'read-profile',
            'active' => ['admin/profile/*'],
        ],
        [
            'text' => 'change_password',
            'url'  => 'admin/change-password',
            'can'  => 'read-profile',
            'icon' => 'fas fa-fw fa-lock',
        ],
        ['header' => 'manage_users', 'can'  => ['read-users', 'read-roles', 'read-permissions']],
        [
            'text' => 'users',
            'icon' => 'fas fa-users',
            'can'  => 'read-users',
            'submenu'     => [
                [
                    'text'   => 'all_users',
                    'url'    => 'admin/manage/users',
                    'can'    => 'read-users',
                    'active' => ['admin/manage/users', 'admin/manage/users/*/edit'],
                ],
                [
                    'text' => 'add_new_user',
                    'can'  => 'add-users',
                    'url'  => 'admin/manage/users/create',
                ],
                [
                    'text'   => 'roles',
                    'url'    => 'admin/manage/roles',
                    'can'    => 'read-roles',
                    'active' => ['admin/manage/roles', 'admin/manage/roles/*', 'admin/manage/roles/*/edit']
                ],
            ]
        ],
        ['header' => 'manage_settings', 'can'  => 'read-settings'],
        [
            'text' => 'settings',
            'icon' => 'fas fa-cogs',
            'can'  => 'read-settings',
            'submenu' => [
                [
                    'text'   => 'web_information',
                    'url'    => 'admin/manage/settings/web-information',
                    'can'    => 'read-pages',
                    'active' => ['admin/manage/settings/web-information'],
                ],
                [
                    'text'   => 'web_contact',
                    'url'    => 'admin/manage/settings/web-contact',
                    'can'    => 'read-pages',
                    'active' => ['admin/manage/settings/web-contact'],
                ],
                [
                    'text'   => 'web_properties',
                    'url'    => 'admin/manage/settings/web-properties',
                    'can'    => 'read-pages',
                    'active' => ['admin/manage/settings/web-properties'],
                ],
                [
                    'text'   => 'web_config',
                    'url'    => 'admin/manage/settings/web-config',
                    'can'    => 'read-pages',
                    'active' => ['admin/manage/settings/web-config'],
                ],
                [
                    'text'   => 'web_backup',
                    'url'    => 'admin/manage/settings/web-backup',
                    'can'    => 'read-pages',
                    'active' => ['admin/manage/settings/web-backup'],
                ],
                [
                    'text'   => 'web_permalinks',
                    'url'    => 'admin/manage/settings/web-permalinks',
                    'can'    => 'read-pages',
                    'active' => ['admin/manage/settings/web-permalinks'],
                ],
            ]
        ],
        [
            'text' => 'env_editor',
            'url'  => 'admin/manage/env-editor',
            'can'  => 'read-env',
            'icon' => 'far fa-file',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'IcheckBootstrap' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/icheck-bootstrap/icheck-bootstrap.min.css',
                ],
            ]
        ],
        'BootstrapTagInput' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-4-tag-input/tagsinput.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-4-tag-input/tagsinput.css',
                ],
            ]
        ],
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/buttons.server-side.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.min.css',
                ]
            ],
        ],
        'Flag' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/flag-icons/css/flag-icons.min.css',
                ]
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/pace-progress/themes/blue/pace-theme-minimal.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/pace-progress/pace.min.js',
                ],
            ],
        ],
        'Toastr' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/toastr/toastr.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/toastr/toastr.min.js',
                ],
            ],
        ],
        'Tinymce' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/tinymce/tinymce.min.js',
                ],
            ],
        ],
        'Nestable' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/nestable/jquery.nestable.js',
                ],
            ],
        ],
        'Toggle' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap4-toggle/bootstrap4-toggle.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/bootstrap4-toggle/bootstrap4-toggle.min.css',
                ],
            ],
        ],
        'Croppie' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/croppie/croppie.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/croppie/croppie.css',
                ],
            ],
        ],
        'ColorPicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css',
                ],
            ],
        ],
        'IconPicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/fontawesome-iconpicker/js/fontawesome-iconpicker.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/fontawesome-iconpicker/css/fontawesome-iconpicker.min.css',
                ],
            ],
        ],
        'Codemirror' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/codemirror/lib/codemirror.js'
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/codemirror/addon/selection/active-line.js'
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/codemirror/addon/edit/matchbrackets.js'
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/codemirror/lib/codemirror.css'
                ]
            ]
        ],
        'BsCustomFileInput' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bs-custom-file-input/bs-custom-file-input.min.js'
                ]
            ]
        ],
        'BootstrapSwitch' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-switch/bootstrap-switch.min.js'
                ]
            ]
        ],
        'FileManager' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/file-manager/js/file-manager.js'
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/file-manager/css/file-manager.css'
                ]
            ]
        ],
        'Sortable' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/sortable/sortable.min.js'
                ]
            ]
        ],
        'Player' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/plyr/plyr.min.js'
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/plyr/plyr.min.css'
                ],
            ]
        ],
        'MediaElementPlayer' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/mediaelement/mediaelement-and-player.min.js'
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/mediaelement/mediaelementplayer.min.css'
                ],
            ]
        ],
        'Filepond' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/filepond/filepond-plugin-file-validate-type.min.js'
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/filepond/filepond.min.js'
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/filepond/filepond.min.css'
                ]
            ]
        ],
        'ShowHidePassword' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'js/show-hide-password.js'
                ],
            ]
        ],
        'Axios' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/axios/axios.js'
                ],
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
