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
}
