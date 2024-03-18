<?php

namespace App\View\Components\Front\Magz;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class Section extends Component
{
    public $page, $section, $layout, $dataSection, $active, $localeId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($page, $layout, $widgetData, $widgetName, $localeId)
    {  
        $this->section     = $widgetName;
        $this->dataSection = $widgetData;
        $this->layout      = $layout;
        $this->page        = $page;
        $this->localeId    = $localeId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.front.magz.section');
    }
}
