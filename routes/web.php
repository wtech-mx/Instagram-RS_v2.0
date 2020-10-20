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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','HomeController@index')->name('inicio.index');
Auth::routes();

//Post controller routes and methods
Route::get('/posts','PostController@index')->name('posts.index');
Route::get('/posts/create','PostController@create')->name('posts.create');
Route::post('/posts','PostController@store')->name('posts.store');
Route::get('/posts/{post}','PostController@show')->name('posts.show');
Route::get('/posts/{post}/edit','PostController@edit')->name('posts.edit');
Route::put('/posts/{post}','PostController@update')->name('posts.update');
Route::delete('/posts/{post}','PostController@destroy')->name('posts.destroy');
Route::get('/search','PostController@search')->name('search.show');
Route::resource('posts', 'PostController');

//Comment paths and methods
Route::post('/','CommentController@store')->name('comments.store');

Route::get('/category/{categoryPost}','CategoriasController@show')->name('post.show');

//Profile paths and methods
Route::get('/profile/{profile}','ProfileController@show')->name('profile.show');
Route::get('/profile/{profile}/edit','ProfileController@edit')->name('profile.edit');
Route::put('/profile/{profile}','ProfileController@update')->name('profile.update');

//Like relationships
Route::get('posts/{post}/like', 'PostController@like')->name('posts.like');
Route::get('posts/{post}/unlike', 'PostController@unlike')->name('posts.unlike');

