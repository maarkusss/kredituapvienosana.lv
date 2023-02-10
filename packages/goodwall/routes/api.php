<?php

use Illuminate\Support\Facades\Route;
use Goodday\Goodwall\Http\Controllers\GoodwallApiController;
use Goodday\Goodwall\Http\Middleware\CanModifyGoodwall;

Route::group([
    'prefix' => '/api/goodwall',
    'middleware' => CanModifyGoodwall::class,
], function () {
    Route::get('/status', [GoodwallApiController::class, 'status']);
    Route::get('/whitelist', [GoodwallApiController::class, 'getWhitelist']);
    Route::post('/add', [GoodwallApiController::class, 'postWhitelist']);
    Route::post('/delete', [GoodwallApiController::class, 'deleteWhitelist']);
});
