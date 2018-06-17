<?php

use App\Book;
use Illuminate\Http\Request;
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

Route::get('/sql_practice', function () {
    return view('sql_practice');
});

/**
 * 本の表示 */
Route::get('/', 'BooksController@index');
/* 本を追加 */
Route::post('/books','BooksController@store');
/* 本を削除 */
Route::delete('/book/{book}', 'BooksController@delete');
/* 本を編集 */
Route::post('/booksedit/{books}', 'BooksController@edit');
/* 本を更新 */
Route::post('/books/update', 'BooksController@update');
Auth::routes();
Route::get('/home', 'RegisterController@index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
