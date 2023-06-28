<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function freeExam(){
        $pdf =  Pdf::loadview("ExportMcqPdf.exportMcq");

        $fileName = 'freeExam.pdf';
        return $pdf->download($fileName);
    }
}
