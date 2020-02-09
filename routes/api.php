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
Route::post('user/activate/', 'UserController@disable_or_enable_user');
Route::post('user/change_password/', 'UserController@change_password');
Route::post('user/reset_pass/', 'UserController@reset_pass');


Route::group(['prefix' => 'reports'], function () {
    Route::post('calls_center_data', 'ReportsController@getCallCenterData');
    Route::post('kit_details_data', 'ReportsController@getKitDetailsReportData');
    Route::post('general_indicators', 'ReportsController@getGeneralIndicators');
    Route::post('zones', 'ReportsController@get_zones');
    Route::post('sites', 'ReportsController@get_sites');
    Route::post('status', 'ReportsController@get_status');
    Route::post('months', 'ReportsController@get_months');
    Route::post('expired_orders', 'ReportsController@get_expired_orders');
    Route::post('activity_orders', 'ReportsController@get_activity_orders');
    Route::post('dashboard_data', 'ReportsController@getDashboardData');
    Route::post('report_by_user', 'ReportsController@report_by_user');
    Route::post('get_pto_job', 'ReportsController@get_pto_job');
});

Route::group([
    'prefix' => 'config',
], function () {
    Route::post('get_all', 'ConfigurationController@get_all_configurations');
    Route::post('save_config', 'ConfigurationController@save_configuration');
});

Route::resource('instalation', 'InstalationsController');
Route::post('instalation/get_all/', 'InstalationsController@get_all_instalations');
