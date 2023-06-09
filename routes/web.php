<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Register;
use App\Http\Middleware\hideLoginRedRouteMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'showHomePage'])->name('homePage');
Route::get('/register',[Register::class,'signUp'])->name('signUp')->middleware(hideLoginRedRouteMiddleware::class);
Route::post('/register/processing',[Register::class,'register'])->name('register')->middleware(hideLoginRedRouteMiddleware::class);
Route::get('/login',[LoginController::class,'login'])->name('login')->middleware(hideLoginRedRouteMiddleware::class);
Route::post('/login/process',[LoginController::class,'loginProcess'])->name('loginProcess')->middleware(hideLoginRedRouteMiddleware::class);
Route::get('/profile',[ProfileController::class,'showProfile'])->name('showProfile')->middleware('auth');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
