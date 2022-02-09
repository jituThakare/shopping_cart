@extends('layouts/user')
@section('title' , 'product info' )       

@section('content')

<section id="single-page" style="min-height: 1000px;">
    <div class="container pb-5">
        <div class="row categories-item text-white pt-5">
            
            <div class="col-md-6 my-2 text-center lh-1">
                <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top w-75 h-75 pt-4" alt="..." style="max-height:400px !important ">
            </div>
            <div class="col-md-6 py-5 px-3">
                <h2 class="text-capitalize">{{ $product->product_name }}</h2>
                <h6>INR {{$product->price}} </h6>
                <p> {{$product->product_desc}} </p>
                <div class="row mb-2">
                    <div class="col-md-5">
                        <p class="mb-0 pt-2">Quantity:</p>
                    </div>
                    <div class="col-md-4 ">
                        <form action="/addToCart/{{$product->id}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <input type="number" class="form-control" value="1" min="1" max="10" name="quantity" class="w-75" id="quantity">
                    </div>
                </div>
                
                <p> Categories :- 
                    <a class="text-warning fw-bold" href="{{ route('home', ['cat_name'=>$product->cat_name ]) }}">{{ $product->cat_name }}   </a>                   
                <p>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-cart-plus fa-1x"></i> Add to cart</button>

                    </form>
                    <a href="wishlist.php " class="btn btn-dark ml-2"><i class="fas fa-heart fa-1x"></i> Wishlist</a>
                </div>
            </div>
        </div>

        <nav>
            <div class="nav nav-tabs bg-warning" id="nav-tab" role="tablist">
                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Details</a>
                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Reviews</a>
              
            </div>
        </nav>
        

        <div class="tab-content bg-white pt-2" id="nav-tabContent">
            <div class="tab-pane fade active show p-3" id="nav-home" role="tabpanel"
                  aria-labelledby="nav-home-tab">
                <p>{{ $product->product_desc }}</p>

                <div class="card">
                    <h5 class="card-header">Related products</h5>
                    <div class="card-body">
                        <div class="row mb-5">
                            {{-- {{ dd($r_product) }} --}}
                           @foreach ($r_products as $r_product)
                        <div class="col-md-4 my-4">
                            <div class="card border text-center">
                                <img src="{{ asset('storage/'.$r_product->image) }}" class="card-img-top " style="height: 183px;" alt="...">
                                <div class="card-body bg-dark text-white"> 
                                    <h5 class="card-title"> <a href="/single/{{$r_product->id}}">{{ $r_product->product_name }}</a></h5>
                                    <p class="card-text">{{ substr($r_product->product_desc, 0, 80) }}</p>
                                    <h6 class="card-text">INR {{ $r_product->price }}</h6>
                                    <hr style="border:1px solid #000">
                                
                                    <a href="{{ route('single',['id'=>$product->id ]) }}" class="btn btn-primary ml-2"><i class="far fa-eye fa-1x"></i> Details</a>

                            </div>
                            </div>
                        </div> 
                            
                          @endforeach                                                 
                     </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade p-5 " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="comment-section">
                    <h4>Reviews for</h4>
                    @if ( $product_review->count() ) 
                        
                        <ul>
                        @foreach ($product_review as $review)
                            <li>
                                <div class="row my-2">
                                    <div class="col-md-2 text-warning">{{$review->name}}</div>
                                    <div class="col-md-4">{{$review->created_at}}</div>
                                </div>
                                <p class="comment-text">{{$review->review}}</p>
                            </li>
                        @endforeach
                        </ul>                   
              
                    @else 
                        <h5 class="text-center ">Add first reviews for product.</h5>
                    @endif               
            
                </div>
                <div class=" review-form mx-auto">
                    <h4 class="py-2">Add a review</h4>

                    @php
                         use App\Models\Reviews;
                         if (Auth::user()) {
                              $check_user_review = Reviews::where('p_id',$product->id )        
                                    ->where('u_id' , Auth::user()->id )
                                    ->first();
                         }
                        
                    @endphp

                    @if (Auth::user())
                        @if ($check_user_review)                             
                           <h5 class="text-center ">You already submitted reviews for this product.</h5> 
                            @else 
                            @if (Auth::user() )
                            
                                <form  method="post">
                                @csrf
                                    <div class="row form-row form-group">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control"  name="name" id="name" value="{{ Auth::user()->name}} " readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text"  class="form-control"  name="email" id="email" value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <input type="hidden" name="productid" value="{{ $product->id }} ">
                                        <label class="text-bold">Review</label>
                                        <textarea class="form-control" name="review" rows="3" id="reason" placeholder="Enter your comment !"></textarea>
                                    </div>
                                    <input type="submit" class="btn btn-primary"  value="Submit review">                              

                                </form>
                                {{-- @else
                                <h6>Log in for add review.</h6>                       
                             --}}
                            @endif                          
                        @endif
                        @else
                        <h6>Log in for add review.</h6>  
                        
                    @endif             
                
                </div>
 
            </div>
        </div>
    </div>

</section>
    
@endsection