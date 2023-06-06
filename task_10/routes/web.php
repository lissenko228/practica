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

Route::get('/','HomeController@index')->name('index');

// авторизация

Route::get('/signup', 'AuthController@getSignup')->middleware('guest')->name('auth.signup');
Route::post('/signup', 'AuthController@postSignup')->middleware('guest');

Route::get('/signin', 'AuthController@getSignin')->middleware('guest')->name('auth.signin');
Route::post('/signin', 'AuthController@postSignin')->middleware('guest');

Route::get('/logout', 'AuthController@logout')->name('auth.logout');

// пользователи

Route::get('/users', 'UserController@users')->middleware('auth')->name('users.index');

// профиль

Route::get('/profile/{userId}', 'ProfileController@profile')->middleware('auth')->name('profile');

// книги

Route::get('/book/{bookId}', 'BookController@read')->middleware('auth')->name('book');

Route::post('/add/{userId}', 'BookController@add')->middleware('auth')->name('add');

Route::get('/edit/{bookId}', 'BookController@edit')->middleware('auth')->name('edit');
Route::post('/edit/{bookId}', 'BookController@postEdit')->middleware('auth');

Route::get('/delete/{bookId}', 'BookController@delete')->middleware('auth')->name('delete');

// читатели

Route::get('reader/{userId}', 'ReaderController@addReader')->middleware('auth')->name('reader');
Route::get('reader/del/{userId}', 'ReaderController@delReader')->middleware('auth')->name('reader.del');

// поделиться ссылкой

Route::get('link', 'LinkController@getLink')->middleware('auth')->name('link');

Route::get('links/{userId}', 'LinkController@viewLink');

Route::get('links/book/{bookId}', 'BookController@readLink')->name('links.book');