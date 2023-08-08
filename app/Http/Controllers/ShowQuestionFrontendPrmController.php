<?php

namespace App\Http\Controllers;

use App\Models\addCq;
use App\Models\addMcq;
use Illuminate\Http\Request;

class showQuestionFrontendPrmController extends Controller
{
    public function showBoardQuestion($book){
        // =======================================================================
        // ----------------- default dinajpur board 2022 return data --------------
        // ========================================================================
        $mcqs = addMcq::where("subjectName",$book)->
            where("questionCat","বোর্ড প্রশ্ন")->
            where("boardOrSchoolName","দিনাজপুর বোর্ড")->
            where("year","২০২২")->get();

        $cqs = addCq::where("subjectName",$book)->
            where("questionCat","বোর্ড প্রশ্ন")->
            where("boardOrSchoolName","দিনাজপুর বোর্ড")->
            where("year","২০২২")->get();
            // dd($mcqs);
        return view("showBoardQuestion.showBoardQuestion",["book"=>$book,'mcq'=>$mcqs,'cq'=>$cqs]);
    }

    public function fetchshowBoardQuestion($book,$year){
        $mcqs = addMcq::where("subjectName",$book)->
            where("questionCat","বোর্ড প্রশ্ন")->
            where("year",$year)->get();

        $cqs = addCq::where("subjectName",$book)->
        where("questionCat","বোর্ড প্রশ্ন")->
        where("year",$year)->get();
        $allData = [$mcqs, $cqs];
        return json_encode($allData);
    }
}
