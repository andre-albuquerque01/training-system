<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'auth']);
    Route::post('user', [UserController::class, 'create']);
    Route::middleware('auth:sanctum')->group(function () {
    });
});
