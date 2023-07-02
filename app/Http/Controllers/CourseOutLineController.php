<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseOutLineController extends Controller
{
    public function showCourseOutline(){
        return view("OutLine.outline");
    }
}
