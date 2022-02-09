@extends('layouts.admin')
@section('title', 'Admin page')

@section('content')
<div class="container"> 
    <!-- <h2 class="text-center py-5 text-white">Shopping browse categories</h2> -->
    <div class="p-5"> 
       <h2 class="text-center p-2 text-white">Browse Shopping categories </h2>
       <div class="row">
 
        @foreach ($products as $product) 
           {{-- dd($products); --}}
       <div class="col-md-4 my-4"> 
           <div class="card border text-center">
                <img src=" {{ asset('storage/'.$product->image )}} " class="card-img-top" alt="..."
                style="height: 200px;border-bottom:2px solid #000"> 
                <div class="card-body text-white bg-dark"> 
                <h5 class="card-title"> <a href="single.php?productid=' . $product_id . '">
                   {{ $product->product_name }} </a></h5>
                <p class="card-text"> {{ substr($product->product_desc, 0, 80)  }}</p>
                <h6 class="card-text"> INR {{  $product->price }} </h6>
                <hr style="border:1px solid #000">
                <a href="addToCart.php?id=' . $product_id . ' " class="btn btn-primary"><i class="fas fa-cart-plus fa-1x"></i> Add to cart</a>
                <a href="/single/{{ $product->id }}" class="btn btn-dark ml-2"><i class="far fa-eye fa-1x"></i> Details</a>
                </div>
            </div>
       </div> 
       @endforeach 

       </div>

    </div>
</div>
@endsection