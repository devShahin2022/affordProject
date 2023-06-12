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
            'file' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
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
        $res1 = questionModel::where('user_id',Auth::user()->id)->where("status",1)->get();
        return view('ProfilePage.ProfilePage',['data' => $res ,'prevData'=>$res1]);
    }


    // for admin panel section
     public function showAllPendingQuestion(){
        $res = questionModel::where("status",0)->get();
        $prevres = questionModel::where("status",1)->get();
        return view("Admin.Messages.message",['data'=>$res,'prevData'=>$prevres]);
    }

    public function msgSending(Request $request){
        $validated = $request->validate([
            'answer' => 'required|min:1',
            'file' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
            'actionId'=>'required'
        ]);

        $question = questionModel::where("id",$request->actionId)->first();
        if( $question->status == 0){
            $answerQues = questionModel::where("id", $request->actionId)->first();
            if(isset($request->file)){
                $imageName = 'afford'.time() . '.' . $request->file->getClientOriginalExtension();
                $path = $request->file('file')->storeAs('images', $imageName, 'public');
                $imgLink = url('storage/images/'.$imageName);
                $answerQues->reply_img = $imgLink;
            }
            $answerQues->reply_teacher_id = Auth::user()->id;
            $answerQues->answer = $request->answer;
            $answerQues->status = 1;
            if($answerQues->save()){
                return back()->with('success',"answer successfully submitted!");
            }else{
                return back()->with('fail',"something went wrong!");
            }
        }else{
            return back();
        }
        
    }
}