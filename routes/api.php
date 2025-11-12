<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\CheckClockSettingController;

Route::prefix('salaries')->group(function () {
    Route::get('/', [SalaryController::class, 'index']);
    Route::post('/', [SalaryController::class, 'store']);
    Route::get('/{salary}', [SalaryController::class, 'show']);
    Route::put('/{salary}', [SalaryController::class, 'update']);
    Route::delete('/{salary}', [SalaryController::class, 'destroy']);
});

Route::prefix('check-clock-settings')->group(function () {
    Route::get('/', [CheckClockSettingController::class, 'index']);
    Route::post('/', [CheckClockSettingController::class, 'store']);
    Route::get('/{checkClockSetting}', [CheckClockSettingController::class, 'show']);
    Route::put('/{checkClockSetting}', [CheckClockSettingController::class, 'update']);
    Route::delete('/{checkClockSetting}', [CheckClockSettingController::class, 'destroy']);
});

