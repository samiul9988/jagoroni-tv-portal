<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\{RedirectResponse, Request};

class LanguageController extends Controller
{
    /**
     * @param Request $request
     * @param $code
     * @return RedirectResponse
     */
    public function changeSwitchLanguage(Request $request, $code)
    {
        $request->session()->put('applocale', $code);

        return back();
    }
}
