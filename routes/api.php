<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

// get detail cases by users
Route::get('/cases/{id}', 'Api\Cases\DetailCaseController@indexByUsers');

// check token
Route::middleware('jwt.auth')->get('/check-token', 'Api\Auth\CheckTokenController@index');

// only executors
Route::group(['middleware' => ['jwt.auth', 'isExecutor']], function() {
    Route::get('/executors/cases', 'Api\Cases\ExecutorListCasesController@index');
    Route::get('/executors/cases/{id}', 'Api\Cases\DetailCaseController@index');
    Route::post('/executors/cases/{id}/feedback', 'Api\Cases\FeedbackCaseController@index');
    // Route::get('/executors/cases', function(){return 'ted';});
});

// Route::get('/testing123', function() {
//     $user = DB::table('users')->where('nik', '11111')->update(['active' => 1]);

//     $user = DB::table('users')->where('nik', '11111')->get();
//     return $user;
// });

// Event
Route::middleware('jwt.auth')->get('/events', 'Api\Event\ListController@index');