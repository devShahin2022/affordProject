<?php

namespace App\Http\Controllers;

use App\Models\addMcq;
use Barryvdh\DomPDF\Facade\pdf;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    public function freeExam(){
        $freeExamQuestion = addMcq::where('departmentName','বিজ্ঞান বিভাগ')->
        where('subjectName','পদার্থবিজ্ঞান')->
        where('chapterName','বল')->
        where('questionCat','বাই অ্যাফোর্ড প্রশ্ন')->
        where('question_set','1')->get();

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
    }
}
