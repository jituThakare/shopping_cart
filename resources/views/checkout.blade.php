@extends('layouts.user')
@section('title', 'home page')

@section('content')

    <section id="checkout" class="text-white" style="background-color: #1f7b87; ">
        <div class="py-3">
            <h2 class="text-center">Shop Checkout</h2>
            <p class="text-center">Get the best kit for smooth shave.</p>
        </div>
        <div class="container pb-5">
            <div class="row justify-content-center ">
                <div class="col-md-8">
                    <h3 class="py-2">Billing details</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{{ session('status') }}</li>
                            </ul>
                        </div>
                    @else
                    @endif

                    @php
                        use App\Models\UserData;                        
                        $check_user = UserData::where('user_id', Auth::user()->id)->first();
                        // print_r($check_user);
                        // dd($check_user);
                    @endphp

                    <form method="post">
                        @csrf
                        <div>
                            <label for="country">Country</label>
                            <select class="custom-select form-group" name="country">
                                <option value="">select country</option>
                                <option value="IN">India</option>
                                <option value="PK">Pakistan</option>
                                <option value="BA">Bangladesh</option>
                                <option value="NE">Nepal</option>
                                <option value="CH">China</option>
                                <option value="RU">Russia</option>
                                <option value="US">United state</option>
                                <option value="FR">France</option>
                            </select>
                        </div>
                        <div class="row ">
                            <div class="col form-group">
                                <label for="inputAddress">first name</label>
                                <input type="text" class="form-control" name="fname"
                                    value="@isset($check_user)  {{ $check_user->firstname }}  @endisset">

                            </div>
                            <div class="col form-group">
                                <label for="inputAddress">Last name</label>
                                <input type="text" class="form-control" name="lname"
                                    value="@isset($check_user)  {{ $check_user->latsname }}  @endisset">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company">Company name</label>
                            <input type="text" class="form-control" name="company" id="company"
                                value="@isset($check_user)  {{ $check_user->company }}  @endisset">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" name="address"
                                value="@isset($check_user)  {{ $check_user->address1 }}  @endisset">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" name="city"
                                    value="@isset($check_user)  {{ $check_user->city }}  @endisset"
                                    id="inputCity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State/Country</label>
                                <input type="text" class="form-control" name="state" id="inputState"
                                    value="@isset($check_user)  {{ $check_user->state }}  @endisset">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputZip">Zip/Postcode</label>
                                <input type="text" name="postcode" class="form-control" id="inputZip"
                                    value="@isset($check_user)  {{ $check_user->pincode }}  @endisset">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                value="@isset($check_user)  {{ $check_user->email }}  @endisset">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone</label>
                            <input type="integer" name="phone" class="form-control" id="exampleInputPassword1"
                            value="@isset($check_user){{$check_user->mobile}} @endisset" >
                        </div>

                        <div class="your-order">
                            <h3>Your order</h3>
                            <table class="table table-bordered table-dark">
                                <tbody>
                                    <tr>
                                        <th scope="col">Cart subtotal</th>
                                        <td>
                                            @if (isset($total))
                                                {{ $total }}.00 /-
                                            @else
                                                {{-- {{$total}} --}}
                                                <p>cart empty</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Shipping nad handling</th>
                                        <td>Free shipping</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Order total</th>
                                        <td>
                                            @if (isset($total))
                                                {{ $total }}.00 /-
                                            @else
                                                <p>Order not placed</p>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="payment">
                            <h3>Payment method</h3>
                            <div class="row m-4">
                                <div class="col-md-4  form-group  custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="payment" value="cod"
                                        class="custom-control-input" 
                                        @isset($check_user) 
                                        @if ($check_user->payment == 'cod')
                                            checked
                                        @endif                                            
                                        @endisset>
                                    <label class="custom-control-label" for="customRadio1">COD</label>
                                </div>
                                <div class="col-md-4 form-group custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="payment" value="paypal"
                                        class="custom-control-input"
                                        @isset($check_user) 
                                        @if ($check_user->payment == 'paypal')
                                            checked
                                        @endif                                            
                                        @endisset>
                                    <label class="custom-control-label" for="customRadio2">Paypal </label>
                                </div>
                                <div class="col-md-4 form-group custom-control custom-radio">
                                    <input type="radio" id="customRadio3" name="payment" value="check"
                                        class="custom-control-input"
                                        @isset($check_user) 
                                        @if ($check_user->payment == 'check')
                                            checked
                                        @endif                                            
                                        @endisset>
                                    <label class="custom-control-label" for="customRadio3">Check Payment</label>
                                </div>
                            </div>
                        </div>

                        <div class="custom-control custom-checkbox form-group">
                            <input type="checkbox" class="custom-control-input" value="true" name="agree" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">I've read and accept <span
                                    class="text-danger"><b>Terms & conditions</b> </span>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" name="paynow">PAY NOW</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
