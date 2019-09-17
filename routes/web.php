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

Route::post('/rankings', 'RankingController@store');
Route::get('/rankings', 'RankingController@index');

Route::post('/charasteristics', 'CharacterController@store');
Route::get('/charasteristics', 'CharacterController@index');

Route::get('/admin/generate', 'AdminController@generate');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/{auth_key}', 'WelcomeController@codelogin');
Route::get('/', 'WelcomeController@index')->name('home');
