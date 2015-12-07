<?php

Route::get('/', 'BookshelfController@index');

Route::post('bookshelf/checkout', 'BookShelfController@checkout');

Route::post('bookshelf/return', 'BookShelfController@returnBook');

Route::get('auth/login', function () {
    return view('auth.login');
});

Route::get('auth/logout', function () {
    return view('auth.login');
});

Route::get('auth/register', function () {
    return view('auth.register');
});

Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
