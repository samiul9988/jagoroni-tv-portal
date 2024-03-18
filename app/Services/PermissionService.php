<?php

namespace App\Services;

use App\Helpers\PermissionHelper;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

Class PermissionService
{
    protected $permission;

        
    /**
     * __construct
     *
     * @param  mixed $permission
     * @return void
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        return $this->permission->all();
    }

    /**
     * @param $except
     * @return mixed
     */
    public function getAllPermission($except = null)
    {
        /** @var object Permission */
        $permissionGetAll = $this->getAll();

        if ($except){
            $permission = $permissionGetAll->except($except);
        } else {
            $permission = $permissionGetAll;
        }

        return $permission->pluck('name', 'id');
    }
    
    /**
     * getPermissions
     *
     * @return void
     */
    public function getPermissions()
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('super-admin')) {
            $permissions = $this->permission->all()->pluck('name', 'id');
        } else {
            $except = [
                $this->permission->firstWhere('name', 'read-super-admin')->id,
                $this->permission->firstWhere('name', 'add-super-admin')->id,
                $this->permission->firstWhere('name', 'update-super-admin')->id,
                $this->permission->firstWhere('name', 'delete-super-admin')->id
            ];

            $permission = $this->permission->all()->except($except);
            $permissions = $permission->pluck('name', 'id');
        }

        return $permissions;
    }

    /**
     * @return array
     */
    public function getModulesRole(): array
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        $getAllPermissions = $currentUser->getAllPermissions();

        $modules = [];
        foreach ($getAllPermissions as $permission) {
            $modules[] = PermissionHelper::getModule($permission->name);
        }

        return array_unique($modules);
    }
    
    /**
     * permissionCount
     *
     * @return void
     */
    public function permissionCount()
    {
        return  $this->permission->count();
    }
}
