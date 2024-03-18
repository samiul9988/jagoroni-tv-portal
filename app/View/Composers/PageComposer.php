<?php

namespace App\View\Composers;

use App\Helpers\ThemeHelper;
use App\Models\Theme;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class PageComposer
{
    /**
     * compose
     *
     * @param  mixed $view
     * @return void
     */
    public function compose(View $view)
    {
        $page = "page";

        $setting = (object) Theme::whereSlug($page)->firstWhere('theme', 'magz')->setting;

        $generalLayout = (object) Theme::find(1)->setting;
        $sidebarCustom = $setting->sidebar['config']['custom'] == 'true';
        $footerCustom = $setting->footer['config']['custom'] == 'true';

        $sidebarActive   = $sidebarCustom ? $setting->sidebar['config']['active'] == 'true' : $generalLayout->sidebar['config']['active'] == 'true';
        $sidebarPosition = $sidebarCustom ? $setting->sidebar['config']['position'] : $generalLayout->sidebar['config']['position'];
        
        $footerActive =  $footerCustom ? $setting->footer['config']['active'] == 'true' : $generalLayout->footer['config']['active'] == 'true';

        $sidebar = $sidebarCustom ? $setting->sidebar['widget'] : $generalLayout->sidebar['widget'];
        $footer = $footerCustom ?  $setting->footer['widget']['section'] :  $generalLayout->footer['widget']['section'];

        $view->with(compact('sidebarActive', 'sidebarPosition', 'footerActive', 'sidebar', 'footer', 'page'));

    }
}
