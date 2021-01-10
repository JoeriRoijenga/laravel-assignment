<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::view('/home', 'home')->middleware(['auth', 'verified']);

Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware('auth');
Route::get('/user/two-factor-auth', [UserController::class, 'showTwoFactor'])->middleware(['auth', 'two.factor.auth']);