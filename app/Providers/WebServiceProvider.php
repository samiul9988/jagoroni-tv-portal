<?php

namespace App\Providers;

use App\Helpers\LocalizationHelper;
use Hashids\Hashids;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class WebServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // header
        Blade::component('logo-header', \App\View\Components\Front\Magz\Header\LogoHeader::class);
        Blade::component('menu-header', \App\View\Components\Front\Magz\Header\MenuHeader::class);

        // sidebar - home
        Blade::component('newsletter-sidebar', \App\View\Components\Front\Magz\Sidebar\NewsletterSidebar::class);
        Blade::component('post-sidebar', \App\View\Components\Front\Magz\Sidebar\PostSidebar::class);
        Blade::component('audio-sidebar', \App\View\Components\Front\Magz\Sidebar\AudioSidebar::class);
        Blade::component('video-sidebar', \App\View\Components\Front\Magz\Sidebar\VideoSidebar::class);
        Blade::component('ads-sidebar', \App\View\Components\Front\Magz\Sidebar\AdsSidebar::class);

        // footer
        Blade::component('about', \App\View\Components\Front\Magz\Footer\AboutFooter::class);
        Blade::component('post-footer', \App\View\Components\Front\Magz\Footer\PostFooter::class);
        Blade::component('menu-link', \App\View\Components\Front\Magz\Footer\MenuLink::class);
        Blade::component('newsletter-footer', \App\View\Components\Front\Magz\Footer\NewsletterFooter::class);
        Blade::component('box-label', \App\View\Components\Front\Magz\Footer\BoxLabel::class);

        // home
        Blade::component('headline', \App\View\Components\Front\Magz\Headline::class);
        Blade::component('featured', \App\View\Components\Front\Magz\Featured::class);
        Blade::component('post', \App\View\Components\Front\Magz\Post::class);
        Blade::component('posts', \App\View\Components\Front\Magz\Posts::class);
        Blade::component('newsletter', \App\View\Components\Front\Magz\Newsletter::class);
        Blade::component('section', \App\View\Components\Front\Magz\Section::class);
        Blade::component('links', \App\View\Components\Front\Magz\Links::class);
        Blade::component('menulink', \App\View\Components\Front\Magz\Menulink::class);
        Blade::component('video', \App\View\Components\Front\Magz\Video::class);
        Blade::component('audio', \App\View\Components\Front\Magz\Audio::class);
        Blade::component('list-label', \App\View\Components\Front\Magz\ListLabel::class);
        Blade::component('mini-post', \App\View\Components\Front\Magz\MiniPost::class);
        Blade::component('bottom-post', \App\View\Components\Front\Magz\BottomPost::class);
        Blade::component('ads', \App\View\Components\Front\Magz\Ads::class);

        // Single
        Blade::component('related-post', \App\View\Components\Front\Magz\RelatedPost::class);

        // Contact
        Blade::component('captcha', \App\View\Components\Front\Magz\Contact\Captcha::class);
        Blade::component('map', \App\View\Components\Front\Magz\Contact\Map::class);

        // Component name space
        Blade::componentNamespace('App\\View\\Components\\Front\\Magz\\Ads', 'ads');
        Blade::componentNamespace('App\\View\\Components\\Front\\Magz\\Post', 'post');
        Blade::componentNamespace('App\\View\\Components\\Front\\Magz\\Video', 'video');
        Blade::componentNamespace('App\\View\\Components\\Front\\Magz\\Audio', 'audio');
        Blade::componentNamespace('App\\View\\Components\\Front\\Magz\\PostCarousel', 'post-carousel');

        View::composer('*', function ($view) {
            $view->with('localeId', LocalizationHelper::getCurrentLocaleId());
        });

        View::share('hashids', new Hashids());

        $this->loadTranslationsFrom(base_path('lang/vendor/theme'), 'dhakawatch');
    }
}
