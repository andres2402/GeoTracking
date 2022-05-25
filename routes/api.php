<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'customer'], function () {
    Route::post('login', 'Api\CustomerApiController@signIn');
    Route::post('register', 'Api\CustomerApiController@signUp');
    Route::post('forgotPassword', 'Api\CustomerApiController@recovery');
    Route::post('confirmCode', 'Api\CustomerApiController@verifyCode');
    Route::post('restorePassword', 'Api\CustomerApiController@restore');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', 'Api\CustomerApiController@signOut');
});
Route::apiResource('parameters','Api\ParametersApiController');
Route::apiResource('users','api\UserApiController');
Route::apiResource('customers','Api\CustomerApiController');

Route::apiResource('payu','Api\PayuApiController'); 
