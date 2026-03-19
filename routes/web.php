<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaregiverController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::view("/teste", "auth.check-email")->name('check-email');





Route::middleware('auth')->group(function () {
    // rotas para usuarios autenticados
    // CLIENT
    Route::view('/dashboard-client', 'client.dashboard-client')->name('dashboard.client');
    Route::get("/find-caregivers", [CaregiverController::class, 'index'])->name('find.caregivers');

    // CAREGIVER
    Route::get("/caregiver-specialties", [CaregiverController::class, 'addSpecialty'])->name('caregiver.specialties');









    Route::post('/caregiver/specialty/{id}', [CaregiverController::class, 'add'])->name('caregiver.specialty.add');

    Route::delete('/caregiver/specialty/{id}', [CaregiverController::class, 'remove'])->name('caregiver.specialty.remove');









    Route::view('/dashboard-cliente-historico', 'client.dashboard-client-historico')->name('dashboard.client.buscar');


    Route::view('/dashboard-caregiver', 'caregiver.dashboard-caregiver')->name('dashboard.caregiver');
    Route::get('/dashboard-caregiver-especialidades', [CaregiverController::class, 'createSpecialty'])->name('dashboard.caregiverespecialidades');
    Route::view('/dashboard-caregiver-propostas', 'caregiver.dashboard-caregiver-propostas')->name('dashboard.caregiver.propostas');


    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');
});

Route::middleware('guest')->group(function () {
    // rotas para visitantes


    Route::view("/", "site.home")->name('home');
    Route::view("/sobre-nos", "site.sobre-nos")->name('sobre-nos');
    Route::view("/politica-privacidade", "site.politica-privacidade")->name('politica-privacidade');
    Route::view("/contatos", "site.contatos")->name('contatos');


    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

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
