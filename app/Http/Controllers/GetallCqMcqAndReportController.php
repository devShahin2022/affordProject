<?php

namespace App\Http\Controllers;

use App\Models\AddCq;
use App\Models\AddMcq;
use Illuminate\Http\Request;

class GetallCqMcqAndReportController extends Controller
{
    public function getAllMcq(){
        $allMcqs = AddMcq::all();
        return view("SiteGeneralContent.GetAllMcq.getAllMcq",['currentData'=>$allMcqs]);
    }
    public function getAllCq(){
        $allcqs = AddCq::all();
        return view("SiteGeneralContent.GetAllCq.GetAllCq",['currentData'=>$allcqs]);
    }
    // get reporte mcq question
    public function repotedMcq(){
        $allCqs = AddCq::where('isReport',1)->latest()->get();
        $allMcqs = AddMcq::where('isReport',1)->latest()->get();
        return view("SiteGeneralContent.Reported.Reporteduestion",["reportedMcq"=>$allMcqs,"reportedCq"=>$allCqs]);
    }
}
