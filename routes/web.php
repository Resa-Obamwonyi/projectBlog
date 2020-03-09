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
    return view('auth.login');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/blog', function () {
    return view('blog');
});
Route::get('/category', function () {
    return view('categories.category');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post', 'PostController@post');
Route::get('/profile', 'ProfileController@profile');
Route::get('/category', 'CategoryController@category');
Route::post('/addCategory', 'CategoryController@addCategory');
Route::post('/addProfile', 'ProfileController@addProfile');
Route::post('/addPost', 'PostController@addPost');
