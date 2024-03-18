<?php

namespace App\View\Components\Front\Magz;

use App\Helpers\LocalizationHelper;
use App\Services\ArticleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class MiniPost extends Component
{
    public $posts, $active, $widgetData, $template, $page, $layout, $widgetName, $type, $section, $column;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ArticleService $articleService, $page, $layout, $widgetName, $widgetData, $localeId)
    {
        $this->posts      = $articleService->dynamicQuery($page, $layout, $widgetName, $widgetData, $localeId);
        $this->active     = $widgetData['active'] == 'true' ? true : false;
        $this->widgetData = $widgetData;
        $this->layout     = $layout;
        $this->widgetName = $widgetName;
        $this->page       = $page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.front.magz.mini-post');
    }
}
