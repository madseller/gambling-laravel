<?php

use Illuminate\Support\Facades\Route;
use App\Services\ClickHouseService;
use App\Http\Controllers\RpcController;

Route::get('/log-view', function (ClickHouseService $clickHouse) {
    $clickHouse->logPageView(1, '/home');
    return 'View logged!';
});

Route::get('/get-views', function (ClickHouseService $clickHouse) {
    return response()->json($clickHouse->getViews());
});

Route::post('/rpc', [RpcController::class, 'handle']);
