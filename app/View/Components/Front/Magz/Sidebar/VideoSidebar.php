<?php

namespace App\View\Components\Front\Magz\Sidebar;

use App\Services\VideoPostService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class VideoSidebar extends Component
{
    public $posts, $active, $widgetData, $template, $page, $layout, $widgetName, $type, $section, $column;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(VideoPostService $videoPostService, $page, $layout, $widgetName, $widgetData, $localeId)
    {
        $this->posts      = $videoPostService->dynamicQuery($page, $layout, $widgetName, $widgetData, $localeId);
        $this->active     = $widgetData['active'];
        $this->widgetData = $widgetData;
        $this->layout     = $layout;
        $this->widgetName = $widgetName;
        $this->page       = $page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        return view('components.front.magz.sidebar.video-sidebar');
    }
}
