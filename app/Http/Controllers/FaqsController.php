<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class faqsController extends Controller
{
    public function showFaqs(){
        return view("faqs.faqs");
    }
}
