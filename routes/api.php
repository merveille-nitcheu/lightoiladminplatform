<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TankController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\JaugeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ServiceStationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('AuthMiddleware')->group(function(){

    Route::prefix('company')->group(function() {
        Route::get('getallcompanies', [CompanyController::class, 'getallcompanies']);
        Route::post('storecompany', [CompanyController::class, 'storecompany']);
        Route::get('showcompany/{companyId}', [CompanyController::class, 'showcompany']);
        Route::post('updatecompany/{companyId}', [CompanyController::class, 'updatecompany']);
        Route::delete('destroycompany/{companyId}', [CompanyController::class, 'destroycompany']);
    });

    // Service Station routes
    Route::prefix('servicestation')->group(function() {
        Route::get('getallservicestation', [ServiceStationController::class, 'getallservicestation']);
        Route::post('storeservicestation', [ServiceStationController::class, 'storeservicestation']);
        Route::get('showservicestation/{stationId}', [ServiceStationController::class, 'showservicestation']);
        Route::post('updateservicestation/{stationId}', [ServiceStationController::class, 'updateservicestation']);
        Route::delete('destroyservicestation/{stationId}', [ServiceStationController::class, 'destroyservicestation']);
    });

    // Product routes
    Route::prefix('product')->group(function() {
        Route::get('getallproduct', [ProductController::class, 'getallproduct']);
        Route::post('storeproduct', [ProductController::class, 'storeproduct']);
        Route::get('showproduct/{productId}', [ProductController::class, 'showproduct']);
        Route::post('updateproduct/{productId}', [ProductController::class, 'updateproduct']);
        Route::delete('destroyproduct/{productId}', [ProductController::class, 'destroyproduct']);
    });

    // Tank routes
    Route::prefix('tank')->group(function() {
        Route::get('getalltank', [TankController::class, 'getalltank']);
        Route::post('storetank', [TankController::class, 'storetank']);
        Route::get('showtank/{tankId}', [TankController::class, 'showtank']);
        Route::post('updatetank/{tankId}', [TankController::class, 'updatetank']);
        Route::delete('destroytank/{tankId}', [TankController::class, 'destroytank']);
    });


    /* jauges routes */
    Route::prefix('jauge')->group(function() {
        Route::get('getalljauge', [JaugeController::class, 'getalljauge']);
        Route::post('storejauge', [JaugeController::class, 'storejauge']);
        Route::get('showjauge/{jaugeId}', [JaugeController::class, 'showjauge']);
        Route::post('updatejauge/{jaugeId}', [JaugeController::class, 'updatejauge']);
        Route::delete('destroyjauge/{jaugeId}', [JaugeController::class, 'destroyjauge']);
        Route::get('getCodebyJaugeId/{jaugeId}', [JaugeController::class, 'getCodebyJaugeId']);
    });

});


// Company routes

