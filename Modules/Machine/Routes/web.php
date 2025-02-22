<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

use Modules\Machine\Http\Controllers\ImportCategoryController;

Route::group(['middleware' => 'auth'], function () {
    //Print Barcode
    Route::get('/machines/print-barcode', 'BarcodeController@printBarcode')->name('barcode.print');
    //machine
    Route::resource('machines', 'MachineController');
    //machine Category
    Route::resource('machine-categories', 'CategoriesController')->except('create', 'show');
    Route::resource('import-categories', 'ImportCategoryController');

     //machine
     Route::resource('import-machines', 'ImportMachineController');
     //Route::post('import-categories',[ ImportMachineController::class, 'import-categories' ]);
   //  Route::post('import-categories',[ ImportCategoryController::class, 'import' ])->name('import-categories');

});

