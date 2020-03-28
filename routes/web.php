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

/*
Routing examples:

//dynamic route:
Route::get('/users/{id}/{name}', function($id, $name) {
    return 'This is user '.$name.' with id '.$id;
});

*/

Route::get('/', 'PagesController@index');
Route::get('/index', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/profile', 'PagesController@profile');
Route::get('/users', 'PagesController@users')->name('users');
Route::get('/feed', 'PagesController@feed');


//all routes for posts
Route::resource('posts', 'PostsController');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//routes for users and follow
Route::get('user/{id}', 'HomeController@user')->name('user.view');
Route::post('/follow/{id}', 'HomeController@followUserRequest')->name('follow');
Route::post('/follow', 'HomeController@followUserRequest')->name('followToggle');
Route::post('/like', 'HomeController@likePost')->name('likeToggle');


