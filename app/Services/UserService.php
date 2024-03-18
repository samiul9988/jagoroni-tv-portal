<?php

namespace App\Services;

use App\Models\{Comment, User};
use App\Traits\ImageTrait;
use App\Traits\LanguageTrait;
use App\Traits\UserTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Auth, Hash, Storage};
use Spatie\Permission\Models\Role;

class UserService
{
    use LanguageTrait, UserTrait, ImageTrait;

    protected $user, $comment;
    
    /**
     * __construct
     *
     * @param  mixed $user
     * @return void
     */
    public function __construct(User $user, Comment $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
    }
    
    /**
     * get
     *
     * @return void
     */
    public function get()
    {
        return Auth::user();
    }
    
    /**
     * getAllPermissions
     *
     * @param  mixed $roles
     * @return void
     */
    public function getAllPermissions($roles)
    {
        /** @var object User */
        $currentUser = Auth::user();
        return $currentUser->getAllPermissions()->whereIn('name', $roles)->flatten()->toArray();
    }
    
    /**
     * changePassword
     *
     * @param  mixed $password
     * @param  mixed $user
     * @return void
     */    
    /**
     * changePassword
     *
     * @param  mixed $password
     * @param  mixed $user
     * @return void
     */
    public function changePassword($password, $user)
    {
        $data = [
            'password' => Hash::make($password)
        ];

        return $user->update($data);
    }
    
    /**
     * userCount
     *
     * @return void
     */
    public function userCount()
    {
        /** @var \App\Models\User */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('super-admin')) {
            return $this->user->count();
        } else {
            $roles = $this->showRoles();
            return $this->user->role($roles)->count();
        }
    }
    
    /**
     * showRoles
     *
     * @return void
     */
    public function showRoles()
    {
        $roles = Role::all()->reject(function ($role) {
            return $role->name === 'super-admin';
        })->map(function ($role) {
            return 'read-' . $role->name;
        })->toArray();

        /** @var Permission */
        $permissions =  $this->getAllPermissions($roles);
        
        $roles = [];
        
        foreach ($permissions as $permission) {
            $roles[] = last(explode('-', $permission['name']));
        }
        return $roles;
    }
    
    /**
     * save
     *
     * @param  mixed $request
     * @return void
     */
    public function save($request)
    {
        $this->user->create([
            'name'       => $request->name,
            'username'   => $request->username,
            'email'      => $request->email,
            'password'   => Hash::make(request('password')),
            'language'   => $this->getLanguageIdByAuth()
        ])->assignRole($request->role);
    }
    
    /**
     * modify
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function modify($request, $id)
    {
        $user = $this->user->findOrFail($id);

        $links = $request->has('links') ? json_encode(array_values($request->links)) : [];

        $user->name       = request('name');
        $user->username   = request('username');
        $user->password   = request('password') ? Hash::make(request('password')) : $user->password;
        $user->email      = request('email');
        $user->occupation = request('occupation');
        $user->about      = request('about');
        $user->links      = $links;
        $user->updated_at = Carbon::now();

        if (request()->missing('status')) {
            $user->ban();
            $user->active = '0';
        } else {
            if ($user->isBanned()) {
                $user->unban();
                $user->active = 1;
            }
        }

        if (request()->hasFile('image')) {
            if (!empty($user->photo)) {
                $this->deleteImage('avatar', $user->photo);
            }

            $image = $request->image_base64;
            $name  = request()->image->getClientOriginalName();

            if (count(explode(';', $image)) == 2) {
                $this->uploadFromBlobImage($name, $image);
                $user->photo = $name;
            }
        } else {
            if (request('isupload') == "remove") {
                if (!empty($user->photo)) {
                    $this->deleteImage('avatar', $user->photo);
                }
                $user->photo = null;
            }
        }

        $user->save();
        $user->syncRoles($request->role);
    }
    
    /**
     * remove
     *
     * @param  mixed $id
     * @return void
     */
    public function remove($id)
    {
        $user = $this->user->findOrFail($id);

        if ($user->photo) {
            $this->diskStorage()->delete('avatar/' . $user->photo);
        }

        $comment = $this->comment->find($id);

        if ($comment) {
            $comment->user_id = 0;
            $comment->save();
        }

        return $user->delete();
    }
    
    /**
     * massRemove
     *
     * @param  mixed $id
     * @return void
     */
    public function massRemove($id)
    {
        $user_id_array = $id;

        $users = $this->user->whereIn('id', $user_id_array)->get();

        foreach ($users as $item) {
            if ($item->photo) {
                $this->diskStorage()->delete('avatar/' . $item->photo);
            }

            $comment = $this->comment->find($item->id);

            if ($comment) {
                $comment->user_id = 0;
                $comment->save();
            }
        }

        return $this->user->whereIn('id', $user_id_array);
    }

}
