<?php

namespace App\Http\Controllers;

use App\Models\addMcq;
use App\Models\leaderBoard;
use App\Models\manageExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class examManageController extends Controller
{
    public function showFreeExam(){
    // ---------------------- Hard coded data for free exam ----------//
        // default exam question find ... is exist or not //
    // ---------------------- Hard coded data for free exam ----------//
        $username = Auth::user()->username;
        $res = manageExam::where('username',$username)->
            where("departmentName","বিজ্ঞান বিভাগ")->
            where("subjectName","পদার্থবিজ্ঞান")->
            where("chapterName","বল")->
            where("questionCat","বাই অ্যাফোর্ড প্রশ্ন")->
            where("set","1")->get()->first();

            // all data
            $allData = manageExam::where("departmentName","বিজ্ঞান বিভাগ")->
            where("subjectName","পদার্থবিজ্ঞান")->
            where("chapterName","বল")->
            where("questionCat","বাই অ্যাফোর্ড প্রশ্ন")->
            where("isclickedSeeResult",1)->
            where("set","1")->orderBy('correctAnswer', 'desc')->orderBy('timeSpent', 'asc')->limit(100)->get();

            // my position here

            // ensure user hit the end exam btn yes or not
            $ensureExamFinish = manageExam::where('username',$username)->
            where("departmentName","বিজ্ঞান বিভাগ")->
            where("subjectName","পদার্থবিজ্ঞান")->
            where("chapterName","বল")->
            where("questionCat","বাই অ্যাফোর্ড প্রশ্ন")->
            where("isclickedSeeResult",1)->
            where("set","1")->get()->first();

            $position = 0;
            if($ensureExamFinish !=null){
                foreach ($allData as $d) {
                    if($d->username == Auth::user()->username){
                        $position ++;
                        break;
                    }else{
                        $position ++;
                    }
                }
            }

            // get exam data
            $examData = $this->FreeExamQuestionFetch();
            return view("freeExam.freeExam",['examData'=> $res,'allExaminer'=>$allData,'examPaper'=>json_decode($examData),"myPosition"=>$position]);

    }


// its for api call
    public function FreeExamQuestionFetch(){
        $freeExamQuestion = addMcq::where('departmentName','বিজ্ঞান বিভাগ')->
            where('subjectName','পদার্থবিজ্ঞান')->
            where('chapterName','বল')->
            where('questionCat','বাই অ্যাফোর্ড প্রশ্ন')->
            where('question_set','1')->get();
            return json_encode($freeExamQuestion);
    }


    // store exam data from front end api call
    public function getUserAnswer(Request $request){
        $answers = $request->input('answer');
        $examStartTime = $request->input('examStartTime');
        $examEndTime = $request->input('examEndTime');
        $examPaperData = $request->input('examPaperData');
        $correctAnswer = $request->input('correctAnswer');
        $wrongAnswer = $request->input('wrongAnswer');
        $untouch = $request->input('untouch');

        $timeSpent = $examEndTime - $examStartTime;

        // default exam question find ... is exist or not
        $username = Auth::user()->username;
        $res = manageExam::where('username',$username)->
        where("departmentName",$examPaperData[0]['departmentName'])->
        where("subjectName",$examPaperData[0]['subjectName'])->
        where("chapterName",$examPaperData[0]['chapterName'])->
        where("questionCat",$examPaperData[0]['questionCat'])->
        where("set",$examPaperData[0]['question_set'])->first();


        // data insert in leader board table
        // ensure user exists or not in leaderboard table
        $findUser = leaderBoard::where('username',Auth::user()->username)->
                where("year",date('y'))->
                where("month",date('m'))->first();
        if($findUser == null){
            $leaderBoard = new leaderBoard();
            $leaderBoard->year = date('y');
            $leaderBoard->month = date('m');
            $leaderBoard->username = Auth::user()->username;
            $leaderBoard->totalMarks = $correctAnswer;
            $leaderBoard->totalExams = 1;
            $leaderBoard->save();
        }
        if($findUser !=null){
            $findUser->totalMarks +=$correctAnswer;
            $findUser->totalExams +=1;
            $findUser->save();
        }

        $feedback = 'আপনার পরীক্ষা খারাপ হয়েছে । আপনাকে আরো ভালোভাবে পড়াশোনা করতে হবে।';
        $percent = ($correctAnswer/sizeof($examPaperData))*100;
        if($percent >= 90 && $percent <=100){
            $feedback = 'অভিনন্দন! আপনি চমৎকার ফলাফল করেছেন ';
        }
        if($percent >= 80 && $percent < 90){
            $feedback = 'আপনি ভালো পরীক্ষা দিয়েছেন';
        }
        if($percent >= 50 && $percent <80){
            $feedback = 'আপনার পরীক্ষা মোটামুটি ভালো হয়েছে । আরো উন্নিতি করতে হবে ';
        }

        if($res == null){
            $storeData = new manageExam();
            $storeData->username = $username;
            $storeData->departmentName = $examPaperData[0]['departmentName'];
            $storeData->subjectName = $examPaperData[0]['subjectName'];
            $storeData->chapterName = $examPaperData[0]['chapterName'];
            $storeData->questionCat = $examPaperData[0]['questionCat'];
            $storeData->set = $examPaperData[0]['question_set'];
            $storeData->isStartExam =$examStartTime;
            $storeData->isEndExam = $examEndTime;
            $storeData->timeSpent = $timeSpent;
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
            $res->timeSpent = $timeSpent;
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
        $res = manageExam::where('username',$username)->
            where("departmentName","বিজ্ঞান বিভাগ")->
            where("subjectName","পদার্থবিজ্ঞান")->
            where("chapterName","বল")->
            where("questionCat","বাই অ্যাফোর্ড প্রশ্ন")->
            where("set","1")->get()->first();
            
            $res->isclickedSeeResult = 1;
            $res->save();
        // all data
        $allData = manageExam::where("departmentName","বিজ্ঞান বিভাগ")->
        where("subjectName","পদার্থবিজ্ঞান")->
        where("chapterName","বল")->
        where("questionCat","বাই অ্যাফোর্ড প্রশ্ন")->
        where("isclickedSeeResult",1)->
        where("set","1")->orderBy('correctAnswer', 'desc')->orderBy('timeSpent','asc')->limit(100)->get();


        // my position here
        $ensureExamFinish = manageExam::where('username',$username)->
        where("departmentName","বিজ্ঞান বিভাগ")->
        where("subjectName","পদার্থবিজ্ঞান")->
        where("chapterName","বল")->
        where("questionCat","বাই অ্যাফোর্ড প্রশ্ন")->
        where("isclickedSeeResult",1)->
        where("set","1")->get()->first();

        $position = 0;
        if($ensureExamFinish !=null){
            foreach ($allData as $d) {
                if($d->username == Auth::user()->username){
                    $position ++;
                    break;
                }else{
                    $position ++;
                }
            }
        }

        // get exam data
        $examData = $this->FreeExamQuestionFetch();

            return view("freeExam.freeExam",['examData'=> $res,'allExaminer'=>$allData, 'examPaper'=>json_decode($examData),"myPosition"=>$position]);
    }
    public function userClickExamBtn(Request $request){
        $examStartTime = $request->input('examStartTime');


        $storeData = new manageExam();
        $storeData->username =  Auth::user()->username;
        $storeData->departmentName = "বিজ্ঞান বিভাগ";
        $storeData->subjectName = "পদার্থবিজ্ঞান";
        $storeData->chapterName = "বল";
        $storeData->questionCat = "বাই অ্যাফোর্ড প্রশ্ন";
        $storeData->questionCat = "বাই অ্যাফোর্ড প্রশ্ন";
        $storeData->set =1;
        $storeData->isStartExam =$examStartTime;
        if($storeData->save()){
            return json_encode("Start exam success");
        }
    }
}