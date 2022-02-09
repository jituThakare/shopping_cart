<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index($param = null) {
    // public function index($param = null) {
        
        if ($param) {
            $products = Products::where('cat_name', $param)->get();
            // var_dump($products);
            // exit;
            if( empty($products ) ) {
                $products = Products::get();

            }
            // else{

            //         //  return "not";
            //         //  exit;
            // }
        } else {
            $products = Products::get();
        }
        
        
        // echo '<pre>';
        // print_r($products);
        // exit;

        $products = Products::get();

        return view('homepage')->with('products', $products);
    }
}
