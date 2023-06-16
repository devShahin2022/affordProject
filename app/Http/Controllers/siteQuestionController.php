<?php

namespace App\Http\Controllers;

use App\Models\AddMcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class siteQuestionController extends Controller
{
    public function addBoardMcqView(){
        return view('SiteGeneralContent.AddMcq.addMcqBoard');
    }
    public function storeMcq(Request $request){
        $validated = $request->validate([
            'question' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'answer' => 'required',
            'year'=> 'required',
            'question_cat'=>'required',
            'board'=>'required',
        ]);
        $addMcq = new AddMcq();
        if(!$request->answer){
            return back()->with('fail',"Mcq ansewer not be empty . Please select minimum 1");
        }
        if($request->question_cat == 1 && $request->board !=0 && $request->question_type!=0 && $request->year!=0){
            $addMcq->year = $request->year;
        }else{
            if($request->question_cat !=0 && $request->question_type!=0){
                
            }else{
                return back()->with('fail',"Please option fill data correctly");
            }
        }

        $addMcq->question_cat = $request->question_cat;
        $addMcq->question_type = $request->question_type;
        
        
        $addMcq->uddipak = $request->uddipak;
        $addMcq->question = $request->question;
        $addMcq->option1 = $request->option_1;
        $addMcq->option2 = $request->option_2;
        $addMcq->option3 = $request->option_3;
        $addMcq->option4 = $request->option_4;
        $addMcq->answer = json_encode($request->answer);
        $addMcq->explain = $request->explain_mcq;
        $addMcq->question_link_id = $request->questionLinkId;
        $addMcq->uploaded_by = Auth::user()->username;
        $addMcq->status = 1;
        $addMcq->similar_question = $request->similarAnswer;

        if(isset($request->file)){
            $imageName = 'afford'.time() . '.' . $request->file->getClientOriginalExtension();
            $path = $request->file('file')->storeAs('images', $imageName, 'public');
            $imgLink = url('storage/images/'.$imageName);
            $addMcq->photo_url = $imgLink;
        }
        if($addMcq->save()){
            return back()->with('success',"Mcq insert success");
        }
        if(!$addMcq->save()){
            return back()->with('fail',"Something went wrong");
        }
        
    }
}
