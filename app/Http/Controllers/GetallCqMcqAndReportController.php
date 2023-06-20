<?php

namespace App\Http\Controllers;

use App\Models\AddMcq;
use Illuminate\Http\Request;

class GetallCqMcqAndReportController extends Controller
{
    public function getAllMcq(){
        $allMcqs = AddMcq::all();
        return view("SiteGeneralContent.GetAllMcq.getAllMcq",['currentData'=>$allMcqs]);
    }
}
