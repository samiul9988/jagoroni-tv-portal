<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Http\Controllers\DarkModeController;

class UserDarkModeController extends DarkModeController
{
    /**
     * Toggle the dark mode preference.
     *
     * @return void
     */
    public function toggle()
    {
        $dark = request('dark');
        $user = User::find(Auth::id());
        $sessionDark = $dark > 0 ? true : false;
        session([$this->sessionKey => $sessionDark]);
        $user->darkmode = $dark;
        $user->save();
    }
}
