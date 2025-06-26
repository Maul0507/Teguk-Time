<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController\AuthController;
use App\Http\Controllers\ApiController\ArticlesController;
use App\Http\Controllers\ApiController\IntensitasController;
use App\Http\Controllers\ApiController\DrinkScheduleController;

// 🧾 Route Auth (tanpa middleware)
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// 🔐 Route yang membutuhkan autentikasi sanctum
Route::middleware('auth:sanctum')->group(function () {

    // 📰 Article routes
    Route::get('/articles', [ArticlesController::class, 'index']);
    Route::get('/articles/{id}', [ArticlesController::class, 'show']);
    Route::post('/articles', [ArticlesController::class, 'store']);
    Route::put('/articles/{id}', [ArticlesController::class, 'update']);
    Route::delete('/articles/{id}', [ArticlesController::class, 'destroy']);

    // 📊 Intensitas routes
    Route::get('/intensitas', [IntensitasController::class, 'index']);
    Route::get('/intensitas/{id}', [IntensitasController::class, 'show']);
    Route::post('/intensitas', [IntensitasController::class, 'store']);
    Route::put('/intensitas/{id}', [IntensitasController::class, 'update']);
    Route::delete('/intensitas/{id}', [IntensitasController::class, 'destroy']);

    // 💧 Drink Schedules routes
    Route::get('/drink-schedules', [DrinkScheduleController::class, 'index']);
    Route::get('/drink-schedules/{id}', [DrinkScheduleController::class, 'show']);
    Route::post('/drink-schedules', [DrinkScheduleController::class, 'store']);
    Route::put('/drink-schedules/{id}', [DrinkScheduleController::class, 'update']);
    Route::delete('/drink-schedules/{id}', [DrinkScheduleController::class, 'destroy']);
});
