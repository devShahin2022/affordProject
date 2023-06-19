<?php

use App\Http\Controllers\AddCqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MakeQuestionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Register;
use App\Http\Controllers\siteQuestionController;
use App\Http\Controllers\sscExamBatchAdmController;
use App\Http\Controllers\UsersTableController;
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
Route::get('/admin/adm-req',[sscExamBatchAdmController::class,'getSScXmAdmissionRequest'])->name('getsscXmReq');
Route::post('/admin/approved-adm-req',[sscExamBatchAdmController::class,'approvedAmsReq'])->name('approvedAddmissionReq');
Route::post('/admin/unapproved-adm-req',[sscExamBatchAdmController::class,'unApprovedAmsReq'])->name('UnapprovedAddmissionReq');
Route::post('/admin/delete-adm-req',[sscExamBatchAdmController::class,'deleteUnapprovedReq'])->name('deleteUnapprovedReq');
// admin users table section
Route::get('/admin/all-users',[UsersTableController::class,'getAllUsers'])->name('getAllUsers');
Route::get('/admin/admin-privilige',[UsersTableController::class,'privilige'])->name('privilige');
Route::get('/admin/change/{name}/{id}/{csrf}',[UsersTableController::class,'changeRole'])->name('changeRole');
Route::get('/admin/search',[UsersTableController::class,'searchUser'])->name('searchUser');
Route::post('/admin/change-privilige',[UsersTableController::class,'changePrivilige'])->name('changePrivilige');
// admin site general content
Route::get('/admin/site-general-content/add-board-mcq',[siteQuestionController::class,'addBoardMcqView'])->name('addBoardMcqView');
Route::post('/admin/site-general-content/upload-mcq',[siteQuestionController::class,'storeMcq'])->name('getMcq');
Route::get('/admin/site-general-content/filter-mcq',[siteQuestionController::class,'findMcqByOptions'])->name('findMcqByOptions');
Route::get('/admin/site-general-content/search-mcq',[siteQuestionController::class,'serachMcq'])->name('serachMcq');
Route::post('/admin/site-general-content/change-mcq-status',[siteQuestionController::class,'changeMcqStatus'])->name('changeMcqStatus');
Route::post('/admin/site-general-content/mcq-delete',[siteQuestionController::class,'deleteMcq'])->name('deleteMcq');
Route::get('/admin/site-general-content/mcq/view/{id}/{mcqNo}',[siteQuestionController::class,'singleMcqView'])->name('singleMcqView');
Route::get('/admin/site-general-content/mcq/update/{id}/{mcqNo}',[siteQuestionController::class,'McqUpdate'])->name('McqUpdate');
// route for cq for admin
Route::get('/admin/site-general-content/get-cq/{statusReset}',[AddCqController::class,'getCq'])->name('getCq');
Route::post('/admin/site-general-content/store-cq',[AddCqController::class,'storeCq'])->name('storeCq');
Route::get('/admin/site-general-content/find-cq',[AddCqController::class,'findCqData'])->name('findCqData');
Route::get('/admin/site-general-content/find-search',[AddCqController::class,'findBuSearch'])->name('findBuSearch');







// route for make exam question admin panel
Route::get('/admin/site-general-content/mcq/make-xm-mcq',[MakeQuestionController::class,'showMakeMcqQuesXm'])->name('showMakeMcqQuesXm');
Route::post('/admin/site-general-content/mcq-xm-store',[MakeQuestionController::class,'storeMcq'])->name('storeMakeXmMcq');
Route::get('/admin/site-general-content/find',[MakeQuestionController::class,'findXmMcqByOptions'])->name('findXmMcqByOptions');
Route::get('/admin/site-general-content/search',[MakeQuestionController::class,'serachMcqXm'])->name('serachMcqXm');



// front site section
Route::get('/contact',[ContactController::class,'showContact'])->name('showContact'); // no auth
Route::post('/contact',[ContactController::class,'sendContact'])->name('sendContact'); // no auth
Route::get('/admin/contact',[ContactController::class,'getAdminContacts'])->name('getAdminContacts'); // no auth
Route::post('/admin/app-contact',[ContactController::class,'approvedContact'])->name('approvedContact'); // no auth

// ssc exam form addmission
Route::get('/ssc-2024/admission',[sscExamBatchAdmController::class,'getSscExamForm'])->name('getSscExamForm')->middleware('auth');;
Route::post('/ssc-2024/admission',[sscExamBatchAdmController::class,'storeAdmSSCExamBatch'])->name('storeAdmSSCExamBatch')->middleware('auth');;
