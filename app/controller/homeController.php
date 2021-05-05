<?php

namespace App\Controller;


use App\Controller\MainController;
use App\Models\Article;

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

        $article= new Article();

        $article=$article->all();  

        // $article=$article->insert([
        //     'title' => 'Blog 2' ,
        //     'content' => 'content 2',
        //     'id-categorie' => 1,
        //     'id-author' => 1,
        // ]);   

        // $article=$article->update(['id',1],'title' , 'Blog NEW');  


        // $article=$article->delete('id',1);  
        

        return view('one.tow',['articles' => $article]);
    }
}