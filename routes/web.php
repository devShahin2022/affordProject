<?php

use App\Http\Controllers\aboutUsController;
use App\Http\Controllers\addCqController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\courseOutLineController;
use App\Http\Controllers\dynamicMcqExamPapersAdd;
use App\Http\Controllers\examManageController;
use App\Http\Controllers\faqsController;
use App\Http\Controllers\getallCqMcqAndReportController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\lawController;
use App\Http\Controllers\leaderBoardController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\makeQuestionController;
use App\Http\Controllers\managePremiumExams;
use App\Http\Controllers\messageController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\questionTypeController;
use App\Http\Controllers\register;
use App\Http\Controllers\showQuestionFrontendPrmController;
use App\Http\Controllers\siteQuestionController;
use App\Http\Controllers\sscExamBatchAdmController;
use App\Http\Controllers\usersTableController;
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

Route::get('/',[homeController::class,'showHomePage'])->name('homePage');
Route::get('/register',[register::class,'signUp'])->name('signUp')->middleware(hideLoginRedRouteMiddleware::class);
Route::post('/register/processing',[register::class,'register'])->name('register')->middleware(hideLoginRedRouteMiddleware::class);
Route::get('/login',[loginController::class,'login'])->name('login')->middleware(hideLoginRedRouteMiddleware::class);
Route::post('/login/process',[loginController::class,'loginProcess'])->name('loginProcess')->middleware(hideLoginRedRouteMiddleware::class);
Route::get('/profile',[profileController::class,'showProfile'])->name('showProfile')->middleware('auth');
Route::post('/logout',[loginController::class,'logout'])->name('logout');
Route::get('/profile/question',[profileController::class,'showQuestionPage'])->name('showQuestionPage')->middleware('auth');
Route::get('/profile/faqs',[faqsController::class,'showFaqs'])->name('showFaqs');
// free exam management
Route::get('/profile/free-exam',[examManageController::class,'showFreeExam'])->name('showFreeExam')->middleware('auth');
Route::get('/profile/free-exam-question-fetch',[examManageController::class,'FreeExamQuestionFetch'])->middleware('auth');
Route::post('/profile/free-exam-data-store',[examManageController::class,'getUserAnswer'])->middleware('auth'); //call by api js
Route::post('/profile/ensure-user-click-start-exam',[examManageController::class,'userClickExamBtn'])->middleware('auth'); //call by api js
Route::get('/profile/see-exam-result',[examManageController::class,'seeFreeExamResult'])->name('seeFreeExamResult')->middleware('auth'); //see exam result




Route::post('/profile/add-question',[messageController::class,'insertMsg'])->name('insertMsg')->middleware('auth');
// Route::get('/profile/question',[messageController::class,'showPendingQuestion'])->name('showQuestion')->middleware('auth');

// admin section
Route::get('/admin/messages-pending',[messageController::class,'showAllPendingQuestion'])->name('showAllPendingQuestion')->middleware('auth');
Route::post('/admin/msg-sending',[messageController::class,'msgSending'])->name('submitAnswer')->middleware('auth');
Route::get('/all-question-ans',[messageController::class,'showAllQuestionAnswer'])->name('showAllQuestionAns'); // no auth
Route::get('/admin/adm-req',[sscExamBatchAdmController::class,'getSScXmAdmissionRequest'])->name('getsscXmReq');
Route::post('/admin/approved-adm-req',[sscExamBatchAdmController::class,'approvedAmsReq'])->name('approvedAddmissionReq');
Route::post('/admin/unapproved-adm-req',[sscExamBatchAdmController::class,'unApprovedAmsReq'])->name('UnapprovedAddmissionReq');
Route::post('/admin/delete-adm-req',[sscExamBatchAdmController::class,'deleteUnapprovedReq'])->name('deleteUnapprovedReq');
// admin users table section
Route::get('/admin/all-users',[usersTableController::class,'getAllUsers'])->name('getAllUsers');
Route::get('/admin/admin-privilige',[usersTableController::class,'privilige'])->name('privilige');
Route::get('/admin/change/{name}/{id}/{csrf}',[usersTableController::class,'changeRole'])->name('changeRole');
Route::get('/admin/search',[usersTableController::class,'searchUser'])->name('searchUser');
Route::post('/admin/change-privilige',[usersTableController::class,'changePrivilige'])->name('changePrivilige');



// admin site general content
Route::get('/admin/site-general-content/add-board-mcq/{statusReset}',[siteQuestionController::class,'addBoardMcqView'])->name('addBoardMcqView');
Route::post('/admin/site-general-content/upload-mcq',[siteQuestionController::class,'storeMcq'])->name('getMcq');
Route::get('/admin/site-general-content/filter-mcq',[siteQuestionController::class,'findMcqByOptions'])->name('findMcqByOptions');
Route::get('/admin/site-general-content/search-mcq',[siteQuestionController::class,'serachMcq'])->name('serachMcq');
Route::post('/admin/site-general-content/change-mcq-status',[siteQuestionController::class,'changeMcqStatus'])->name('changeMcqStatus');
Route::post('/admin/site-general-content/mcq-delete',[siteQuestionController::class,'deleteMcq'])->name('deleteMcq');
Route::get('/admin/site-general-content/mcq/view/{id}/{mcqNo}',[siteQuestionController::class,'singleMcqView'])->name('singleMcqView');
Route::get('/admin/site-general-content/mcq/update/{id}/{mcqNo}',[siteQuestionController::class,'McqUpdate'])->name('McqUpdate');


// route for cq for admin
Route::get('/admin/site-general-content/get-cq/{statusReset}',[addCqController::class,'getCq'])->name('getCq');
Route::post('/admin/site-general-content/store-cq',[addCqController::class,'storeCq'])->name('storeCq');
Route::get('/admin/site-general-content/find-cq',[addCqController::class,'findCqData'])->name('findCqData');
Route::get('/admin/site-general-content/find-search',[addCqController::class,'findBuSearch'])->name('findBuSearch');
Route::post('/admin/site-general-content/a_d',[addCqController::class,'activeOrDeactive'])->name('activeOrDeactive');
Route::post('/admin/site-general-content/cq-delete',[addCqController::class,'deleteCq'])->name('deleteCq');
Route::get('/admin/site-general-content/cq-view/{serial}/{id}',[addCqController::class,'viewSingleCq'])->name('viewSingleCq');
Route::get('/admin/site-general-content/cq-view/update/{serial}/{id}',[addCqController::class,'viewSingleCqUpdate'])->name('viewSingleCqUpdate');
Route::post('/admin/site-general-content/cq-view/update/',[addCqController::class,'updateCq'])->name('updateCq');

// create xm cq question
Route::get('/admin/site-general-content/xm-cq-q/{statusReset}',[addCqController::class,'cqExamQuestionView'])->name('cqExamQuestionView');
Route::post('/admin/site-general-content/xm-cq-q/store',[addCqController::class,'storeExamQuestion'])->name('storeExamQuestion');
Route::get('/admin/site-general-content/xm-cq-find',[addCqController::class,'findXmCqQues'])->name('findXmCqQues');
Route::get('/admin/site-general-content/xm-cq-search',[addCqController::class,'findXmCQSearch'])->name('findXmCQSearch');






// route for make exam question mcq admin panel
Route::get('/admin/site-general-content/mcq/make-xm-mcq/{statusReset}',[makeQuestionController::class,'showMakeMcqQuesXm'])->name('showMakeMcqQuesXm');
Route::post('/admin/site-general-content/mcq-xm-store',[makeQuestionController::class,'storeMcq'])->name('storeMakeXmMcq');
Route::get('/admin/site-general-content/find',[makeQuestionController::class,'findXmMcqByOptions'])->name('findXmMcqByOptions');
Route::get('/admin/site-general-content/search',[makeQuestionController::class,'serachMcqXm'])->name('serachMcqXm');

// get all mcq
Route::get('/admin/site-general-content/all-mcq',[getallCqMcqAndReportController::class,'getAllMcq'])->name('getAllMcq');
Route::get('/admin/site-general-content/all-cq',[getallCqMcqAndReportController::class,'getAllCq'])->name('getAllCq');
Route::get('/admin/site-general-content/reorted-mcq',[getallCqMcqAndReportController::class,'repotedMcq'])->name('repotedMcq');


// front site section
Route::get('/contact',[contactController::class,'showContact'])->name('showContact'); // no auth
Route::post('/contact',[contactController::class,'sendContact'])->name('sendContact'); // no auth
Route::get('/admin/contact',[contactController::class,'getAdminContacts'])->name('getAdminContacts'); // no auth
Route::post('/admin/app-contact',[contactController::class,'approvedContact'])->name('approvedContact'); // no auth

// ssc exam form addmission
Route::get('/ssc-2024/admission',[sscExamBatchAdmController::class,'getSscExamForm'])->name('getSscExamForm')->middleware('auth');;
Route::post('/ssc-2024/admission',[sscExamBatchAdmController::class,'storeAdmSSCExamBatch'])->name('storeAdmSSCExamBatch')->middleware('auth');;


// dynamic exam paper set
Route::get('/admin/exam-paper-add-mcq/{statusReset}',[dynamicMcqExamPapersAdd::class,'getPreXmPapers'])->name('addDynamicMcqQuestionGet'); // no auth
Route::get('/admin/exam-paper-set-find',[dynamicMcqExamPapersAdd::class,'findMcqExamQuesSet'])->name('findMcqExamQuesSet'); // no auth
Route::post('/admin/upload-xm-papers',[dynamicMcqExamPapersAdd::class,'uploadExamPapers'])->name('uploadExamPapers'); // no auth
Route::get('/admin/upload-xm-papers/delete/{id}',[dynamicMcqExamPapersAdd::class,'deleteMcqExam'])->name('deleteMcqExam'); // no auth

// premium exampanel view
Route::get('/premium/exam-panel/{className}',[managePremiumExams::class,'PremiumExamPanelView'])->name('PremiumExamPanelView'); // no auth


// get current premium exam data
Route::post('/premium/fetch/premium-exam-data',[managePremiumExams::class,'getPremiumExamData']); // no auth
Route::get('/premium/fetch/premium-exam-result',[managePremiumExams::class,'seePremExamResult'])->name('seePremExamResult'); // no auth
// custom premium exam participate
Route::get('/premium/fetch/custom-prem-exam/{className}/{subjectName}/{chapterName}/{set}',[managePremiumExams::class,'customExamParticipate'])->name('customExamParticipate'); // no auth

// leader board routes
Route::get('/leaderboard',[leaderBoardController::class,'getLeaderBoardData'])->name('getLeaderBoardData'); // no auth

// generate pdf
Route::get('/generate-pdf', [pdfController::class,'freeExam'])->name('freeExam')->middleware('auth');
Route::get('/generate-pdf/{subject}/{chapter}/{set}', [pdfController::class,'premiumExam'])->name('premiumExam')->middleware('auth');

// course outLine
Route::get('/course-outline', [courseOutLineController::class,'showCourseOutline'])->name('showCourseOutline');

// about us page
Route::get('/about-us', [aboutUsController::class,'showAboutUsPage'])->name('showAboutUsPage');

// show question in front end
Route::get('/premium/board-question/{book}', [showQuestionFrontendPrmController::class,'showBoardQuestion'])->name('showBoardQuestion');

Route::get('/premium/fetch-board-question/{book}/{year}', [showQuestionFrontendPrmController::class,'fetchshowBoardQuestion']);

// upload a law
Route::get('/admin/upload-law/{status}', [lawController::class,'getLaw'])->name('getLaw');
Route::post('/admin/upload-law', [lawController::class,'uploadLaw'])->name('uploadLaw');
Route::get('/admin/update-law/{id}', [lawController::class,'getUpdateLaw'])->name('getUpdateLaw');
Route::get('/admin/delete-law/{id}', [lawController::class,'lawDelete'])->name('lawDelete');

// show law for user
Route::get('/premium/law/{subject}/{chapter}', [lawController::class,'shoqLawforUser'])->name('shoqLawforUser');
Route::get('/premium/fetch-law-data-json/{bookName}/{chapter}', [lawController::class,'fetchLawdatajson']);

// each chapter manage from admin
Route::get('/admin/upload-ques-type/{status}', [questionTypeController::class,'uploadQuestionTypeGet'])->name('uploadQuestionTypeGet');
// store category data in database
<<<<<<< HEAD
Route::post('/admin/store-cat', [questionTypeController::class,'storeCat'])->name('storeCat');
Route::get('/admin/delete-type/{id}', [questionTypeController::class,'deleteType'])->name('deleteType');
Route::get('/admin/kaj-onusiloni/{status}', [questionTypeController::class,'kajOonusiloni'])->name('kajOonusiloni');
=======
Route::post('/admin/store-cat', [QuestionTypeController::class,'storeCat'])->name('storeCat');
Route::get('/admin/delete-type/{id}', [QuestionTypeController::class,'deleteType'])->name('deleteType');
Route::get('/admin/kaj-onusiloni/{status}', [QuestionTypeController::class,'kajOonusiloni'])->name('kajOonusiloni');
<<<<<<< HEAD
=======
>>>>>>> a961923fba524b0f528acdd380c5a6bcc36976ad
>>>>>>> 3413b77633e9acdf11526e1aaa6ff9ba301ebee0

