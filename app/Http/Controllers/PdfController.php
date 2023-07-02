<?php

namespace App\Http\Controllers;

use App\Models\AddMcq;
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

        // $pdf =  Pdf::loadview("ExportMcqPdf.exportMcq",["freeExamQuestion" => $freeExamQuestion]);
        // $fileName = 'freeExam.pdf';
        // return $pdf->download($fileName);
        
        return view("ExportMcqPdf.exportMcq",["freeExamQuestion" => $freeExamQuestion]);
    }
    // free exam question
}
