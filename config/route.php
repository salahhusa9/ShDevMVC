<?php
require_once __DIR__.'\..\core\helpers\Route.php';

use core\Route;

Route::get('' , 'view\home.php');
Route::get('home' , 'view\home.php');
Route::get('test/{id}' , 'view\one\tow.php');
Route::get('test/user/{id}/add/{staus}/{par}' , 'view\one\tow.php');
Route::get('test/user/{id}/delete/{staus}/{par}' , 'view\one\tow.php');
