<?php

namespace App\View\Composers;

use App\Helpers\ThemeHelper;
use App\Helpers\LocalizationHelper;
use App\Models\Theme;
use App\Services\ArticleService;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HomeComposer
{
    protected $article, $term, $articleService, $termService;
    
    /**
     * __construct
     *
     * @param  mixed $article
     * @param  mixed $term
     * @param  mixed $articleService
     * @param  mixed $termService
     * @return void
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;

    }
    
    /**
     * compose
     *
     * @param  mixed $view
     * @return void
     */
    public function compose(View $view)
    {
        $page = 'home';

        $setting = (object) Theme::whereSlug($page)->firstWhere('theme', 'magz')->setting;

        $generalLayout = (object) Theme::find(1)->setting;
        $sidebarCustom = $setting->sidebar['config']['custom'] == 'true';
        $footerCustom = $setting->footer['config']['custom'] == 'true';

        $sidebarActive   = $sidebarCustom ? $setting->sidebar['config']['active'] == 'true' : $generalLayout->sidebar['config']['active'] == 'true';
        $sidebarPosition = $sidebarCustom ? $setting->sidebar['config']['position'] : $generalLayout->sidebar['config']['position'];
        
        $footerActive =  $footerCustom ? $setting->footer['config']['active'] == 'true' : $generalLayout->footer['config']['active'] == 'true';
        $bottomPostActive = $setting->body['widget']['bottom_post']['active'] == 'true';

        $body       = $setting->body['widget'];
        $bottomPost = $setting->body['widget']['bottom_post'];
        $sidebar    = $sidebarCustom ? $setting->sidebar['widget'] : $generalLayout->sidebar['widget'];
        $footer = $footerCustom ?  $setting->footer['widget']['section'] :  $generalLayout->footer['widget']['section'];

        $view->with(compact('body', 'bottomPost', 'sidebar', 'footer', 'sidebarActive', 'footerActive', 'bottomPostActive', 'sidebarPosition', 'page'));
    }
}
