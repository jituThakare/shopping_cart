<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;

class UserDataController extends Controller
{
    public function index()
    {

        // this method is used for " test "  route .

        $userdata = User::find('1')->userData;
        // $userreview = User::find('1')->reviews;
        $userreview = User::find('1')->reviews;
        // dd($userdata);
        // dd($userreview);
        $user_orders = User::find('1')->orders;
        // dd($user_orders);

        $order = Orders::where('user_id', 1);
        // dd($order->user);


        // **** Has Many Through intermediate table  ****

        $user_order_items = User::find('1')->ordersItems;
        // dd($user_order_items);

        // **inverse relationship *** 

        $userdata2 = UserData::where('user_id', '1')->first();
        // dd($userdata2);        
        // dd($userdata2->user);
    }
}
