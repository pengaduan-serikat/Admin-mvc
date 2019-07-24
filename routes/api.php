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

// Route::get('/test', function() {
//     return ['message' => 'tessst'];
// })->middleware('private_access');

Route::middleware('jwt.auth')->get('users', function () {
    return auth('api')->user();
});

// login
Route::post('/login', 'Api\Auth\LoginController@login');
Route::post('/employees/login', 'Api\Auth\LoginController@loginEmployee');

// change password
Route::middleware('jwt.auth')->put('/change-password', 'Api\Auth\ChangePasswordController@changePassword');

// register 
Route::post('/employees/register', 'Api\Auth\RegisterController@registerEmployee');

// create new case
Route::middleware('jwt.auth')->post('/cases', 'Api\Cases\CreateCaseController@index');
Route::middleware('jwt.auth')->get('/cases', 'Api\Cases\EmployeeListCasesController@index');


// check token
// Route::middleware('jwt.auth')->get('/check-token', 'Api\Auth\CheckTokenController@index');
Route::group(['middleware' => ['jwt.auth', 'isExecutor']], function() {
    Route::get('/executors/cases', 'Api\Cases\ExecutorListCasesController@index');
    // Route::get('/executors/cases', function(){return 'ted';});
});