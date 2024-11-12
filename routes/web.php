<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/signin-register', [LoginController::class, 'register'])->name('register');
Route::post('/validation', [LoginController::class, 'login'])->name('validation');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->get('/admin', function () {
    if (Auth::user()->role_id === 1) {
        return view('admin-panel'); // Vista del administrador
    } else {
        return redirect()->route('dashboard'); // Redirige al dashboard del usuario
    }
})->name('admin');

Route::get('/dashboard', function () {
    return view('dashboard'); // Vista para usuarios regulares
})->name('dashboard');


Route::get('/two-factor-challenge', [LoginController::class, 'twoFactorChallenge'])->name('two-factor.login');
Route::post('/two-factor-challenge', [LoginController::class, 'twoFactorLogin'])->name('two-factor.verify');


