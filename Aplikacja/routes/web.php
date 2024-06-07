<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Strona Główna

Route::get('/', [OfferController::class, 'mainPageindex'])->name('mainPage');
Route::post('/show-more-offers', [OfferController::class, 'showMoreOffers'])->name('showMoreOffers');
Route::get('/search', [OfferController::class, 'search'])->name('offersSearch');

//Admin Panel
Route::get('/admin', [AuthController::class, 'adminPage'])->name('admin');


// Zarządzanie ofertami

Route::get('/admin/offers', [OfferController::class, 'index'])->name('offerIndex');
Route::post('/admin/offers/create',[OfferController::class, 'store'])->name('offerStore');
Route::get('/admin/offers/{id}/edit', [OfferController::class, 'show'])->name('offerShow');
Route::put('/admin/offers/{id}', [OfferController::class, 'update'])->name('offerUpdate');
Route::delete('/admin/offers/{id}', [OfferController::class, 'destroy'])->name('offerDelete');

// Zarządzanie użytkownikami

Route::get('/admin/users', [UserController::class, 'index'])->name('userIndex');
Route::post('/admin/users/create',[UserController::class, 'store'])->name('userStore');
Route::get('/admin/users/{id}/edit', [UserController::class, 'show'])->name('userShow');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('userUpdate');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('userDelete');

// Logowanie i rejestracja

Route::get('/login', [AuthController::class, 'showLoginPage'])->name('loginPage');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'registerPage'])->name('register');

Route::post('/register', [UserController::class, 'register'])->name('userRegister');

// Panel użytkownika

Route::get('/users/{id}', [UserController::class, 'indexUser'])->name('profile');
Route::get('/users/{id}/settings', [UserController::class, 'showSettings'])->name('profileEdit');
Route::put('/users/{id}', [UserController::class, 'updateInSettings'])->name('profileUpdate');
Route::delete('/offers/{id}', [OfferController::class, 'destroyByUser'])->name('userOfferDelete');

// Panel ofert

Route::get('/offers/{id}', [OfferController::class, 'showWithPhotos'])->name('offerShowWithPhotos');
Route::get('user/offers/{id}', [OfferController::class, 'editWithPhotos'])->name('offerEditWithPhotos');
Route::put('user/offers/{id}', [OfferController::class, 'updateByUser'])->name('updateByUser');
Route::get('/offers/create', [OfferController::class, 'showAddOffer'])->name('showCreateOffer');
Route::post('/offers',[OfferController::class, 'storeByUser'])->name('storeByUser');

//zarzadzanie zdjęciami
Route::post('/offers/{id}/photo',[PhotoController::class, 'store'])->name('storePhoto');
Route::delete('/photo/{id}', [PhotoController::class, 'destroy'])->name('deletePhoto');




