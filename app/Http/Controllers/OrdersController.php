<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\orderTracking;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index($id)
    {
         //  ****  use auhtorization orders model class  ****
        //      $this->authorize('isAdmin', Orders::class );

        // ****** use order relationship model has many relationship *****
        // $orders_track = Orders::find('1')->orderTracking;
        // $orders_track = Orders::find('1')->orderItems ->first();;
        // dd($orders_track);


        $orders = OrderItems::join('products', 'order_items.productid', '=', 'products.id')
            ->where('order_id', $id)->get();
        //    dd($orders);

        $orders_details = Orders::where('id', $id)->first();
        
        // dd($orders_details['userid']);  
        // dd( $orders_details['paymentmode'] , $orders_details['userid']);  

        //***   eloquent model binding  ****

        //    dd($orders_details->toJson());
            //   dd($orders_details->toJson(JSON_PRETTY_PRINT));

        //    dd($orders_details->toArray());
        //    dd($orders_details->attributesToArray());

            //   $orders_details = OrderItems::all();
            // dd($orders_details->toArray());           
            // dd($orders_details::all());

            // $orders_details->makeVisible('productid')->toArray();
            // dd($orders_details);

        //   dd((string) OrderItems::find(1));
        //    dd( $orders_details->append('is_admin')->toArray() );
        //    return $user->toJson();



        return view('viewOrder')->with('orderDetails', $orders)
            ->with('order_data', $orders_details);
    }

    public function cancelOrder($id)
    {
        // use auhtorization orders model class
        // $this->authorize('isAdmin', Orders::class );

        

        $orders = OrderItems::join('products', 'order_items.productid', '=', 'products.id')
            ->where('order_id', $id)->get();
        //    dd($orders);

        $orders_details = Orders::where('id', $id)->first();
        // dd($orders_details);  

        return view('cancelOrder')->with('orderDetails', $orders)
            ->with('order_data', $orders_details);
    }

    public function destroy(Request $request) {
        // dd($request);
        $insertQuery = new orderTracking();
        $insertQuery->order_id = $request->orderid;
        $insertQuery->status = 'cancel';
        $insertQuery->reason = $request->reason;

         $insert_result = $insertQuery->save();

         $o_id = $request->orderid;

         if($insert_result){
             $update_order = Orders::where('id', $o_id)
                            ->update([
                                'orderstatus' => 'cancel'
                            ]);
         };

         return redirect()->route('my-profile');

    }
}
