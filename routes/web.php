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









Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/post', 'PostController@post');
Route::get('/profile', 'ProfileController@profile')->middleware('auth');
Route::get('/categories', 'CategoryController@categories');

Route::get('/category/{id}', 'CategoryController@category');

Route::get('/view/{id}', 'PostController@view');
Route::get('/edit/{id}', 'PostController@edit');
Route::get('/delete/{id}', 'PostController@delete');
Route::get('/like/{id}', 'PostController@like');
Route::get('/dislike/{id}', 'PostController@dislike');

Route::get('/post/show/{id}', 'PostController@show')->name('posts.show');
Route::get('/post/cat/{id}', 'PostController@cat')->name('posts.cat');

Route::post('/addCategory', 'CategoryController@addCategory');
Route::post('/addProfile', 'ProfileController@addProfile');
Route::post('/addPost', 'PostController@addPost');
Route::post('/comment', 'CommentsController@newComment');

Route::post('/comment/store', 'CommentController@store')->name('comment.add');
Route::post('/reply/store', 'CommentController@replyStore')->name('reply.add');

Route::post('/editPost/{id}', 'PostController@editPost');
Route::post('/deletePost/{id}', 'PostController@deletePost');

Route::get('users/register', 'Auth\RegisterController@showRegistrationForm');
Route::post('users/register', 'Auth\RegisterController@register');
