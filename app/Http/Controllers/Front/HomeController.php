<?php

namespace App\Http\Controllers\Front;

use App\Helpers\{LocalizationHelper, SeoHelper, SettingHelper, ThemeHelper, UtlHelper};
use App\Http\Controllers\Controller;
use App\Traits\LanguageTrait;
use App\Models\{Post, Term};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeController extends Controller
{
    use LanguageTrait;

     /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        SeoHelper::getAll(config('settings.site_name'));
        return view(SettingHelper::activeTheme('page/jamuna-home'));
    }

    /**
     * @param $slug
     * @return RedirectResponse|never|void
     */
    public function show($slug)
    {
        $locale = LaravelLocalization::getCurrentLocale();
        $id = LocalizationHelper::getCurrentLocaleId();
        $isContactUrl = UtlHelper::isContactUrl();

        if (Post::videoAudioPost()->wherePostName($slug)->exists()) {
            if (config('settings.permalink_type') == 'custom') {
                $prefix = config('settings.permalink');
                return redirect('/'. $prefix . '/' . $slug);
            } else {
                $rpost = Post::videoAudioPost()->wherePostName($slug)->first();
                return (new ArticleController)->show($rpost);
            }
        } else if (Post::page()->wherePostName($slug)->exists()) {
            if (config('settings.page_permalink_type') == 'page_name') {
                $rpage = Post::page()->wherePostName($slug)->first();
                return (new PageController)->show($rpage);
            } else {
                return redirect('/page/' . $slug);
            }

        } else if (Term::Category()->where('slug', $slug)->exists()) {

            if (config('settings.category_permalink_type') == 'with_prefix_category') {
                return redirect('/category/' . $slug);
            } else {
                $rcategory = Term::Category()->where('slug', $slug)
                    ->where('language_id', $id)->first();

                if ($rcategory) {
                    return (new CategoryController)->__invoke($rcategory);
                } else {
                    $translation = Term::Category()->firstWhere('slug', $slug)->translation;
                    $slug = json_decode($translation, true);
                    return redirect('/category/' . $slug[$locale]);
                }
            }
        } else if ($isContactUrl) {
            if ($locale != $isContactUrl) {
                $data  = ThemeHelper::getConfigContact('magz', 'contact', 'body')['config'];
                return redirect($data['url'][$locale]);
            }
            SeoHelper::getAll(__('jagoronitv::magz.contact'), null, null, null, url("/contact"));
            return view(SettingHelper::activeTheme('page/contact'));
        } else {
            return abort(404);
        }

    }
}
