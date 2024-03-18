<?php

namespace App\Providers;

use App\View\Composers\CategoryComposer;
use App\View\Composers\ContactComposer;
use App\View\Composers\HomeComposer;
use App\View\Composers\PageComposer;
use App\View\Composers\PopularComposer;
use App\View\Composers\PostsComposer;
use App\View\Composers\VideosComposer;
use App\View\Composers\AudiosComposer;
use App\View\Composers\SearchComposer;
use App\View\Composers\SingleComposer;
use App\View\Composers\TagComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('frontend.magz.page.home', HomeComposer::class);
        View::composer('frontend.magz.page.single', SingleComposer::class);
        View::composer('frontend.magz.page.posts', postsComposer::class);
        View::composer('frontend.magz.page.videos', VideosComposer::class);
        View::composer('frontend.magz.page.audios', AudiosComposer::class);
        View::composer('frontend.magz.page.popular', PopularComposer::class);
        View::composer('frontend.magz.page.category', categoryComposer::class);
        View::composer('frontend.magz.page.tag', TagComposer::class);
        View::composer('frontend.magz.page.page', PageComposer::class);
        View::composer('frontend.magz.page.contact', ContactComposer::class);
        View::composer('frontend.magz.page.search', SearchComposer::class);
    }
}
