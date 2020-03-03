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
    //return view('welcome');


//Auth::routes();
Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::get('/login/agent', 'Auth\LoginController@showAgentLoginForm')->name('login.agent');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
Route::get('/register/agent', 'Auth\RegisterController@showAgentRegisterForm')->name('register.agent');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/agent', 'Auth\LoginController@agentLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register.admin');
Route::post('/register/agent', 'Auth\RegisterController@createAgent')->name('register.agent');

//no auth

Route::view('/home', 'home')->middleware('auth');
Route::get('/view/{id}', 'PostController@view')->middleware('auth');

Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
    Route::get('/housecategory', 'CategoryController@adminCategory')->middleware('auth');
    Route::get('/addCategory', 'CategoryController@addCategory')->middleware('auth');
    Route::post('/addCategory', 'CategoryController@addCategory')->middleware('auth');
    Route::get('/post', 'PostController@post')->middleware('auth');
    Route::post('/addPost', 'PostController@addPost')->middleware('auth');

// view posts
    Route::get('/view/{id}', 'PostController@view')->middleware('auth');
    Route::get('/edit/{id}', 'PostController@edit')->middleware('auth');
    Route::post('/edit/{id}', 'PostController@editPost')->middleware('auth');
    Route::get('/delete/{id}', 'PostController@deletePost')->middleware('auth');

    
    
});

Route::group(['middleware' => 'auth:agent'], function () {
    Route::view('/agent', 'agent');
});