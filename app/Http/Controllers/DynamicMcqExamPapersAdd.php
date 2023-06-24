<?php

namespace App\Http\Controllers;

use App\Models\AddMcq;
use App\Models\PremiumExamPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DynamicMcqExamPapersAdd extends Controller
{
    // find current exam all department
    public function findCurrentXmAllDepart(){
        $allActiveExams = PremiumExamPaper::where('isCurrent',1)->get();
        $dataArr = array();
        if(sizeof($allActiveExams)>0){
            $class_9_sci = array();
            $class_9_human = array();
            $class_10_sci = array();
            $class_10_human = array();
            $class_appli_sci = array();
            $class_appli_human = array();

            for($i=0; $i<sizeof($allActiveExams); $i++){
                if($allActiveExams[$i]->departmentName == "বিজ্ঞান বিভাগ" && $allActiveExams[$i]->targetClass == "নবম শ্রেণী"){
                    $class_9_sci = $allActiveExams[$i];
                }else if($allActiveExams[$i]->departmentName == "মানবিক বিভাগ" && $allActiveExams[$i]->targetClass == "নবম শ্রেণী"){
                    $class_9_human = $allActiveExams[$i];
                }else if($allActiveExams[$i]->departmentName == "বিজ্ঞান বিভাগ" && $allActiveExams[$i]->targetClass == "দশম শ্রেণী"){
                    $class_10_sci = $allActiveExams[$i];
                }else if($allActiveExams[$i]->departmentName == "মানবিক বিভাগ" && $allActiveExams[$i]->targetClass == "দশম শ্রেণী"){
                    $class_10_human = $allActiveExams[$i];
                }else if($allActiveExams[$i]->departmentName == "বিজ্ঞান বিভাগ" && $allActiveExams[$i]->targetClass == "পরীক্ষার্থী"){
                    $class_appli_sci = $allActiveExams[$i];
                }else if($allActiveExams[$i]->departmentName == "মানবিক বিভাগ" && $allActiveExams[$i]->targetClass == "পরীক্ষার্থী"){
                    $class_appli_human = $allActiveExams[$i];
                }
            }
            array_push($dataArr,$class_9_sci,$class_9_human,$class_10_sci, $class_10_human,$class_appli_sci,$class_appli_human);
        }
        // dd($dataArr);
        return $dataArr;
    }

    // dynamically show latest exam set
    public function getPreXmPapers($statusReset){
        $lastUploadedMcq = NULL; // handle reset form
        $isBeforePublishedXm = array();
        if($statusReset == 1){ // 1 means reset form
            return view("SiteGeneralContent.GetPremiumXmPapers.getPremiumMcqXmPapers",['currentData'=>$lastUploadedMcq,'totalSet'=>0,
            'isBeforePub'=>$isBeforePublishedXm,
            'activeExams'=>$this->findCurrentXmAllDepart()
        
        ]);
        }
        $lastAddedData = AddMcq::where('uploaded_by',Auth::user()->username)->
        where('isXmQuestion',1)->latest()->get();



        if(sizeof($lastAddedData)>0){
            $lastUploadedMcq = AddMcq::where('uploaded_by',Auth::user()->username)->
            where('departmentName',$lastAddedData[0]->departmentName)->
            where('subjectName',$lastAddedData[0]->subjectName)->
            where('chapterName',$lastAddedData[0]->chapterName)->
            where('questionCat',$lastAddedData[0]->questionCat)->get();


            // find is before published this question is or not
            $isBeforePublishedXm = PremiumExamPaper::where('departmentName',$lastAddedData[0]->departmentName)->
            where('subjectName',$lastAddedData[0]->subjectName)->where('chapterName',$lastAddedData[0]->chapterName)->latest()->get();


            $numerOfSet = 1;
            if(sizeof($lastUploadedMcq) > 0){
                for ($i=0; $i < sizeof($lastUploadedMcq); $i++) { 
                    if($numerOfSet < $lastUploadedMcq[$i]->question_set ){
                        $numerOfSet++;
                    }
                }
            }
            return view("SiteGeneralContent.GetPremiumXmPapers.getPremiumMcqXmPapers",['currentData'=>$lastUploadedMcq,'totalSet'=>$numerOfSet,
            'isBeforePub'=>$isBeforePublishedXm,'activeExams'=>$this->findCurrentXmAllDepart()]);
        }


        if(sizeof($lastAddedData)==0){
            return view("SiteGeneralContent.GetPremiumXmPapers.getPremiumMcqXmPapers",['currentData'=>$lastUploadedMcq,'totalSet'=>0,
            'isBeforePub'=>$isBeforePublishedXm,'activeExams'=>$this->findCurrentXmAllDepart()]);
        }
    }
    // find exams papers
        // find xm mcq
    public function findMcqExamQuesSet(Request $request){
        // dd("hellp");
        $validated = $request->validate([
            'departmentName' => 'required',
            'subjectName' => 'required',
            'chapterName' => 'required',
        ]);

        $findData = AddMcq::where('departmentName',$request->departmentName)->
        where('subjectName',$request->subjectName)->
        where('chapterName',$request->chapterName)->latest()->get();

        // total set
        $numerOfSet = 1;
        if(sizeof($findData) > 0){
            for ($i=0; $i < sizeof($findData); $i++) { 
                if($numerOfSet < $findData[$i]->question_set ){
                    $numerOfSet++;
                }
            }
        }
            // find is before published this question is or not
            $isBeforePublishedXm = PremiumExamPaper::where('departmentName',$request->departmentName)->
                where('subjectName',$request->subjectName)->where('chapterName',$request->chapterName)->latest()->get();



        // dd($numerOfSet);
        return view('SiteGeneralContent.GetPremiumXmPapers.getPremiumMcqXmPapers',['currentData'=>$findData,'totalSet'=>$numerOfSet,
        'isBeforePub'=>$isBeforePublishedXm,'activeExams'=>$this->findCurrentXmAllDepart()]);
    }

    //  upload exam papers
    public function uploadExamPapers(Request $request){
        $validated = $request->validate([
            'targetClass' => 'required',
            'whichSection' => 'required',
            'examDeadLine' => 'required',
            'examTitle' => 'required',
        ]);

        if( $request->targetClass ==0 ||  $request->whichSection ==0 || $request->examDeadLine ==0 ){
            return back()->with("fail","please select every field");
        }

        $departmentName = $request->departmentName;
        $subjectName = $request->subjectName;
        $chapterName = $request->chapterName;
        $question_set = $request->question_set;
        $targetClass = $request->targetClass;
        $whichSection = $request->whichSection;
        $deadLine = $request->examDeadLine;

        // manage dead line
        $currentMilliseconds = round(microtime(true));
        $endTime = 86400000 * json_decode($deadLine) + $currentMilliseconds;
        // dd($endTime);
        // store data
        $examPapers = new PremiumExamPaper();
        $examPapers->ExamTitle =  $request->examTitle;
        $examPapers->departmentName =  $departmentName;
        $examPapers->subjectName =  $subjectName;
        $examPapers->chapterName =  $chapterName;
        $examPapers->question_set = $question_set;
        $examPapers->startDate = $currentMilliseconds;
        $examPapers->endingDate =  $endTime;
        $examPapers->targetClass =  $targetClass;
        $examPapers->whichSection =  $whichSection; 
        $examPapers->deadLine =  $request->examDeadLine;
        $examPapers->isCurrent = 1; // current it
        // set previous question iscurrent of

        $prevPapers = PremiumExamPaper::where('departmentName',$departmentName)->
                where('targetClass',$targetClass)->where('isCurrent',1)->where('whichSection',$whichSection)->latest()->first();

        if($prevPapers !=null){
            $prevPapers->isCurrent = 0;
            $prevPapers->isAlreadyPublished = 1;
            $prevPapers->save();
        }
        
        if($examPapers->save()){
            return back()->with("success","Exam paper uploaded success");
        }else{
            return back()->with("fail","something went wrong!");
        }
    }

    // delete exam paper
    public function deleteMcqExam($id){
        $findExam = PremiumExamPaper::where('id',$id)->first();
        if($findExam->delete()){
            return back()->with("success","exam delete success");
        }else{
            return back()->with("fail","something went wrong!");
        }
    }

}