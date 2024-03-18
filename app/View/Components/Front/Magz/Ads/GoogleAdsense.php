<?php

namespace App\View\Components\Front\Magz\Ads;

use Illuminate\View\Component;

class GoogleAdsense extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.magz.ads.google-adsense');
    }
}
