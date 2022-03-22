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
    return view('welcome');
});
Route::get('/login', 'LoginZaloController@index');
Route::get('/chat', 'LoginZaloController@getToken');
Route::get('/oa', 'LoginZaloController@officalAccount');
Route::get('/test', 'LoginZaloController@test');