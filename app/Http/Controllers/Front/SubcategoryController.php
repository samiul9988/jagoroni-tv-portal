<?php

namespace App\Http\Controllers\Front;

use App\Helpers\{LocalizationHelper, SeoHelper, SettingHelper};
use App\Http\Controllers\Controller;
use App\Models\Term;
use Hashids\Hashids;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SubcategoryController extends Controller
{
    /**
     * @param Term $category
     * @return Application|Factory|View
     */
    public function __invoke(Term $category, Term $subcategory)
    {
        $id = LocalizationHelper::getCurrentLocaleId();
        $parentId = $subcategory->parent;

        if (!$parentId) {
            return abort(404);
        }

        $subcategory->load('posts');

        $description = $subcategory->description ? Str::limit(strip_tags($subcategory->description), 160) : '';

        $paginate_posts = $subcategory->posts()->where('post_language', $id)->paginate(8);

        $hashids = new Hashids();

        $ogImage = (config('settings.og_image')) ? route('ogi.display', config('settings.og_image')) :
            asset('img/cover.webp');

        if (!empty($subcategory->image)) {
            $image = route('ogipost.display', $subcategory->image);
        } else {
            if (config('settings.ogi_category')) {
                $image = route('ogi.display', config('settings.ogi_category'));
            } else {
                $image = $ogImage;
            }
        }

        if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') {
            $title = $subcategory->name . " :" . __('theme_magz.category') . " - " . config('settings.site_name');
        } else {
            $title = config('settings.site_name') . " - ".__('theme_magz.category') . ": " . $subcategory->name;
        }


        SeoHelper::getMeta($title, $description, null, route('category.show', $category->slug));
        SeoHelper::getOpenGraph($title, $description, route('category.show', $category->slug), null, $image);
        if (config('settings.twitter_username')) {
            SeoHelper::getTwitter($title, $description, route('category.show', $category->slug), $image);
        }
        SeoHelper::getJsonLd($title, $description, route('category.show', $category->slug), $image);

        return view(SettingHelper::activeTheme('page/subcategory'), compact(
            'category', 'subcategory', 'paginate_posts', 'hashids'
        ));

    }
}
