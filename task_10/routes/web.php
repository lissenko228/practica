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

Route::middleware('guest')->group(function()
{
    
    // авторизация
    Route::get('/signup', 'AuthController@getSignup')->name('auth.signup');
    Route::post('/signup', 'AuthController@postSignup');

    Route::get('/signin', 'AuthController@getSignin')->name('auth.signin');
    Route::post('/signin', 'AuthController@postSignin');

});

Route::middleware('auth')->group(function()
{

    // пользователи
    Route::get('/users', 'UserController@users')->name('users.index');

    // профиль
    Route::get('/profile/{userId}', 'ProfileController@profile')->name('profile');

    // книги
    // Route::get('/book/{bookId}', 'BookController@read')->middleware('book')->name('book');

    Route::post('/add/{userId}', 'BookController@add')->name('add');

    Route::get('/edit/{bookId}', 'BookController@edit')->name('edit');
    Route::post('/edit/{bookId}', 'BookController@postEdit');

    Route::get('/delete/{bookId}', 'BookController@delete')->name('delete');

    // читатели
    Route::get('reader/{userId}', 'ReaderController@addReader')->name('reader');
    Route::get('reader/del/{userId}', 'ReaderController@delReader')->name('reader.del');

    // поделиться ссылкой
    Route::get('linkbook/{bookId}', 'LinkController@getLink')->name('linkbook');

});

Route::get('/','HomeController@index')->name('index'); //главная

Route::get('/logout', 'AuthController@logout')->name('auth.logout'); // выход

Route::get('book/{bookId}', 'BookController@read')->middleware('book')->name('book'); //доступ по ссылке