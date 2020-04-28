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

Route::get('/post/create', 'PostController@createPost')->name('createPost');
Route::post('/post/create', 'PostController@addPost')->name('addPost');
Route::get('/posts', 'PostController@allPost')->name('allPost');
Route::get('/post/edit/{id}', 'PostController@editPost')->name('editPost');
Route::post('/post/update/{id}', 'PostController@updatePost')->name('updatePost');
Route::get('/delete-post/{id}', 'PostController@deletePost')->name('deletePost');


