<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');


Route::namespace('API')->group(function() {
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::post('logout', 'UserController@logout')->middleware('auth:sanctum');

    Route::group(['prefix' => 'books', 'middleware' => 'auth:sanctum'], function () {
        Route::get('/', [BookController::class, 'index']);
        Route::post('add', [BookController::class, 'add']);
        Route::get('edit/{id}', [BookController::class, 'edit']);
        Route::post('update/{id}', [BookController::class, 'update']);
        Route::delete('delete/{id}', [BookController::class, 'delete']);
    });
});