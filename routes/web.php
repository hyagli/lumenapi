<?php

use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->get('/hash/{id}', function ($id) use ($router) {
	return Hash::make($id);
});

$router->group(['prefix' => 'firma/'], function() use ($router) {
    $router->post('login/','UserController@authenticate');
    $router->post('giris/','FirmaController@Giris');
    $router->post('gunle/','FirmaController@Gunle');
    $router->post('ekle/','FirmaController@Ekle');
});