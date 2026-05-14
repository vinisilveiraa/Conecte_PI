<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaregiverController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ReviewController;
use App\Models\Caregiver;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\DatabaseNotification;


// esta rota é apenas para a vizualizaação da pagina de email
Route::view("/teste", "auth.check-email")->name('check-email');

// rota pra pega cordenada
Route::get('/geocode', [AuthController::class, 'getCoordinates']);

// rota pra certificados
Route::get('/caregiver/certificate/{id}', [CaregiverController::class, 'certificate'])
    ->middleware('auth')
    ->name('caregiver.certificate');

Route::middleware('auth')->get('/notification/{id}', function ($id) {

    $notification = Auth::user()
        ->notifications
        ->where('id', $id)
        ->first();

    if (!$notification) {
        abort(404);
    }

    $notification->markAsRead();

    return redirect($notification->data['link']);
})->name('notification.read');


// ROTAS PARA USUARIOS AUTENTICADOS
Route::middleware('auth')->group(function () {

    // LOGOUT
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('home');
    })->name('logout');

    // USER
    Route::view('/dashboard.caregiver-editProfile', 'caregiver.dashboard-caregiver-editprofile')
        ->name('dashboard.caregiver-editProfile');


    Route::get('/caregiverProfile', [CaregiverController::class, 'UpdateCaregiverForm'])
        ->name('caregiver.edit-Profile');

    Route::post('/caregiverProfileUpdated', [CaregiverController::class, 'UpdateCaregiver'])
        ->name('update.caregiver');
    Route::get('/caregiver/check-slug', [CaregiverController::class, 'checkSlug'])
        ->name('caregiver.check-slug');

    Route::view('/dashboard.client-edit Profile', 'client.dashboard-client-editprofile')
        ->name('dashboard.client-editProfile');

    Route::post('/dashboard-updateProfile', [ProfileController::class, 'updateProfile'])
        ->name('update.profile');
    Route::post('/dashboard-editAvatar', [ProfileController::class, 'updateAvatar'])
        ->name('edit.profile.avatar');

    // CLIENT
    Route::view('/dashboard-client', 'client.dashboard-client')->name('dashboard.client');

    // CAREGIVER
    Route::get('/dashboard-caregiver', [CaregiverController::class, 'showDashboard'])
        ->name('dashboard.caregiver');

    Route::get("/caregiver-specialties", [CaregiverController::class, 'showSpecialties'])
        ->name('caregiver.specialties');

    Route::post('/caregiver/specialty/{id}', [CaregiverController::class, 'addSpecialty'])
        ->name('caregiver.add.specialty');

    Route::delete('/caregiver/specialty/{id}', [CaregiverController::class, 'removeSpecialty'])
        ->name('caregiver.remove.specialty');



    // CAREGIVER : PROPOSTAS - HIRE

    Route::get('/dashboard-caregiver-proposals', [ProposalController::class, 'proposalHistory'])
        ->name('caregiver.proposals');

    Route::get('/dashboard-reviews', [ReviewController::class, 'showReview'])
        ->name('caregiver.showReviews');


    // CLIENTE : CONTRATAR - HIRE
    Route::get('/dashboard-hire-form/{id}', [ProposalController::class, 'hireForm'])
        ->name('client.hire.form');

    Route::post('/dashboard-hire', [ProposalController::class, 'hireCaregiver'])
        ->name('client.hire');

    Route::get('/dashboard-hire-history', [ProposalController::class, 'hireHistory'])
        ->name('client.hire-history');

    // review
    Route::post('/dashboard-hire-history/rate', [ReviewController::class, 'rateCaregiver'])
        ->name('client.proposal.rate');



    Route::get('/cuidador/{slug}', [CaregiverController::class, 'PublicProfile'])
        ->name('caregiver.public-profile');

    Route::patch(
        '/caregiver/proposal/{id}/{status}',
        [ProposalController::class, 'setProposalStatus']
    )->name('proposal.set-proposal-status');


    // Route::view('/dashboard-cliente-historico', 'client.dashboard-client-historico')->name('dashboard.client.buscar');


    // Route::get('/dashboard-caregiver-especialidades', [CaregiverController::class, 'createSpecialty'])->name('dashboard.caregiverespecialidades');
    // Route::view('/dashboard-caregiver-propostas', 'caregiver.dashboard-caregiver-propostas')->name('dashboard.caregiver.propostas');



});

// ROTAS DO MENU
Route::view("/", "site.home")->name('home');
Route::view("/sobre-nos", "site.sobre-nos")->name('sobre-nos');
Route::view("/politica-privacidade", "site.politica-privacidade")->name('politica-privacidade');
Route::view("/contatos", "site.contatos")->name('contatos');
Route::post('/chatbot', [ChatbotController::class, 'responder']);


Route::get("/searchCaregiver", [ClientController::class, 'searchCaregiver'])
    ->name('client.searchCaregiver');



// ROTAS PARA VISITANTES
Route::middleware('guest')->group(function () {

    // ROTAS PARA O LOGIN
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    // ROTAS PARA CADASTRO
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'store']);
    // ROTAS PARA APRESENTAÇÃO DAS VIEWS DE CADASTRO
    Route::view("/register-client", "auth.register-client")->name('register.client');
    Route::view('/register-caregiver', 'auth.register-caregiver')->name('register.caregiver');

    // ESQUECI SENHA
    Route::view('/forgot-password', 'site.forgot-password')
        ->name('password.request');
    Route::post('/forgot-password', [PasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email-sent');

    Route::get('/reset-password/{token}', function ($token) {
        return view('site.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/password-update', [PasswordController::class, 'updatePassword'])
        ->name('password.update');
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
