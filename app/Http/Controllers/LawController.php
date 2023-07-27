<?php

namespace App\Http\Controllers;

use App\Models\uploadLaw;
use Illuminate\Http\Request;

class lawController extends Controller
{
    public function getLaw($status){
        if($status == 0){
            return view("lawUpload.lowUpload",['currentData' => array()]);
        }
        $fetchLaws = uploadLaw::latest()->get();
        return view("lawUpload.lowUpload",['currentData' => $fetchLaws]);
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
            $uploadLaw = uploadLaw::where('id',$request->tarid)->first();
            $flag = false;
        }else{
            $uploadLaw = new uploadLaw();
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
        $law = uploadLaw::where('id',$id)->first();
        return view("lawUpload.updateLaw",['currentData'=>$law]);
    }
    // delete law
    public function lawDelete($id){
        $law = uploadLaw::where('id',$id)->first();
        if($law->delete()){
            return back()->with('success',"law delete success");
        }else{
            return back()->with('fail',"Something went wrong");
        }
    }
    // funtion for show data for user
    public function shoqLawforUser($subject,$chapter){
        $law = uploadLaw::where('subjectName',$subject)->where('chapterName',$chapter)->get();
        return view("lawUpload.showLawforUser",['subject'=>$subject, 'currentData'=> $law, "chapter"=>$chapter]);
    }

    public function fetchLawdatajson($bookName,$chapter){
        $law = uploadLaw::where('subjectName',$bookName)->where('chapterName',$chapter)->get();
        return json_encode($law);
    }


}
