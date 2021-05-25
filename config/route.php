<?php
require_once __DIR__.'\..\core\helpers\Route.php';

use core\Route;

Route::get('login' , 'AuthController@index');
Route::get('login/confirme' , 'AuthController@confirme');
Route::get('logout' , 'AuthController@logout');

Route::get('article' , 'ArticleController@index');
Route::get('article/api' , 'ArticleController@api');
Route::get('article/add' , 'ArticleController@add');
Route::get('article/update' , 'ArticleController@update');
Route::get('article/delete' , 'ArticleController@delete');
