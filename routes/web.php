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
Route::get('/', function () {
    return view('welcome');
});
*/
use App\Http\Controllers\Auth\AccountController;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'IndexController@show')->name('index');
Route::get('/live/{user_id}', 'LiveController@show')->name('live');
Route::get('/play/{id}', 'PlayController@show')->name('play');
Route::namespace('Auth')->group(function () {
    Route::get('/account', 'AccountController@show')->name('account');
    Route::post('/updateAccount', 'AccountController@updateAccount');
});

Route::get('/uploadVideo','UploadVideoController@show')->name('uploadVideo');
Route::post('/uploadVideo','UploadVideoController@uploadVideo');
Route::post('/insertComment','CommentController@insertComment');
Route::post('/getComment','CommentController@getComment');

