<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MuscleController;
use App\Http\Controllers\Api\TrainingTypeController;
use App\Http\Controllers\Api\TrainingWorkOutController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'auth']);
    Route::post('user/register', [UserController::class, 'store']);
    Route::post('email/resendEmail', [UserController::class, 'resendEmail']);
    Route::post('email/recoverPassword', [UserController::class, 'recoverPassword']);
    Route::get('email/verify/{id}/{hash}', [UserController::class, 'verifyEmail']);
    Route::post('user/updateRecoverPassword', [UserController::class, 'updateRecoverPassword']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('user/update', [UserController::class, 'update']);
        Route::post('user/show', [UserController::class, 'show']);
        Route::post('user/destroy', [UserController::class, 'destroy']);
        Route::apiResource('work', WorkController::class);
        Route::apiResource('trainingWorkOut', TrainingWorkOutController::class);
        Route::apiResource('trainingType', TrainingTypeController::class);
    });
});
