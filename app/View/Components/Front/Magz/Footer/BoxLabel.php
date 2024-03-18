<?php

namespace App\View\Components\Front\Magz\Footer;

use App\Helpers\LocalizationHelper;
use App\Services\TermService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class BoxLabel extends Component
{
    public $termService, $widgetData, $widgetName, $column, $terms;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(TermService $termService, $page, $layout, $widgetName, $widgetData)
    {
        $this->terms = $termService->dynamicQuery($page, $layout, $widgetName, $widgetData);
        $this->widgetData = $widgetData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function render()
    {
        return view('components.front.magz.footer.box-label');
    }
}
