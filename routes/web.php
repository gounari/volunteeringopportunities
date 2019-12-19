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

Route::get('/users', 'UserController@index')->name('users.index')->middleware('auth');
Route::get('/users/{user}', 'UserController@show')->name('users.show')->middleware('auth');

Route::get('/comments', 'CommentController@page')->name('comments.index')->middleware('auth');
Route::get('/comments/{comment}', 'CommentController@show')->name('comments.show')->middleware('auth');
Route::delete('/comments/{comment}', 'CommentController@destroy')->name('comments.destroy')->middleware('auth');
Route::put('/comments/{comment}', 'CommentController@update')->name('comments.update')->middleware('auth');

Route::get('/posts', 'PostController@page')->name('posts.index')->middleware('auth');
Route::get('/posts/create', 'PostController@create')->name('posts.create')->middleware('auth');
Route::post('/posts', 'PostController@store')->name('posts.store')->middleware('auth');
Route::get('/posts/{post}', 'PostController@show')->name('posts.show')->middleware('auth');
Route::get('/posts/edit/{post}', 'PostController@edit')->name('posts.edit')->middleware('auth');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
