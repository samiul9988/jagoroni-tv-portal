<?php

namespace App\View\Components\Front\Magz\Footer;

use App\Helpers\LocalizationHelper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class AboutFooter extends Component
{
    public $widgetData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($widgetData)
    {
        $this->widgetData = $widgetData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.front.magz.footer.about-footer');
    }
}
