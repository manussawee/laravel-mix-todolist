<?php

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

Route::get('/', function () {
    return view('app');
});

Route::get('/token', 'TodoController@getToken');

Route::get('/todo', 'TodoController@getTodo');
Route::post('/todo', 'TodoController@postTodo');
Route::put('/todo', 'TodoController@putTodo');
Route::delete('/todo', 'TodoController@deleteTodo');
