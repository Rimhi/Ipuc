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
/*Departamento*/
Route::resource('departamento','DepartamentoController');
Route::get('/departamento-image/{filename}','DepartamentoController@getImage')->name('departamento.avatar');
/*User*/
Route::get('/user-config','UserController@config')->name('config');
Route::get('/user-image/{filename}','UserController@getImage')->name('user.avatar');
Route::post('/user-edit','UserController@update')->name('user.update');
Route::get('/perfil/{id}','UserController@perfil')->name('user.perfil');
Route::post('/estado','UserController@estado')->name('user.estado');
Route::get('/add-cargo','UserController@cargo')->name('user.cargo');
Route::get('/add-cargo-user/{id}','UserController@getUser')->name('user.cargoadd');
Route::post('/add-cargo','UserController@guardarcargo')->name('user.cargopost');
Route::get('/delete-cargo/{id}/{departamento}','UserController@eliminarcargo')->name('user.cargodelete');
/*images*/
Route::resource('image','ImageController',['except' => ['destroy']]);
Route::get('image/delete/{id}', 'ImageController@destroy')->name('image.destroy');
Route::get('/image-image/{filename}','ImageController@getImage')->name('image.avatar');
/*Comentarios*/
Route::resource('comment','CommentController',['except' => ['destroy','index','create','show','edit']]);
Route::get('comment/delete/{id}', 'CommentController@destroy')->name('comment.destroy');
/*Like*/
Route::get('/like/{id}','LikeController@store')->name('like.store');
Route::get('/dislike/{id}','LikeController@destroy')->name('like.destroy');
Route::get('/favoritos','LikeController@userfavoritos')->name('like.fav');

Route::get('/', 'HomeController@index')->name('home');
