<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        return view('/auth/login');
    }
    public function register2()
    {
        return view('/auth/register2');
    }
}
