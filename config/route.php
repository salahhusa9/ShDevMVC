<?php
require_once __DIR__.'\..\core\helpers\Route.php';

use core\Route;

Route::get('article' , 'ArticleController@index');
Route::get('article/api' , 'ArticleController@api');
