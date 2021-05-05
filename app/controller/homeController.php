<?php

namespace App\Controller;


use App\Controller\MainController;

class HomeController extends MainController {
    
    public function index()
    {
        // return 'gg';
        return view('home');
    }

    public function test($id)
    {
        return $id;
    }

    public function view()
    {
        return view('one.tow');
    }
}