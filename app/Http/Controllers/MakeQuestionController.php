<?php

namespace App\Http\Controllers;

use App\Models\AddMcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MakeQuestionController extends Controller
{
    public function showMakeMcqQuesXm(){
        $lastAddedData = AddMcq::latest()->first();
        $data = array();
        if( $lastAddedData ){
            if( $lastAddedData->question_set !=NULL){
                $data = AddMcq::where('subject_name',$lastAddedData->subject_name)->
                    where('chapter_name', $lastAddedData->chapter_name)->
                    where('question_set', $lastAddedData->question_set)->latest()->get();
            }
        }
       return view('SiteGeneralContent.MakeQuesForExam.makeMcqXm',['mcqs'=>$data]);
    }

    public function storeMcq(Request $request){
        $validated = $request->validate([
            'question' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'option_3' => 'required',
            'answer' => 'required',
            'chapterName'=>'required',
            'setCapacity'=>'required |numeric',
            'subjectName'=>'required'
        ]);
        $addMcq = new AddMcq();
        $flag = false; // its for upadate data handler
        // make sure question set already exits or not
        if($request->makeSureIsExitSet == 0){ //data set from frontend view
            $addMcq->question_set = 1;
            $addMcq->max_capacity = $request->setCapacity;
        }
        if($request->makeSureIsExitSet !=0){ //data set from frontend view
            $addMcq->question_set = $request->current_question_set;
            $findLatestSetData = AddMcq::where('question_set',$request->makeSureIsExitSet)->
                where('chapter_name',$request->chapterName)->
                where('subject_name',$request->subjectName)->get();
            if($findLatestSetData[0]->max_capacity != $request->setCapacity){
                for($i=0; $i<sizeof($findLatestSetData); $i++){
                    $findLatestSetData[$i]->max_capacity = $request->setCapacity;
                    $findLatestSetData[$i]->save();
                }
                $addMcq->max_capacity = $request->setCapacity;
            }
            if(sizeof($findLatestSetData) > $request->setCapacity-1){ // +1 for execute logics
                $addMcq->question_set += 1 ;
            }
        }
        if($request->id != 0){
            $flag = true;
            $addMcq = AddMcq::where('id',$request->id)->first();
        }
        if(!$request->answer){
            return back()->with('fail',"Mcq ansewer not be empty . Please select minimum 1");
        }

        $addMcq->question_cat = 3; // 3 means only by afford
        $addMcq->question_type = $request->question_type;
        $addMcq->chapter_name = $request->chapterName;
        // board
        
        $addMcq->uddipak = $request->uddipak;
        $addMcq->subject_name = $request->subjectName;

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
                return redirect()->route('addBoardMcqView')->with("success","Data update success");
            }
            return back()->with('success',"Mcq insert success");
        }
        if(!$addMcq->save()){
            return back()->with('fail',"Something went wrong");
        }
    }

    // find xm mcq
    public function findXmMcqByOptions(Request $request){
        if($request->subjectName !=0 && $request->chapterName !=0 && $request->questionSet){
            $res = AddMcq::where('subject_name',$request->subjectName)->
                where('chapter_name',$request->chapterName)->
                where('question_set',$request->questionSet)->get();
                $lastAddedData = AddMcq::latest()->get();
                return view('SiteGeneralContent.MakeQuesForExam.makeMcqXm',['mcqs'=>$res,'size'=> sizeof($lastAddedData)]);
        }else{
            return back();
        }
    }
    // search mcq
    public function serachMcqXm(Request $request){
        $validated = $request->validate([
            'searchValue' => 'required',
        ]);
        $mcqs = new AddMcq();
        $res = $mcqs->search($request->searchValue)->all();
        $lastAddedData = AddMcq::latest()->get();
        return view('SiteGeneralContent.MakeQuesForExam.makeMcqXm',['mcqs'=>$res, 'searchText'=> $request->searchValue, 'size'=> sizeof($lastAddedData)]);
    }
}
