<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{   

    public function login(){
        return view('Login.login');
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
