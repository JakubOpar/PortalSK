<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\UserController;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Support\Facades\Route;

//Strona Główna

Route::get('/', [OfferController::class, 'MainPageindex'])->name('mainPage');
Route::post('/show-more-offers', [OfferController::class, 'showMoreOffers'])->name('showMoreOffers');
Route::get('/search', [OfferController::class, 'search'])->name('offersSearch');

//Admin Panel
Route::get('/admin', [AuthController::class, 'adminPage'])->name('admin');


// Zarządzanie ofertami

Route::get('/admin/offers', [OfferController::class, 'index'])->name('offerIndex');
Route::post('/admin/offers',[OfferController::class, 'store'])->name('offerStore');
Route::get('/admin/offers/{id}/offerEdit', [OfferController::class, 'show'])->name('offerShow');
Route::put('/admin/offers/{id}', [OfferController::class, 'update'])->name('offerUpdate');
Route::delete('/admin/offers/{id}', [OfferController::class, 'destroy'])->name('offerDelete');

// Zarządzanie użytkownikami

Route::get('/admin/users', [UserController::class, 'index'])->name('userIndex');
Route::post('/admin/users',[UserController::class, 'store'])->name('userStore');
Route::get('/admin/users/{id}/userEdit', [UserController::class, 'show'])->name('userShow');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('userUpdate');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('userDelete');

// Logowanie i rejestracja

Route::get('/login', [AuthController::class, 'showLoginPage'])->name('loginPage');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/rejestracja', function () {
    return view('PageFunctions.register');
})->name('register');

Route::post('/rejestracja', [UserController::class, 'register'])->name('userRegister');

// Panel użytkownika

Route::get('/user/{id}', [UserController::class, 'indexUser'])->name('profile');
Route::get('/user/{id}/settings', [UserController::class, 'showSettings'])->name('profileEdit');
Route::put('/user/{id}', [UserController::class, 'updateInSettings'])->name('profileUpdate');
//Route::get('/user/{id}/settings', [UserController::class, 'index'])->name('userSettings');

// Panel ofert

Route::get('/offers/{id}', [OfferController::class, 'showWithPhotos'])->name('offerShowWithPhotos');



