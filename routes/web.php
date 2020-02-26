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

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

Auth::routes(['verify' => True]);

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/register', 'RegisterController@ShowRegisterForm')->name('register');

// Route::post('/register', 'RegisterController@HandleRegister');

// Route::get('/login', 'LoginController@ShowLoginForm')->name('login');

// Route::post('/login', 'LoginController@HandleLogin');

// Route::get('/verify/{token}', 'VerifyController@VerifyEmail')->name('verify');