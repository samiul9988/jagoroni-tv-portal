<?php

namespace App\View\Composers;

use App\Helpers\ThemeHelper;
use App\Models\Theme;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class CategoryComposer
{
    /**
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $page = "category";

        $setting = (object) Theme::whereSlug($page)->firstWhere('theme', 'magz')->setting;
        $generalLayout = (object) Theme::find(1)->setting;

        //sidebar
        $sidebarCustom   = $setting->sidebar['config']['custom'] == 'true';
        $sidebarActive   = $sidebarCustom ? $setting->sidebar['config']['active'] == 'true' : $generalLayout->sidebar['config']['active'] == 'true';
        $sidebarPosition = $sidebarCustom ? $setting->sidebar['config']['position'] : $generalLayout->sidebar['config']['position'];
        $sidebar         = $sidebarCustom ? $setting->sidebar['widget'] : $generalLayout->sidebar['widget'];

        //footer
        $footerCustom = $setting->footer['config']['custom'] == 'true';
        $footerActive = $footerCustom ? $setting->footer['config']['active'] == 'true' : $generalLayout->footer['config']['active'] == 'true';
        $footer       = $footerCustom ?  $setting->footer['widget']['section'] :  $generalLayout->footer['widget']['section'];

        $view->with(compact('sidebarActive', 'sidebarPosition', 'footerActive', 'sidebar', 'footer', 'page'));
    }
}
