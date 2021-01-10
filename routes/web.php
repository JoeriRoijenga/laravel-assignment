<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/users/overview', [UserController::class, 'showAll'])->middleware(['auth', 'verified']);
Route::get('/user/delete/{id}', [UserController::class, 'delete'])->middleware(['auth', 'verified']);

// Companies
Route::get('/companies/overview', [CompanyController::class, 'showAll'])->middleware(['auth', 'verified']);
Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->middleware(['auth', 'verified']);
Route::get('/company/delete/{id}', [CompanyController::class, 'delete'])->middleware(['auth', 'verified']);
Route::get('/company/update', [CompanyController::class, 'update', 'as' => 'company-update'])->middleware(['auth', 'verified']);
