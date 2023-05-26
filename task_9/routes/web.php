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

Route::get('/', 'HomeController@index')->name('home');

// авторизация

Route::get('/signup', 'AuthController@getSignUp')->name('auth.signup');
Route::post('/signup', 'AuthController@postSignUp');

Route::get('/signin', 'AuthController@getSignIn')->name('auth.signin');
Route::post('/signin', 'AuthController@postSignIn');