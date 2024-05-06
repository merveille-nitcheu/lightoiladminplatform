<?php

use App\Models\Tank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TankController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\JaugeController;
use App\Http\Controllers\CompagnyController;
use App\Http\Controllers\ServiceStationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/* Route::middleware('AuthMiddleware')->group(function(){}); */


/* company routes */
Route::get('company/getallcompagnies', [CompagnyController::class, 'getallcompagnies']);
Route::post('company/storecompany', [CompagnyController::class, 'storecompany']);
Route::get('company/showcompany/{companyId}', [CompagnyController::class, 'showcompany']);
Route::post('company/updatecompany/{companyId}', [CompagnyController::class, 'updatecompany']);
Route::delete('company/destroycompany/{companyId}', [CompagnyController::class, 'destroycompany']);

/* service_Station routes */
Route::get('servicestation/getallservicestation', [ServiceStationController::class, 'getallservicestation']);
Route::post('servicestation/storeservicestation', [ServiceStationController::class, 'storeservicestation']);
Route::get('servicestation/showservicestation/{stationId}', [ServiceStationController::class, 'showservicestation']);
Route::post('servicestation/updateservicestation/{stationId}', [ServiceStationController::class, 'updateservicestation']);
Route::delete('servicestation/destroyservicestation/{stationId}', [ServiceStationController::class, 'destroyservicestation']);

/* product routes */
Route::get('product/getallproduct', [ProductController::class, 'getallproduct']);
Route::post('product/storeproduct', [ProductController::class, 'storeproduct']);
Route::get('product/showproduct/{productId}', [ProductController::class, 'showproduct']);
Route::post('product/updateproduct/{productId}', [ProductController::class, 'updateproduct']);
Route::delete('product/destroyproduct/{productId}', [ProductController::class, 'destroyproduct']);

/* tank routes */
Route::get('tank/getalltank', [TankController::class, 'getalltank']);
Route::post('tank/storetank', [TankController::class, 'storetank']);
Route::get('tank/showtank/{tankId}', [TankController::class, 'showtank']);
Route::post('tank/updatetank/{tankId}', [TankController::class, 'updatetank']);
Route::delete('tank/destroytank/{tankId}', [TankController::class, 'destroytank']);


/* jauges routes */
Route::get('jauge/getalljauge', [JaugeController::class, 'getalljauge']);
Route::post('jauge/storejauge', [JaugeController::class, 'storejauge']);
Route::get('jauge/showjauge/{jaugeId}', [JaugeController::class, 'showjauge']);
Route::post('jauge/updatejauge/{jaugeId}', [JaugeController::class, 'updatejauge']);
Route::delete('jauge/destroyjauge/{jaugeId}', [JaugeController::class, 'destroyjauge']);
Route::get('jauge/getCodebyJaugeId/{jaugeId}', [JaugeController::class, 'getCodebyJaugeId']);
