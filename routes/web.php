<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Ruta de inicio (login)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Rutas protegidas (requieren sesión)
Route::middleware('auth.session')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard (para ambos roles)
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    
    // Rutas solo para Administrador
    Route::middleware('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
    
    // Rutas para Usuario común
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
});