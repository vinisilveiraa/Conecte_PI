<?php

use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    // rotas para usuarios autenticados
});

Route::middleware('guest')->group(function () {
    // rotas para visitantes
    Route::view("/", "site.home")->name('home');
    Route::view("/register-client", "auth.register-client")->name('register.client');
});
