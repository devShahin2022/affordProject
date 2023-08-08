<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class usersTableController extends Controller
{ 
    public function getAllUsers(){
        $users = user::all();
        return view("admin.allusers.user",['users'=>$users]);
    }
    public function privilige(){
        $users = user::where('role','admin')->get();
        return view("admin.privilige.privilige",['users'=>$users]);
    }
    public function changeRole($name,$id,$csrf){
        if($csrf == session('csrf')){
            $user = user::where('id',$id)->first();
            if($name === "disabled"){
                $user->status = 0; //boolean value
                $user->save();
                session()->pull('csrf', $csrf);
                return back()->with('success','User maked disabled');
            }
            if($name === "active"){
                $user->status = 1; //boolean value
                $user->save();
                session()->pull('csrf', $csrf);
                return back()->with('success','User maked active');
            }
            if($name === "teacher"){
                $user->role = 'teacher';
                $user->save();
                session()->pull('csrf', $csrf);
                return back()->with('success','User maked teacher');
            }
            if($name === "student"){
                $user->role = 'student';
                $user->save();
                session()->pull('csrf', $csrf);
                return back()->with('success','User maked student');
            }
            if($name === "admin"){
                $user->role = 'admin';
                $user->save();
                session()->pull('csrf', $csrf);
                return back()->with('success','User maked admin');
            }
            else{
                return back()->with('fail','tag name not valid!');
            }
        }else{
            return back()->with('error','Cross site scripting.');
        }
    }
    public function searchUser(Request $request){ 
        $validated = $request->validate([
            'search' => 'required'
        ]);
        $user = new user();
        $res = $user->search($request->search)->all();
        return view("admin.allusers.user",['users'=>$res,'isSearch'=>$request->search]);
    } 
    public function changePrivilige(Request $request){
        $ps = $request->priviligeSlag;
        $user = user::where('id',$request->id)->first();
        if($ps == 'read'){
            $user->privilige =0;
            $user->save();
            return back()->with('success',"admin previlige change to `read`");
        }
        else if($ps == 'createUpdatePart'){
            $user->privilige =1;
            $user->save();
            return back()->with('success',"admin previlige change to `create and update particular`");
        }
        else if($ps == 'createUpdateAll'){
            $user->privilige =2;
            $user->save();
            return back()->with('success',"admin previlige change to `create and update whole site`");
        }
        else if($ps == 'updatePart'){
            $user->privilige =3;
            $user->save();
            return back()->with('success',"admin previlige change to `Update particular`");
        }
        else if($ps == 'updateAll'){
            $user->privilige =4;
            $user->save();
            return back()->with('success',"admin previlige change to `Update whole site`");
        }
        else if($ps == 'create'){
            $user->privilige =5;
            $user->save();
            return back()->with('success',"admin previlige change to `You can create`");
        }
        else if($ps == 'deletePart'){
            $user->privilige =6;
            $user->save();
            return back()->with('success',"admin previlige change to `Delete particular`");
        }
        else if($ps == 'deleteAll'){
            $user->privilige =7;
            $user->save();
            return back()->with('success',"admin previlige change to `Delete whole site`");
        }
        else if($ps == 'allPower'){
            $user->privilige =8;
            $user->save();
            return back()->with('success',"admin previlige change to `All power`");
        }
        else{
            return back()->with('fail',"Error!your slag unmatch!");
        }
    }
}
