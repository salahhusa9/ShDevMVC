<?php
namespace App\Controller;

use App\Models\Article;
use code\helpers\Auth;

class ArticleController extends MainController
{
    public function __construct() {
        if (!Auth::check()) {
            redirect('login');
        }
    }

    public function index()
    {
        return view('article',['user' => Auth::user()]);
    }

    public function api()
    {
        $data=new Article();
        $data=$data->all();

        return json_encode(["data"=>$data]);
    }

    public function add()
    {
        $data=new Article();
        return $data->insert([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'id-categorie' => 1,
            'id-author' => 1,
        ]);

    }

    public function update()
    {
        $data=new Article();
        $data->update(['id' , $_POST['id']], 'title' , $_POST['title'] );
        $data->update(['id' , $_POST['id']], 'content' , $_POST['content'] );
        return true;
    }

    public function delete()
    {
        $data=new Article();
        $data->delete('id' , $_POST['id'] );
        return true;
    }
}
