<?php

use App\Helpers\{ImageHelper, LocalizationHelper};
use App\Http\Controllers\Front\ArticleController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\SubcategoryController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\TagController;
use App\Http\Controllers\Front\VideoPostController;
use App\Http\Controllers\Front\AudioPostController;
use App\Http\Controllers\SearchController;
use App\Models\{Post, Term};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
*/


// -------------------------------- Open Graph image  --------------------------------
Route::get('ogi/{filename}', function ($filename) {
    if (ImageHelper::isExists('assets', $filename)) {
        return Image::make(ImageHelper::imageStoragePathLocation('assets') . '/' . $filename)->response();
    } else {
        return Image::make(public_path('img/cover.png'))->response();
    }
})->name('ogi.display');

// ---------------------------------------- Feed ----------------------------------------
Route::feeds();

Route::prefix(LaravelLocalization::setLocale())->middleware('public', 'XSS', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'language', 'frontend.locale')->group(function () {

    // -------------------------------------- Sitemap --------------------------------------
    Route::controller(\App\Http\Controllers\Front\SitemapController::class)->group(function () {
        Route::get('/sitemap.xml', 'index')->name('sitemap');
        Route::get('/sitemap-posts.xml', 'posts')->name('sitemap.posts');
        Route::get('/sitemap-pages.xml', 'pages')->name('sitemap.pages');
        Route::get('/sitemap-categories.xml', 'categories')->name('sitemap.categories');
    });

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/news/latest', [ArticleController::class, 'index'])->name('articles.latest');
    Route::get('/news/popular', [ArticleController::class, 'showPopular'])->name('article.popular');
    Route::get('/videos/latest', [VideoPostController::class, 'index'])->name('videos.latest');
    Route::get('/live-tv', [VideoPostController::class, 'live'])->name('live.tv');
    Route::get('/{slug}',[HomeController::class, 'show'])->name('show');
    Route::get('/audios/latest', [AudioPostController::class, 'index'])->name('audios.latest');
    Route::get('/tag/{tag}', [TagController::class, 'index'])->name('tag.show');
    Route::get('/categories/{category}', [CategoryController::class, '__invoke'])->name('categories.show');
    Route::patch('/post/react', [ArticleController::class, 'react'])->name('sendreact');

    // Article Route

    Route::get('/{year}/{month}/{day}/{post:post_name}', function ($year, $month, $day, $post) {
        if (config('settings.permalink_type') == '%year%/%month%/%day%') {

            $showpost = Post::videoAudioPost()
                ->whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '=', $month)
                ->whereDay('created_at', '=', $day)
                ->wherePostName($post)
                ->first();

            return app('App\Http\Controllers\Front\ArticleController')->show($showpost);
        } elseif (config('settings.permalink_type') == '%year%/%month%') {
            return redirect('/' . $year . '/' . $month . '/' . $post);
        } elseif (config('settings.permalink_type') == 'custom') {
            $prefix = config('settings.permalink');
            return redirect('/' . $prefix . '/' . $post);
        } else {
            return redirect('/' . $post);
        }
    })->name('article.show.year-month-day')
        ->where('day', '[0-9]{2}')
        ->where('month', '[0-9]{2}')
        ->where('year', '[0-9]{4}');

    Route::get('/{year}/{month}/{post:post_name}', function ($year, $month, $post) {
        if (config('settings.permalink_type') == '%year%/%month%/%day%') {

            $query = Post::videoAudioPost()->firstWhere('post_name', $post);
            $day = $query->created_at->format('d');

            return redirect('/' . $year . '/' . $month . '/' . $day . '/' . $post);
        } elseif (config('settings.permalink_type') == 'custom') {
            $prefix = config('settings.permalink');
            return redirect('/' . $prefix . '/' . $post);
        } elseif (config('settings.permalink_type') == 'post_name') {
            return redirect('/' . $post);
        } else {
            $showpost = Post::videoAudioPost()->whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '=', $month)
                ->wherePostName($post)
                ->first();

            return app('App\Http\Controllers\Front\ArticleController')->show($showpost);
        }
    })->name('article.show.year-month')
        ->where('month', '[0-9]{2}')
        ->where('year', '[0-9]{4}');

    Route::get('/{prefix}/{post:post_name}', function ($prefix, $post) {
        if (config('settings.permalink_type') == '%year%/%month%/%day%') {

            $query = Post::videoAudioPost()->firstWhere('post_name', $post);
            $year  = $query->created_at->format('Y');
            $month = $query->created_at->format('m');
            $day   = $query->created_at->format('d');

            return redirect('/' . $year . '/' . $month . '/' . $day . '/' . $post);
        } elseif (config('settings.permalink_type') == '%year%/%month%') {

            $query = Post::videoAudioPost()->firstWhere('post_name', $post);
            $year  = $query->created_at->format('Y');
            $month = $query->created_at->format('m');

            return redirect('/' . $year . '/' . $month . '/' . $post);
        } elseif (config('settings.permalink_type') == 'post_name') {
            return redirect('/' . $post);
        } else {
            if ($prefix == config('settings.permalink')) {
                $showpost = Post::videoAudioPost()->wherePostName($post)->first();
                return app('App\Http\Controllers\Front\ArticleController')->show($showpost);
            } else {
                $prefix = config('settings.permalink');
                return redirect('/' . $prefix . '/' . $post);
            }
        }
    })->name('article.show.prefix')
        ->where('prefix', '(?!page|category|favicons)[^\/]+');

    Route::get('/{post:post_name}', function ($post) {
        $query = Post::videoAudioPost()->firstWhere('post_name', $post);

        if (!$query) {
            return Redirect::route('page.show', $post);
        }

        $year  = $query->created_at->format('Y');
        $month = $query->created_at->format('m');
        $day   = $query->created_at->format('d');

        if (config('settings.permalink_type') == '%year%/%month%/%day%') {
            return redirect('/' . $year . '/' . $month . '/' . $day . '/' . $post);
        } elseif (config('settings.permalink_type') == '%year%/%month%') {
            return redirect('/' . $year . '/' . $month . '/' . $post);
        } elseif (config('settings.permalink_type' == 'post_name')) {
            return redirect('/' . $post);
        } elseif (config('settings.permalink_type') == 'custom') {
            $prefix = config('settings.permalink');
            return redirect('/' . $prefix . '/' . $post);
        } else {
            return app('App\Http\Controllers\Front\ArticleController')->show($query);
        }
    })->name('article.show');

    // Page Route

    Route::get('/page/{page:post_name}', function ($page) {
        if (config('settings.page_permalink_type') == 'with_prefix') {
            $rpage = Post::page()->wherePostName($page)->first();

            return app('App\Http\Controllers\Front\PageController')->show($rpage);


        } elseif (config('settings.page_permalink_type') == 'page_name') {
            return redirect('/' . $page);
        }
    })->name('page.show');

    Route::get('/{page:post_name}', function ($page) {
        if (config('settings.page_permalink_type') == 'page_name') {
            return app('App\Http\Controllers\Front\PageController')->show($page);
        } elseif (config('settings.page_permalink_type') == 'with_prefix') {
            return redirect('/page/' . $page);
        }
    })->name('page.show');

    // Category Route

    Route::get('/{category}', function ($category) {
        if (config('settings.category_permalink_type') == 'with_prefix_category') {
            return redirect('/category/' . $category);
        }

        return (new CategoryController)->__invoke($category);
    })->name('category.show');

    Route::get('/category/{category}', function ($category) {
        if (config('settings.category_permalink_type') == 'category_name') {
            return redirect('/' . $category);
        } else {
            $id = LocalizationHelper::getCurrentLocaleId();
            $rcategory = Term::Category()->where('slug', $category)
                ->where('language_id', $id)->first();

            if ($rcategory) {
                return (new CategoryController)->__invoke($rcategory);
            } else {
                $locale = LaravelLocalization::getCurrentLocale();
                $term = Term::Category()->firstWhere('slug', $category);

                if ($term) {
                    $translation = $term->translation;
                    $slug = json_decode($translation, true);
                    return redirect('/category/' . $slug[$locale]);
                } else {
                    // return abort(404);
                    return app('App\Http\Controllers\Front\CategoryController')->__invoke($term);
                }

            }

        }
    })->name('category.show');

    Route::get('/category/{category}/{subcategory}', function ($category) {
        if (config('settings.category_permalink_type') == 'category_name') {
            return redirect('/' . $category);
        } else {

            $id = LocalizationHelper::getCurrentLocaleId();

            $rcategory = Term::Category()->where('slug', $category)
                ->where('language_id', $id)->first();
            return (new SubcategoryController)->__invoke($rcategory);
        }
    })->name('subcategory.show');
});
