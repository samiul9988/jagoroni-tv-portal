<?php

namespace App\View\Components\Front\Magz;

use App\Helpers\LocalizationHelper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class Links extends Component
{
    public $active, $links, $widgetData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($page, $layout, $widgetName, $widgetData)
    {
        $this->active = $widgetData['active'];
        $this->links = json_decode(config('settings.links'));
        $this->widgetData = $widgetData;
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.front.magz.links');
    }
}
