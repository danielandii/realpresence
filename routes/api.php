<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return view('login');
});

Route::group(['prefix' => 'auth'], function () {

    Route::group(['middleware' => 'cors'], function() {
        Route::post('login', 'Api\AuthController@login');
        Route::post('signup', 'Api\AuthController@signup');
    });
  
    Route::group(['middleware' => ['cors','auth:api']], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::resource('user', 'Api\AuthController');
        Route::get('profile', 'Api\AuthController@profile');
        Route::put('changePass', 'Api\AuthController@changePass');
        Route::get('getRole', 'Api\AuthController@getRole' );
        Route::post('presence', 'Api\AuthController@presence' );
        Route::post('unpresence', 'Api\AuthController@unpresence' );
        Route::get('historypresence', 'Api\AuthController@historypresence' );
        Route::get('yearhistorypresence', 'Api\AuthController@yearhistorypresence' );
    });
});