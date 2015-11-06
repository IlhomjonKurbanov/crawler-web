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

// Route::get('/', 'WelcomeController@index');

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@selectMall');

Route::get('getImagesByMall', 'RedisController@getImagesByMall');

Route::get('getImagesByMall2', 'RedisController@getImagesByMall2');

Route::get('getMallByCity', 'RedisController@getMallByCity');

Route::get('getCityByCountry', 'RedisController@getCityByCountry');

Route::get('getMallByCountry', 'RedisController@getMallByCountry');

Route::get('getCountry', 'RedisController@getCountry');

Route::get('getImagesById', 'RedisController@getImagesById');

Route::get('report', 'RedisController@index');

Route::get('image', 'RedisController@getImagesById');

Route::get('updateImageList', 'RedisController@updateImageList');

Route::post('saveCircle', 'MapController@saveCircleToDatabase');

Route::post('saveRectangle', 'MapController@saveRectangleToDatabase');

Route::get('map', 'MapController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
