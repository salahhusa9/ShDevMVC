<?php

// use App\Controller\HomeController;
// use App\Controller\MainController;

use core\Route;

    require_once __DIR__.'\..\config\route.php';
    require_once __DIR__.'\..\core\header.php';
    require_once __DIR__.'\..\config\class.php';

    // spl_autoload_register(function ($class_name) {
    //     // $dir= "C:\Users\Youcode\Desktop\all dos\ShDevMVC\\";
    //     $dir= "..\App\Controller\\";
    //     $path = $dir.$class_name;
    //     include $path. '.php';
    // });

    $myRoutes=Route::$myRoutes;

    // get : http://localhost:3030/one/tow?key=val
    $linkReq=$_SERVER['REQUEST_URI']; // get : /one/tow?key=val

    $linkReq = ltrim($linkReq, '/');    // get : one/tow?key=val (delete first /)
    $path=explode("?",$linkReq);        // separt the get parame
    // // print_r($path);
    if (isset($myRoutes[$path[0]])) { // if don't have eny parame in the link 
        //routing
        $link=explode("@",$myRoutes[$path[0]]);
        include_once '../App/Controller/'.$link[0].'.php'; // include file of class
        $className=$link[0];

        $class="App\Controller\\".$className;
        $sep1=new $class();
        $sep2=$link[1];

        if (!file_exists($sep1->$sep2())) {
            print_r($sep1->$sep2());
        }else {
            require_once $sep1->$sep2();
        }

    }else{
        $pathParam=explode("/",$path[0]);
        $countPathParam=count($pathParam);
        $parameters=[];
        // //print_r($pathParam);
        foreach ($myRoutes as $key => $value) {
            $good[$key]=0;
            $routeParam=explode("/",$key);
            if (count($routeParam) == $countPathParam) {  // Compares the count of items in the link (for optimize)
                // // echo '</br> ok';
                for ($i=0; $i < $countPathParam; $i++) { 
                    if ($pathParam[$i] == $routeParam[$i]) { // Compares the items in the link
                            // //echo '</br> good : '.$pathParam[$i].' == '.$routeParam[$i];
                            $good[$key]++; // if Matches and point
                        }
                }
                $p=0;
                foreach ($routeParam as  $arg) {
                    if ($arg[0] == '{') {            // create the get parametre :delete { } and create
                        $arg=ltrim($arg, '{');
                        $arg=chop($arg, '}');
                        $_GET[$arg]=$pathParam[$p];
                        $GLOBALS[$arg]=$pathParam[$p];
                        $parameters[$arg]=$pathParam[$p];

                    }
                $p++;
                }

                foreach ($_GET as $key => $value) {
                    $GLOBALS[$key]=$value;
                }
            }
        }

        if (isset($good) and max($good) != 0) { // If we are the largest equals 0 , It means that no link has been endorsed
            $root= array_search(max($good),$good); // This is the key to the right path, because he is the one who has obtained the most number of validations
            // //echo $root; // this the key of the true route
            $link=explode("@",$myRoutes[$root]);
            
            require_once '../App/Controller/'.$link[0].'.php'; // include file of class
            $className=$link[0];
            $class="App\Controller\\".$className;
            $sep1=new $class();
            $sep2=$link[1];

            if (!file_exists($sep1->$sep2(...$parameters))) {
                print_r($sep1->$sep2(...$parameters));
            }else {
                require_once $sep1->$sep2(...$parameters);
            }

            // require_once $sep1->$sep2(...$parameters);
        }
        // // print_r($_GET);
        return header("HTTP/1.0 404 Not Found");
    }
?>