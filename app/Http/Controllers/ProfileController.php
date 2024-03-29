<?php

namespace App\Http\Controllers;

use App\Models\questionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function showProfile(){
        return view("profilePage.profilePage");
    }
    // show all pending question
    public function showQuestionPage(){
        $res = questionModel::where('user_id',Auth::user()->id)->where("status",0)->get();
        $res1 = questionModel::where('user_id',Auth::user()->id)->where("status",1)->get();
        // return view('ProfilePage.ProfilePage',['data' => $res ,'prevData'=>$res1]);
        return view('profilePage.questionPage.questionPage',['data' => $res ,'prevData'=>$res1]);
    }
}
