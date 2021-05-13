<?php

namespace core;

class Route {

    public static $myRoutes=[];
    
    public static function get($link,$path)
    {
        // if ($_SERVER['REQUEST_METHOD']!=='GET') {
        //     die('the method is false ,not get');
        // }
        
        return self::$myRoutes[$link]=$path;
    }

    public static function test()
    {
        return  'test';
    }
}
