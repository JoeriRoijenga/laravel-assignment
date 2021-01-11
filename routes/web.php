<?php

use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

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

// Welcome
Route::get('/', function () {
    return view('welcome');
});

// Home
Route::view('/home', 'home')->middleware(['auth', 'verified']);

// Users
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware('auth');
Route::get('/user/two-factor-auth', [UserController::class, 'showTwoFactor'])->middleware(['auth', 'two.factor.auth']);
Route::get('/users/overview', [UserController::class, 'showAll'])->middleware(['auth', 'verified'])->name('show-all-users');
Route::get('/user/delete/{id}', [UserController::class, 'delete'])->middleware(['auth', 'verified']);
Route::get('/user/delete/{id}', [UserController::class, 'delete'])->middleware(['auth', 'verified']);

// Register
Route::get('/user/register', [RegisterUserController::class, 'store'])->middleware(['auth', 'verified'])->name('register-user');
Route::get('/user/register/new', [RegisterUserController::class, 'show'])->middleware(['auth', 'verified'])->name('register-view');

// Email Verify
Route::get('/email/verify/{id}/{hash}', [UserController::class, 'verifyView'])->name('verification.verify');
Route::get('/email/verify/update', [UserController::class, 'verify'])->name('verification.verify.update');

// Companies
Route::get('/companies/overview', [CompanyController::class, 'showAll'])->middleware(['auth', 'verified']);
Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->middleware(['auth', 'verified']);
Route::get('/company/delete/{id}', [CompanyController::class, 'delete'])->middleware(['auth', 'verified']);
Route::post('/company/update', [CompanyController::class, 'update'])->middleware(['auth', 'verified']);
Route::get('/company/add', function () {
    return view('company.add');
})->middleware(['auth', 'verified'])->name('company-add');
Route::get('/company/add/new', [CompanyController::class, 'add'])->middleware(['auth', 'verified'])->name('company-add-new');