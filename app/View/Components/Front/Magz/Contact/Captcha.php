<?php

namespace App\View\Components\Front\Magz\Contact;

use App\Helpers\ThemeHelper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class Captcha extends Component
{
    public $active;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->active = ThemeHelper::isWidgetActive('magz', 'contact', 'body', 'widget', null, null, 'captcha');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        return view('components.front.magz.contact.captcha');
    }
}
