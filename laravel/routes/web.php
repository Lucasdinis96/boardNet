<?php

use App\Http\Controllers\BoardgameController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TradeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/boardgames', [BoardgameController::class, 'index'])->name('boardgames');
Route::get('/boardgame/{id}', [BoardgameController::class, 'show'])->name('showBoardgame');

Route::get('/trades', [TradeController::class, 'index'])->name('trades');
Route::get('/trade/{id}', [TradeController::class, 'show'])->name('showTrade');

Route::get('/cities/search', [CityController::class, 'search'])->name('cities.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 
    Route::get('/profile/my-trades', [TradeController::class, 'myTrades'])->name('myTrades');
    Route::get('/profile/my-trades/create', [TradeController::class, 'create'])->name('createTrade');
    Route::post('profile/my-trades/store', [TradeController::class, 'store'])->name('storeTrade');
    Route::get('/profile/my-trades/{trade}/edit', [TradeController::class, 'edit'])->name('editTrade');
    Route::put('/profile/my-trades/{trade}/update', [TradeController::class, 'update'])->name('updateTrade');
    Route::delete('/profile/my-trades/{trade}', [TradeController::class, 'destroy'])->name('deleteTrade');
    Route::delete('/profile/my-trades/{trade}/boardgame/{boardgame}', [TradeController::class, 'detachBoardgame'])->name('detachBoardgame');
    Route::get('/profile/collection', [CollectionController::class, 'index'])->name('myCollection');
    
    Route::post('/collection', [CollectionController::class, 'add'])->name('addCollection');
    Route::delete('/collection/{collection}', [CollectionController::class, 'remove'])->name('removeCollection');
    
});

require __DIR__.'/auth.php';
