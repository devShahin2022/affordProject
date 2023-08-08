<?php

namespace App\Http\Controllers;

use App\Models\AddMcq;
use App\Models\AddCq;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function freeExam(){
        $freeExamQuestion = AddMcq::where('departmentName','বিজ্ঞান বিভাগ')->
        where('subjectName','পদার্থবিজ্ঞান')->
        where('chapterName','বল')->
        where('questionCat','বাই অ্যাফোর্ড প্রশ্ন')->
        where('question_set','1')->get();
        
        return view("ExportMcqPdf.exportMcq",["premiumCqQuestion" => array(),"freeExamQuestion" => $freeExamQuestion]);
    }
    // free exam question
    public function premiumExam($subject, $chapter, $set){
        $PrmiumExamQuestion = AddMcq::where('subjectName',$subject)->
        where('chapterName',$chapter)->
        where('question_set',$set)->get();
        $examCq = AddCq::where('subjectName',$subject)->
            where('chapterName',$chapter)->
            where('setNo',$set)->get();
        return view("ExportMcqPdf.exportMcq",["premiumCqQuestion" => $examCq,"freeExamQuestion" => $PrmiumExamQuestion]);
    }
}
