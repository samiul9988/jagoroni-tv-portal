<?php

namespace App\View\Components\Front\Magz\Sidebar;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class PopularSidebar extends Component
{
    public $popularSidebar;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($popularSidebar)
    {
        $this->popularSidebar = $popularSidebar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.front.magz.sidebar.popular-sidebar');
    }
}
