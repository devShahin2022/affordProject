<?php

namespace App\Http\Controllers;

use App\Models\QuestionType;
use Illuminate\Http\Request;

class QuestionTypeController extends Controller
{
    public function uploadQuestionTypeGet($status){
        if($status == 0){
            return view("EachChapter.uploadQuestionType",["currentData" => array()]);
        }
        $data = QuestionType::latest()->get();
        return view("EachChapter.uploadQuestionType",["currentData" => $data]);
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
        $uploadType = new QuestionType();
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
        $type = QuestionType::where("id",$id)->first();
        if($type->delete()){
            return back()->with("success","Data delete success");
        }
    }
}
