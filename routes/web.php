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
    return view('login');
});

//all
Route::get('/login',  'LoginController@index')->name('login');
Route::post('/login',  'LoginController@login');
Route::get('/logout',  'LoginController@logout');


Route::group(['middleware' => ['auth']], function() {
    Route::get('/home',  'LoginController@home');
	Route::get('/changepass',  'UserController@changePass');
	Route::post('/changepass/{id}',  'UserController@changePassSubmit')->name('changepass');

	//admin
    Route::group(['middleware' => ['role:1']], function() {
        
	});


});


