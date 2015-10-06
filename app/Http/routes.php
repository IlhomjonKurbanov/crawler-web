<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('getImagesByMall', 'RedisController@getImagesByMall');

Route::get('getMallByCity', 'RedisController@getMallByCity');

Route::get('getCityByCountry', 'RedisController@getCityByCountry');

Route::get('getMallByCountry', 'RedisController@getMallByCountry');

Route::get('getCountry', 'RedisController@getCountry');

Route::get('getImagesById', 'RedisController@getImagesById');

Route::get('report', 'RedisController@index');

Route::get('image', 'RedisController@getImagesById');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
