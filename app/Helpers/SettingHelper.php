<?php

namespace App\Helpers;

use ArrayAccess;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use JeroenNoten\LaravelAdminLte\Events\ReadingDarkModePreference;
use JeroenNoten\LaravelAdminLte\Http\Controllers\DarkModeController;

class SettingHelper
{
    /**
     * @param $dir
     * @return mixed
     */
    public static function getTheme($dir)
    {
        $content = File::get(public_path('themes/' . $dir . '/theme.json'));
        return json_decode($content, true);
    }

    /**
     * @param $page
     * @return string
     */
    public static function activeTheme($page)
    {
        $theme_dir = config('settings.current_theme_dir');
        return 'frontend.'.$theme_dir.'.'.$page;
    }

    /**
     * @param $dir
     * @return array|ArrayAccess|mixed
     */
    public static function getThemeName($dir)
    {
        $getTheme = self::getTheme(last(explode('/', $dir)));
        return self::themeName($getTheme);
    }

    /**
     * @param $arr
     * @return array|ArrayAccess|mixed
     */
    public static function themeName($arr)
    {
        return Arr::get($arr, 'theme_name');
    }

    /**
     * @param $arr
     * @param $key
     * @return array|ArrayAccess|mixed
     */
    public static function getDataTheme($arr, $key)
    {
        return Arr::get($arr, $key);
    }

    /**
     * @return string
     */
    public static function makeNavClasses()
    {
        $classes = [];
        $darkModeCtrl = new DarkModeController();
        event(new ReadingDarkModePreference($darkModeCtrl));

        if ($darkModeCtrl->isEnabled()) {
            $classes[] = 'navbar-black navbar-dark';
        } else {
            $classes[] = 'navbar-white navbar-light';
        }

        return trim(implode(' ', $classes));
    }
    
    /**
     * check_connection
     *
     * @return void
     */
    public static function check_connection()
    {
        $connected = @fsockopen("www.google.com", 80);
        $is_conn = false;
        if ($connected) {
            $is_conn = true;
            fclose($connected);
        }
        return $is_conn;
    }
    
    /**
     * checkCredentialFileExists
     *
     * @return void
     */
    public static function checkCredentialFileExists()
    {
        return File::exists(storage_path('app/analytics/service-account-credentials.json'));
    }
}
