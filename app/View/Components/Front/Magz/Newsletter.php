<?php

namespace App\View\Components\Front\Magz;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class Newsletter extends Component
{
    public $active, $widgetData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($template, $page, $layout, $type, $section, $column, $widgetName, $widgetData)
    {
        $this->active = $widgetData['active'];
        $this->widgetData = $widgetData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function render()
    {
        return view('components.front.magz.newsletter');
    }
}
