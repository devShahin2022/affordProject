<?php

namespace App\Http\Controllers;

use App\Models\addCq;
use App\Models\addMcq;
use Illuminate\Http\Request;

class getallCqMcqAndReportController extends Controller
{
    public function getAllMcq(){
        $allMcqs = addMcq::all();
        return view("siteGeneralContent.getAllMcq.getAllMcq",['currentData'=>$allMcqs]);
    }
    public function getAllCq(){
        $allcqs = addCq::all();
        return view("siteGeneralContent.getAllCq.getAllCq",['currentData'=>$allcqs]);
    }
    // get reporte mcq question
    public function repotedMcq(){
        $allCqs = addCq::where('isReport',1)->latest()->get();
        $allMcqs = addMcq::where('isReport',1)->latest()->get();
        return view("siteGeneralContent.reported.reporteduestion",["reportedMcq"=>$allMcqs,"reportedCq"=>$allCqs]);
    }
}
