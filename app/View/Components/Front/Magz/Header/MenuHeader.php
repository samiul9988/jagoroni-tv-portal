<?php

namespace App\View\Components\Front\Magz\Header;

use App\Services\{LanguageService, MenuService};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\View\Component;

class MenuHeader extends Component
{
    public $logoWebsite;
    public $menuHeader;
    public $displayLanguage;
    public $activeCount;
    public $languages;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(MenuService $menu, LanguageService $language, $localeId)
    {
        $this->logoWebsite     = config('settings.logo_web_dark');
        $this->menuHeader      = $menu->getHeaderMenu($localeId);
        $this->displayLanguage = config('settings.display_language');
        $this->languages       = $language->showDropdown();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('components.front.magz.header.menu-header');
    }
}
