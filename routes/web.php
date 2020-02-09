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

use App\Http\Controllers\PhotosController;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){
    // Route::resource('photos', 'PhotosController');
    // Route::resource('comments', 'CommentsController');
    Route::get('/photos', 'PhotosController@index')->name('photos.index');
    Route::get('/photos/create', 'PhotosController@create')->name('photos.create');
    Route::post('/photos', 'PhotosController@store')->name('photos.store');
    Route::get('/photos/{id}', 'PhotosController@show')->name('photos.show');
    Route::get('/photos/{id}/edit', 'PhotosController@edit')->name('photos.edit');
    Route::post('/photos/{id}', 'PhotosController@update')->name('photos.update');
    Route::post('/photos/{id}/delete', 'PhotosController@destroy')->name('photos.delete');
    

    // Route::get('/mypage', 'UsersController@mypage')->name('users.mypage');


});




