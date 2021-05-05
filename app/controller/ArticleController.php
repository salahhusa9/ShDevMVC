<?php

namespace App\Controller;

use App\Models\Article;

class ArticleController extends MainController
{
    public function index()
    {
        return view('article');
    }

    public function api()
    {
        $data=new Article();
        $data=$data->all();

        return json_encode(["data"=>$data]);
    }
}
