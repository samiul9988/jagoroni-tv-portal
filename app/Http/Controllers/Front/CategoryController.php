<?php

namespace App\Http\Controllers\Front;

use App\Helpers\{ImageHelper, LocalizationHelper, SeoHelper, SettingHelper};
use App\Http\Controllers\Controller;
use App\Models\{Post, Term};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryController extends Controller
{
    /**
     * @param Term $category
     * @return Application|Factory|View
     */
    public function __invoke($category)
    {
        if (is_string($category)) {
            $id = LocalizationHelper::getCurrentLocaleId();
            $category = Term::Category()
                ->where('slug', $category)
                ->where('language_id', $id)
                ->first() ?? Term::Category()->firstWhere('slug', $category);
        }

        if($category){
            $id = LocalizationHelper::getCurrentLocaleId();
            $category->load('posts');

            $description = $category->description ? Str::limit(strip_tags($category->description), 160) : '';

            $posts = $category->posts()->where('post_language', $id)->paginate(8);

            $latestPosts = Post::query()
                ->publish()
                ->where('post_language', $id)
                ->with('categories')
                ->latest()
                ->take(5)
                ->get();

            $mostReadPosts = Post::query()
                ->publish()
                ->where('post_language', $id)
                ->with('categories')
                ->orderByDesc('post_hits')
                ->latest()
                ->take(5)
                ->get();

            $image = ImageHelper::ogImageCategory($category->image);

            if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') {
                $title = $category->name . " :" . __('jagoronitv::magz.category') . " - " . config('settings.site_name');
            } else {
                $title = config('settings.site_name') . " - ".__('jagoronitv::magz.category') . ": " . $category->name;
            }

            SeoHelper::getMeta($title, $description, null, route('category.show', $category->slug));
            SeoHelper::getOpenGraphPage('category', $title, $description, route('category.show', $category->slug), null, $image);
            if (config('settings.twitter_username')) {
                SeoHelper::getTwitter($title, $description, route('category.show', $category->slug), $image);
            }
            SeoHelper::getJsonLd($title, $description, route('category.show', $category->slug), $image);
        } else {
            $posts = [];
            $category = [];
            $latestPosts = collect();
            $mostReadPosts = collect();
        }

        return view(SettingHelper::activeTheme('page/category'), compact('posts', 'category', 'latestPosts', 'mostReadPosts'))->with('page', 'category');
    }
}
