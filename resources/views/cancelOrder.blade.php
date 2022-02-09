@extends('layouts.user')
@section('title', 'view order page')

@section('content')
    <section id="products" class="pb-5" style="background-color: greenyellow;min-height:100vh; ">

        <h2 class="text-center py-2">Cancel orders</h2>
        <div class="container">
            <h3>Products information  in orders</h3>
            <table class="table table-bordered table-striped bg-white text-center">
                <thead>
                    <tr >
                        <th scope="col">Product name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total price</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderDetails as $product)
                        <tr>
                            <td>
                                <a href="single.php">{{ $product['product_name'] }} </a>
                            </td>
                            <td> {{ $product['quantity'] }}</td>
                            <td> {{ $product['productprice'] }} </td>
                            <td> {{ $product['quantity'] * $product['productprice'] }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                <tfoot style="border-top: double;">                   
                    <tr>
                        <td></td>
                        <td></td>
                        <th>Total price</th>
                        <td>{{ $order_data['totalprice'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <th>Order status</th>
                        <td>{{ $order_data['orderstatus'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <th>Date of order</th>
                        <td>{{ $order_data['created_at'] }}</td>
                    </tr>
                </tfoot>
            </table>
            <form  method="post">
                @csrf
                <div class="container">
                    <div class="form-group w-75 mx-auto">
                        <input type="hidden" name="orderid" value="{{ $order_data['id'] }}">
                        <label class="text-bold" style="font-size: 23px;font-weight: 500;">Reason</label>
                        <textarea class="form-control" name="reason" rows="7" id="reason"></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger d-flex m-auto text-center" name="cancel" >Cancel order</button>
    
                </div>
            </form>
    
        </div>
    </section>

@endsection
