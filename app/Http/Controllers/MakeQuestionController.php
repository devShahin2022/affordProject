<?php

namespace App\Http\Controllers;

use App\Models\addMcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class makeQuestionController extends Controller
{
    public function showMakeMcqQuesXm($statusReset){
        $lastUploadedMcq = NULL; // handle reset form
        if($statusReset == 1){ // 1 means reset form
            return view("siteGeneralContent.makeQuesForExam.makeMcqXm",['currentData'=>$lastUploadedMcq]);
        }
        $lastAddedData = addMcq::where('uploaded_by',Auth::user()->username)->
        where('isXmQuestion',1)->latest()->get();
       

        if(sizeof($lastAddedData)>0){
            $lastUploadedMcq = addMcq::where('uploaded_by',Auth::user()->username)->
            where('question_set',$lastAddedData[0]->question_set)->
            where('departmentName',$lastAddedData[0]->departmentName)->
            where('subjectName',$lastAddedData[0]->subjectName)->
            where('chapterName',$lastAddedData[0]->chapterName)->
            where('questionCat',$lastAddedData[0]->questionCat)->get();
            return view("siteGeneralContent.makeQuesForExam.makeMcqXm",['currentData'=>$lastUploadedMcq]);
        }
        if(sizeof($lastAddedData)==0){
            return view("siteGeneralContent.makeQuesForExam.makeMcqXm",['currentData'=>$lastUploadedMcq]);
        }
    }
    public function storeMcq(Request $request){ // actually its store custom exam question for cq
        $validated = $request->validate([
            'departmentName' => 'required',
            'subjectName' => 'required',
            'chapterName' => 'required',
            'questionCat' => 'required',
            'question_type' => 'required',
            'question' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'answer' => 'required',
            'max_capacity' => 'required'
        ]);
        $addMcq = new addMcq();
        // make sure question set already exits or not
        if($request->makeSureIsExitSet == 0){ //data set from frontend view
            $addMcq->question_set = 1;
            $addMcq->max_capacity = $request->max_capacity;
        }
        if($request->makeSureIsExitSet !=0){ //data set from frontend view
            $addMcq->max_capacity = $request->max_capacity;
            $addMcq->question_set = $request->makeSureIsExitSet;
            $findLatestSetData = addMcq::where('question_set',$request->makeSureIsExitSet)->
                where('subjectName',$request->subjectName)->
                where('chapterName',$request->chapterName)->get();
            if($findLatestSetData[0]->max_capacity != $request->max_capacity){
                for($i=0; $i<sizeof($findLatestSetData); $i++){
                    $findLatestSetData[$i]->max_capacity = $request->max_capacity;
                    $findLatestSetData[$i]->save();
                }
            }
            if(sizeof($findLatestSetData) > $request->max_capacity-1){
                $addMcq->question_set += 1 ;
            }
        }
        $addMcq->departmentName = $request->departmentName; 
        $addMcq->questionCat = $request->questionCat; 
        $addMcq->question_type = $request->question_type;
        $addMcq->chapterName = $request->chapterName;
        // check mark its a exam question
        $addMcq->isXmQuestion = 1;
        $addMcq->uddipak = $request->uddipak;
        $addMcq->subjectName = $request->subjectName;

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
            return back()->with('success',"Mcq insert success");
        }
        if(!$addMcq->save()){
            return back()->with('fail',"Something went wrong");
        }
    }

    // find xm mcq
    public function findXmMcqByOptions(Request $request){
        $validated = $request->validate([
            'departmentName' => 'required',
            'subjectName' => 'required',
            'chapterName' => 'required',
            'question_set' => 'required'
        ]);
        $findData = addMcq::where('departmentName',$request->departmentName)->
                    where('subjectName',$request->subjectName)->
                    where('chapterName',$request->chapterName)->
                    where('question_set',$request->question_set)->latest()->get();
        return view('siteGeneralContent.makeQuesForExam.makeMcqXm',['currentData'=>$findData,'findSize'=>sizeof($findData)]);
    }
    // search mcq
    public function serachMcqXm(Request $request){
        $validated = $request->validate([
            'searchValue' => 'required',
        ]);
        $mcqs = new addMcq();
        $res = $mcqs->search($request->searchValue)->all();
        return view('siteGeneralContent.makeQuesForExam.makeMcqXm',['currentData'=>$res, 'searchText'=> $request->searchValue, 'findSize'=> sizeof($res)]);
    }
}
