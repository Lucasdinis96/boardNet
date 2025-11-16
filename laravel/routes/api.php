<?php

use App\Http\Controllers\Api\Auth\LoginApiController;
use App\Http\Controllers\Api\Auth\RegisterApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\TradeApiController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;


Route::domain('api.localhost')->group(function () {

    Route::post('/register', [RegisterApiController::class, 'store']);
    Route::post('/login', [LoginApiController::class, 'login']);
    
    Route::get('/cities', [CityController::class, 'search']);

    Route::middleware('auth:sanctum')->group(function () {
        
        Route::get('/', [HomeApiController::class, 'index']);

        Route::get('/profile', [ProfileApiController::class, 'show']);
        Route::put('/profile/update', [ProfileApiController::class, 'update']);
                        
        Route::get('/trades', [TradeApiController::class, 'index']);
        Route::get('/trades/{id}', [TradeApiController::class, 'show']);
        
        Route::post('/logout', [LoginApiController::class, 'logout']);
    });  
});
