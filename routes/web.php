
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

Route::get("/images/{image}", function($img) {
  ob_start();
  require(path("public") . "images/" . $img);
  return ob_get_clean();
});

Route::post('/comment', 'CommentsController@store');
Route::get('/comment', 'CommentsController@create')->name('comment');

Route::post('/quote', 'QuotesController@store');
Route::get('/quote', 'QuotesController@create')->name('quote');

Route::post('/idea', 'IdeaController@store');
Route::get('/idea', 'IdeaController@create')->name('idea');

Route::post('/moment', 'MomentsController@store');
Route::get('/moment', 'MomentsController@create')->name('moment');

Route::post('/rankings', 'RankingController@store');
Route::get('/rankings', 'RankingController@index');

Route::post('/characteristics', 'CharacterController@store');
Route::get('/characteristics', 'CharacterController@create');

Route::get('/admin/generate', 'AdminController@generate');
Route::get('/admin/edit_ranking/{ranking_id}', 'AdminController@edit_ranking');
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/logout', 'Auth\LoginController@logout');

//UNCOMMENT THIS TO REENABLE THE ABIZEITUNG APPLICATION --- Route::get('/{auth_key}', 'WelcomeController@codelogin');
Route::get('/', 'WelcomeController@index')->name('home');
