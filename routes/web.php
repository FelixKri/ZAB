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

Route::get('/', 'RechnungController@show');
Route::post('/', 'RechnungController@pay');
Route::get('/archive', 'RechnungController@showArchive');

Route::get('/register', 'AuthController@create');
Route::post('/register', 'AuthController@store');

Route::get('/login', 'SessionController@create')->name('login');
Route::post('/login', 'SessionController@store');
Route::get('/logout', 'SessionController@destroy');

Route::get('/bill/new', 'RechnungController@create');
Route::post('/bill/new', 'RechnungController@fill');
Route::post('bill/store', 'RechnungController@store');

Route::get('/admin/panel', 'PanelController@create');