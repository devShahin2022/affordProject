<?php

namespace App\Http\Controllers;

use App\Models\questionType;
use Illuminate\Http\Request;

class questionTypeController extends Controller
{
    public function uploadQuestionTypeGet($status){
        if($status == 0){
            return view("eachChapter.uploadQuestionType",["currentData" => array()]);
        }
        $data = questionType::latest()->get();
        return view("eachChapter.uploadQuestionType",["currentData" => $data]);
    }
    // store question category
    public function storeCat(Request $request){
        $validated = $request->validate([
            'departmentName' => 'required',
            'subjectName' => 'required',
            'chapterName' => 'required',
            'titleOfQuestionType' => 'required',
            'typeQuestion' => 'required',
            'currentCatNo' => 'required',
        ]);

        // call model
        $uploadType = new questionType();
        // proccessing image
        if(isset($request->questionImage)){
            $imageName = 'afford_uddipak'.time() . '.' . $request->questionImage->getClientOriginalExtension();
            $path = $request->file('questionImage')->storeAs('images', $imageName, 'public');
            $imgLinkQuestionImage = url('storage/images/'.$imageName);
            $uploadType->questionImg = $imgLinkQuestionImage;
        }
        if(isset($request->answerImage)){
            $imageName = 'afford_answer1'.time() . '.' . $request->answerPhoto1->getClientOriginalExtension();
            $path = $request->file('answerImage')->storeAs('images', $imageName, 'public');
            $answerImageLink = url('storage/images/'.$imageName);
            $uploadType->answerImg = $answerImageLink;
        }

        // upload texts
        $uploadType->departmentName = $request->departmentName;
        $uploadType->subjectName = $request->subjectName;
        $uploadType->chapterName = $request->chapterName;
        $uploadType->cat_no = $request->currentCatNo;
        $uploadType->quesTypeTitle = $request->titleOfQuestionType;
        $uploadType->question = $request->typeQuestion;
        $uploadType->answer = $request->typeAnswer;
        $uploadType->justAnswer = $request->justAnswer;

        if($uploadType->save()){
            return back()->with("success","data store success");
        }else{
            return back()->with("fail","Something went wrong");
        }
    }
    // delete type
    public function deleteType( $id ){
        $type = questionType::where("id",$id)->first();
        if($type->delete()){
            return back()->with("success","Data delete success");
        }
    }
    // kaj o onusiloni prosno
    public function kajOonusiloni($status){
        if($status == 0){
            return view("kajOonusiloni.kajOonusiloni",["currentData" => array()]);
        }
        $data = questionType::latest()->get();
        return view("kajOonusiloni.kajOonusiloni",["currentData" => $data]);
    }
}
