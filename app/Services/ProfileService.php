<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Support\Carbon;

class ProfileService
{
    use ImageTrait;

    protected $user;
    
    /**
     * __construct
     *
     * @param  mixed $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        $user->email      = request('email');
        $user->occupation = request('occupation');
        $user->about      = request('about');
        $user->links      = $links;
        $user->updated_at = Carbon::now();

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
        
        if ($request->has('role')) {
            $user->syncRoles($request->role);
        }

        if ($user->wasChanged()) {
            $message = __('message.your_profile_has_been_successfully_changed');
        } else {
            $message = __('message.your_profile_change_failed');
        }

        return $message;           
    }
}