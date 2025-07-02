<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LaptopController;
use function PHPUnit\Framework\returnArgument;

Route::prefix('api')->group(function() {
    Route::prefix('/user')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::get('/login', [AuthController::class, 'login']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/whoami', function (Request $request) {
            return $request->user();
        });

    })->middleware('auth:api');
    
    Route::apiResource('laptop', LaptopController::class);

    Route::resource('laptop', LaptopController::class, [
        'only' => [
            'index',
            'show',
        ]
    ]);

    Route::resource('laptop', LaptopController::class, [
        'except' => [
            'index',
            'show',
        ]
    ])->middleware(['auth:api']);
});