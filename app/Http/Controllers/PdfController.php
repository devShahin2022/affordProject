<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\AddMcq;
use App\Models\AddCq;
use Barryvdh\DomPDF\Facade\Pdf;
=======
use App\Models\addMcq;
use Barryvdh\DomPDF\Facade\pdf;
>>>>>>> 3413b77633e9acdf11526e1aaa6ff9ba301ebee0
use Illuminate\Http\Request;

class pdfController extends Controller
{
    public function freeExam(){
        $freeExamQuestion = addMcq::where('departmentName','বিজ্ঞান বিভাগ')->
        where('subjectName','পদার্থবিজ্ঞান')->
        where('chapterName','বল')->
        where('questionCat','বাই অ্যাফোর্ড প্রশ্ন')->
        where('question_set','1')->get();
<<<<<<< HEAD
        
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
=======

        // $pdf =  pdf::loadview("ExportMcqPdf.exportMcq",["freeExamQuestion" => $freeExamQuestion]);
        // $fileName = 'freeExam.pdf';
        // return $pdf->download($fileName);
        
        return view("exportMcqPdf.exportMcq",["freeExamQuestion" => $freeExamQuestion]);
    }
    // free exam question
    public function premiumExam($subject, $chapter, $set){
        $freeExamQuestion = addMcq::where('subjectName',$subject)->
        where('chapterName',$chapter)->
        where('question_set',$set)->get();
        return view("exportMcqPdf.exportMcq",["freeExamQuestion" => $freeExamQuestion]);
>>>>>>> 3413b77633e9acdf11526e1aaa6ff9ba301ebee0
    }
}
