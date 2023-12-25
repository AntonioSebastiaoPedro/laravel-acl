<?php

use App\Http\Controllers\{PermissionController, UserController};
use App\Http\Controllers\Auth\AuthApiController;
use Illuminate\Support\Facades\Route;

Route::post('/auth', [AuthApiController::class, 'auth'])->name('auth');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout'])->name('logout');
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::apiResource('permissions', PermissionController::class);
});
