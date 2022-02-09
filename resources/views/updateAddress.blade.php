@extends('layouts.user')
@section('title', 'home page')

@section('content')

    <section id="checkout" class="text-white" style="background-color: #1f7b87; ">
        <div class="py-3">
            <h2 class="text-center">Update address</h2>
            <p class="text-center">Get the best experience</p>
        </div>
        <div class="container pb-5">
            <div class="row justify-content-center ">
                <div class="col-md-8">

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
                        
                        <button type="submit" class="btn btn-primary" name="submit" name="paynow">Update Address</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
