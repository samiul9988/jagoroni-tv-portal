<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class UserHelper
{    
    /**
     * getModuleFromPermission
     *
     * @param  mixed $permission
     * @return void
     */
    public static function getModuleFromPermission($permission) {
        $explode = explode('-', $permission);

        if (count($explode) < 3) {
            $module = Arr::last($explode);
        } else {
            array_shift($explode);
            $module = implode('-', $explode);
        }

        return $module;
    }
}
