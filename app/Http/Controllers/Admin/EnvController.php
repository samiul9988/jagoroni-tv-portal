<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class EnvController extends Controller
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:read-env');
    }
}
