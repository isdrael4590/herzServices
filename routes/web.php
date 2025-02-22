<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')
        ->name('home');

    Route::get('/testbowies/chart-data', 'HomeController@testBowiesChart')
        ->name('testbowies.chart');
    Route::get('/current-month/chart-data', 'HomeController@currentMonthChart')->name('current-month.chart');
    Route::get('/currentProducMonth/chart-data', 'HomeController@currentMonthProductionChart')->name('currentProduc-month.chart');
    Route::get('/productions/chart-data', 'HomeController@ProductionsChart')->name('productions.chart');
    Route::get('/productionlabels/chart-data', 'HomeController@ProductionlabelsChart')->name('productionlabels.chart');
    Route::get('/resultproductions/chart-data', 'HomeController@ResultProductionChart')->name('resultproductions.chart');
    Route::get('/biologics/chart-data', 'HomeController@BiologicChart')->name('biologics.chart');
    Route::get('/central/chart-data', 'HomeController@CentralChart')->name('central.chart');
});
