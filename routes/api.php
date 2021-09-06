<?php
use Illuminate\Support\Facades\Route;




Route::namespace('API')->group(function() {

    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('logout', 'UserController@logout');

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index');
            Route::post('add', 'UserController@add');
            Route::get('edit/{id}', 'UserController@edit');
            Route::post('update/{id}', 'UserController@update');
            Route::delete('delete/{id}', 'UserController@delete');
        });

        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', 'RoleController@index');
            Route::post('add', 'RoleController@add');
            Route::get('edit/{id}', 'RoleController@edit');
            Route::post('update/{id}', 'RoleController@update');
            Route::delete('delete/{id}', 'RoleController@delete');
        });
    });
});