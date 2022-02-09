<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {

        $cart = session()->get('cart');
        if ($cart) {
            $total = 0;
            foreach ($cart as $id) {
                $total = $total + ($id['quantity'] * $id['price']);
            }
        } else {
            $total = 0;
        }
        // dd($total);       

        return view('checkout')->with('total', $total);
    }

    public function store(Request $request)
    {

        $data =  $request->validate([
            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'company' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'postcode' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'payment' => ['required'],
            'agree' => ['required'],
        ]);

        $user_id = Auth::user()->id;

        $check_user = UserData::where('user_id', $user_id)->count();
        // dd($dat);

        if ($check_user) {

            $user_add = UserData::where('user_id', $user_id)
                ->update([
                    'firstname' => $request->fname,
                    'latsname' => $request->lname,
                    'company' => $request->company,
                    'address1' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'pincode' => $request->postcode,
                    'email' => $request->email,
                    'mobile' => $request->phone,
                    'payment' => $request->payment
                ]);
            // dd($user_update);            

        } else {
            $user = new UserData();
            $user->user_id = Auth::user()->id;
            $user->firstname = $request->fname;
            $user->latsname = $request->lname;
            $user->company = $request->company;
            $user->address1 = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->pincode = $request->postcode;
            $user->email = $request->email;
            $user->mobile = $request->phone;
            $user->payment = $request->payment;

            $user_add = $user->save();
        }

        // dd($user_add);
        $cart = session()->get('cart');

        $total = 0;
        foreach ($cart as $id) {
            $total = $total + ($id['quantity'] * $id['price']);
        }

        $order = new Orders();
        $order->userid = $user_id;
        $order->totalprice = $total;
        $order->orderstatus = 'order placed';
        $order->paymentmode = $request->payment;

        $check = $order->save();

        // get the last insert order id
        $order_id1 = $order->id;
        $order_id = strval($order_id1);

        //    var_dump($order_id);
        //    exit;

        $cart = session()->get('cart');
        //    dd($cart);

        // dd($cart[1]['p_id']);
        //   dd(OrderItems::all());


        // if () {
        foreach ($cart as $id) {
            //    $id1 = implode(" ",$id);

            $price = $id['price'];
            $quantity = $id['quantity'];
            $p_id = $id['p_id'];

            $or_items = new OrderItems();
            $or_items->order_id = $order_id;
            $or_items->productid = $p_id;
            $or_items->quantity = $quantity;
            $or_items->productprice = $price;

            $or_items->save();
        };
        // }         
        // dd($order_id);        
        //  return back()->with('status', 'data submitted');
        return redirect('myprofile');
    }
    public function showUpdateForm()
    {
        return view('updateAddress');
    }
    public function updateAddress(Request $request)
    {

        $user_id = Auth::user()->id;
        $check_user = UserData::where('user_id', $user_id)->first();
        // dd($check_user,$request);

        if ($check_user) {
            $check_user->update([

                'company' => $request->company,
                'address1' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->postcode,
                'email' => $request->email,
                'mobile' => $request->phone,
            ]);
            // dd($user_update);            
            return redirect('myprofile');
        }
    }
}
