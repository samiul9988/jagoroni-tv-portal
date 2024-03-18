<?php

namespace App\Helpers;

use App\Traits\ThemeTrait;
use Illuminate\Support\{Arr, Str};
use JeroenNoten\LaravelAdminLte\Events\ReadingDarkModePreference;
use JeroenNoten\LaravelAdminLte\Http\Controllers\DarkModeController;

class ThemeHelper
{    
    /**
     * isLayoutActive
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @param  mixed $layout
     * @param  mixed $widget
     * @return void
     */
    public static function isLayoutActive($theme, $page, $layout, $widget)
    {
        return (new class {
                use ThemeTrait;
            })->getSettingTheme($theme, $page, $layout)['config']['active'] == "true";
    }
    
    /**
     * isSectionActive
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @param  mixed $layout
     * @param  mixed $widget
     * @return void
     */
    public static function isSectionActive($theme, $page, $layout, $widget)
    {
        return (new class
        {
            use ThemeTrait;
        })->getSettingTheme($theme, $page, $layout)['config']['active'] == "true";
    }
    
    /**
     * isWidgetFeaturedActive
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @param  mixed $layout
     * @param  mixed $widget
     * @return void
     */
    public static function isWidgetFeaturedActive($theme, $page, $layout, $widget)
    {
        $active = (new class {
                use ThemeTrait;
            })->getSettingTheme($theme, $page, $layout)['widget'][$widget]['active'] == "true";

        return $active == 'true';
    }
    
    /**
     * isWidgetActive
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @param  mixed $layout
     * @param  mixed $type
     * @param  mixed $section
     * @param  mixed $column
     * @param  mixed $widget
     * @return void
     */
    public static function isWidgetActive($theme, $page, $layout, $type, $section, $column, $widget)
    {
        $active = "true";

        if ($layout == 'footer') {
            $active = (new class {
                    use ThemeTrait;
                })->getSettingTheme($theme, $page, $layout)['widget']['section'][$column][$widget]['active'] == "true";
        } else {
            if ($type == 'section') {
                $active = (new class {
                        use ThemeTrait;
                    })->getSettingTheme($theme, $page, $layout)['widget'][$section][$widget]['active'] == "true";
            } else {
                if ($widget != 'post') {
                    $active = (new class {
                            use ThemeTrait;
                        })->getSettingTheme($theme, $page, $layout)['widget'][$widget]['active'] == "true";
                }
            }
        }

        return $active == 'true';
    }
    
    /**
     * getWidget
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @param  mixed $layout
     * @return void
     */
    public static function getWidget($theme, $page, $layout)
    {
        $arrTheme = (new class { use ThemeTrait; })->getSettingTheme($theme, $page, $layout);
        return $arrTheme['widget'];
    }
    
    /**
     * getConfigContact
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @param  mixed $layout
     * @return void
     */
    public static function getConfigContact($theme, $page, $layout)
    {
        $arrTheme = (new class
        {
            use ThemeTrait;
        })->getSettingTheme($theme, $page, $layout);
        
        return $arrTheme;
    }
    
    /**
     * getConfig
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @param  mixed $layout
     * @param  mixed $widget
     * @param  mixed $item
     * @return void
     */
    public static function getConfig($theme, $page, $layout, $widget, $item)
    {
        $arrTheme = (new class { use ThemeTrait; })->getSettingTheme($theme, $page, $layout);
        if ($layout == 'body') {
            $locate = 'config.'.$widget;
        } else {
            $locate = 'config';
        }
        return Arr::get($arrTheme, $locate.'.'.$item);
    }
    
    /**
     * getProperty
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @param  mixed $layout
     * @param  mixed $widget
     * @param  mixed $item
     * @param  mixed $section
     * @param  mixed $column
     * @return void
     */
    public static function getProperty($theme, $page, $layout, $widget, $item, $section=null, $column=null)
    {
        $arrTheme = (new class { use ThemeTrait; })->getSettingTheme($theme, $page, $layout);

        if ($section == 'section') {
            $locate = 'widget.section.' . $widget;
        } elseif ($section == 'column') {
            $locate = 'widget.section.'.$column.'.'.$widget;
        } else {
            if ($layout == 'body') {
                $locate = 'widget.'.$widget;
            }
        }

        return Arr::get($arrTheme, $locate.'.'.$item);
    }
    
    /**
     * getSetSection
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @param  mixed $type
     * @param  mixed $section
     * @param  mixed $side
     * @return void
     */
    public static function getSetSection($theme, $page, $type, $section, $side)
    {
        $arrTheme = (new class { use ThemeTrait; })->getSettingTheme($theme, $page, $type);
        return Arr::get($arrTheme, $section.'.'.$side);
    }
    
    /**
     * getWidgetNameWithoutId
     *
     * @param  mixed $widget
     * @return void
     */
    public static function getWidgetNameWithoutId($widget)
    {
        $getWidgetName = Arr::first(Str::of($widget)->explode('-'));

        if (preg_match('/^[a-z]+_[a-z]+$/i', $getWidgetName)) {
            $getWidgetName = Arr::first(Str::of($widget)->explode('_'));
        }

        return Str::headline($getWidgetName);
    }
    
    /**
     * makeNavClasses
     *
     * @return void
     */
    public static function makeNavClasses()
    {
        $classes = [];

        // Use the dark mode controller to check if dark mode is enabled.

        $darkModeCtrl = new DarkModeController();

        // Dispatch an event to notify we are about to read the dark mode
        // preference. A listener may catch this event in order to setup the
        // dark mode initial state using the methods provided by the controller.

        event(new ReadingDarkModePreference($darkModeCtrl));

        // Now, check if dark mode is enabled.

        if ($darkModeCtrl->isEnabled()) {
            $classes[] = 'navbar-black navbar-dark';
        } else {
            $classes[] = 'navbar-white navbar-light';
        }

        return trim(implode(' ', $classes));
    }

    /**
     * @return bool
     */
    public static function isDarkModeDashboard()
    {
        $darkModeCtrl = new DarkModeController();

        event(new ReadingDarkModePreference($darkModeCtrl));

        if ($darkModeCtrl->isEnabled()) {
            return true;
        }

        return false;
    }
    
    /**
     * getComponentName
     *
     * @param  mixed $widgetName
     * @return void
     */
    public static function getComponentName($widgetName)
    {
        return str_replace('_', '-', Arr::first(Str::of($widgetName)->explode('-')));
    }
    
    /**
     * getpostType
     *
     * @param  mixed $arr
     * @return void
     */
    public static function getpostType($arr)
    {
        return Arr::first(Str::of($arr)->explode('_'));
    }
    
    /**
     * getWidgetTitle
     *
     * @param  mixed $widget
     * @param  mixed $titles
     * @param  mixed $language
     * @return void
     */
    public static function getWidgetTitle($widget, $titles, $language)
    {
        return ($titles && Arr::exists($titles, $language) && $titles[$language]) 
                ? $titles[$language] : Str::headline(Arr::first(Str::of($widget)->explode('-')));
    }

}
