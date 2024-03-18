<?php

namespace App\Helpers;

use Illuminate\Support\{Arr, Str};

use App\Traits\StorageDiskTrait;

Class ImageHelper
{
    /**
     * @param $dir
     * @param $file
     * @return mixed
     */
    public static function isExists($dir, $file)
    {
        return (new class { use StorageDiskTrait; })->isExistFile($dir, $file);
    }

    /**
     * imageStoragePathLocation
     *
     * @param mixed $dir
     * @return void
     */
    public static function imageStoragePathLocation($dir)
    {
        return (new class {use StorageDiskTrait; })->pathLocal($dir);
    }

    /**
     * @param $dir
     * @param $file
     * @return mixed
     */
    public static function dbExists($dir, $file)
    {
        return (new class { use StorageDiskTrait; })->isExistFile($dir, $file);
    }

    /**
     * @param $dir
     * @param $file
     * @param $locate_filename_default
     * @return string
     */
    public static function show($dir, $file, $locate_filename_default = null)
    {
        if (! $file) {
            return asset($locate_filename_default);
        }

        $isExists = self::isExists($dir, $file);
        return $isExists ? asset('storage/' . $dir . '/' . $file) : asset($locate_filename_default);
    }

    /**
     * @return string
     */
    public static function webLogoLight()
    {
        if (config('settings.logo_web_light') AND self::isExists('assets', config('settings.logo_web_light'))) {
            return asset('storage/assets/' . config('settings.logo_web_light'));
        } else {
            return asset('themes/magz/images/logo-light.webp');
        }
    }

    /**
     * @return string
     */
    public static function webLogoDark()
    {
        if (config('settings.logo_web_dark') AND self::isExists('assets', config('settings.logo_web_dark'))) {
            return asset('storage/assets/' . config('settings.logo_web_dark'));
        } else {
            return asset('themes/magz/images/logo.webp');
        }
    }
    
    /**
     * webIcon
     *
     * @return void
     */
    public static function webIcon()
    {
        if (config('settings.favicon') AND self::isExists('assets', config('settings.favicon'))) {
            return asset('storage/assets/' . config('settings.favicon'));
        } else {
            return asset('favicons/favicon-96x96.png');
        }
    }

    /**
     * @param $image
     * @return string
     */
    public static function ogImageCategory($image)
    {
        if ($image) {
            return asset('storage/images/' . $image);
        } else {
            if (config('settings.ogi_category')) {
                return asset('storage/assets/' . config('settings.ogi_category'));
            }else{
                return asset('img/cover.webp');
            }
        }
    }

    /**
     * @param $image
     * @return string
     */
    public static function getVideoThumbnail($image)
    {
        if ($image) {
            if (self::isExists('images', $image)) {
                return asset('storage/images/' . $image);
            }
        }

        return  asset('img/bg-player.png');
    }
    
    /**
     * showAdImage
     *
     * @param  mixed $image
     * @param  mixed $widgetName
     * @return void
     */
    public static function showAdImage($image, $widgetName)
    {
        if ($image) {
            return asset('storage/ad/' . $image);
        } else {
            $file = (Arr::first(Str::of($widgetName)->explode('-'))) == 'ads' ? '750x80.webp' : '350x300.webp';
            return asset('themes/magz/images/' . $file);
        }
        
    }
}
