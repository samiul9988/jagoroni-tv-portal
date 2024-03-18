<?php

namespace App\Services;

use App\Models\{Setting, Theme};
use App\Traits\WidgetTrait;
use Illuminate\Support\{Arr, Str};
use Illuminate\Support\Facades\Cache;

class ThemeService
{
    use WidgetTrait;
    
    /**
     * getValue
     *
     * @param  mixed $slug
     * @param  mixed $theme
     * @return void
     */
    public function getValue($slug, $theme)
    {
        return Theme::whereSlug($slug)->whereTheme($theme)->first()->value;
    }
    
    /**
     * setPosition
     *
     * @param  mixed $request
     * @return void
     */
    public function setPosition($request)
    {
        $theme = Theme::whereTheme($request->theme)->whereSlug($request->page);
        $arrSetting = $theme->first()->setting;
        Arr::set($arrSetting, 'sidebar.config.position', $request->position);

        $theme->update([
            'setting' => $arrSetting
        ]);

        return __('message.changed_successfully');
    }

    /**
     * setCustomLayout
     *
     * @param  mixed $request
     * @return void
     */
    public function setCustomLayout($request)
    {
        $theme = Theme::whereTheme($request->theme)->whereSlug($request->page);
        $arrSetting = $theme->first()->setting;
        $locate = $request->layout.'.config.custom';

        Arr::set($arrSetting, $locate, $request->active);

        $theme->update([
            'setting' => $arrSetting
        ]);

        if($request->active == 'true') {
            $message = $request->title . ' ' . __('message.activated_successfully');
        } else {
            $message = $request->title . ' ' . __('message.deactivated_successfully');
        }

        return $message;
    }
    
    /**
     * setVisibleLayout
     *
     * @param  mixed $request
     * @return void
     */
    public function setVisibleLayout($request)
    {
        $theme = Theme::whereTheme($request->theme)->whereSlug($request->page);
        $arrSetting = $theme->first()->setting;
        $locate = $request->layout.'.config.active';

        Arr::set($arrSetting, $locate, $request->active);

        $theme->update([
            'setting' => $arrSetting
        ]);

        if($request->active == 'true') {
            $message = $request->title . ' ' . __('message.activated_successfully');
        } else {
            $message = $request->title . ' ' . __('message.deactivated_successfully');
        }

        return $message;
    }
    
    /**
     * setVisibleWidget
     *
     * @param  mixed $theme
     * @param  mixed $page
     * @param  mixed $layout
     * @param  mixed $widget
     * @param  mixed $request
     * @return void
     */
    public function setVisibleWidget($theme, $page, $layout, $widget, $request)
    {
        $theme = Theme::whereTheme($theme)->whereSlug($page);
        $arrSetting = $theme->first()->setting;

        if ($request->type == 'column') {
            $locate = $layout.'.widget.section.'.$request->column.'.'.$widget.'.active';
        } else if ($request->type == 'section') {
            $locate = $layout . '.widget.' . $request->section . '.widget.' .  $widget . '.active';
        } else if ($request->type == 'featured') {
            $locate = $layout.'.widget.'.$widget.'.active';
        } else {
            $locate = $layout . '.widget.' . $widget . '.active';
        }

        Arr::set($arrSetting, $locate, $request->active);

        $theme->update([
            'setting' => $arrSetting
        ]);

        return __('message.changed_successfully');
    }
    
    /**
     * insertWidget
     *
     * @param  mixed $theme
     * @param  mixed $slug
     * @param  mixed $layout
     * @param  mixed $request
     * @return void
     */
    public function insertWidget($theme, $slug, $layout, $request)
    {
        $theme = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;

        $exists = false;
        $message = __('message.added_successfully');

        $posts = Arr::get($arrSetting, $layout . '.widget.posts');
        $bottomPost = Arr::get($arrSetting, $layout . '.widget.bottom_post');

        if ($layout == 'body') {
            $widget = $request->widget.'-' .Str::random();

            if ($request->widget == 'section') {
                $data = null;
            
                Arr::forget($arrSetting, $layout . '.widget.posts');
                Arr::forget($arrSetting, $layout . '.widget.bottom_post');
                
                Arr::set($arrSetting, $layout . '.widget.' . $widget, ['active' => 'true', 'widget' => []]);
                Arr::set($arrSetting, $layout . '.widget.posts', $posts);
                Arr::set($arrSetting, $layout . '.widget.bottom_post', $bottomPost);

            } else {
                $data = $this->{$request->widget}($layout, $request);
                if ($request->section === 'true') {
                    Arr::set($arrSetting, $layout.'.widget.'.$request->sectionName.'.widget.'.$widget, $data);
                } else {

                    Arr::forget($arrSetting, $layout . '.widget.posts');
                    Arr::forget($arrSetting, $layout.'.widget.bottom_post');

                    Arr::set($arrSetting, $layout.'.widget.'.$widget, $data);
                    Arr::set($arrSetting, $layout . '.widget.posts', $posts);
                    Arr::set($arrSetting, $layout.'.widget.bottom_post', $bottomPost);
                }
            }
        } else if ($layout == 'sidebar') {
            $widget = $request->widget . '-' . Str::random();
            $data = $this->{$request->widget}($layout, $request);
            Arr::set($arrSetting, $layout . '.widget.' . $widget, $data);
        } else if ($layout == 'footer') {

            $getExist = Arr::get($arrSetting, $layout.'.config.exist');
            $exists = in_array($request->widget, $getExist);

            if ($exists) {
                $widget = null;
                $data = null;
                $message = __('message.widget_already_exist');
            } else {
                $widget = $request->widget;
                $data = $this->{$widget}($layout, $request);

                //cek middle_column
                if ($request->column == 'right_column') {
                    //get column data
                    $getColumn = Arr::get($arrSetting, $layout . '.widget.section');

                    //check middle_column exist
                    $isMiddleColumnExist = Arr::exists($getColumn, 'middle_column');

                    if(!$isMiddleColumnExist) {
                        $newColumn = ['middle_column' => []];

                        //insert middle_column into the second position column in the array
                        $newArrColumn = array_merge(array_slice($getColumn, 0, 1), $newColumn, array_slice($getColumn, 1));

                        //get right_column data
                        $getDataRightColumn = Arr::get($newArrColumn, 'right_column');

                        //move to middle_column
                        Arr::set($newArrColumn, 'middle_column', $getDataRightColumn);

                        //remove right_column data
                        Arr::set($newArrColumn, 'right_column', []);

                        //nserting new column data into $arrSetting
                        Arr::set($arrSetting, $layout . '.widget.section', $newArrColumn);
                    }  
                }

                //insert widget name to exist config
                array_push($getExist, $widget);

                Arr::set($arrSetting, $layout . '.config.exist', $getExist);   
                Arr::set($arrSetting, $layout.'.widget.section.'.$request->column.'.'.$widget, $data);   
            }
        }

        $theme->update([
            'setting' => $arrSetting
        ]);

        return [
            'message' => $message,
            'widget'  => $widget,
            'data'    => $data
        ];
    }
    
    /**
     * insertColumn
     *
     * @param  mixed $theme
     * @param  mixed $slug
     * @param  mixed $layout
     * @param  mixed $request
     * @return void
     */
    public function insertColumn($theme, $slug, $layout, $request)
    {
        $theme = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;

        $locateSet = $layout . '.widget.section';

        if ($layout == 'footer') {
            foreach ($request->data as $widget) {
                if (Arr::exists($widget, 'children')) {
                    foreach ($widget['children'] as $iWidget) {
                        $arr[$widget['id']][$iWidget['id']] = json_decode($iWidget['data'], true);
                    }
                } else {
                    $arr[$widget['id']] = [];
                }
            }
        }

        Arr::set($arrSetting, $locateSet, $arr);

       $theme->update([
            'setting' => $arrSetting
        ]);

        return [
            'message' => __('message.added_successfully'),
        ];
    }
    
    /**
     * modifyWidgetPosition
     *
     * @param  mixed $theme
     * @param  mixed $slug
     * @param  mixed $layout
     * @param  mixed $request
     * @return void
     */
    public function modifyWidgetPosition($theme, $slug, $layout, $request)
    {
        $theme = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;

        $arr = [];

        if ($layout == 'footer') {
            $locateSet = $layout.'.widget.section';
            foreach ($request->widget as $widget) {
                if (Arr::exists($widget, 'children')) {
                    foreach($widget['children'] as $iWidget){
                        $arr[$widget['id']][$iWidget['id']] = json_decode($iWidget['data'], true);
                    }
                } else {
                    $arr[$widget['id']] = [];
                }
            }
        }

        if ($layout == 'body' OR $layout == 'sidebar') {
            $locateSet = $layout.'.widget';
            
            foreach ($request->widget as $widget) {
                if (Arr::exists($widget, 'children')) {
                    $arr[$widget['id']]['active'] = $widget['data'];
                    foreach($widget['children'] as $iWidget){
                        $arr[$widget['id']]['widget'][$iWidget['id']] = json_decode($iWidget['data'], true);
                    }
                } else {
                    $arr[$widget['id']] = json_decode($widget['data'], true);
                }
            }
        }

        Arr::set($arrSetting, $locateSet, $arr);

        $theme->update([
            'setting' => $arrSetting
        ]);

        return [
            'message' => __('message.added_successfully'),
        ];
    }
    
    
    /**
     * modifySidebarWidget
     *
     * @param  mixed $theme
     * @param  mixed $slug
     * @param  mixed $layout
     * @param  mixed $request
     * @return void
     */
    public function modifySidebarWidget($theme, $slug, $layout, $request)
    {
        $theme = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;

        $widget = Arr::first(Str::of($request->widget)->explode('-'));

        if ($widget == 'post') {

            $title = $request->title ? $request->title : '';
            $postType = $request->filled('post_type') ? $request->post_type: 'none';
            $category = $request->filled('category') ? $request->category: 'none';
            $popular = $request->filled('popular_based') ? $request->popular_based: 'none';

            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.post_type', $postType);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.category', $category);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.layout_type', 'list');
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.title', $title);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.order', $request->order);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.popular_based', $popular);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.number_of_posts', $request->number_of_posts);
        }

        if ($widget == 'term') {
            $title = $request->title ? $request->title : '';
            $popular = $request->filled('popular_based') ? $request->popular_based: 'none';

            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.title', $title);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.term_type', $request->term_type);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.order', $request->order);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.popular_based', $popular);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.number_of_posts', $request->number_of_posts);
        }

        if ($widget == 'newsletter') {
            $title = $request->title ? $request->title : '';
            $description = $request->description ? $request->description : '';

            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.title', $title);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.description', $description);
        }

        if ($widget == 'about') {
            $title = $request->title ? $request->title : '';

            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.title', $title);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.logo', $request->logo);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.link', $request->link);
        }

        if ($widget == 'social_media_link') {
            $title = $request->title ? $request->title : '';
            $description = $request->description ? $request->description : '';

            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.title', $title);
            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.description', $description);
        }

        if ($widget == 'menu_link') {
            $title = $request->title ? $request->title : '';

            Arr::set($arrSetting, $layout.'.widget.'.$request->widget.'.title', $title);
        }

        $theme->update([
            'setting' => $arrSetting
        ]);

        return [
            'title' => $request->title ? $request->title : Str::headline($widget),
            'message' => __('message.changed_successfully')
        ];
    }
    
    /**
     * getWidgetData
     *
     * @param  mixed $setting
     * @param  mixed $layout
     * @param  mixed $request
     * @return void
     */
    public function getWidgetData($setting, $layout, $request)
    {
        if ($request->type == 'column') {
            $locate = $layout.'.widget.section.'.$request->column.'.'.$request->widget;
        } else if ($request->type == 'section') {
            $locate = $layout.'.widget.'.$request->typeName.'.widget.'.$request->widget;
        } else {
            $locate = $layout.'.widget.'.$request->widget;
        }

        $data        = Arr::get($setting, $locate);
        $widgetType  = Arr::first(Str::of($request->widget)->explode('-'));
        $widgetModal = $widgetType.'Modal';

        if ($layout == 'body') {
            if ($request->type == 'featured') {
                $html             = $this->{$widgetModal}($data);
            } else if ($request->type == 'section') {
                if ($widgetModal == 'mini_postModal') {
                    $html = $this->{$widgetModal}($data);
                } else if ($widgetModal == 'list_labelModal') {
                    $html = $this->{$widgetModal}($data);
                } else {
                    $exists = Arr::exists($data, 'carousel_autoplay');

                    if ($exists) {
                        $carouselAutoplay = Arr::get($setting, $layout . '.widget.'.$request->typeName.'.' . $request->widget . '.carousel_autoplay');
                        $html             = $this->{$widgetModal}($layout, $data, $carouselAutoplay);
                    } else {
                        $html = $this->{$widgetModal}($layout, $data);
                    }
                }
            } else {
                $html = $this->{$widgetModal}($data);
            }
        } else {
            $html = $this->{$widgetModal}($data);
        }

        return $html;
    }
    
    /**
     * modifyWidget
     *
     * @param  mixed $themeName
     * @param  mixed $slug
     * @param  mixed $layout
     * @param  mixed $request
     * @return void
     */
    public function modifyWidget($themeName, $slug, $layout, $request)
    {
        $theme = Theme::whereTheme($themeName)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;

        $locate = $layout.'.widget.'.$request->widget.'.ad_image';
        $image = Arr::get($arrSetting, $locate);

        $column = $request->column;
        $widget = $request->widget;
        $widgetType = Arr::first(Str::of($request->widget)->explode('-'));

        if ($request->type == 'column') {
            $locate = $layout.'.widget.section.'.$column.'.'.$widget;
        } else if ($request->type == 'section') {
            $locate = $layout.'.widget.'.$request->typeName.'.'.$widget;
        } else {
            $locate = $layout.'.widget.'.$widget;
        }

        $fileName = '';

        if ($widgetType == 'ads' OR $widgetType == 'ads_sidebar') {
            if ($request->has('ad_image')) {
                if ($image) {
                    $exists = $this->diskStorage()->exists('ad/' . $image);

                    if ($exists) {
                        $this->diskStorage()->delete('ad/' . $image);
                    }
                }

                $fileName    = $this->uploadFile('ad', $request->ad_image);
            } else {
                $fileName = $image;
            }
        }

        $request->merge([
            'image'  => $fileName
        ]);

        $widgetUpdate = $widgetType.'Update';
        $setting = $this->{$widgetUpdate}($arrSetting, $layout, $locate, $request);

        $theme->update([
            'setting' => $setting
        ]);

        return [
            'title' => $request->title ?: Str::headline($widgetType),
            'message' => __('message.changed_successfully')
        ];
    }
    
    /**
     * modifyContactConfig
     *
     * @param  mixed $request
     * @return void
     */
    public function modifyContactConfig($request)
    {
        $theme = Theme::whereTheme('magz')->whereSlug('contact');
        $arrSetting = $theme->first()->setting;

        $locate = 'body.config';

        $setting = $this->contactConfigUpdate($arrSetting, $locate, $request);
        
        $theme->update([
            'setting' => $setting
        ]);

        return [
            'message' => __('message.changed_successfully')
        ];
    }
    
    /**
     * modifySection
     *
     * @param  mixed $theme
     * @param  mixed $slug
     * @param  mixed $section
     * @param  mixed $request
     * @return void
     */
    public function modifySection($theme, $slug, $section, $request)
    {
        $theme = Theme::whereTheme($theme)->whereSlug($slug);

        $arrSetting = $theme->first()->setting;

        if ($section == 'headline_news') {
            Arr::set($arrSetting, 'main.headline_news.autoplay', $request->autoplay);
        } else if ($section == 'main_widget') {

            $title = $request->title ? $request->title : '';
            $category = $request->filled('category') ? $request->category: 'none';
            $postType = $request->filled('post_type') ? $request->post_type: 'none';

            Arr::set($arrSetting, 'main.main_widget.'.$request->side.'.type', $request->type);
            Arr::set($arrSetting, 'main.main_widget.'.$request->side.'.post_type', $postType);
            Arr::set($arrSetting, 'main.main_widget.'.$request->side.'.category', $category);
            Arr::set($arrSetting, 'main.main_widget.'.$request->side.'.title', $title);
            Arr::set($arrSetting, 'main.main_widget.'.$request->side.'.order', $request->order);
            Arr::set($arrSetting, 'main.main_widget.'.$request->side.'.number_of_posts', $request->number_of_posts);

        } else if ($section == 'main_widget') {
            dd(1);
        } else {

            $title = $request->title ? $request->title : '';
            $category = $request->filled('category') ? $request->category: 'none';
;
            Arr::set($arrSetting, 'main.featured_news.post_type', $request->post_type);
            Arr::set($arrSetting, 'main.featured_news.category', $category);
            Arr::set($arrSetting, 'main.featured_news.layout_type', $request->layout_type);
            Arr::set($arrSetting, 'main.featured_news.title', $title);
            Arr::set($arrSetting, 'main.featured_news.order', $request->order);
            Arr::set($arrSetting, 'main.featured_news.number_of_posts', $request->number_of_posts);
        }

        $theme->update([
            'setting' => $arrSetting
        ]);

        return __('message.changed_successfully');
    }
    
    /**
     * widgetMapUpdate
     *
     * @param  mixed $request
     * @return void
     */
    public function widgetMapUpdate($request)
    {
        Cache::forget('settings');
        
        Setting::where('key', 'google_map_code')->update(['value' => $request->google_map_code]);

        return [
            'title' => 'Map',
            'message' => __('message.changed_successfully')
        ];
    }
    
    /**
     * removeColumn
     *
     * @param  mixed $theme
     * @param  mixed $slug
     * @param  mixed $layout
     * @param  mixed $request
     * @return void
     */
    public function removeColumn($theme, $slug, $layout, $request)
    {
        $theme = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;

        if ($request->widgets) {
            $getExists = Arr::get($arrSetting, $layout.'.config.exist');

            foreach ($request->widgets as $data) {
                if (($key = array_search($data, $getExists)) !== false) {
                    unset($getExists[$key]);
                }
            }

            Arr::set($arrSetting, $layout.'.config.exist', $getExists);
        }

        $locateSet = $layout . '.widget.section';

        if ($layout == 'footer') {
            foreach ($request->data as $widget) {
                if (Arr::exists($widget, 'children')) {
                    foreach ($widget['children'] as $iWidget) {
                        $arr[$widget['id']][$iWidget['id']] = json_decode($iWidget['data'], true);
                    }
                } else {
                    $arr[$widget['id']] = [];
                }
            }
        }

        Arr::set($arrSetting, $locateSet, $arr);

        return $theme->update([
            'setting' => $arrSetting
        ]);
    }
    
    /**
     * removeWidget
     *
     * @param  mixed $theme
     * @param  mixed $slug
     * @param  mixed $layout
     * @param  mixed $widget
     * @param  mixed $request
     * @return void
     */
    public function removeWidget($theme, $slug, $layout, $widget, $request)
    {

        $theme = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;

        if($request->filled('data')) {
            Arr::forget($arrSetting, $layout.'.widget.section.'.$request->data.'.'.$widget);
        }

        if ($layout == 'footer') {
            $getExists = Arr::get($arrSetting, $layout.'.config.exist');

            if (($key = array_search($widget, $getExists)) !== false) {
                unset($getExists[$key]);
            }
            Arr::set($arrSetting, $layout.'.config.exist', $getExists);
        }

        if ($request->filled('column')) {
            Arr::forget($arrSetting, $layout.'.widget.section.'.$request->column.'.'.$widget);
        } else {
            if ($request->type === 'widget') {
                Arr::forget($arrSetting, $layout.'.widget.'.$widget);
            } else if ($request->type === 'widget-section') {
                Arr::forget($arrSetting, $layout . '.widget.'.$request->section.'.widget.'. $widget);
            } else if ($request->type === 'section') {
                Arr::forget($arrSetting, $layout . '.widget.'.$widget);
            }
        }

        return $theme->update([
            'setting' => $arrSetting
        ]);
    }


}
