@extends('layouts.user')
@section('title' , 'home page' )        

@section('content')

<section id="products" style="background-color: greenyellow; min-height:100vh;padding-top:30px ">
    <div class="container">
        <h2 class="text-center">Cart items</h2>
        <form action="removeCart" method="get">
            <input type="submit" name="removeBtn" class="btn btn-danger"style="float: right;display:block;margin:10px 10px"  value="Remove all" />            
        </form>
        
    </div>
    <div class="container">
        <table class="table table-bordered table-striped bg-white">
            <thead>
                <tr class="text-center">
                    <th scope="col">Image</th>
                    <th scope="col">Product name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody> 

                @if (session()->get('cart')) 
                    @php
                         $cart = session()->get('cart');
                    // echo '<pre>';
                    // print_r($cart[2]['price']);
                    // print_r($cart);
                    // echo '<pre>';
                    // exit;
                    $total = 0;
                    @endphp                   
                    
                    @foreach ($cart as $id)                                       
                        <tr class="text-center">
                            <td><img src="{{ asset('storage/'.$id['image'] ) }}" width="100px" height="100px" alt="proImg"> </td>
                            <td><a href="single/{{ $id['p_id'] }}" class="fa-1x">
                                    {{ $id['p_name'] }} </a> </td>
                            <td>{{ $id['quantity'] }}</td>
                            <td>{{ $id['price'] }}</td>
                            <td>{{ $id['quantity'] *  $id['price']   }}</td>
                            <td>
                                <a class="text-danger" href="removeCart/{{ $id['p_id'] }}">
                                    Remove</a>
                            </td>
                        </tr>
                      @php
                          $total = $total + ( $id['price'] * $id['quantity'] ); 
                      @endphp                         
                                       
                    @endforeach
                
                @else            
                    <tr>
                        <td colspan="6">
                            <h4 class="text-center"> Please add items to cart</h4>   
                        </td>                     
                     </tr>
                
                @endif
                
            </tbody>
        </table>

        <div class="text-right mb-3">
            @isset($cart)
              <a class="btn btn-primary mr-5" href="checkout">Checkout</a>
            @endisset
        </div>
        <div class="card">
            <div class="card-header">
                Total
            </div>
            <div class="card-body">
                <p>Total amount:
                    <?php if (isset($total)) {                    
                    echo 'INR.' . $total .'.00' ; }
                    ?>  
                </p>

            </div>
        </div>



    </div>
</section>  

@endsection