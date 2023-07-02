<?php

namespace App\Http\Controllers;

use App\Models\AddCq;
use App\Models\AddMcq;
use Illuminate\Http\Request;

class ShowQuestionFrontendPrmController extends Controller
{
    public function showBoardQuestion($book){
        // =======================================================================
        // ----------------- default dinajpur board 2022 return data --------------
        // ========================================================================
        $mcqs = AddMcq::where("subjectName",$book)->
            where("questionCat","বোর্ড প্রশ্ন")->
            where("boardOrSchoolName","দিনাজপুর বোর্ড")->
            where("year","২০২২")->get();

        $cqs = AddCq::where("subjectName",$book)->
            where("questionCat","বোর্ড প্রশ্ন")->
            where("boardOrSchoolName","দিনাজপুর বোর্ড")->
            where("year","২০২২")->get();
            // dd($mcqs);
        return view("ShowBoardQuestion.showBoardQuestion",["book"=>$book,'mcq'=>$mcqs,'cq'=>$cqs]);
    }

    public function fetchshowBoardQuestion($book,$year){
        $mcqs = AddMcq::where("subjectName",$book)->
            where("questionCat","বোর্ড প্রশ্ন")->
            where("year",$year)->get();

        $cqs = AddCq::where("subjectName",$book)->
        where("questionCat","বোর্ড প্রশ্ন")->
        where("year",$year)->get();
        $allData = [$mcqs, $cqs];
        return json_encode($allData);
    }
}
