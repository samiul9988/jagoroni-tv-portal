<?php

namespace App\Http\Controllers\Front;

use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Contracts\Foundation\Application;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Helpers\{LocalizationHelper, PostHelper, SeoHelper, SettingHelper, UtlHelper};

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Post $page
     * @return Application|Factory|View
     */
    public function show($page)
    {
        if ($page) {
            UtlHelper::resolvePageUrl(LaravelLocalization::getNonLocalizedURL());

            preg_match_all('/src="([^"]*)"/', $page->post_content, $result);

            $getCurrentLocale = LaravelLocalization::getCurrentLocale()
                ? LaravelLocalization::getCurrentLocale()
                : config('settings.default_language');

            $id = LocalizationHelper::getCurrentLocaleId();

            $value = $page->translations->first()->value;

            if (count(json_decode($value, true)) > 1) {
                $pageId = data_get(json_decode($value, true), $getCurrentLocale);
            } else {
                if ($page->post_language == $id) {
                    $pageId = $page->id;
                } else {
                    abort(404);
                }
            }

            $pages = Post::find($pageId);

            if ($pages->meta_description) {
                $description = $page->meta_description;
            } else {
                if ($pages->post_summary) {
                    $description = Str::limit(strip_tags($pages->post_summary), 160);
                } else {
                    if ($pages->post_content) {
                        $description = Str::limit(strip_tags($pages->post_content), 160);
                    } else {
                        $description = config('settings.site_description');
                    }
                }
            }

            if ($pages->meta_keyword) {
                $keyword = $pages->meta_keyword;
            } else {
                $keyword = config('settings.meta_keyword');
            }

            if ($pages->post_visibility != "public" || $pages->post_status == "draft") {
                if (!Auth::check() || $pages->post_author != Auth::id()) {
                    return abort(404);
                }
            }

            $ogImage = (config('settings.ogi_page')) ? route('ogi.display', config('settings.ogi_page')) : asset('img/cover.webp');

            if (!empty($pages->post_image)) {
                $image = route('ogi.display', $pages->post_image);
            } else {
                if ($result[0]) {
                    $image = route('ogi.display', last(explode('/', $result[1][0])));
                } else {
                    if (config('settings.ogi_page')) {
                        $image = route('ogi.display', config('settings.ogi_page'));
                    } else {
                        $image = $ogImage;
                    }
                }
            }

            SeoHelper::getMeta($pages->post_title, $description, $keyword, PostHelper::getUriPost($pages));

            SeoHelper::getOpenGraphCustom(
                $pages->post_title,
                $description,
                PostHelper::getUriPost($pages),
                null,
                $image,
                [
                    'published_time' => $pages->created_at,
                    'modified_time'  => $pages->updated_at,
                    'author'         => $pages->user->name
                ]
            );

            if (config('settings.twitter_username')) {
                SeoHelper::getTwitter($pages->post_title, $description, PostHelper::getUriPost($pages));
            }

            SeoHelper::getJsonLd($pages->post_title, $description, PostHelper::getUriPost($pages), $image);
        } else {
            $pages = (object) [
                'post_title' => $page,
                'post_summary' => null,
                'post_image' => null,
                'post_content' => null
            ];
        }
       
        return view(SettingHelper::activeTheme('page/page'), compact('pages'));
    }
}
