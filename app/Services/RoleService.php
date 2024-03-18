<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

Class RoleService
{
    protected $role, $userService;
    
    /**
     * __construct
     *
     * @param  mixed $role
     * @return void
     */
    public function __construct(UserService $userService, Role $role)
    {
        $this->role = $role;
        $this->userService = $userService;
    }
    
    /**
     * roles
     *
     * @return void
     */
    public function roles()
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if (! $currentUser->hasRole('super-admin')) {
            $roles = $this->getAllRolesReject();
        } else {
            $roles = $this->getAllRoles();
        }

        $permissions = $currentUser->getAllPermissions()->whereIn('name', $roles)->flatten()->toArray();

        $roleName = [];
        foreach ($permissions as $permission) {
            $name    = $permission['name'];
            $roleName[] = last(explode('-', $name));
        }

        return $this->role->select('id', 'name')
            ->whereIn('name', $roleName)->get();
    }
    
    /**
     * searchRole
     *
     * @param  mixed $keyword
     * @return void
     */
    public function searchRole($keyword) {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if (! $currentUser->hasRole('super-admin') ) {
            $roles = $this->getAllRolesReject();
        } else {
            $roles = $this->getAllRoles();
        }

        $permissions = $currentUser->getAllPermissions()->whereIn('name', $roles)->flatten()->toArray();

        $roleName = [];
        foreach ($permissions as $permission) {
            $name    = $permission['name'];
            $roleName[] = last(explode('-', $name));
        }

        return $this->searchByName($roleName, $keyword);
    }
    
    /**
     * searchByName
     *
     * @param  mixed $role
     * @param  mixed $keyword
     * @return void
     */
    public function searchByName($role, $keyword)
    {
        return $this->role->select('id','name')
            ->whereIn('name', $role)
            ->where("name", "LIKE", "%$keyword%")->get();
    }
    
    /**
     * getAllRoles
     *
     * @return void
     */
    public function getAllRoles()
    {
        return $this->role->all()->map(function ($role) {
            return 'read-' . $role->name;
        })->toArray();
    }
    
    /**
     * getAllRolesReject
     *
     * @return void
     */
    public function getAllRolesReject()
    {
        return $this->role->all()->reject(function ($role) {
            return $role->name === 'super-admin';
        })->map(function ($role) {
            return 'read-' . $role->name;
        })->toArray();
    }

    /**
     * @param $roleName
     * @return bool
     */
    public function checkRoleExcept($roleName)
    {
        $allRoles = $this->role->select('name')->whereNotIn('name', ['super-admin', 'admin', 'author'])->get();
        $arrRoles = Arr::flatten($allRoles->toArray());
        return in_array($roleName, $arrRoles);
    }
    
    /**
     * getRoleHasPermission
     *
     * @param  mixed $id
     * @return void
     */
    public function getRoleHasPermission($id)
    {
        return DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $role
     * @return void
     */
    public function update($request, $role)
    {
        $data = [
            'name' => Str::lower($request->name),
            'updated_at' => Carbon::now()
        ];

        return $role->update($request);
    }
    
    /**
     * roleCount
     *
     * @return void
     */
    public function roleCount()
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();
        
        if ($currentUser->hasRole('super-admin')) {
            return $this->role->count();
        } else {
            return $this->role->whereIn('name', $this->userService->showRoles())->count();
        }
    }

}
