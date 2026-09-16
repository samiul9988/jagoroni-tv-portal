<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['nullable', 'email', 'required_without:username'],
            'username' => ['nullable', 'string', 'required_without:email'],
            'password' => ['required', 'string', 'min:6']
        ]);

        $loginValue = $request->input('email') ?: $request->input('username');
        $fieldType = $request->filled('email') || filter_var($loginValue, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';
        $remember = $request->has('remember') ? $request->remember : null;

        $credentials = [
            $fieldType => $loginValue,
            'password' => $request->password,
            'active' => 1
        ];

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');
        }

        return back()
            ->withInput()
            ->withErrors([
                $fieldType => __('auth.failed'),
            ]);
    }
}
