<?php

namespace App\View\Components\Front\Magz\Contact;

use App\Helpers\ThemeHelper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class Map extends Component
{
    public $active, $data, $google_map_code;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->active = ThemeHelper::isWidgetActive('magz', 'contact', 'body', 'widget', null, null, 'map');
        $this->data = ThemeHelper::getWidget('magz', 'contact', 'body');
        $this->google_map_code = $this->data['map']['google_map_code'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function render()
    {
        return view('components.front.magz.contact.map');
    }
}
