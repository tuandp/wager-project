<?php

use App\Http\Controllers\BuyWagerController;
use App\Http\Controllers\WagerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'wagers'], static function (): void {
    Route::get('/', [WagerController::class, 'index'])->name('wagers.index');
    Route::post('/', [WagerController::class, 'store'])->name('wagers.create');
});

Route::post('/buy/{wager}', [BuyWagerController::class, 'buy'])->name('wagers.buy');
