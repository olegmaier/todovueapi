<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/logout', 'AuthController@logout');

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::get('/tasks', 'TasksController@index');
Route::get('/tasks/{id}', 'TasksController@show');
Route::post('/tasks', 'TasksController@store');
Route::put('/tasks/{id}', 'TasksController@store');
Route::delete('/tasks/{id}', 'TasksController@destroy');

Route::get('/users', 'UsersController@index');
Route::get('/users/{id}', 'UsersController@show');
Route::post('/users', 'UsersController@store');
Route::put('/users/{id}', 'UsersController@store');
Route::delete('/users/{id}', 'UsersController@destroy');