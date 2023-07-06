<?php

namespace App\Http\Controllers;

use App\Models\UploadLaw;
use Illuminate\Http\Request;

class LawController extends Controller
{
    public function getLaw($status){
        if($status == 0){
            return view("LawUpload.lowUpload",['currentData' => array()]);
        }
        $fetchLaws = UploadLaw::latest()->get();
        return view("LawUpload.lowUpload",['currentData' => $fetchLaws]);
    }
    public function uploadLaw(Request $request){
        $validated = $request->validate([
            'departmentName' => 'required',
            'subjectName' => 'required',
            'chapterName' => 'required',
            'writeLaw' => 'required',
        ]);

        $flag = true;

        // dd($request->tarid);

        if($request->tarid !=null){
            $uploadLaw = UploadLaw::where('id',$request->tarid)->first();
            $flag = false;
        }else{
            $uploadLaw = new UploadLaw();
        }
        $uploadLaw->departmentName = $request->departmentName;
        $uploadLaw->subjectName = $request->subjectName;
        $uploadLaw->chapterName = $request->chapterName;
        $uploadLaw->law = $request->writeLaw;
        $uploadLaw->lawExplain = $request->lawExplain;
        $uploadLaw->example = $request->exampleLaw;


        if($flag){
            if($uploadLaw->save()){
                return back()->with("success","law upload success");
            }else{
                return back()->with("fail","Something went wrong!");
            }
        }else{
            if($uploadLaw->save()){
                return redirect()->route('getLaw',['status'=>1])->with('success',"Law updated success");
            }else{
                return back()->with("fail","Something went wrong!");
            }
        }
    }

    // update a lawpanel
    public function getUpdateLaw($id){
        $law = UploadLaw::where('id',$id)->first();
        return view("LawUpload.updateLaw",['currentData'=>$law]);
    }
    // delete law
    public function lawDelete($id){
        $law = UploadLaw::where('id',$id)->first();
        if($law->delete()){
            return back()->with('success',"law delete success");
        }else{
            return back()->with('fail',"Something went wrong");
        }
    }
    // funtion for show data for user
    public function shoqLawforUser($subject,$chapter){
        $law = UploadLaw::where('subjectName',$subject)->where('chapterName',$chapter)->get();
        return view("LawUpload.showLawforUser",['subject'=>$subject, 'currentData'=> $law, "chapter"=>$chapter]);
    }

    public function fetchLawdatajson($bookName,$chapter){
        $law = UploadLaw::where('subjectName',$bookName)->where('chapterName',$chapter)->get();
        return json_encode($law);
    }


}
