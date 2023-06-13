<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Register;
use App\Http\Controllers\sscExamBatchAdmController;
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
Route::get('/profile/question',[ProfileController::class,'showQuestionPage'])->name('showQuestionPage')->middleware('auth');


Route::post('/profile/add-question',[MessageController::class,'insertMsg'])->name('insertMsg')->middleware('auth');
// Route::get('/profile/question',[MessageController::class,'showPendingQuestion'])->name('showQuestion')->middleware('auth');

// admin section
Route::get('/admin/messages-pending',[MessageController::class,'showAllPendingQuestion'])->name('showAllPendingQuestion')->middleware('auth');
Route::post('/admin/msg-sending',[MessageController::class,'msgSending'])->name('submitAnswer')->middleware('auth');
Route::get('/all-question-ans',[MessageController::class,'showAllQuestionAnswer'])->name('showAllQuestionAns'); // no auth



// front site section
Route::get('/contact',[ContactController::class,'showContact'])->name('showContact'); // no auth
Route::post('/contact',[ContactController::class,'sendContact'])->name('sendContact'); // no auth
Route::get('/admin/contact',[ContactController::class,'getAdminContacts'])->name('getAdminContacts'); // no auth
Route::post('/admin/app-contact',[ContactController::class,'approvedContact'])->name('approvedContact'); // no auth

// ssc exam form addmission
Route::get('/ssc-2024/admission',[sscExamBatchAdmController::class,'getSscExamForm'])->name('getSscExamForm')->middleware('auth');;
Route::post('/ssc-2024/admission',[sscExamBatchAdmController::class,'storeAdmSSCExamBatch'])->name('storeAdmSSCExamBatch')->middleware('auth');;
