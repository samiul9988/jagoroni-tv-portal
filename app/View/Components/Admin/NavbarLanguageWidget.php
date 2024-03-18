<?php

namespace App\View\Components\Admin;

use App\Models\Language;
use App\Services\LanguageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class NavbarLanguageWidget extends Component
{
    public $languages, $languageCode, $languageName, $flagIcon;

    /**
     * Create a new component instance.
     */
    public function __construct(LanguageService $languageService)
    {
        $this->languages    = Language::active()->select('name', 'country_code', 'id')->get();
        $this->languageCode = Auth::user()->userLanguage->locale;
        $this->languageName = $languageService->getLanguageNameByAuth();
        $this->flagIcon     = 'flag-icon-' . Str::lower(Auth::user()->userLanguage->country_code);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.admin.navbar-language-widget');
    }
}
