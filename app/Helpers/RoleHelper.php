<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RoleHelper
{
    /**
     * @return array
     */
    public static function showRoles()
    {
        $roles = Role::all()->reject(function ($role) {
            return $role->name === 'super-admin';
        })->map(function ($role) {
            return 'read-' . $role->name;
        })->toArray();

        $permissions = Auth::user()->getAllPermissions()->whereIn('name', $roles)->flatten()->toArray();

        $roles = [];
        foreach ($permissions as $permission) {
            $roles[] = last(explode('-', $permission['name']));
        }

        return $roles;
    }
}
