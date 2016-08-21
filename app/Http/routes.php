<?php

Route::get('/', 'PagesController@home');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Flyers routes...
// resource takes precedence
Route::resource('flyers', 'FlyersController');
Route::get('{zip}/{street}', 'FlyersController@show');
Route::post('{zip}/{street}/photos', [
    'as' => 'store_photo_path',
    'uses' => 'PhotosController@store'
]);

Route::delete('photos/{id}', 'PhotosController@destroy');