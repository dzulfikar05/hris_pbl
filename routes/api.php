<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\CheckClockSettingController;

Route::prefix('salaries')->group(function () {
    Route::get('/', [SalaryController::class, 'index']);
    Route::post('/', [SalaryController::class, 'store']);
    Route::get('/{id}', [SalaryController::class, 'show']);
    Route::put('/{id}', [SalaryController::class, 'update']);
    Route::delete('/{id}', [SalaryController::class, 'destroy']);
});

Route::prefix('check-clock-settings')->group(function () {
    Route::get('/', [CheckClockSettingController::class, 'index']);
    Route::post('/', [CheckClockSettingController::class, 'store']);
    Route::get('/{id}', [CheckClockSettingController::class, 'show']);
    Route::put('/{id}', [CheckClockSettingController::class, 'update']);
    Route::delete('/{id}', [CheckClockSettingController::class, 'destroy']);
});

