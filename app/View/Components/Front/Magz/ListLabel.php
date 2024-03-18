<?php

namespace App\View\Components\Front\Magz;

use App\Helpers\LocalizationHelper;
use App\Services\TermService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class ListLabel extends Component
{
    public $active, $widgetData, $terms, $localeId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(TermService $termService, $page, $layout, $widgetName, $widgetData, $localeId)
    {
        $this->terms = $termService->dynamicQuery($page, $layout, $widgetName, $widgetData, $localeId);
        $this->active = $widgetData['active'] == 'true' ? true : false;
        $this->widgetData = $widgetData;
        $this->localeId = $localeId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function render()
    {
        return view('components.front.magz.list-label');
    }
}
