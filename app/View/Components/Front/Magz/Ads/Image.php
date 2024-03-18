<?php

namespace App\View\Components\Front\Magz\Ads;

use App\Helpers\{ImageHelper, LocalizationHelper};
use Illuminate\View\Component;

class Image extends Component
{
    public $widgetData, $image, $layout;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($layout, $widgetName, $widgetData)
    {
        $image            = $widgetData['ad_image'] ? $widgetData['ad_image'] : '';
        $this->widgetData = $widgetData;
        $this->image      = ImageHelper::showAdImage($image, $widgetName,);
        $this->layout     = $layout;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.magz.ads.image');
    }
}
