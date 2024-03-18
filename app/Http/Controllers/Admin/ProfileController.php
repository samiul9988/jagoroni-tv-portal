<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Services\{ProfileService, UserService};
use App\Traits\ImageTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};

class ProfileController extends Controller
{
    private $userService, $profileService;
    use ImageTrait;
    
    /**
     * __construct
     *
     * @param  mixed $userService
     * @param  mixed $profileService
     * @return void
     */
    public function __construct(UserService $userService, ProfileService $profileService)
    {
        $this->userService = $userService;
        $this->profileService = $profileService;

        $this->middleware('permission:read-profile');
        $this->middleware('permission:update-profile', ['only' => ['edit']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $user    = User::find(Auth::id());
        $image   = $this->getBlobImage('avatar', $user->photo);
        $links   = json_decode($user->links);
        $roles   = $user->roles;

        return view('admin.profile.index', compact('user', 'links', 'image', 'roles'));
    }

    
    /**
     * edit_password
     *
     * @return void
     */
    public function edit_password()
    {
        return view('admin.profile.change_password');
    }
    
    /**
     * update_password
     *
     * @param  mixed $request
     * @return void
     */
    public function update_password(ChangePasswordRequest $request)
    {
        $id = Auth::id();
        $user = User::find($id);

        if (Hash::check($request->old_password, $user->password)) {
            $this->userService->changePassword($request->password, $user);
        } else {
            return redirect('admin/change-password')
                ->withErrors(['old_password' => __('message.password_wrong')])
                ->withInput();
        }

        return redirect()->route('view.password.edit')
            ->withSuccess(__('message.change_password_successfully'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name'       => 'required|string|min:2|max:100',
            'username'   => 'required|string|min:3|max:100|unique:users,username, ' . $id . ',id',
            'email'      => 'required|email|unique:users,email, ' . $id . ',id',
        ]);

        $profile = $this->profileService->modify($request, $id);

        return redirect()->route('profile.index')
            ->withSuccess($profile);
    }

    
}
