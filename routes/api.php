<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Promocodes\Core\Http\Controllers\Api\PromocodeController;

Route::post('/promocodes', [PromocodeController::class, 'store']);
Route::post('/promocodes/send', [PromocodeController::class, 'promocodeSms' ]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
