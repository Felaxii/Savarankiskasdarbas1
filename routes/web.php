<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ConferenceController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('client')->group(function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/conference/{id}', [ClientController::class, 'show']);
});

Route::prefix('employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'index']);
});

Route::prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/conferences', [ConferenceController::class, 'index']);
});
