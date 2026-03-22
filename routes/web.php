<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaregiverController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// esta rota é apenas para a vizualizaação da pagina de email
Route::view("/teste", "auth.check-email")->name('check-email');





// ROTAS PARA USUARIOS AUTENTICADOS
Route::middleware('auth')->group(function () {

    // LOGOUT
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');

    // USER
    Route::post('/dashboard-editAvatar', [ProfileController::class, 'updateAvatar'])
        ->name('edit.profile.avatar');

    // CLIENT
    Route::view('/dashboard-client', 'client.dashboard-client')->name('dashboard.client');
    Route::get("/select-specialty", [ClientController::class, 'selectSpecialty'])->name('select.specialty');
    Route::post("/load-caregivers", [ClientController::class, 'loadCaregivers'])->name('load.caregivers');

    // CAREGIVER
    Route::view('/dashboard-caregiver', 'caregiver.dashboard-caregiver')->name('dashboard.caregiver');
    
    Route::get("/caregiver-specialties", [CaregiverController::class, 'showSpecialties'])
        ->name('caregiver.specialties');

    Route::post('/caregiver/specialty/{id}', [CaregiverController::class, 'addSpecialty'])
        ->name('caregiver.add.specialty');

    Route::delete('/caregiver/specialty/{id}', [CaregiverController::class, 'removeSpecialty'])
        ->name('caregiver.remove.specialty');







    // Route::view('/dashboard-cliente-historico', 'client.dashboard-client-historico')->name('dashboard.client.buscar');


    // Route::get('/dashboard-caregiver-especialidades', [CaregiverController::class, 'createSpecialty'])->name('dashboard.caregiverespecialidades');
    // Route::view('/dashboard-caregiver-propostas', 'caregiver.dashboard-caregiver-propostas')->name('dashboard.caregiver.propostas');



});

// ROTAS PARA VISITANTES
Route::middleware('guest')->group(function () {


    // ROTAS NDO MENU
    Route::view("/", "site.home")->name('home');
    Route::view("/sobre-nos", "site.sobre-nos")->name('sobre-nos');
    Route::view("/politica-privacidade", "site.politica-privacidade")->name('politica-privacidade');
    Route::view("/contatos", "site.contatos")->name('contatos');

    // ROTAS PARA O LOGIN
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    // ROTAS PARA CADASTRO
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'store']);
    // ROTAS PARA APRESENTAÇÃO DAS VIEWS DE CADASTRO
    Route::view("/register-client", "auth.register-client")->name('register.client');
    Route::view('/register-caregiver', 'auth.register-caregiver')->name('register.caregiver');
});



// ROTA EXCLUSIVA PARA A CONFIRMAÇÃO DO EMAIL
Route::middleware('guest')->get('/login-link/{user}', function (User $user) {
    Auth::login($user);
    request()->session()->regenerate();

    if ($user->role === 'client') {
        return redirect()->route('dashboard.client');
    }

    return redirect()->route('dashboard.caregiver');
})->name('login.link');
