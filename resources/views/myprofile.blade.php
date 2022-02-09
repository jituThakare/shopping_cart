@extends('layouts.user')
@section('title', 'my profile page')

@section('content')
    <section id="products" class="pb-5" style="background-color: greenyellow;min-height:100vh; ">

        <h2 class="text-center py-2">My profiles</h2>
        <div class="container">
            <h3>Recent orders</h3>
            <table class="table table-bordered table-striped bg-white">
                <thead>
                    <tr>
                        <th scope="col">Total price</th>
                        <th scope="col">Order status</th>
                        <th scope="col">Payment mode</th>
                        <th scope="col">Time of order</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order['totalprice'] }}</td>
                            <td>{{ $order['orderstatus'] }}</td>
                            <td>{{ $order['paymentmode'] }}</td>
                            <td>{{ $order['created_at'] }}</td>
                            <td>
                                <a class="mr-2" href="viewOrder/{{ $order['id'] }}">View</a>
                                @if ($order['orderstatus'] != 'cancel')
                                    <a href=" {{ route('cancelorder', ['id'=> $order['id']]) }} ">Cancel</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>My Billing address</h3>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Billing address
                        <span><a class="text-danger pl-2" href="updateAddress"> Edit</a></span>
                    </h5>
                </div>
                <div class="card-body"> 

                    <address>
                        <br>
                       <h6> {{ $user_address['company'] }}</h6>
                       <h6>{{ $user_address['address1'] }}</h6> 
                        {{ $user_address['city'] }},{{ $user_address['state'] }} <br>
                        {{ $user_address['pincode'] }}<br>
                    
                        <a href="">{{ $user_address['email'] }}</a> <br>
                        {{ $user_address['mobile'] }}<br>
                    </address>

                </div>


            </div>
    </section>

@endsection
