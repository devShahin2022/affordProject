<?php

namespace App\Http\Controllers;

use App\Models\AddMcq;
use App\Models\ManageExam;
use App\Models\PremiumExamPaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagePremiumExams extends Controller
{
       
    public function PremiumExamPanelView($className){
        $premiumXMquestion = PremiumExamPaper::where('departmentName',Auth::user()->departmentName)->
        where('isCurrent',1)->where('targetClass',$className)->where('whichSection',"কোচিং")->first();
        $username = Auth::user()->username;
        

        // dd($prevQuestions);
        // find the questions papers
        $questionPaper = array();
        $res = array();
        $isAlreadyExist = array();
        $prevQuestions = array();
        $allData = null;
        if($premiumXMquestion != null){


            $prevQuestions = PremiumExamPaper::where('departmentName',Auth::user()->departmentName)->
            where('isCurrent',0)->
            where('targetClass',$className)->
            where('subjectName',$premiumXMquestion->subjectName)->
            where('whichSection',"কোচিং")->get();


            // findout user already prticipate or not
            if($prevQuestions !=null){
                $allParticipator = ManageExam::where('username',$username)->
                where("departmentName",$premiumXMquestion->departmentName)->
                where("subjectName",$premiumXMquestion->subjectName)->
                where("chapterName",$premiumXMquestion->chapterName)->get();
    
                for($i=0; $i<sizeof($prevQuestions);$i++){
                    $data = ManageExam::where('username',$username)->
                    where("departmentName",$prevQuestions[$i]->departmentName)->
                    where("subjectName",$prevQuestions[$i]->subjectName)->
                    where("chapterName",$prevQuestions[$i]->chapterName)->
                    where("set",$prevQuestions[$i]->question_set)->first();
                    if($data !=null){
                        array_push($isAlreadyExist,$data);
                    }else{
                        array_push($isAlreadyExist,false);
                    }
                }
                // dd($isAlreadyExist);
            }

            $questionPaper = AddMcq::where("departmentName",$premiumXMquestion->departmentName)->
            where("subjectName", $premiumXMquestion->subjectName)->
            where("chapterName", $premiumXMquestion->chapterName)->
            where("question_set", $premiumXMquestion->question_set)->get();

            // all participator data
            $allData = ManageExam::where("departmentName",$premiumXMquestion->departmentName)->
            where("subjectName",$premiumXMquestion->subjectName)->
            where("chapterName",$premiumXMquestion->chapterName)->
            where("set",$premiumXMquestion->question_set)->latest()->get();

            $res = ManageExam::where('username',$username)->
                where("departmentName",$premiumXMquestion->departmentName)->
                where("subjectName",$premiumXMquestion->subjectName)->
                where("chapterName",$premiumXMquestion->chapterName)->
                where("set",$premiumXMquestion->question_set)->get()->first();

            // dd( $res );

        }

        return view("PremiumAccount.premXmView",[
            'examData'=> $res,
            "examPaper"=>$questionPaper,
            'currentExamSet'=>$premiumXMquestion,
            'allExaminer'=> $allData,
            'isAlreadyExam'=>$isAlreadyExist,
            'prevExamSet' => $prevQuestions
        ]);
    }

    // participate custom premium exam
    public function customExamParticipate($className, $subject, $chapter, $set){
        $premiumXMquestion = PremiumExamPaper::where('departmentName',Auth::user()->departmentName)->
        where('subjectName',$subject)->
        where('targetClass',$className)->
        where('whichSection',"কোচিং")->
        where('question_set',$set)->
        where('chapterName',$chapter)->first();

        // dd($premiumXMquestion);

        $username = Auth::user()->username;
        
        $prevQuestions = PremiumExamPaper::where('departmentName',Auth::user()->departmentName)->
        where('isCurrent',0)->
        where('targetClass',$className)->
        where('subjectName',$premiumXMquestion->subjectName)->
        where('whichSection',"কোচিং")->get();

        $isAlreadyExist = array();
        // findout user already prticipate or not
        if($prevQuestions !=null){
            $allParticipator = ManageExam::where('username',$username)->
            where("departmentName",$premiumXMquestion->departmentName)->
            where("subjectName",$premiumXMquestion->subjectName)->
            where("chapterName",$premiumXMquestion->chapterName)->get();

            for($i=0; $i<sizeof($prevQuestions);$i++){
                $data = ManageExam::where('username',$username)->
                where("departmentName",$prevQuestions[$i]->departmentName)->
                where("subjectName",$prevQuestions[$i]->subjectName)->
                where("chapterName",$prevQuestions[$i]->chapterName)->
                where("set",$prevQuestions[$i]->question_set)->first();
                if($data !=null){
                    array_push($isAlreadyExist,$data);
                }else{
                    array_push($isAlreadyExist,false);
                }
            }
            // dd($isAlreadyExist);
        }


        // dd($prevQuestions);
        // find the questions papers
        $questionPaper = array();
        $res = array();
        $allData = null;
        if($premiumXMquestion != null){
            $questionPaper = AddMcq::where("departmentName",$premiumXMquestion->departmentName)->
            where("subjectName", $premiumXMquestion->subjectName)->
            where("chapterName", $premiumXMquestion->chapterName)->
            where("question_set", $premiumXMquestion->question_set)->get();

            // all participator data
            $allData = ManageExam::where("departmentName",$premiumXMquestion->departmentName)->
            where("subjectName",$premiumXMquestion->subjectName)->
            where("chapterName",$premiumXMquestion->chapterName)->
            where("set",$premiumXMquestion->question_set)->latest()->get();

            $res = ManageExam::where('username',$username)->
                where("departmentName",$premiumXMquestion->departmentName)->
                where("subjectName",$premiumXMquestion->subjectName)->
                where("chapterName",$premiumXMquestion->chapterName)->
                where("set",$premiumXMquestion->question_set)->get()->first();

            // dd( $res );

        }

        return view("PremiumAccount.premXmView",[
            'examData'=> $res,
            "examPaper"=>$questionPaper,
            'currentExamSet'=>$premiumXMquestion,
            'allExaminer'=> $allData,
            'isAlreadyExam'=>$isAlreadyExist,
            'prevExamSet' => $prevQuestions
        ]);
    }

    public function getPremiumExamData(Request $request){
        $departmentName = $request->input('departmentName');
        $subjectName = $request->input('subjectName');
        $chapterName = $request->input('chapterName');
        $question_set = $request->input('question_set');

        $getPremiumMcqs = AddMcq::where("departmentName",$departmentName)->where("subjectName",$subjectName)
            ->where("chapterName",$chapterName)
            ->where("question_set",$question_set)->get();

        return json_encode($getPremiumMcqs);
    }

    // see exam results
    // show free exam result
    public function seePremExamResult(Request $request){

        // 
        $premiumXMquestion = PremiumExamPaper::where('departmentName',Auth::user()->departmentName)->
        where('isCurrent',1)->where('targetClass',$request->className)->where('whichSection',"কোচিং")->first();


        $username = Auth::user()->username;
        $res = ManageExam::where('username',$username)->
            where("departmentName",$request->departmentName)->
            where("subjectName",$request->subjectName)->
            where("chapterName",$request->chapterName)->
            where("set",$request->question_set)->get()->first();
            $res->isclickedSeeResult = 1;
            $res->save();

        // all data
        $allData = ManageExam::where("departmentName",$request->departmentName)->
        where("subjectName",$request->subjectName)->
        where("chapterName",$request->chapterName)->
        where("set",$request->question_set)->latest()->get();

        // get exam paper data
        $questionPaper = AddMcq::where("departmentName",$request->departmentName)->
        where("subjectName",$request->subjectName)->
        where("chapterName",$request->chapterName)->
        where("question_set",$request->question_set)->get();
        // dd($questionPaper);


        $prevQuestions = PremiumExamPaper::where('departmentName',Auth::user()->departmentName)->
        where('isCurrent',0)->
        where('targetClass',$request->className)->
        where('subjectName',$request->subjectName)->
        where('whichSection',"কোচিং")->get();

        // dd($premiumXMquestion);

        $isAlreadyExist = array();
        if($prevQuestions !=null){
            $allParticipator = ManageExam::where('username',$username)->
            where("departmentName",$premiumXMquestion->departmentName)->
            where("subjectName",$premiumXMquestion->subjectName)->
            where("chapterName",$premiumXMquestion->chapterName)->get();

            for($i=0; $i<sizeof($prevQuestions);$i++){
                $data = ManageExam::where('username',$username)->
                where("departmentName",$prevQuestions[$i]->departmentName)->
                where("subjectName",$prevQuestions[$i]->subjectName)->
                where("chapterName",$prevQuestions[$i]->chapterName)->
                where("set",$prevQuestions[$i]->question_set)->first();
                if($data !=null){
                    array_push($isAlreadyExist,$data);
                }else{
                    array_push($isAlreadyExist,false);
                }
            }
            // dd($isAlreadyExist);
        }

        return view("PremiumAccount.premXmView",[
            'examData'=> $res,
            "examPaper"=>$questionPaper,
            'currentExamSet'=>$premiumXMquestion,
            'allExaminer'=> $allData,
            'isAlreadyExam'=>$isAlreadyExist,
            'prevExamSet' => $prevQuestions
        ]);
    }
}

