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

Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::post('/auth/login', 'LoginController@login');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::post('/email/recover', 'UsersController@sendEmailToRecoverPassword');
    Route::post('/user/recover/{id}', 'UsersController@recoverMe');
    Route::get('/job/repairdate', 'SheetsController@jobDateRepair');
});

Route::group(['middleware' => ['check.token'], 'namespace' => 'App\Http\Controllers'], function () {


    Route::resource('profiles', 'ProfilesController');
    Route::resource('users', 'UsersController');
    Route::get('user/online', 'UsersController@onlines');
    Route::post('user/block', 'UsersController@block');
    Route::post('users/signature/{user_id}', 'UsersController@uploadSignature');
    Route::delete('users/signature/{user_id}', 'UsersController@removeSignature');
    Route::get('sheets/deleteds', 'SheetsController@deleteds');
    Route::patch('sheets/restore/{protocol}', 'SheetsController@restore');
    Route::resource('sheets', 'SheetsController');
    Route::post('sheet/{id}/update', 'SheetsController@update');
    Route::put('sheet/{id}/finish', 'SheetsController@finishSheet');


    Route::resource('hospitals', 'HospitalsController');
    Route::resource('emergencies', 'EmergenciesController');
    Route::get('emergency_type/emergency/{emergency_id}', 'EmergencyTypesController@emergency_type_by_emergency_id');
    Route::get('doctors', 'UsersController@get_doctors');
    Route::get('doctor/{id}', 'UsersController@get_doctor');
    Route::post('sheets/search', 'SheetsController@search');
    Route::resource('emergency_type', 'EmergencyTypesController');
    Route::resource('severities', 'SeveritiesController');
    Route::resource('status', 'StatusController');
    Route::resource('teams', 'TeamsController');
    Route::resource('transports', 'TransportsController');
    Route::resource('cities', 'CitiesController');
    Route::resource('locales', 'LocalesController');
    Route::resource('victims', 'VictimsController');

    Route::prefix('reports')->group(function () {
        Route::post('/statistic/daily/1',       'ReportsController@daily_statistic_01');
        Route::post('/statistic/daily/2',       'ReportsController@daily_statistic_02');
        Route::post('/statistic/daily/3',       'ReportsController@daily_statistic_03');
        Route::post('/statistic/daily/4',       'ReportsController@daily_statistic_04');
        Route::post('/monthly/33',              'ReportsController@monthly_ambulance_reserve');
        Route::post('/monthly/32',              'ReportsController@monthly_samu_avanced_2');
        Route::post('/monthly/31',              'ReportsController@monthly_samu_avanced');
        Route::post('/monthly/30',              'ReportsController@monthly_motolancia');
        Route::post('/monthly/29',              'ReportsController@monthly_samu_basic');
        Route::post('/monthly/28',              'ReportsController@monthly_regulation_center');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/attendance', 'DashboardController@attendance');
        Route::get('/cases', 'DashboardController@cases');
    });

    // Estoque
    Route::resource('stocks', 'StockController');
    Route::get('stock/top50', 'StockController@getTop50');
    Route::post('stock/withdrawn/{id}', 'StockController@withDrawn');
    Route::post('stock/withdrawn-multi', 'StockController@withDrawnMulti');
    Route::post('stock/add/{id}', 'StockController@addStock');
    Route::get('stock/add/{id}', 'StockController@getAdds');
    Route::get('stock/add-component/{id}', 'StockController@getAddComponents');
    Route::get('stock/extract/{id}', 'StockController@extractStock');
    Route::get('stock/all', 'StockController@getAllStock');
    Route::get('stock/reports', 'StockController@getReports');
    Route::get('stock/report/{id}', 'StockController@pdfReportById');


    // Notificações
    Route::get('notifications', 'NotificationController@getAll');
    Route::post('notifications/read', 'NotificationController@updateAll');
});
