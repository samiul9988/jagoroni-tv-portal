<?php

namespace App\Http\Controllers\Front;

use App\Helpers\{LocalizationHelper, SeoHelper, SettingHelper};
use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Contracts\Foundation\Application;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index($slug)
    {
        $id = LocalizationHelper::getCurrentLocaleId();
        $term = Term::tag()->whereSlug($slug)->whereLanguageId($id);
        $tag = $term->first();

        if ($tag) {
            $tag->load('posts');
            
            $description = $tag->description ? Str::limit(strip_tags($tag->description), 160) : '';

            $posts = $tag->posts()->where('post_language', $id)->paginate(8);

            if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') {
                $title = $tag->name . " :" . __('dhakawatch::magz.category') . " - " . config('settings.site_name');
            } else {
                $title = config('settings.site_name') . " - " . __('dhakawatch::magz.tag') . ": " . $tag->name;
            }

            SeoHelper::getMeta($title, $description, null, route('tag.show', $tag));
            SeoHelper::getOpenGraphPage('tag', $title, $description, route('tag.show', $tag), null, null);
            if (config('settings.twitter_username')) {
                SeoHelper::getTwitter($title, $description, route('tag.show', $tag), null);
            }
            SeoHelper::getJsonLd($title, $description, route('tag.show', $tag), null);

        } else {
            $posts = [];
            $tag = [];
        }

        return view(SettingHelper::activeTheme('page/tag'), compact('posts', 'tag'));
    }
}
