<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;

class contactController extends Controller 
{
    public function showContact(){
        return view("frontSite.contact.contact");
    }
    public function sendContact(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2',
            'schoolName' => 'required|min:2',
            'replyEmailOrPhone' => 'required|min:5',
            'message' => 'required|min:10',
        ]);

        $message = new contact();
        $message->name = $request->name;
        $message->school = $request->schoolName;
        $message->message = $request->message;
        $message->reply_phone_email = $request->replyEmailOrPhone;
        $message->status = 0; //0 mean pending 1 mean success delivered

        if( $message->save()){
            return back()->with('success', "Success! Your contact has been submitted");
        }else{
            return back()->with('fail', "Something went wrong");
        }
    }
    public function getAdminContacts(){
        $res = contact::where('status',0)->get(); // pending contact
        $res1 = contact::where('status',1)->latest()->get(); //delivered contact
        return view('admin.adminContact',['pendingData'=>$res,'deliveredData'=>$res1]);
    } 
    public function approvedContact(Request $request){
        $validated = $request->validate([
            'text' => 'required|min:8|max:8',
        ]);
        if($request->text === 'approved'){
            $data = contact::where('id',$request->id)->first();
            $data->status = 1;
            if($data->save()){
                return back()->with('success',"Contact approved success!'");
            }else{
                return back()->with('err',"something went wrong!'");
            }
        }else{
            return back()->with('fail',"Please type 'approved'");
        }
        
    }
}
