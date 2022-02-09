<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id; 

        $order = Orders::where('userid' , $user_id)->get();
        // dd($order);

        $user_address = UserData::where('user_id', $user_id)->first();
        // dd($user_address);

        return view('myprofile')->with('orders',  $order)
                                ->with('user_address' , $user_address);
    }
}
