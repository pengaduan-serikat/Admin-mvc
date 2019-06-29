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

// user
Route::resource('/users', 'UserController');

// testing
Route::get('/admin', function() {
  return view('test');
});
