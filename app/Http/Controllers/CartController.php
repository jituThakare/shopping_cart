<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    

    public function addToCart($id, Request $request)
    {
        // dd($request->quantity);
        if ($request->quantity) {
            $quantity1 = $request->quantity;
        // convert string to integer
            $quantity =intval($quantity1);
            // dd($quantity);
        } else {

            $quantity = 1;
            // dd($quantity);
        }

        $product = Products::find($id);
        // dd($product);
 
        if(!$product) {
             abort(404); 
        }
 
        $cart = session()->get('cart'); 
       // if cart is empty then this the first product
        // dd($cart);
        
        if(!$cart) { 
            // dd($product->image);
            $cart = [
                    $id => [
                        'quantity' => $quantity,
                        'image' => $product->image,
                        'p_name' => $product->product_name,
                        'p_id' => $product->id,
                        'price' => $product->price,                        
                    ]
            ];
 
            session()->put('cart', $cart); 
            // dd($cart);
            return redirect('cart');
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) { 
            
            $cart[$id]['quantity'] = $quantity;
            // dd($cart);                
 
            session()->put('cart', $cart);
            //  dd($cart);
 
            // return redirect()->back()->with('success', 'Product added to cart successfully!');
            return redirect('cart');
 
        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [            
            "quantity" => $quantity ,   
            'image' => $product->image,
            'p_name' => $product->product_name,
            'p_id' => $product->id,
            'price' => $product->price,        
        ];
 
        session()->put('cart', $cart);

        // dd($cart);
 
        return redirect('cart');
        // return redirect()->back();
    }

    public function index()
    {
        // echo"<pre>";
        // echo "this i cart page <br>";
        // dd(session('cart'));
        // exit;
        // $session = session('cart');
        // print_r( session()->get('cart') );
        // exit;
        // print_r( session()->get('cartitem') );
      
        return view('cart');
    }

    public function deleteCart($id = null) {
        if ($id) {
            $cart = session()->get('cart'); 
            // session()->forget('key');

            // dd($cart[$id]['quantity']);

            unset($cart[$id]);
            // dd($cart);

            session()->put('cart',$cart);
            // dd($cart);
            // session()->pull('cart',$cart[$id]);
            // session()->forget($cart[$id]);


            // dd($cart);

           
        //    echo $id;
            // session()->pull( $id);
            // session()->forget($id);
        //    print_r(session()->get('cart' , $id) );
        //    exit;
            // session()->forget('$id');
            return back();
        
          
        //   dd(session()->get('cart'));
        


        } else {
            // echo "no id";
            session()->pull('cart');
            return back();
        }
        
       
    }
}
