<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller 
{
    public function showContact(){
        return view("FrontSite.Contact.contact");
    }
    public function sendContact(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2',
            'schoolName' => 'required|min:2',
            'replyEmailOrPhone' => 'required|min:5',
            'message' => 'required|min:10',
        ]);

        $message = new Contact();
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
        $res = Contact::where('status',0)->get(); // pending contact
        $res1 = Contact::where('status',1)->latest()->get(); //delivered contact
        return view('Admin.adminContact',['pendingData'=>$res,'deliveredData'=>$res1]);
    } 
    public function approvedContact(Request $request){
        $validated = $request->validate([
            'text' => 'required|min:8|max:8',
        ]);
        if($request->text === 'approved'){
            $data = Contact::where('id',$request->id)->first();
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
