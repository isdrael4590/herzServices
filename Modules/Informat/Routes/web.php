<?php

use Illuminate\Support\Facades\Route;
/*use Modules\Informat\Http\Controllers\InformatController;


|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::group([], function () {
    Route::resource('informat', InformatController::class)->names('informat');
});
*/

Route::group(['middleware' => 'auth'], function () {
   

    //informat
    Route::resource('informats', 'InformatController');
    //informat Category
    Route::resource('institute', 'InstituteController');
    Route::resource('area', 'AreaController');
    Route::resource('brand', 'BrandController');
});