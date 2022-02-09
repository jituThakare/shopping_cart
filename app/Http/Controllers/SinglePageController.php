<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SinglePageController extends Controller
{
    public function index($id) {
        
        $product = Products::where('id', $id)->first();
        // dd($product->id);
        $related_product = Products::get()->random(3);

        // $product_review = Reviews::where('p_id', $id)->get();
        // $product_review = Reviews::where('p_id', $id)->users();
        $reviews = Reviews::join('users', 'reviews.u_id', '=', 'users.id')
               ->where('p_id', $id)->get();
          // $res = $reviews->contains('review');
        // dd($reviews);

        // if ( $reviews->count() ) {
        //   dd('yes');

        // } else {
        //    dd('no');
        // }
        

        // dd(Auth::user()->email);
        // $review = Reviews::get();

        if(Auth::user()) {
           $check_user_review = Reviews::where('p_id',$id )        
                                ->where('u_id' , Auth::user()->id )
                                ->first();
        }
                           
        // echo "<pre>";
        // print_r($review);
        // exit;


        return view('single')->with(['product'=> $product , 'r_products' => $related_product, 'product_review' => $reviews]);

        // return view('single')->with(['product'=> $product , 'r_products' => $related_product, 'user_review' => $check_user_review, 'product_review' => $reviews]);
    }

    public function review_save(Request $request){
    //    dd($request);

          $user_id = Auth::user()->id;
        //   dd($user_id);
      //   DB::table('reviews')->insert([
      //     'p_id' => 9,
      //     'u_id' => 2,
      //     'review' => 'like'
      // ]);
                  

          $review = new Reviews();

          $review->p_id = $request->productid;
          $review->u_id = $user_id;
          $review->review = $request->review;

          // $review->p_id = '1';
          // $review->u_id = '5';
          // $review->review = 'like';

          $review->save();

          return redirect()->back();


    }
}
