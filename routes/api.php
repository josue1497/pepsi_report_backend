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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group([
    'prefix' => 'import',
], function () {
    Route::post('callcenter', 'CallCenterReportController@import');
    Route::post('kitreport', 'KitReportsController@import');
    Route::post('kitdetailsreport', 'KitDetailsReportsController@import');
});


Route::resource('user', 'UserController');

Route::group(['prefix' => 'reports'], function () {
    Route::post('calls_center_data', 'ReportsController@getCallCenterData');
    Route::post('kit_details_data', 'ReportsController@getKitDetailsReportData');

});
