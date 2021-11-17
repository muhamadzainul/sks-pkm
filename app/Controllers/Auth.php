<?php

namespace App\Controllers;

// use App\Models\Model_pasien;
// use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        return view('/auth/login');
    }
}
