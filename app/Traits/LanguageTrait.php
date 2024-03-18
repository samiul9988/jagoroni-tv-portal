<?php

namespace App\Traits;

use App\Models\Language;
use Illuminate\Support\Facades\Auth;

trait LanguageTrait
{    
    /**
     * getLanguageCodeByAuth
     *
     * @return void
     */
    public function getLanguageCodeByAuth()
    {
        $languageId = Auth::user()->language;
        $language = Language::find($languageId);
        return $language->language;
    }
    
    /**
     * getLanguageIdByAuth
     *
     * @return void
     */
    public function getLanguageIdByAuth()
    {
        $languageId = Auth::user()->language;
        $language = Language::find($languageId);
        return $language->id;
    }
    
    /**
     * getLanguageCodeById
     *
     * @param  mixed $id
     * @return void
     */
    public function getLanguageCodeById($id)
    {
        $language = Language::find($id);
        return $language->language;
    }
    
    /**
     * getLanguageIdByCode
     *
     * @param  mixed $code
     * @return void
     */
    public function getLanguageIdByCode($code)
    {
        return Language::firstWhere('language', $code)->id;
    }
}
