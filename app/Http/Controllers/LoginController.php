<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function register() {
        // dd("hrllo");
       return view('register');
    }

    // public function register_user(Request $request) {
    //     $request->validate([          
    //         'name' => 'required',
    //         'email' => 'required | email | unique:users',
    //         'password' => 'required | min:2 | max:5'
    //     ]);

    //     // dd($request);

    //     $user = new Users();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password) ;
    //     $res = $user->save();

    //     if ($res) {
            
    //     } else {
    //         return back()->with('fail' , 'something is worng ') ;
    //     }        

    //     return "value posted";
    // }
}
