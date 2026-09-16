<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Hashids\Hashids;
use App\Helpers\{SeoHelper, SettingHelper};
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SearchController extends Controller
{
    private $postService;
    
    /**
     * __construct
     *
     * @param  mixed $postService
     * @return void
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request)
    {
        $hashids = new Hashids();
        $keyword = $request->get('q');

        $query = $this->postService->postQuery();

        $query_search = $query->where(function($query) use ($keyword) {
            $query->where('post_title', 'like', "%".$keyword."%")
            ->orWhere('post_content', 'like', "%".$keyword."%")
            ->orWhere('post_image', 'like', "%".$keyword."%")
            ->orWhereHas('terms', function ($query) use ($keyword) {
                $query->where('name', $keyword);
            });
        });

        $posts       = $query_search->paginate(4);
        $countResults  = $query_search->count();

        if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') {
            $attr = ($posts->currentPage() == 1) ? "" : __('jagoronitv::magz.page')." " . $posts->currentPage() . " - ";
            $seoTitle = "$attr " . __('jagoronitv::magz.latest_news') . " - " . config('settings.site_name');
        } else {
            $attr = ($posts->currentPage() == 1) ? "" : " - ".__('jagoronitv::magz.page')." " . $posts->currentPage();
            $seoTitle = config('settings.site_name') . " - " .__('jagoronitv::magz.latest_news') ." $attr";
        }

        SeoHelper::getPage('search', $seoTitle);

        return view(SettingHelper::activeTheme('page/search'), compact(
            'posts',
            'keyword',
            'countResults',
            'hashids'));
    }
}
