<?php

namespace App\View\Components\Front\Magz\Footer;

use App\Services\MenuService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class MenuLink extends Component
{
    public $menus, $widgetData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(MenuService $menu, $widgetData, $localeId)
    {
        $this->menus = $menu->getFooterMenu($localeId);
        $this->widgetData = $widgetData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.front.magz.footer.menu-link');
    }
}
