<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class aboutUsController extends Controller
{
    public function showAboutUsPage(){
        return view("aboutUs.aboutUs");
    }
}
