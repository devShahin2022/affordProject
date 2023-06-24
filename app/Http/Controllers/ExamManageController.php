<?php

namespace App\Http\Controllers;

use App\Models\AddMcq;
use App\Models\ManageExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamManageController extends Controller
{
    public function showFreeExam(){
    // ---------------------- Hard coded data for free exam ----------//
        // default exam question find ... is exist or not //
    // ---------------------- Hard coded data for free exam ----------//
        $username = Auth::user()->username;
        $res = ManageExam::where('username',$username)->
            where("departmentName","বিজ্ঞান বিভাগ")->
            where("subjectName","পদার্থবিজ্ঞান")->
            where("chapterName","বল")->
            where("questionCat","বাই অ্যাফোর্ড প্রশ্ন")->
            where("set","1")->get()->first();

            // all data
            $allData = ManageExam::where("departmentName","বিজ্ঞান বিভাগ")->
            where("subjectName","পদার্থবিজ্ঞান")->
            where("chapterName","বল")->
            where("questionCat","বাই অ্যাফোর্ড প্রশ্ন")->
            where("set","1")->latest()->get();

            // get exam data
            $examData = $this->FreeExamQuestionFetch();
            return view("FreeExam.FreeExam",['examData'=> $res,'allExaminer'=>$allData,'examPaper'=>json_decode($examData)]);

    }


// its for api call
    public function FreeExamQuestionFetch(){
        $freeExamQuestion = AddMcq::where('departmentName','বিজ্ঞান বিভাগ')->
            where('subjectName','পদার্থবিজ্ঞান')->
            where('chapterName','বল')->
            where('questionCat','বাই অ্যাফোর্ড প্রশ্ন')->
            where('question_set','1')->get();
            return json_encode($freeExamQuestion);
    }
// user click start exam btn 
//     public function userClickExamBtn(Request $request){
//         $examStartTime = $request->input('examStartTime');
//         $examPaperData = $request->input('examPaperData');

//         $username = Auth::user()->username;
//         $storeData = new ManageExam();
//         $storeData->username = $username;
//         $storeData->departmentName = $examPaperData[0]['departmentName'];
//         $storeData->subjectName = $examPaperData[0]['subjectName'];
//         $storeData->chapterName = $examPaperData[0]['chapterName'];
//         $storeData->questionCat = $examPaperData[0]['questionCat'];
//         $storeData->set = $examPaperData[0]['question_set'];
//         $storeData->isStartExam =$examStartTime;
//         $storeData->save();
//         return response()->json(['message' =>"user click success and store user clicked data in database"]);



// }

    // store exam data from front end api call
    public function getUserAnswer(Request $request){
        $answers = $request->input('answer');
        $examStartTime = $request->input('examStartTime');
        $examEndTime = $request->input('examEndTime');
        $examPaperData = $request->input('examPaperData');
        $correctAnswer = $request->input('correctAnswer');
        $wrongAnswer = $request->input('wrongAnswer');
        $untouch = $request->input('untouch');

        // default exam question find ... is exist or not
        $username = Auth::user()->username;
        $res = ManageExam::where('username',$username)->
        where("departmentName",$examPaperData[0]['departmentName'])->
        where("subjectName",$examPaperData[0]['subjectName'])->
        where("chapterName",$examPaperData[0]['chapterName'])->
        where("questionCat",$examPaperData[0]['questionCat'])->
        where("set",$examPaperData[0]['question_set'])->first();

        $feedback = 'আপনার পরীক্ষা খারাপ হয়েছে । আপনাকে আরো ভালোভাবে পড়াশোনা করতে হবে।';
        
        $percent = ($correctAnswer/sizeof($examPaperData))*100;
        if($percent >= 90 && $percent <=100){
            $feedback = 'অভিনন্দন! আপনি চমৎকার ফলাফল করেছেন ';
        }
        if($percent >= 80 && $percent < 90){
            $feedback = 'আপনি ভালো পরীক্ষা দিয়েছেন';
        }
        if($percent >= 50 && $percent <80){
            $feedback = 'আপনার পরীক্ষা মোটামুটি হয়েছে । আরো উন্নিতি করতে হবে ';
        }

        if($res == null){
            $storeData = new ManageExam();
            $storeData->username = $username;
            $storeData->departmentName = $examPaperData[0]['departmentName'];
            $storeData->subjectName = $examPaperData[0]['subjectName'];
            $storeData->chapterName = $examPaperData[0]['chapterName'];
            $storeData->questionCat = $examPaperData[0]['questionCat'];
            $storeData->set = $examPaperData[0]['question_set'];
            $storeData->isStartExam =$examStartTime;
            $storeData->isEndExam = $examEndTime;
            $storeData->yourAnswers = json_encode($answers);
            $storeData->totalQuestion = sizeof($examPaperData);
            $storeData->wrongAnswer =$wrongAnswer;
            $storeData->correctAnswer = $correctAnswer;
            $storeData->untouch =$untouch;
            $storeData->affordMsg =$feedback;
            $storeData->status = 1;
            $storeData->save();
            return response()->json(['message' =>"success data insert"]);
        }
        else{
            $res->isEndExam = $examEndTime;
            $res->yourAnswers = json_encode($answers);
            $res->totalQuestion = sizeof($examPaperData);
            $res->wrongAnswer =$wrongAnswer;
            $res->correctAnswer = $correctAnswer;
            $res->untouch =$untouch;
            $res->affordMsg =$feedback;
            $res->save();
            return response()->json(['message' =>"success data insert"]);
        }
    }

    // show free exam result
    public function seeFreeExamResult(){
    // ---------------------- Hard coded data for free exam ----------//
    // default exam question find ... is exist or not //
    // ---------------------- Hard coded data for free exam ----------//
    $username = Auth::user()->username;
    $res = ManageExam::where('username',$username)->
        where("departmentName","বিজ্ঞান বিভাগ")->
        where("subjectName","পদার্থবিজ্ঞান")->
        where("chapterName","বল")->
        where("questionCat","বাই অ্যাফোর্ড প্রশ্ন")->
        where("set","1")->get()->first();
        
        $res->isclickedSeeResult = 1;
        $res->save();
    // all data
    $allData = ManageExam::where("departmentName","বিজ্ঞান বিভাগ")->
    where("subjectName","পদার্থবিজ্ঞান")->
    where("chapterName","বল")->
    where("questionCat","বাই অ্যাফোর্ড প্রশ্ন")->
    where("set","1")->latest()->get();

    // get exam data
    $examData = $this->FreeExamQuestionFetch();

        return view("FreeExam.FreeExam",['examData'=> $res,'allExaminer'=>$allData, 'examPaper'=>json_decode($examData)]);
        
    }
}