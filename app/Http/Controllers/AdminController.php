<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class AdminController extends Controller
{
    public function show(){
        $products = Products::get();
        // dd($products);

        return view('adminpage')->with('products', $products); 

    }
}
