<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ThemePagesDataTable;
use App\Helpers\SettingHelper;
use App\Http\Controllers\Controller;
use App\Models\{Language, Setting, Theme};
use App\Services\ThemeService;
use App\Traits\ThemeTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\{Auth, Gate};
use Illuminate\Support\{Arr, Str};

class ThemeController extends Controller
{
    use ThemeTrait;

    private $themeService;
    
    /**
     * __construct
     *
     * @param  mixed $themeService
     * @return void
     */
    public function __construct(ThemeService $themeService)
    {
        $this->middleware('permission:read-themes');
        $this->themeService = $themeService;
    }

    /**
     * @return null
     */
    public function activated()
    {
        Setting::where('name', 'current_theme')->update(['value' => request('theme')]);
        Setting::where('name', 'current_theme_dir')->update(['value' => request('theme_dir')]);
        return request()->session()->flash('success', __('message.theme_successfully_activated'));
    }

    /**
     * @return mixed
     */
    public function theme()
    {
        $theme = request('theme');
        return SettingHelper::getTheme(last(explode('/', $theme)));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $dirs = glob('themes/*' , GLOB_ONLYDIR);
        return view('admin.themes.index', compact('dirs'));
    }

    /**
     * General Layout
     *
     * @param Theme $theme
     * @return void
     */
    public function generalLayout(Theme $theme)
    {
        $themes = $theme->find(1);
        $settings = (object)$themes->setting;
        return view('admin.themes.general_layout', compact('themes', 'settings'));
    }

    /**
     * Set General layout
     *
     * @param mixed $layout
     * @return void
     */
    public function setGeneralLayout($theme, $layout)
    {
        $theme      = Theme::find(1);
        $arrSetting = $theme->first()->setting;

        $themeName  = $theme->first()->theme;
        $pageName   = $theme->first()->page;
        $language   = Auth::user()->language;
        $widgets    = $arrSetting[$layout]['widget'];

        $numberOfWidgetSection = '';

        if (Arr::exists($arrSetting, 'body')) {
            if(Arr::exists($arrSetting['body']['widget'], 'section')){
                if (count($arrSetting['body']['widget']['section']) > 1){
                    $numberOfWidgetSection = 'col-lg-6 col-md-6';
                } else {
                    $numberOfWidgetSection = 'col-lg-12 col-md-12';
                }
            }
        }

        $columns = $arrSetting['footer']['widget']['section'];

        $numberOfColumns = '';

        if (count($columns) == 3) {
            $numberOfColumns = 'col-lg-4 col-md-4';
        } else if (count($columns) == 2){
            $numberOfColumns = 'col-lg-6 col-md-6';
        } else {
            $numberOfColumns = 'col-lg-12 col-md-12';
        }

        $slug = 'all';

        $view = $layout.'._'.$layout;

        $language = Language::select('language')->find(Auth::user()->language)->language;

        return view('admin.themes.magz.'.$view, compact('themeName', 'pageName', 'slug', 'layout', 'widgets', 'language', 'numberOfWidgetSection', 'layout', 'numberOfColumns','columns', 'language'));
    }

    /**
     * @param ThemePagesDataTable $dataTable
     * @param $theme
     * @return mixed
     */
    public function pages(ThemePagesDataTable $dataTable, $theme)
    {
        $themeName = $theme;
        return $dataTable->render('admin.themes.pages', compact('themeName'));
    }

    /**
     * @param Theme $theme
     * @param $slug
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function layout(Theme $theme, $slug)
    {
        $themes = $theme->whereSlug($slug)->first();
        $settings = (object)$themes->setting;

        return view('admin.themes.layout', compact(
            'themes',
            'settings'
        ));
    }

    /**
     * @param $theme
     * @param $slug
     * @param $layout
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function widgets($theme, $slug, $layout)
    {
        $theme      = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;

        $themeName  = $theme->first()->theme;
        $pageName   = $theme->first()->page;
        $language   = Auth::user()->language;
        $widgets    = $arrSetting[$layout]['widget'];

        $numberOfWidgetSection = '';

        if (Arr::exists($arrSetting, 'body')) {
            if(Arr::exists($arrSetting['body']['widget'], 'section')){
                if (count($arrSetting['body']['widget']['section']) > 1){
                    $numberOfWidgetSection = 'col-lg-6 col-md-6';
                } else {
                    $numberOfWidgetSection = 'col-lg-12 col-md-12';
                }
            }
        }

        $columns = $arrSetting['footer']['widget']['section'];

        $numberOfColumns = '';

        if (count($columns) == 3) {
            $numberOfColumns = 'col-lg-4 col-md-4';
        } else if (count($columns) == 2){
            $numberOfColumns = 'col-lg-6 col-md-6';
        } else {
            $numberOfColumns = 'col-lg-12 col-md-12';
        }

        $view = $layout == 'body' ? $layout.'._'.$slug : $layout.'._'.$layout;

        $language = Language::select('language')->find(Auth::user()->language)->language;

        return view('admin.themes.magz.'.$view, compact('themeName', 'pageName', 'slug', 'layout', 'widgets', 'language', 'numberOfWidgetSection', 'layout', 'numberOfColumns','columns', 'language'));
    }

    /**
     * @param $theme
     * @param $slug
     * @param $layout
     * @param Request $request
     * @return JsonResponse
     */
    public function widgetStore($theme, $slug, $layout, Request $request)
    { 
        $result = $this->themeService->insertWidget($theme, $slug, $layout, $request);
        return response()->json(['success' => $result['message'], 'widgetName' => $result['widget'], 'widgetData' => $result['data']]);
    }

    /**
     * @param $theme
     * @param $slug
     * @param $layout
     * @param Request $request
     * @return JsonResponse
     */
    public function widgetEdit($theme, $slug, $layout, Request $request)
    {
        $theme    = Theme::whereTheme($theme)->whereSlug($slug)->first();
        $setting  = $theme->setting;
        $response = $this->themeService->getWidgetData($setting, $layout, $request);

        return response()->json($response);
    }

    /**
     * @param $theme
     * @param $slug
     * @param $layout
     * @param Request $request
     * @return JsonResponse
     */
    public function widgetUpdate($theme, $slug, $layout, Request $request)
    {
        if ($request->has('google_map_code')) {
            $result = $this->themeService->widgetMapUpdate($request);
        } else {
            $result = $this->themeService->modifyWidget($theme, $slug, $layout, $request);
        }
        
        return response()->json(['success' => $result['message'], 'title' => $result['title']]);
    }
    
    /**
     * contactConfigUpdate
     *
     * @param  mixed $request
     * @return void
     */
    public function contactConfigUpdate(Request $request)
    {
        $result = $this->themeService->modifyContactConfig($request);

        return response()->json(['success' => $result['message']]);
    }

    /**
     * @param $theme
     * @param $slug
     * @param $layout
     * @param Request $request
     * @return JsonResponse
     */
    public function changePosition($theme, $slug, $layout, Request $request)
    {
        $result = $this->themeService->modifyWidgetPosition($theme, $slug, $layout, $request);
        return response()->json(['success' => $result['message']]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeCustom(Request $request)
    {
        $message = $this->themeService->setCustomLayout($request);
        return response()->json(['success' => $message]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeVisible(Request $request)
    {
        $message = $this->themeService->setVisibleLayout($request);
        return response()->json(['success' => $message]);
    }

    /**
     * @param $theme
     * @param $page
     * @param $layout
     * @param $widget
     * @param Request $request
     * @return JsonResponse
     */
    public function changeVisibleWidget($theme, $page, $layout, $widget, Request $request)
    {
        $message = $this->themeService->setVisibleWidget($theme, $page, $layout, $widget, $request);
        return response()->json(['success' => $message]);
    }

    /**
     * @param $theme
     * @param $slug
     * @param $layout
     * @param $column
     * @param Request $request
     * @return JsonResponse
     */
    public function destroyColumn($theme, $slug, $layout, $column, Request $request)
    {
        if (!Gate::allows('delete-themes')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

        $this->themeService->removeColumn($theme, $slug, $layout, $request);
        return response()->json(['success' => __('message.deleted_successfully')]);
    }

    /**
     * @param $theme
     * @param $slug
     * @param $layout
     * @param $widget
     * @param Request $request
     * @return JsonResponse
     */
    public function destroyWidget($theme, $slug, $layout, $widget, Request $request)
    {
        if (!Gate::allows('delete-themes')) {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }

        $this->themeService->removeWidget($theme, $slug, $layout, $widget, $request);
        return response()->json(['success' => __('message.deleted_successfully')]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeSidebarPosition(Request $request)
    {
        $message = $this->themeService->setPosition($request);
        return response()->json(['success' => $message]);
    }

    /**
     * @param Theme $theme
     * @param $slug
     * @param $type
     * @param $section
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function sectionEdit(Theme $theme, $slug, $type, $section)
    {
        $page = $theme->whereSlug($slug)->first();
        $setting = (object)$theme->setting;

        $section = Str::replace('-', '_', $section);

        $val = $setting->{$type}[$section];

        $language = Auth::user()->language;

        return view('admin.themes.section', compact('page','type', 'section','val', 'language'));
    }

    /**
     * @param $theme
     * @param $slug
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function bodyEdit($theme, $slug)
    {
        $theme      = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;
        $themeName  = $theme->first()->theme;
        $pageName   = $theme->first()->page;
        $layout     = 'body';
        $language   = Auth::user()->language;
        $widgets    = $arrSetting['body']['widget'];

        return view('admin.themes.body._'.$slug, compact('themeName', 'pageName', 'slug', 'layout', 'widgets', 'language'));
    }

    /**
     * @param $theme
     * @param $slug
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function contactEdit($theme, $slug)
    {
        $theme      = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;
        $widgets    = $arrSetting['body']['widget'];
        return view('admin.themes.magz._contact', compact('widgets'));
    }

    /**
     * @param $theme
     * @param $slug
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function sidebarEdit($theme, $slug)
    {
        $theme = Theme::whereTheme($theme)->whereSlug($slug);
        $arrSetting = $theme->first()->setting;

        $active = $arrSetting['sidebar']['config']['active'];
        $position = $arrSetting['sidebar']['config']['position'];
        $themeName = $theme->first()->theme;
        $layout = 'sidebar';
        $widgets = $arrSetting['sidebar']['widget'];
        $language = Auth::user()->language;

        return view('admin.themes.sidebar', compact('themeName', 'slug', 'layout', 'widgets', 'language','active','position'));
    }

    /**
     * @param Theme $theme
     * @param $slug
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function footerEdit(Theme $theme, $slug)
    {
        $setting = (object)$theme->setting;
        $themeName = $theme->theme;
        $layout = 'footer';
        $section = $setting->footer;
        $columns = $section['widget']['section'];
        $language = Auth::user()->language;

        if(count($columns) == 3){
            $numberOfColumns = 'col-lg-4 col-md-4';
        }elseif(count($columns)==2){
            $numberOfColumns = 'col-lg-6 col-md-6';
        }else{
            $numberOfColumns = 'col-lg-12 col-md-12';
        }

        return view('admin.themes.magz._footer', compact('themeName', 'slug', 'columns', 'language', 'layout', 'numberOfColumns'));
    }

    /**
     * @param $theme
     * @param $slug
     * @param $layout
     * @param Request $request
     * @return JsonResponse
     */
    public function columnStore($theme, $slug, $layout, Request $request)
    {
        $result = $this->themeService->insertColumn($theme, $slug, $layout, $request);
        return response()->json(['success' => $result['message']]);
    }

    /**
     * @param Request $request
     * @param $theme
     * @param $slug
     * @param $section
     * @return mixed
     */
    public function sectionUpdate(Request $request, $theme, $slug, $section)
    {
        $message = $this->themeService->modifySection($theme, $slug, $section, $request);

        return redirect()->route('theme.section.edit', [$theme, $slug, $request->type_layout, $section])
            ->withSuccess($message);
    }
}
