<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Register extends Controller
{
    public function signUp(){
        return view("Register.register");
    }
    public function register(Request $request){
        $validated = $request->validate([
            'phone' => 'required|digits:11|numeric',
            'username' => 'required|min:5',
            'psw' => 'required|min:6',
            'repeatPassword' => 'required|min:6',
        ]);
        if($request->psw !== $request->repeatPassword){
            return back()->with('pswdmath', "Password don't match ");
        }else{
            $users = User::all();
            $previousPhoneNumerUsers = 0;
            $isExistUsername = false;
            foreach ($users as $user) {
                if (Hash::check($request->username, $user->username)) {
                    $isExistUsername = true;
                }
                if ($request->phone == $user->phone) {
                    $previousPhoneNumerUsers ++;
                }
            }

            if($isExistUsername){
                return back()->with('usernameExist',"Username already taken");
            }
            if($previousPhoneNumerUsers > 2){
                return back()->with('maxPhoneUser',"Phone user limit exeed!");
            }
            // data store
            $register = new User();
            $register->phone = $request->phone;
            $register->username = $request->username;
            $register->account_type = 0; //pending requested , default 0 mean basic account, 1 mean premium account, 2 mean admission sssExam
            $register->password = Hash::make($request->psw);
            $register->role = "student";
            if($register->save()){
                return redirect('/login')->with('success',"Register success! please login");
            }else{
                return back()->with('fail',"Something went wrong!");
            }
        }
    }
}
