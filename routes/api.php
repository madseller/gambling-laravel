<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\BetController;

Route::post('/process-bet', [NotificationController::class, 'processBet']);
Route::post('/place-bet', [BetController::class, 'placeBet']);
