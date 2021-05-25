<?php

namespace App\Controller;

use code\helpers\Auth;

class AuthController extends MainController
{
    public function index()
    {
        return view('auth.login');
    }

    public function confirme()
    {
        $check=Auth::login(['email' => $_POST['email'] , 'password' => $_POST['password']]);

        if (!$check) {
            return redirect('login');
        }

        return redirect('article');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

}
