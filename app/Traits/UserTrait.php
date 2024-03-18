<?php

namespace App\Traits;

use App\Helpers\UserHelper;
use App\Services\{RoleService, UserService};
use Illuminate\Support\Facades\Auth;

trait UserTrait
{
    use ImageTrait;

    protected $roleService, $userService;

    public function __construct(RoleService $roleService, UserService $userService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    /**
     * @param $roleName
     * @return bool
     */
    public function getCheckRoleExcept($roleName)
    {
        return $this->roleService->checkRoleExcept($roleName);
    }
    
    /**
     * getModulesRole
     *
     * @return array
     */
    public static function getModulesRole(): array
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        $getAllPermissions  = $currentUser->getAllPermissions();

        $modules = [];
        foreach ($getAllPermissions as $permission) {
            $modules[] = UserHelper::getModuleFromPermission($permission->name);
        }

        return array_unique($modules);
    }
    
    /**
     * storePhotoGetFileName
     *
     * @param  mixed $image
     * @return void
     */
    public function storePhotoGetFileName($image)
    {
        $image = request('image_base64');
        $name = request()->image->getClientOriginalName();

        $this->uploadFromBlobImage($name, $image);

        return $name;
    }
}
