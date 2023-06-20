<?php

namespace App\Http\Controllers;

use App\Models\AddMcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class siteQuestionController extends Controller
{
    public function addBoardMcqView($statusReset){
        $lastAddedData = array();
        if($statusReset == 1){
            return view('SiteGeneralContent.AddMcq.addMcqBoard',['currentData'=>$lastAddedData]);
        }

        $lastAddedData = AddMcq::where('uploaded_by',Auth::user()->username)->latest()->get();
        if(sizeof($lastAddedData) > 0){
            $departmentName = $lastAddedData[0]->departmentName;
            $subjectName =  $lastAddedData[0]->subjectName;
            $chapterName =  $lastAddedData[0]->chapterName;
            $questionCat =  $lastAddedData[0]->questionCat;
            $boardOrSchoolName =  $lastAddedData[0]->boardOrSchoolName;
            $year =  $lastAddedData[0]->year;
            // check static data...
            if(  $questionCat  == "বোর্ড প্রশ্ন" ){
                $lastAddedData = AddMcq::where('departmentName',$departmentName)->where('subjectName',$subjectName)->
                where('chapterName',$chapterName)->
                where('boardOrSchoolName',$boardOrSchoolName)->
                where('year',$year)->latest()->get();
            }
            if(  $questionCat  == "স্কুলের প্রশ্ন" ){
                $lastAddedData = AddMcq::where('departmentName',$departmentName)->where('subjectName',$subjectName)->
                where('chapterName',$chapterName)->
                where('boardOrSchoolName',$boardOrSchoolName)->latest()->get();
            }
            if(  $questionCat  == "বাই অ্যাফোর্ড প্রশ্ন" ){
                $lastAddedData = AddMcq::where('departmentName',$departmentName)->where('subjectName',$subjectName)->
                where('chapterName',$chapterName)->latest()->get();
            }
            return view('SiteGeneralContent.AddMcq.addMcqBoard',['currentData'=>$lastAddedData]);
        }else{
            return view('SiteGeneralContent.AddMcq.addMcqBoard',['currentData'=>$lastAddedData]);
        }
    }


    public function storeMcq(Request $request){
        $validated = $request->validate([
            'departmentName' => 'required',
            'subjectName' => 'required',
            'chapterName' => 'required',
            'questionCat' => 'required',
            'question_type' => 'required',
            'question'=>'required',
            'answer'=>'required',
            'option_1'=>'required',
            'option_2'=>'required',
            'option_3'=>'required',
        ]);
        $addMcq = new AddMcq();
        $flag = false;
        if($request->id != 0){
            $flag = true;
            $addMcq = AddMcq::where('id',$request->id)->first();
        }
        if($request->question_type == 0){
            return back()->with('fail',"You have to select question type");
        }
        if(!$request->answer){
            return back()->with('fail',"Mcq ansewer not be empty . Please select minimum 1");
        }
        if($request->questionCat == "বোর্ড প্রশ্ন"){
            if($request->boardOrSchoolName == 0 || $request->year == 0  ){
                return back()->with('fail',"Missing board or year name");
            }
            $addMcq->boardOrSchoolName = $request->boardOrSchoolName;
            $addMcq->year = $request->year;
        }
        if($request->questionCat == "স্কুলের প্রশ্ন"){
            if($request->boardOrSchoolName == 0){
                return back()->with('fail',"Must be select a school name");
            }
            $addMcq->boardOrSchoolName = $request->boardOrSchoolName;
        }
        // otherwise by default set it afford question...

        $addMcq->departmentName = $request->departmentName;
        $addMcq->subjectName = $request->subjectName;
        $addMcq->chapterName = $request->chapterName;
        $addMcq->questionCat = $request->questionCat;
        $addMcq->question_type = $request->question_type;
        // board
        
        $addMcq->uddipak = $request->uddipak;

        $addMcq->question = $request->question;
        $addMcq->option1 = $request->option_1;
        $addMcq->option2 = $request->option_2;
        $addMcq->option3 = $request->option_3;
        $addMcq->option4 = $request->option_4;
        $addMcq->answer = json_encode($request->answer);
        $addMcq->explain = $request->explain_mcq;
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
                return redirect()->route('addBoardMcqView', ['statusReset'=> 0 ])->with("success","Data update success");
            }
            return back()->with('success',"Mcq insert success");
        }
        if(!$addMcq->save()){
            return back()->with('fail',"Something went wrong");
        }
    }
    // find data
    public function findMcqByOptions(Request $request){
        $validated = $request->validate([
            'departmentName' => 'required',
            'subjectName' => 'required',
            'chapterName' => 'required',
            'questionCat' => 'required'
        ]);
        if(  $request->questionCat  == "বোর্ড প্রশ্ন" ){
            $lastAddedData = AddMcq::where('departmentName',$request->departmentName)->where('subjectName',$request->subjectName)->
            where('chapterName',$request->chapterName)->
            where('boardOrSchoolName',$request->boardOrSchoolName)->
            where('year',$request->year)->latest()->get();
        }
        if(  $request->questionCat  == "স্কুলের প্রশ্ন" ){
            $lastAddedData = AddMcq::where('departmentName',$request->departmentName)->where('subjectName',$request->subjectName)->
            where('chapterName',$request->chapterName)->
            where('boardOrSchoolName',$request->boardOrSchoolName)->latest()->get();
        }
        if(  $request->questionCat  == "বাই অ্যাফোর্ড প্রশ্ন" ){
            $lastAddedData = AddMcq::where('departmentName',$request->departmentName)->where('subjectName',$request->subjectName)->
            where('chapterName',$request->chapterName)->latest()->get();
        }
        return view('SiteGeneralContent.AddMcq.addMcqBoard',['currentData'=>$lastAddedData]);
    }

    // search mcq
    public function serachMcq(Request $request){
        $validated = $request->validate([
            'searchValue' => 'required',
        ]);
        $mcqs = new AddMcq();
        $res = $mcqs->search($request->searchValue)->all();
        return view('SiteGeneralContent.AddMcq.addMcqBoard',['currentData'=>$res, 'searchText'=> $request->searchValue]);
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
            return redirect()->route('addBoardMcqView', ['statusReset'=> 0 ])->with("success","Delete success");
        }else{
            return redirect()->route('addBoardMcqView', ['statusReset'=> 0 ])->with("fail","Something went wrong");
        }
    }
    // single mcq view
    public function singleMcqView($id, $mcqNo){
        $res = AddMcq::where('id',$id)->first();
        return view('SiteGeneralContent.AddMcq.EachMcqView',['currentData'=>$res,'mcqNo'=>$mcqNo]);
    }
    // update mcq panel

    public function McqUpdate($id, $mcqNo){
        $res = AddMcq::where('id',$id)->first();
        return view('SiteGeneralContent.AddMcq.UpdateMcqPanel',['currentData'=>$res,'mcqNo'=>$mcqNo]);
    }
}
