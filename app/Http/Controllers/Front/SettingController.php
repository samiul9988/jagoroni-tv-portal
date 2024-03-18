<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function changeSwitchLanguage(Request $request): string
    {
        $request->session()->put('applocale', request('code'));
        return 'success';
    }
}
