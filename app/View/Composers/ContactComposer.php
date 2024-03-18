<?php

namespace App\View\Composers;

use App\Helpers\ThemeHelper;
use App\Models\Theme;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class ContactComposer
{
    /**
     * compose
     *
     * @param  mixed $view
     * @return void
     */
    public function compose(View $view)
    {
        $page = "contact";

        $setting = (object) Theme::whereSlug($page)->firstWhere('theme', 'magz')->setting;
        $generalLayout = (object) Theme::find(1)->setting;

        //footer
        $footerCustom = $setting->footer['config']['custom'] == 'true';
        $footerActive =  $footerCustom ? $setting->footer['config']['active'] == 'true' : $generalLayout->footer['config']['active'] == 'true';
        $footer = $footerCustom ?  $setting->footer['widget']['section'] :  $generalLayout->footer['widget']['section'];
        
        $captchaActive = $setting->body['widget']['captcha']['active'] == 'true';
        $contactInformation = $setting->body['widget']['contact_information']['active'] == 'true';

        $view->with(compact('captchaActive', 'footerActive', 'footer', 'page', 'contactInformation'));
    }
}
