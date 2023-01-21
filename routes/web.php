<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', 'FrontController@view')->name('front');

Route::match(['get', 'post'], '/add_firm', 'FirmController@add')->name('add.firm');
Route::match(['get', 'post'], '/edit_firm', 'FirmController@edit')->name('edit.firm');

Route::get('/view_firm/{id}', 'FirmController@view')->name('view.firm');
Route::get('/delete_firm/{id}', 'FirmController@delete')->name('delete.firm');

Route::post('/save_comment','CommentController@saveComment')->name('save.comment');

Route::get('/get_inn','CommentController@getInnComment')->name('get.innComment');
Route::post('/add_inn','CommentController@addInnComment')->name('add.innComment');

Route::post('/add_about','CommentController@addAboutComment')->name('add.aboutComment');
Route::get('/get_about','CommentController@getAboutComment')->name('get.about');

Route::post('/add_name','CommentController@addNameComment')->name('add.nameComment');
Route::get('/get_name','CommentController@getNameComment')->name('get.nameComment');

Route::post('/add_dir','CommentController@addDirComment')->name('add.dirComment');
Route::get('/get_dir','CommentController@getDirComment')->name('get.dirComment');

Route::post('/add_addr','CommentController@addAddrComment')->name('add.addrComment');
Route::get('/get_addr','CommentController@getAddrComment')->name('get.addrComment');

Route::post('/add_ph','CommentController@addPhComment')->name('add.addrComment');
Route::get('/get_ph','CommentController@getPhComment')->name('get.addrComment');

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
})->name('clear');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
