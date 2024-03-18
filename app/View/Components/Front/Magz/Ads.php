<?php

namespace App\View\Components\Front\Magz;

use Illuminate\View\Component;

class Ads extends Component
{
    public $active, $widgetName, $widgetData, $page, $layout;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($page, $layout, $widgetName, $widgetData)
    {
        $this->active     = $widgetData['active'] == 'true' ? true : false;
        $this->page       = $page;
        $this->layout     = $layout;
        $this->widgetName = $widgetName;
        $this->widgetData = $widgetData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.magz.ads');
    }
}
