<?php

use Illuminate\Support\Facades\Route;

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

//rotta pubblica
Route::get('/', 'HomeController@index')->name('home');

Route::get('/blog', 'PostController@index')->name('blog');
Route::get('/blog/{slug}', 'PostController@show')->name('blog-detail');


//rotte private
Route::prefix('admin')
    ->namespace('Admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/posts/show', 'HomeController@show')->name('home');
    
    Route::resource('posts', 'PostController');
});