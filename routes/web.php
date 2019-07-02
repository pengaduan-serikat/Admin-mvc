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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')
      ->middleware('is_admin')->name('home');

// divisi
Route::resource('/divisions', 'DivisionController');

// position
Route::resource('/positions', 'PositionController');

// USER
Route::resource('/users', 'UserController');

// employee
Route::get('/employees', 'UserController@indexEmployees');
Route::get('/employees/create', 'UserController@createEmployee');
Route::post('/employees', 'UserController@storeEmployee');
Route::get('/employees/{id}', 'UserController@showEmployee');
Route::put('/employees/{id}', 'UserController@updateEmployee');
Route::delete('/employees/{id}', 'UserController@destroyEmployee');

// executor
Route::get('/executors', 'UserController@indexExecutors');
Route::get('/executors/create', 'UserController@createExecutor');
Route::post('/executors', 'UserController@storeExecutor');
Route::get('/executors/{id}', 'UserController@showExecutor');
Route::put('/executors/{id}', 'UserController@updateExecutor');
Route::delete('/executors/{id}', 'UserController@destroyExecutor');

// testing
Route::get('/admin', function() {
  return view('test');
});
