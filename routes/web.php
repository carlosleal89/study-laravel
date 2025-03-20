<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;

// Rota principal protegida
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth']);

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rotas de visualização (Blade)
    Route::get('/accounts', function () {
        return view('accounts.index');
    })->name('accounts.index');

    Route::get('/accounts/create', function () {
        return view('accounts.create');
    })->name('accounts.create');

    Route::get('/accounts/{id}/edit', function ($id) {
        return view('accounts.edit');
    })->name('accounts.edit');

    Route::get('/accounts/{id}', function ($id) {
        return view('accounts.show');
    })->name('accounts.show');
});
