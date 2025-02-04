<?php

use App\Http\Controllers\Api\YukatechtestController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:10,1')->group(function () {
    Route::post('/locations', [YukatechtestController::class, 'store']);
    Route::get('/locations', [YukatechtestController::class, 'index']);
    Route::get('/locations/{id}', [YukatechtestController::class, 'show']);
    Route::put('/locations/{id}', [YukatechtestController::class, 'update']);
    Route::delete('/locations/{id}', [YukatechtestController::class, 'destroy']);
    Route::get('/locations/route', [YukatechtestController::class, 'route']);
});
