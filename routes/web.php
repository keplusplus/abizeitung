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


Auth::routes();

Route::post('/comment', 'CommentsController@store');
Route::get('/comment', 'CommentsController@create')->name('comment');

Route::post('/quote', 'QuotesController@store');
Route::get('/quote', 'QuotesController@create')->name('quote');

Route::post('/idea', 'IdeaController@store');
Route::get('/idea', 'IdeaController@create')->name('idea');

Route::post('/rankings', 'RankingController@store');
Route::get('/rankings', 'RankingController@index');

Route::post('/characteristics', 'CharacterController@store');
Route::get('/characteristics', 'CharacterController@create');

Route::get('/admin/generate', 'AdminController@generate');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/{auth_key}', 'WelcomeController@codelogin');
Route::get('/', 'WelcomeController@index')->name('home');
