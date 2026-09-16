<?php

namespace App\Http\Controllers\Front;

use App\Helpers\{SeoHelper, SettingHelper};
use App\Http\Controllers\Controller;
use App\Services\AudioPostService;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AudioPostController extends Controller
{
    private $audioPostService;
    
    /**
     * __construct
     *
     * @param  mixed $audioPostService
     * @return void
     */
    public function __construct(AudioPostService $audioPostService)
    {
        $this->audioPostService = $audioPostService;
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $query = $this->audioPostService->query();
        $posts = $query->latest()->paginate(8);

        if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') {
            $attr = ($posts->currentPage() == 1) ? "" : __('jagoronitv::magz.page') . " " . $posts->currentPage() . " - ";
            $seoTitle = "$attr " . __('jagoronitv::magz.latest_audios') . " - " . config('settings.site_name');
        } else {
            $attr = ($posts->currentPage() == 1) ? "" : " - " . __('jagoronitv::magz.page') . " " . $posts->currentPage();
            $seoTitle = config('settings.site_name') . " - " . __('jagoronitv::magz.latest_audios') . " $attr";
        }

        SeoHelper::getPage('audio_post', $seoTitle);

        return view(SettingHelper::activeTheme('page/audios'), compact('posts'));
    }
}
