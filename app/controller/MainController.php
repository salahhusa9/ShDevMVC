<?php

namespace App\Controller;

class MainController{

    public static function callAction($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

}