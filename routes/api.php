<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LegacySyncController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Grupo protegido por JWT
Route::middleware(['auth.jwt.service'])->prefix('v1/legacy')->group(function () {
    
    // 1. Crear usuario (Tenant)
    Route::post('/tenants', [LegacySyncController::class, 'createTenant']);
    
    // 2. Vincular canal (WhatsApp/IG)
    Route::post('/channels', [LegacySyncController::class, 'syncChannel']);
    
    // 3. Desvincular canal (Delete lógico)
    Route::delete('/channels', [LegacySyncController::class, 'removeChannel']);

});

