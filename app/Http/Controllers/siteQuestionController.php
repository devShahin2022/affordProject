<?php

namespace App\Http\Controllers;

use App\Models\AddMcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class siteQuestionController extends Controller
{
    public function addBoardMcqView(){
        $lastAddedData = AddMcq::latest()->get();
        $size = 0;
        if($lastAddedData){
            $size = sizeof($lastAddedData);
        }
        if(sizeof($lastAddedData) > 0){
            $bookName =  $lastAddedData[0]->subject_name;
            $question_cat =  $lastAddedData[0]->question_cat;
            $year =  $lastAddedData[0]->year;
            $board =  $lastAddedData[0]->Board_name;
            $chapter =  $lastAddedData[0]->chapter_name;
            if($question_cat == 1){
                $res = AddMcq::where('subject_name',$bookName)->
                    where('question_cat',$question_cat)->
                    where('Board_name',$board)->
                    // where('chapter_name',$chapter)->
                    where('year',$year)->latest()->get();
                    return view('SiteGeneralContent.AddMcq.addMcqBoard',['mcqs'=>$res, 'size'=>$size]);
            }else{
                if($question_cat == 2){
                    $res = AddMcq::where('subject_name',$bookName)->
                    where('question_cat',$question_cat)->latest()->get();
                    return view('SiteGeneralContent.AddMcq.addMcqBoard',['mcqs'=>$res, 'size'=>$size]);
                }else{ // defenately it will 3
                    $res = AddMcq::where('subject_name',$bookName)->
                    where('question_cat',$question_cat)->latest()->get();
                    return view('SiteGeneralContent.AddMcq.addMcqBoard',['mcqs'=>$res, 'size'=>$size]);
                }
            }
            return view('SiteGeneralContent.AddMcq.addMcqBoard',['mcqs'=>$lastAddedData, 'size'=>$size]);
        }else{
            return view('SiteGeneralContent.AddMcq.addMcqBoard',['mcqs'=>$lastAddedData, 'size'=>$size]);
        }
    }
    public function autoCompleteSearch($sub, $quesCat, $board, $year){
        
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
            'chapterName'=>'required'
        ]);
        $addMcq = new AddMcq();
        $flag = false;
        if($request->id != 0){
            $flag = true;
            $addMcq = AddMcq::where('id',$request->id)->first();
        }
        if(!$request->answer){
            return back()->with('fail',"Mcq ansewer not be empty . Please select minimum 1");
        }
        if($request->question_cat == 1 && $request->board !=0 && $request->question_type!=0 && $request->year!=0 && $request->subjectName!=0){
            $addMcq->year = $request->year;
        }else{
            if($request->question_cat !=0 && $request->question_type!=0 && $request->subjectName!=0){
                
            }else{
                return back()->with('fail',"Please option fill data correctly");
            }
        }

        $addMcq->question_cat = $request->question_cat;
        $addMcq->question_type = $request->question_type;
        $addMcq->chapter_name = $request->chapterName;
        // board
        
        $addMcq->uddipak = $request->uddipak;
        $addMcq->subject_name = $request->subjectName;
        $addMcq->Board_name = $request->board;

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
            if($flag){
                return redirect()->route('addBoardMcqView')->with("success","Data update success");
            }
            return back()->with('success',"Mcq insert success");
        }
        if(!$addMcq->save()){
            return back()->with('fail',"Something went wrong");
        }
    }
    // find data
    public function findMcqByOptions(Request $request){
        if($request->subjectName !=0 && $request->question_cat !=0 && $request->year !=0 && $request->board !=0){
            $res = AddMcq::where('subject_name',$request->subjectName)->
                where('question_cat',$request->question_cat)->
                where('Board_name',$request->board)->
                where('year',$request->year)->latest()->get();
                $lastAddedData = AddMcq::latest()->get();
                return view('SiteGeneralContent.AddMcq.addMcqBoard',['mcqs'=>$res,'size'=> sizeof($lastAddedData)]);
        }else{
            return back();
        }
    }

    // search mcq
    public function serachMcq(Request $request){
        $validated = $request->validate([
            'searchValue' => 'required',
        ]);
        $mcqs = new AddMcq();
        $res = $mcqs->search($request->searchValue)->all();
        $lastAddedData = AddMcq::latest()->get();
        return view('SiteGeneralContent.AddMcq.addMcqBoard',['mcqs'=>$res, 'searchText'=> $request->searchValue, 'size'=> sizeof($lastAddedData)]);
    }
    // mcq status change
    public function changeMcqStatus(Request $request){
        $mcq = AddMcq::where('id', $request->id)->first();
        if($request->status_val == 0){
            $mcq->status = 1;
            $mcq->save();
            return back()->with('success',"status change");
        }else{
            $mcq->status = 0;
            $mcq->save();
            return back()->with('success',"status change");
        }
    }
    // delete mcq 
    public function deleteMcq(Request $request){
        $mcq = AddMcq::where('id', $request->id)->first();
        if($mcq->delete()){
            return redirect()->route('addBoardMcqView')->with("success","Delete success");
        }else{
            return redirect()->route('addBoardMcqView')->with("fail","Something went wrong");
        }
    }
    // single mcq view
    public function singleMcqView($id, $mcqNo){
        $res = AddMcq::where('id',$id)->first();
        return view('SiteGeneralContent.AddMcq.EachMcqView',['mcq'=>$res,'mcqNo'=>$mcqNo]);
    }
    // update mcq panel

    public function McqUpdate($id, $mcqNo){
        $res = AddMcq::where('id',$id)->first();
        return view('SiteGeneralContent.AddMcq.UpdateMcqPanel',['mcq'=>$res,'mcqNo'=>$mcqNo]);
    }
}
