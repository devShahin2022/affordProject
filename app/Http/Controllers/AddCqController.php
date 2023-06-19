<?php

namespace App\Http\Controllers;

use App\Models\AddCq;
use App\Models\AddMcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddCqController extends Controller
{
    public function getCq($statusReset){
        $lastUploadedCq = NULL; // handle reset form
        if($statusReset == 1){ // 1 means reset form
            return view("SiteGeneralContent.AddCq.addCq",['currentData'=>$lastUploadedCq]);
        }
        $lastUploadedCq = AddCq::where('addedBy',Auth::user()->username)->latest()->get(); // fetch by specific user perpose
        // dd( $lastUploadedCq );
        return view("SiteGeneralContent.AddCq.addCq",['currentData'=>$lastUploadedCq]);
    }
    public function storeCq(Request $request){
        $validated = $request->validate([
            'departmentName' => 'required',
            'subjectName' => 'required',
            'chapterName' => 'required',
            'questionCat' => 'required',
            'uddipakText' => 'required',
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required'
        ]);

        // return if select board or school name but not select board name+year or school name
        if( $request->questionCat !=0){
            if($request->questionCat == 'বোর্ড প্রশ্ন'){ // it's check board question
                if( $request->year == 0 || $request->boardOrSchoolName == 0 ){
                    return redirect()->route("getCq",['statusReset'=>0])->with('fail',"Fail! Board name or year name missing");
                }
            }else if($request->questionCat == 'স্কুলের প্রশ্ন'){ //its check school question
                if($request->boardOrSchoolName == 0){
                    return redirect()->route("getCq",['statusReset'=>0])->with('fail',"Fail! Must be select school name");
                }
            }
        }
        // validation end
        // start cq upload process

        $addCq = new AddCq();

        // first processing image upload
        if(isset($request->uddipakPhoto)){
            $imageName = 'afford_uddipak'.time() . '.' . $request->uddipakPhoto->getClientOriginalExtension();
            $path = $request->file('uddipakPhoto')->storeAs('images', $imageName, 'public');
            $imgLinkUddipak = url('storage/images/'.$imageName);
            $addCq->uddipakPhoto = $imgLinkUddipak;
        }
        // uddipak image process
        if(isset($request->answerPhoto1)){
            $imageName = 'afford_answer1'.time() . '.' . $request->answerPhoto1->getClientOriginalExtension();
            $path = $request->file('answerPhoto1')->storeAs('images', $imageName, 'public');
            $answerPhoto1 = url('storage/images/'.$imageName);
            $addCq->answerPhoto1 = $answerPhoto1;
        }
         // uddipak image process
         if(isset($request->answerPhoto2)){
            $imageName = 'afford_answer2'.time() . '.' . $request->answerPhoto2->getClientOriginalExtension();
            $path = $request->file('answerPhoto2')->storeAs('images', $imageName, 'public');
            $answerPhoto2 = url('storage/images/'.$imageName);
            $addCq->answerPhoto2 = $answerPhoto2;
        }
         // uddipak image process
         if(isset($request->answerPhoto3)){
            $imageName = 'afford_answer3'.time() . '.' . $request->answerPhoto3->getClientOriginalExtension();
            $path = $request->file('answerPhoto3')->storeAs('images', $imageName, 'public');
            $answerPhoto3 = url('storage/images/'.$imageName);
            $addCq->answerPhoto3 = $answerPhoto3;
        }
         // uddipak image process
         if(isset($request->answerPhoto4)){
            $imageName = 'afford_answer4'.time() . '.' . $request->answerPhoto4->getClientOriginalExtension();
            $path = $request->file('answerPhoto4')->storeAs('images', $imageName, 'public');
            $answerPhoto4 = url('storage/images/'.$imageName);
            $addCq->answerPhoto4 = $answerPhoto4;
        }

        // end image proccess
        // start basic information collection
        $addCq->departmentName = $request->departmentName;
        $addCq->subjectName = $request->subjectName;
        $addCq->chapterName = $request->chapterName;
        $addCq->questionCat = $request->questionCat;
        $addCq->boardOrSchoolName = $request->boardOrSchoolName;
        if(isset($request->year)){
            $addCq->year = $request->year;
        }
        $addCq->uddipakText = $request->uddipakText;
        $addCq->question1 = $request->question1;
        $addCq->question2 = $request->question2;
        $addCq->question3 = $request->question3;
        if(isset($request->question4)){
            $addCq->question4 = $request->question4;
        }
        if(isset($request->answerQuestion1)){
            $addCq->answerQuestion1 = $request->answerQuestion1;
        }
        if(isset($request->answerQuestion2)){
            $addCq->answerQuestion2 = $request->answerQuestion2;
        }
        if(isset($request->answerQuestion3)){
            $addCq->answerQuestion3 = $request->answerQuestion3;
        }
        if(isset($request->answerQuestion4)){
            $addCq->answerQuestion4 = $request->answerQuestion4;
        }
        $addCq->addedBy = Auth::user()->username; 

        if($addCq->save()){
            return redirect()->route("getCq",['statusReset'=>0])->with('success',"Cq uploaded success");
        }else{
            return redirect()->route("getCq",['statusReset'=>0])->with('fail',"Something went wrong! Try again");
        }
    }

    // find data ..
    function findCqData(Request $request){
        $validated = $request->validate([
            'departmentName' => 'required',
            'subjectName' => 'required',
            'chapterName' => 'required',
            'questionCat' => 'required'
        ]);

        $flag = 0; // afford question

        // return if select board or school name but not select board name+year or school name
        if( $request->questionCat !=0){
            if($request->questionCat == 'বোর্ড প্রশ্ন'){ // it's check board question
                if( $request->year == 0 || $request->boardOrSchoolName == 0 ){
                    return redirect()->route("getCq",['statusReset'=>0])->with('fail',"Fail! Board name or year name missing");
                }
                $flag = 1; //board question
            }else if($request->questionCat == 'স্কুলের প্রশ্ন'){ //its check school question
                if($request->boardOrSchoolName == 0){
                    return redirect()->route("getCq",['statusReset'=>0])->with('fail',"Fail! Must be select school name");
                }
                $flag = 2; // means school question
            }
        }
        // start basic information collection
        $departmentName = $request->departmentName;
        $subjectName = $request->subjectName;
        $chapterName = $request->chapterName;
        $questionCat = $request->questionCat;
        $boardOrSchoolName = $request->boardOrSchoolName;
        if(isset($request->year)){
            $year = $request->year;
        }
        $getCqs = NULL;
        // data fectch... various criterias
        // if afford question
        if($flag == 0){
            $getCqs = AddCq::where('departmentName', $departmentName)->
            where('subjectName',$subjectName)->where('chapterName', $chapterName)->
            where('questionCat', $questionCat)->latest()->get();
        }
        // for board question
        if($flag == 1){
            $getCqs = AddCq::where('departmentName', $departmentName)->
            where('subjectName',$subjectName)->where('chapterName', $chapterName)->
            where('questionCat', $questionCat)->
            where('boardOrSchoolName',$boardOrSchoolName)->where('year',$year)->latest()->get();
        }
        // for school question
        if($flag == 2){
            $getCqs = AddCq::where('departmentName', $departmentName)->
            where('subjectName',$subjectName)->where('chapterName', $chapterName)->
            where('questionCat', $questionCat)->
            where('boardOrSchoolName',$boardOrSchoolName)->latest()->get();
        }
        // send find data to front end
        return view("SiteGeneralContent.AddCq.addCq",['currentData'=>$getCqs]);
    }

    // for search field
    public function findBuSearch(Request $request){
        $validated = $request->validate([
            'search' => 'required'
        ]);
        $cqs = new AddCq();
        $res = $cqs->search($request->search)->all();
        return view("SiteGeneralContent.AddCq.addCq",['currentData'=>$res,'searchText'=>$request->search]);
    }
    // deactive cq publition
    public function activeOrDeactive(Request $request){
        $cq = AddCq::where('id',$request->id)->first();
        if($cq->status == 1){
            $cq->status = 0;
        }else{
            $cq->status = 1;
        }
        $cq->save();
        return back()->with('success', 'Status changed!');
    }
    // delete cq
    public function deleteCq(Request $request){
        $cq = AddCq::where('id',$request->id)->first();
        if($cq->delete()){
            return back()->with('success', 'Cq delete success');
        }else{
            return  back()->with("fail","Something went wrong");
        }
    }
    // view single cq
    public function viewSingleCq($serial, $id){
        $eachCqData = AddCq::where('id',$id)->first();
        return view("SiteGeneralContent.Cqview.singleCqView",['currentData'=>$eachCqData,'serial'=>$serial]);
    }
}