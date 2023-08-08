<?php

namespace App\Http\Controllers;

use App\Models\register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class loginController extends Controller
{   

    public function login(){
        return view('login.login');
    }
    public function loginProcess(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $res = Auth::attempt($credentials);
        if($res){
            return redirect('/');
        }else{
            return back()->with('fail',"Username or password invalid");
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
