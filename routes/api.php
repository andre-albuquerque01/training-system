<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MuscleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'auth']);
    Route::post('register', [UserController::class, 'store']);
    Route::apiResource('work', WorkController::class);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('update', [UserController::class, 'update']);
        Route::post('show', [UserController::class, 'show']);
        Route::post('destroy', [UserController::class, 'destroy']);
        Route::apiResource('muscle', MuscleController::class);
    });
});
