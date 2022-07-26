<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\DonationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [HomeController::class, 'contact']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//USERS
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::post('/users/add', [UserController::class, 'add'])->name('users.add');
Route::get('/searchuser', [UserController::class, 'search'])->name('searchuser');

//PROFILE
Route::get('/profile{user}', [UserController::class, 'profile']);
Route::get('/editprofile{user}', [UserController::class, 'edit']);
Route::put('/profile/update/{user}',  [UserController::class, 'update']);
Route::get('/profile/delete/{id}',  [UserController::class, 'deleteprofil'])->name('profile.delete');

//ANIMALS
Route::get('/animals', [AnimalController::class, 'index'])->name('animals');
Route::post('/animals/store', [AnimalController::class, 'store'])->name('animals.store');
Route::get('/editanimal{animal}', [AnimalController::class, 'edit']);
Route::put('/animal/update/{animal}',  [AnimalController::class, 'update']);
Route::get('/animal/delete/{id}',  [AnimalController::class, 'destroy'])->name('animal.delete');
Route::get('/animal{animal}', [AnimalController::class, 'show']);

//DONATIONS
Route::get('/donations', [DonationController::class, 'index'])->name('donations');
Route::post('/donations/store', [DonationController::class, 'store'])->name('donations.store');
