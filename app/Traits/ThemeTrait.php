<?php

namespace App\Traits;

use App\Models\Theme;

trait ThemeTrait
{    
    /**
     * getValue
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @return void
     */
    public function getValue($theme, $page)
    {
        return Theme::whereSlug($page)->firstWhere('theme', $theme);
    }
    
    /**
     * getSettingTheme
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @param  mixed $layout
     * @return void
     */
    public function getSettingTheme($theme, $page, $layout)
    {
        $setting = (object) Theme::whereSlug($page)->firstWhere('theme', $theme)->setting;
        return $setting->{$layout};
    }
}
