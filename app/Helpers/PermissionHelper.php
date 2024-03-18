<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

Class PermissionHelper
{    
    /**
     * getModule
     *
     * @param  mixed $permission
     * @return void
     */
    public static function getModule($permission) {
        $explode = explode('-', $permission);

        if (count($explode) < 3) {
            return Arr::last($explode);
        } else {
            array_shift($explode);
            return implode('-', $explode);
        }
    }
}
