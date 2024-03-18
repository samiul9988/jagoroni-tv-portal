<?php

namespace App\Traits;

use App\Models\Language;

trait LocalizationTrait
{    
    /**
     * listFlags
     *
     * @return void
     */
    public static function listFlags()
    {
        return Language::select('id', 'language', 'country_code')->active()->get();
    }
}


