<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sscExamBatchAdmController extends Controller
{
    public function getSscExamForm(){
        return view("Register.sscExamBatch");
    }
    public function storeAdmSSCExamBatch(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2',
            'amtTaka' => 'required|numeric',
            'paymentNumber' => 'required|min:5|numeric',
            'paymentMethod' => 'required|min:2',
            'TnxId' => 'required|min:2'
        ]);

        // dd(Auth::user());
        $admission = new Payment();
        $admission->std_name = $request->name;
        $admission->user_id = Auth::user()->id;
        $admission->amt_taka = $request->amtTaka;
        $admission->payment_method = $request->paymentMethod;
        $admission->payment_number = $request->paymentNumber;
        $admission->trx_id = $request->TnxId;
        $admission->status = 0; // 0 mean unapproved 1 mean approved

        if($admission->save()){
            $register = User::where('id',Auth::user()->id)->first();
            $register->account_type = 'pending';
            $register->save();
            return back()->with('success',"সাকসেস ! তোমার তথ্যগুলো জমা হয়েছে। আমরা সত্যতা যাচাই করে ২৪ ঘণ্টার ভেতরে জানিয়ে দেব।");
        }else{
            return back()->with("fail","Something went wrong! Please try again letter.");
        }
    }
    // for admin
    public function getSScXmAdmissionRequest(){
        $res = Payment::where('status',0)->get(); // uncheck payment request
        $res1 = Payment::where('status',1)->latest()->get(); // approved request
        $res2 = Payment::where('status',2)->latest()->get(); // check and unapproved request
        return view("Admin.admissionRequest.sscXmReq",['newReq'=>$res,'approvedReq'=>$res1,'unapprovedReq'=>$res2]);
    } 
    public function approvedAmsReq(Request $request){
        $id = $request->id;
        $payment = Payment::where('id', $id)->first();
        $userId = $payment->user_id;
        $user = User::where('id', $userId)->first(); 
        $payment->status = 1; // approved payment
        if($payment->save()){
            $user->account_type = 2; // acount premium and admission success
            $user->save();
            return back()->with('success',"Approved success");
        }else{
            return back()->with('fail',"something went wrong!");
        }
    }
    public function unApprovedAmsReq(Request $request){
        $id = $request->id;
        $payment = Payment::where('id', $id)->first();
        $userId = $payment->user_id;
        $user = User::where('id', $userId)->first(); 
        $payment->status = 2; // unapproved payment
        if($payment->save()){
            $user->account_type = 0; // basic account
            $user->save();
            return back()->with('success',"Unapproved success");
        }else{
            return back()->with('fail',"something went wrong!");
        }
    } 

    public function deleteUnapprovedReq(Request $request){
        $id = $request->id;
        $payment = Payment::where('id', $id)->first();
        $userId = $payment->user_id;
        $user = User::where('id', $userId)->first(); 
        if($payment->delete()){
            $user->account_type = 0; // basic account
            $user->save();
            return back()->with('success',"delete success");
        }else{
            return back()->with('fail',"something went wrong!");
        }
    } 
    
}
