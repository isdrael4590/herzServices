<?php

namespace Modules\ConfigurateBase\Http\Controllers;
use Illuminate\Support\Facades\Route;

// Rutas para el módulo de ubicaciones
Route::resource('company_sites', CompanySitesController::class);

// Ruta adicional para cambiar el estado
Route::patch('company_sites/{company_sites}/toggle-status', [CompanySitesController::class, 'toggleStatus'])
    ->name('company_sites.toggle-status');

// Si quieres agrupar las rutas con middleware:
/*
Route::middleware(['auth'])->group(function () {
    Route::resource('company_sites', LocationController::class);
    Route::patch('company_sites/{location}/toggle-status', [LocationController::class, 'toggleStatus'])
        ->name('company_sites.toggle-status');
});
*/