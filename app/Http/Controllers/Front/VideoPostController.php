<?php

namespace App\Http\Controllers\Front;

use App\Helpers\{SeoHelper, SettingHelper};
use App\Http\Controllers\Controller;
use App\Services\VideoPostService;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class VideoPostController extends Controller
{
    private $videoPostService;
    
    /**
     * __construct
     *
     * @param  mixed $videoPostService
     * @return void
     */
    public function __construct(VideoPostService $videoPostService)
    {
        $this->videoPostService = $videoPostService;
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $query = $this->videoPostService->query();
        $posts = $query->latest()->paginate(8);

        if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') {
            $attr = ($posts->currentPage() == 1) ? "" : __('jagoronitv::magz.page') . " " . $posts->currentPage() . " - ";
            $seoTitle = "$attr " . __('jagoronitv::magz.latest_videos') . " - " . config('settings.site_name');
        } else {
            $attr = ($posts->currentPage() == 1) ? "" : " - " . __('jagoronitv::magz.page') . " " . $posts->currentPage();
            $seoTitle = config('settings.site_name') . " - " . __('jagoronitv::magz.latest_videos') . " $attr";
        }

        SeoHelper::getPage('video_post', $seoTitle);

        return view(SettingHelper::activeTheme('page/videos'), compact('posts'));
    }
}