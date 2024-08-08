<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        return view("login");
    }

    public function register(){
        return view("register");
    }

    public function createuser(Request $request){
        $formFields=$request->validate([
            "name"=>"required",
            "email"=>["required","email"],
            "password"=>"required||confirmed",
        ]);

        User::create($formFields);
        return redirect("/")->with("message","Register Succcess, now try login");
        
    }

    public function autification(Request $request){
        $formFields=$request->validate([
            "email"=>"required",
            "password"=>"required",
        ]);

        if(auth()->attempt($formFields)){
            return back()->with("message","Login Success, welcome");
        }
        return back()->withErrors(['name'=>'Invalid Credentials'])->onlyInput("name");;

    }

}
