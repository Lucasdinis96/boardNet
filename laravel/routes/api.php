<?php

use App\Http\Controllers\Api\Auth\LoginApiController;
use App\Http\Controllers\Api\Auth\RegisterApiController;
use App\Http\Controllers\Api\CollectionApiController;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\TradeApiController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;


Route::domain('api.localhost')->group(function () {

    Route::post('/register', [RegisterApiController::class, 'store']);
    Route::post('/login', [LoginApiController::class, 'login']);
    
    Route::get('/cities/search', [CityController::class, 'search']);

    Route::middleware('auth:sanctum')->group(function () {
        
        Route::get('/', [HomeApiController::class, 'index']);

        Route::get('/profile', [ProfileApiController::class, 'show']);
        Route::put('/profile/update', [ProfileApiController::class, 'update']);
        Route::delete('/profile/delete', [ProfileApiController::class, 'destroy']);
                
        Route::get('/trades', [TradeApiController::class, 'index']);
        Route::get('/trades/{id}', [TradeApiController::class, 'show']);
        Route::post('/trades/store', [TradeApiController::class, 'store']);
        Route::put('/trades/{trade}/update', [TradeApiController::class, 'update']);
        Route::delete('/trades/{trade}/delete', [TradeApiController::class, 'destroy']);
        Route::get('/my-trades', [TradeApiController::class, 'myTrades']);
        Route::delete('/trades/{trade}/boardgame/{boardgame}', [TradeApiController::class, 'detachBoardgame']);

        Route::get('/my-collection', [CollectionApiController::class, 'index']);
        Route::post('/collection/{collection}/add', [CollectionApiController::class, 'add']);
        Route::delete('/collection/{collection}/remove', [CollectionApiController::class, 'remove']);

        Route::post('/logout', [LoginApiController::class, 'logout']);
    });  
});
