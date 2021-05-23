<?php

namespace code\helpers;

// session_start();

use App\Models\User;

class Auth
{

    public static function login($user)
    {
        $userFind=(new User)->where(['email' => $user['email']])[0] ?? false;
        
        if (!$userFind) {
            $_SESSION['login'] = false;
            return false;
        }

        if ($userFind->password == $user['password']) {
            
            $_SESSION['login'] = true;
            $_SESSION['user'] = $userFind;
            return true;
        }else {
            $_SESSION['login'] = false;
            return false;
        }
    }

    public static function check()
    {
        return $_SESSION['login'] ?? false;
    }

    public static function user()
    {
        return $_SESSION['user'] ?? false;
    }
}
