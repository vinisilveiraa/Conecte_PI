<?php

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::middleware('auth')->group(function () {
    // rotas para usuarios autenticados
    Route::view('/dashboard-client', 'client.dashboard-client')->name('dashboard.client');
    Route::view('/dashboard-caregiver', 'caregiver.dashboard-caregiver')->name('dashboard.caregiver');
});

Route::middleware('guest')->group(function () {
    // rotas para visitantes

    Route::view("/", "site.home")->name('home');
    Route::view('/login', 'auth.login')->name('login');

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'store']);
    Route::view("/register-client", "auth.register-client")->name('register.client');
    Route::view('/register-caregiver', 'auth.register-caregiver')->name('register.caregiver');
});


Route::middleware('guest')->get('/login-link/{user}', function (User $user) {
    Auth::login($user);
    request()->session()->regenerate();
    if ($user->role === 'client') {
        return redirect()->route('dashboard.client');
    }
    return redirect()->route('dashboard.caregiver');
})->name('login.link');


