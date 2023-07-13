<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AddCqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseOutLineController;
use App\Http\Controllers\DynamicMcqExamPapersAdd;
use App\Http\Controllers\ExamManageController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\GetallCqMcqAndReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LawController;
use App\Http\Controllers\LeaderBoardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MakeQuestionController;
use App\Http\Controllers\ManagePremiumExams;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionTypeController;
use App\Http\Controllers\Register;
use App\Http\Controllers\ShowQuestionFrontendPrmController;
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
Route::get('/profile/faqs',[FaqsController::class,'showFaqs'])->name('showFaqs');
// free exam management
Route::get('/profile/free-exam',[ExamManageController::class,'showFreeExam'])->name('showFreeExam')->middleware('auth');
Route::get('/profile/free-exam-question-fetch',[ExamManageController::class,'FreeExamQuestionFetch'])->middleware('auth');
Route::post('/profile/free-exam-data-store',[ExamManageController::class,'getUserAnswer'])->middleware('auth'); //call by api js
Route::post('/profile/ensure-user-click-start-exam',[ExamManageController::class,'userClickExamBtn'])->middleware('auth'); //call by api js
Route::get('/profile/see-exam-result',[ExamManageController::class,'seeFreeExamResult'])->name('seeFreeExamResult')->middleware('auth'); //see exam result




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
Route::get('/admin/site-general-content/add-board-mcq/{statusReset}',[siteQuestionController::class,'addBoardMcqView'])->name('addBoardMcqView');
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
Route::post('/admin/site-general-content/a_d',[AddCqController::class,'activeOrDeactive'])->name('activeOrDeactive');
Route::post('/admin/site-general-content/cq-delete',[AddCqController::class,'deleteCq'])->name('deleteCq');
Route::get('/admin/site-general-content/cq-view/{serial}/{id}',[AddCqController::class,'viewSingleCq'])->name('viewSingleCq');
Route::get('/admin/site-general-content/cq-view/update/{serial}/{id}',[AddCqController::class,'viewSingleCqUpdate'])->name('viewSingleCqUpdate');
Route::post('/admin/site-general-content/cq-view/update/',[AddCqController::class,'updateCq'])->name('updateCq');

// create xm cq question
Route::get('/admin/site-general-content/xm-cq-q/{statusReset}',[AddCqController::class,'cqExamQuestionView'])->name('cqExamQuestionView');
Route::post('/admin/site-general-content/xm-cq-q/store',[AddCqController::class,'storeExamQuestion'])->name('storeExamQuestion');
Route::get('/admin/site-general-content/xm-cq-find',[AddCqController::class,'findXmCqQues'])->name('findXmCqQues');
Route::get('/admin/site-general-content/xm-cq-search',[AddCqController::class,'findXmCQSearch'])->name('findXmCQSearch');






// route for make exam question mcq admin panel
Route::get('/admin/site-general-content/mcq/make-xm-mcq/{statusReset}',[MakeQuestionController::class,'showMakeMcqQuesXm'])->name('showMakeMcqQuesXm');
Route::post('/admin/site-general-content/mcq-xm-store',[MakeQuestionController::class,'storeMcq'])->name('storeMakeXmMcq');
Route::get('/admin/site-general-content/find',[MakeQuestionController::class,'findXmMcqByOptions'])->name('findXmMcqByOptions');
Route::get('/admin/site-general-content/search',[MakeQuestionController::class,'serachMcqXm'])->name('serachMcqXm');

// get all mcq
Route::get('/admin/site-general-content/all-mcq',[GetallCqMcqAndReportController::class,'getAllMcq'])->name('getAllMcq');
Route::get('/admin/site-general-content/all-cq',[GetallCqMcqAndReportController::class,'getAllCq'])->name('getAllCq');
Route::get('/admin/site-general-content/reorted-mcq',[GetallCqMcqAndReportController::class,'repotedMcq'])->name('repotedMcq');


// front site section
Route::get('/contact',[ContactController::class,'showContact'])->name('showContact'); // no auth
Route::post('/contact',[ContactController::class,'sendContact'])->name('sendContact'); // no auth
Route::get('/admin/contact',[ContactController::class,'getAdminContacts'])->name('getAdminContacts'); // no auth
Route::post('/admin/app-contact',[ContactController::class,'approvedContact'])->name('approvedContact'); // no auth

// ssc exam form addmission
Route::get('/ssc-2024/admission',[sscExamBatchAdmController::class,'getSscExamForm'])->name('getSscExamForm')->middleware('auth');;
Route::post('/ssc-2024/admission',[sscExamBatchAdmController::class,'storeAdmSSCExamBatch'])->name('storeAdmSSCExamBatch')->middleware('auth');;


// dynamic exam paper set
Route::get('/admin/exam-paper-add-mcq/{statusReset}',[DynamicMcqExamPapersAdd::class,'getPreXmPapers'])->name('addDynamicMcqQuestionGet'); // no auth
Route::get('/admin/exam-paper-set-find',[DynamicMcqExamPapersAdd::class,'findMcqExamQuesSet'])->name('findMcqExamQuesSet'); // no auth
Route::post('/admin/upload-xm-papers',[DynamicMcqExamPapersAdd::class,'uploadExamPapers'])->name('uploadExamPapers'); // no auth
Route::get('/admin/upload-xm-papers/delete/{id}',[DynamicMcqExamPapersAdd::class,'deleteMcqExam'])->name('deleteMcqExam'); // no auth

// premium exampanel view
Route::get('/premium/exam-panel/{className}',[ManagePremiumExams::class,'PremiumExamPanelView'])->name('PremiumExamPanelView'); // no auth


// get current premium exam data
Route::post('/premium/fetch/premium-exam-data',[ManagePremiumExams::class,'getPremiumExamData']); // no auth
Route::get('/premium/fetch/premium-exam-result',[ManagePremiumExams::class,'seePremExamResult'])->name('seePremExamResult'); // no auth
// custom premium exam participate
Route::get('/premium/fetch/custom-prem-exam/{className}/{subjectName}/{chapterName}/{set}',[ManagePremiumExams::class,'customExamParticipate'])->name('customExamParticipate'); // no auth

// leader board routes
Route::get('/leaderboard',[LeaderBoardController::class,'getLeaderBoardData'])->name('getLeaderBoardData'); // no auth

// generate pdf
Route::get('/generate-pdf', [PdfController::class,'freeExam'])->name('freeExam')->middleware('auth');
Route::get('/generate-pdf/{subject}/{chapter}/{set}', [PdfController::class,'premiumExam'])->name('premiumExam')->middleware('auth');

// course outLine
Route::get('/course-outline', [CourseOutLineController::class,'showCourseOutline'])->name('showCourseOutline');

// about us page
Route::get('/about-us', [AboutUsController::class,'showAboutUsPage'])->name('showAboutUsPage');

// show question in front end
Route::get('/premium/board-question/{book}', [ShowQuestionFrontendPrmController::class,'showBoardQuestion'])->name('showBoardQuestion');

Route::get('/premium/fetch-board-question/{book}/{year}', [ShowQuestionFrontendPrmController::class,'fetchshowBoardQuestion']);

// upload a law
Route::get('/admin/upload-law/{status}', [LawController::class,'getLaw'])->name('getLaw');
Route::post('/admin/upload-law', [LawController::class,'uploadLaw'])->name('uploadLaw');
Route::get('/admin/update-law/{id}', [LawController::class,'getUpdateLaw'])->name('getUpdateLaw');
Route::get('/admin/delete-law/{id}', [LawController::class,'lawDelete'])->name('lawDelete');

// show law for user
Route::get('/premium/law/{subject}/{chapter}', [LawController::class,'shoqLawforUser'])->name('shoqLawforUser');
Route::get('/premium/fetch-law-data-json/{bookName}/{chapter}', [LawController::class,'fetchLawdatajson']);

// each chapter manage from admin
Route::get('/admin/upload-ques-type/{status}', [QuestionTypeController::class,'uploadQuestionTypeGet'])->name('uploadQuestionTypeGet');
// store category data in database
Route::post('/admin/store-cat', [QuestionTypeController::class,'storeCat'])->name('storeCat');
Route::get('/admin/delete-type/{id}', [QuestionTypeController::class,'deleteType'])->name('deleteType');
