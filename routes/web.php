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

	//admin
    Route::group(['middleware' => ['role:1']], function() {
        Route::get('/home',  'LoginController@home');
        Route::resource('users', 'UserController');
        Route::resource('settings','SettingController');
        Route::get('printqr/{id}', 'SettingController@printqr')->name('printqr');
        Route::resource('/data-employees/employees', 'EmployeesController');
        Route::resource('/data-employees/salaries', 'SalariesController');
        Route::patch('settings', 'SettingController@updateDeductions')->name('settings.updateDeductions');
        Route::patch('/salarypdf/{id}', 'SalariesController@salarypdf')->name('salarypdf');
        Route::get('printpdf/{id}', 'SalariesController@printpdf')->name('printpdf');
        Route::get('/changepass',  'UserController@changePass');
        Route::get('/changepass',  'UserController@changePass');
        Route::post('/changepass/{id}',  'UserController@changePassSubmit')->name('changepass');
        Route::get('/data-employees/absent',  'EmployeesController@absent');
        Route::get('/data-employees/employees/{id}/edit-data', 'EmployeesController@editEmployee')->name('employees.editEmployee');
        Route::patch('/data-employees/{id}', 'EmployeesController@updateEmployee')->name('employees.updateEmployee');
    });

    Route::group(['middleware' => ['role:20']], function() {
        Route::get('/karyawan',  'LoginController@employeeView');
        Route::get('/cek-data',  'employeesController@cekData');
        Route::get('/cek-gaji',  'employeesController@cekGaji');
        Route::get('/cek-gaji/{id}',  'employeesController@detailGaji')->name('detail.gaji');
    });

});


