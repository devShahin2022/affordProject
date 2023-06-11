<?php

namespace App\Http\Controllers;

use App\Models\questionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function prevMsgRetrive(){
        return "Hello";
    }
    public function insertMsg(Request $request){
        $validated = $request->validate([
            'question' => 'required|min:5',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        $question = new questionModel();
        if(isset($request->file)){
            $imageName = 'afford'.time() . '.' . $request->file->getClientOriginalExtension();
            $path = $request->file('file')->storeAs('images', $imageName, 'public');
            $imgLink = url('storage/images/'.$imageName);
            $question->question_img = $imgLink;
        }
        $question->user_id = Auth::user()->id;
        $question->question = $request->question;
        $question->status = 0;

        if($question->save()){
            return redirect()->back()->with('success', 'Question upload success! please wait some moment');
        }else{
            return redirect()->back()->with('fail', 'Something went wrong!'); 
        }
    }
    // show all pending question
    public function showPendingQuestion(){
        $res = questionModel::where('user_id',Auth::user()->id)->where("status",0)->get();
        return view('ProfilePage.ProfilePage',['data' => $res  ]);
    }

     // show all previos question
     public function showPrevQuestion(){
        $res = questionModel::where('user_id',Auth::user()->id)->where("status",1)->get();
        return view('ProfilePage.ProfilePage',['prevData' => $res  ]);
    }
}
