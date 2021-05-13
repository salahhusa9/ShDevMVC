<?php

namespace App\Controller;

use App\Models\Article;

class AuthController extends MainController
{
    public function index()
    {
        return view('auth.login');
    }

}
