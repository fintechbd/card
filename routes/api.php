<?php

use Fintech\RestApi\Http\Controllers\Card\PrepaidCardController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "API" middleware group. Enjoy building your API!
|
*/
if (Config::get('fintech.card.enabled')) {
    Route::prefix(config('fintech.card.root_prefix', 'api/'))->middleware(['api'])->group(function () {
        Route::prefix('card')->name('card.')
            ->middleware(config('fintech.auth.middleware'))
            ->group(function () {
                //            Route::post('prepaid-cards/{prepaid_card}/restore', [PrepaidCardController::class, 'restore'])->name('prepaid-cards.restore');
                Route::post('prepaid-cards/{prepaid_card}/status', [PrepaidCardController::class, 'status'])->name('prepaid-cards.status');
                Route::apiResource('prepaid-cards', PrepaidCardController::class);
                //DO NOT REMOVE THIS LINE//
            });
        Route::prefix('dropdown')->name('card.')->group(function () {
            Route::get('prepaid-cards', [PrepaidCardController::class, 'dropdown'])->name('prepaid-cards.dropdown');
            Route::get('prepaid-card-statuses', [PrepaidCardController::class, 'statusDropdown'])->name('prepaid-card-statues.dropdown');
        });
    });
}
