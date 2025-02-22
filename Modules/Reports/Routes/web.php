<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'], function () {
    //Print Barcode
    Route::get('/testbd-report', 'ReportsController@testbdReport')->name('testbd-report.index');
    
    Route::get('/reception-report', 'ReportsController@receptionReport')->name('reception-report.index');
    

    Route::get('/discharge-report', 'ReportsController@dischargeReport')->name('discharge-report.index');

    Route::get('/expedition-report', 'ReportsController@expeditionReport')->name('expedition-report.index');

});