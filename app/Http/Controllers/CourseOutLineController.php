<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class courseOutLineController extends Controller
{
    public function showCourseOutline(){
        return view("outLine.outline");
    }
}
