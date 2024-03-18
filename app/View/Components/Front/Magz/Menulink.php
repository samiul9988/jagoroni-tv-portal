<?php

namespace App\View\Components\Front\Magz;

use App\Helpers\ThemeHelper;
use App\Services\MenuService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class Menulink extends Component
{
    public $active, $menu, $widgetData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(MenuService $menu, $template, $page, $layout, $type, $section, $column, $widgetName, $widgetData, $localeId)
    {
        $this->menu = $menu->getFooterMenu($localeId);
        $this->active = ThemeHelper::isWidgetActive($template, $page, $layout, $type, $section, $column, $widgetName);
        $this->widgetData = $widgetData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.front.magz.menulink');
    }
}
