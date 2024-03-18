<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Services\{PermissionService, RoleService, UserService};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Support\Facades\{Auth, Gate};
use Illuminate\Support\Str;
use Spatie\Permission\Models\{Permission, Role};

class RoleController extends Controller
{
    private $permissionService, $roleService, $userService;
    
    /**
     * __construct
     *
     * @param  mixed $permissionService
     * @param  mixed $roleService
     * @param  mixed $userService
     * @return void
     */
    public function __construct(PermissionService $permissionService, RoleService $roleService, UserService $userService)
    {
        $this->permissionService = $permissionService;
        $this->roleService = $roleService;
        $this->userService = $userService;

        $this->middleware('permission:read-roles', ['except' => ['ajaxSearch']]);
        $this->middleware('permission:add-roles', ['only' => ['create']]);
        $this->middleware('permission:update-roles', ['only' => 'edit', 'update', 'changePermission', 'changeAllPermission']);
        $this->middleware('permission:delete-roles', ['only' => 'destroy', 'massdestroy']);
    }
    
    /**
     * ajaxSearch
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
        return $this->roleService->searchRole($keyword);
    }

    /**
     * @return JsonResponse
     */
    public function changePermission()
    {
        $role = Role::findOrFail(request('role_id'));

        $permission = Permission::find(request('permissions'));
        if ($role->hasPermissionTo($permission->name)) {
            $role->revokePermissionTo($permission->name);
            $msg = __('message.revoke_permissions', ['name' => $permission->name]);
        } else {
            $role->givePermissionTo($permission->name);
            $msg = __('message.give_permissions', ['name' => $permission->name]);
        }
        return response()->json(['success' => $msg]);
    }

    /**
     * @return JsonResponse
     */
    public function changeAllPermission()
    {
        $role = Role::findOrFail(request('role_id'));

        if (request('status') === 'true') {
            $role->givePermissionTo(Permission::all());
            $msg = __('message.give_all_permission');
        } else {
            $role->revokePermissionTo(Permission::all());
            $msg = __('message.revoke_all_permission');
        }

        return response()->json(['success' => $msg]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(RolesDataTable $dataTable)
    {
        return $dataTable->render('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $permissions = $this->permissionService->getPermissions();
        $modules = $this->permissionService->getModulesRole();

        return view('admin.roles.create', compact('permissions', 'modules'));
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:roles|max:50|min:2|alpha_dash'
        ]);

        $role = Role::firstOrCreate(['name' => Str::lower(request('name'))]);

        $role->syncPermissions(request('permissions'));

        $read       = Permission::create(['name' => 'read-' . Str::lower(request('name'))]);
        $add        = Permission::create(['name' => 'add-' . Str::lower(request('name'))]);
        $update     = Permission::create(['name' => 'update-' . Str::lower(request('name'))]);
        $delete     = Permission::create(['name' => 'delete-' . Str::lower(request('name'))]);
        $editPost   = Permission::create(['name' => 'edit-post-' . Str::lower(request('name'))]);
        $deletePost = Permission::create(['name' => 'delete-post-' . Str::lower(request('name'))]);

        Role::findByName('super-admin')->givePermissionTo([
            $read, $add, $update, $delete, $editPost, $deletePost
        ]);
        Role::findByName('admin')->givePermissionTo([
            $read, $add, $update, $delete, $editPost, $deletePost
        ]);

        return redirect()->route('roles.index')->withSuccess(__('message.saved_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        $role = Role::find($id);
        $status = $this->roleService->checkRoleExcept($role->name);

        if($currentUser->hasRole('super-admin')) {
            $permissions = $this->permissionService->getAllPermission();
        }else{
            $except = [
                Permission::firstWhere('name', 'read-settings')->id,
                Permission::firstWhere('name', 'update-settings')->id
            ];

            $permissions = $this->permissionService->getAllPermission($except);
        }
        $modules         = $this->permissionService->getModulesRole();
        $rolePermissions = $this->roleService->getRoleHasPermission($id);
        $ifCheckAll      = $this->permissionService->permissionCount() === count($rolePermissions);

        return view('admin.roles.edit', compact(
            'role',
            'permissions',
            'rolePermissions',
            'ifCheckAll',
            'modules',
            'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::find($id);
        $status = $this->roleService->checkRoleExcept($role->name);

        if ($status) {
            $this->roleService->update($request, $role);

            return redirect()->route('roles.index')
                ->withSuccess(__('message.updating_successfully'));
        } else {
            return response()->json(['error' => __('message.dont_have_permission')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if (!Gate::allows('delete-roles')) {
            return response()->json(['error' =>  __('message.dont_have_permission')]);
        }

        $role = Role::findOrFail($id);

        if ($this->roleService->checkRoleExcept($role->name)) {
            Permission::where('name', 'read-' . $role->name)->delete();
            Permission::where('name', 'add-' . $role->name)->delete();
            Permission::where('name', 'update-' . $role->name)->delete();
            Permission::where('name', 'delete-' . $role->name)->delete();
            Permission::where('name', 'edit-post-' . $role->name)->delete();
            Permission::where('name', 'delete-post-' . $role->name)->delete();
            $role->delete();
            return response()->json(['success' => __('message.deleted_successfully')]);
        }
        return response()->json(['error' => __('message.deleted_not_successfully')]);
    }

    /**
     * Remove the multi resource from storage.
     *
     * @return JsonResponse
     */
    public function massdestroy()
    {
        if (!Gate::allows('delete-roles')) {
            return response()->json(['error' =>  __('message.dont_have_permission')]);
        }

        $roles_id_array = request('id');

        $roles = Role::whereIn('id', $roles_id_array);

        $roles_id = [];
        $permission_id_array = [];

        foreach ($roles->get() as $role) {
            if ($this->roleService->checkRoleExcept($role->name)) {
                $permission_id_array[] = Permission::where('name', 'read-' . $role->name)->first()->id;
                $permission_id_array[] = Permission::where('name', 'add-' . $role->name)->first()->id;
                $permission_id_array[] = Permission::where('name', 'update-' . $role->name)->first()->id;
                $permission_id_array[] = Permission::where('name', 'delete-' . $role->name)->first()->id;
                $permission_id_array[] = Permission::where('name', 'edit-post-' . $role->name)->first()->id;
                $permission_id_array[] = Permission::where('name', 'delete-post-' . $role->name)->first()->id;

                $roles_id[] = $role->id;
            }
        }

        Permission::whereIn('id', $permission_id_array)->delete();

        $roles = Role::whereIn('id', $roles_id);

        if ($roles->delete()) {
            return response()->json(['success' => __('message.deleted_successfully')]);
        } else {
            return response()->json(['error' => __('message.deleted_not_successfully')]);
        }
    }
}
