<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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
    return view('login');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticating']);

Route::get('logout', [AuthController::class, 'logout']);

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerProcess']);

Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('forgot-password', [AuthController::class, 'forgotPasswordProcess']);

Route::get('validate-forgot-password/{token}', [AuthController::class, 'validateForgotPassword'])->name('validate-forgot-password');
Route::post('validate-forgot-password-act', [AuthController::class, 'validateForgotPasswordProcess'])->name('validate-forgot-password-act');

Route::get('reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
