<?php

namespace App\View\Components\Front\Magz\Footer;

use App\Helpers\LocalizationHelper;
use Illuminate\View\Component;

class NewsletterFooter extends Component
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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front.magz.footer.newsletter-footer');
    }
}
