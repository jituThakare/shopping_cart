<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function addproduct()
    {
        $category = Category::select('category_name')->get();
        // dd($category);

        return view('add-product')->with('categories', $category);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|unique:products,product_name',
            'product_desc' => 'required',
            'cat_name' => 'required',
            'price' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        $name = $request->file('image')->getClientOriginalName();
        $extension = $request->file('image')->getClientOriginalExtension();
        // dd($extension,$name);
        $img_name = time(). '-' . $name;
        // dd($img_name);
        // $path = $request->file('image')->store('images', 'public');
        $path = $request->file('image')->storeAs('images', $img_name, 'public');
        // $path = $request->file($img_name)->store('public');
        //  $path = $request->file('image')->storeAs(
        //         'public', $img_name
        //     );
        // dd($path);
        //  echo asset("public/images/2hNULd1Gb71mfTYOwYkoUI7RlQ3ItCiIJvVmf3Gn.webp");
        //  exit;      
        $save = new Products();

        $save->product_name = $request->product_name;
        $save->product_desc = $request->product_desc;
        $save->cat_name = $request->cat_name;
        $save->price = $request->price;
        // $save->name = $name;
        $save->image = $path;

        $save->save();

        return redirect()->back()->with('status', 'Image Has been uploaded');
    }



    // Storage::disk('local')->put($request->image, 'public');
    //  echo asset('avatars/DyEARWC0igqQjxrJMubuvwPMYN48mdy3b4JGbWuC.png');
    //  exit;
    // $path = $request->file('image')->storeAs(
    //     'avatars', 'oppo'
    // );
    // $path = $request->file('image')->store('avatars');

    // return $path;
    //         $file = $request->file('avatar');

    // $name = $file->hashName(); // Generate a unique, random name...
    // $extension = $file->extension(); 

    // dd($path);
// }
}
