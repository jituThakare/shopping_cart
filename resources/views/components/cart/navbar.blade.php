<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">UI MONK</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mr-5">

            @can('isAdmin')
                 <li class="nav-item dropdown pr-2">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Orders
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../admin/orders.php">View orders</a>
                    <a class="dropdown-item" href="#">Add orders</a>
                </div>
            </li>
            @endcan           
           
            <li class="nav-item dropdown pr-2">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Category
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="mobiles">Mobiles</a>
                    <a class="dropdown-item" href="t-shirt">T-shirts</a>
                    <a class="dropdown-item" href="#">Jeans</a>
                </div>
            </li>
            @can('isAdmin')
                 <li class="nav-item dropdown pr-2">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Products
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../admin/products.php">view products</a>
                    <a class="dropdown-item" href=" {{ route('addproduct') }} ">add products</a>
                </div>
            </li>
            @endcan
           
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>

            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6  sm:block pt-2 mx-2">
                    @auth
                        <li class="nav-item dropdown pr-2">
                            <a class="nav-link text-warning dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('my-profile') }}">My Profile</a>
                                <a class="dropdown-item" href="/shopping-cart/show-wishlist.php">Wishlist</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <input type="submit" value="logout">
                                </form>

                            </div>
                        </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="text-sm nav-link text-gray-700 text-primary  underline d-inline">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-sm text-gray-700  nav-link d-inline text-primary underline">Register</a>
                        @endif
                    </li>
                    @endauth
                </div>
            @endif

        </ul>
        <form class="form-inline my-2 my-lg-0">

            @php
                $total = 0;
                if (session('cart')) {
                    $cart = session('cart');
                    $count = count($cart);
                    // print_r($cart);
                } else {
                    // $cart = $_SESSION['cart'];
                    $count = 0;
                }
            @endphp

            <li class="nav-item dropdown ml-5 list-unstyled">
                <div class="dropdown">
                    <button type="button" class="btn btn-info dropleft" data-toggle="dropdown">
                        <i class="fas fa-cart-plus fa-1x"></i> Cart <span class="badge badge-warning">
                            <?php echo $count; ?> </span>
                    </button>

                    <div class="dropdown-menu bg-warning"
                        style="left:-238px!important;min-width:15vw!important;padding: 20px!important;top:123%"
                        aria-labelledby="navbarDropdown">
                        @isset($cart)
                            @foreach ($cart as $id)
                                <div class="row text-center">
                                    <div class="col-lg-4 px-0">
                                        <img src=" {{ asset('storage/' . $id['image']) }}" width="70%" height="70%"
                                            alt="proImg">
                                    </div>
                                    <div class="col-lg-8 px-2">
                                        <p class="mb-1 text-warning font-weight-bold"> {{ $id['p_name'] }} </p>
                                        <div class="row">
                                            <div class="col-lg-6 px-0">INR {{ $id['price'] }} </div>
                                            <div class="col-lg-6 px-0">Quantity: {{ $id['quantity'] }} </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    
                                    $total = $total + $id['price'] * $id['quantity'];
                                @endphp
                            @endforeach
                        @endisset

                        <div class="row align-items-center px-3">
                            <div class="col-lg-6"> <i class="fas fa-cart-plus fa-1x"></i>
                                <span class="badge badge-warning">{{ $count }}</span>
                            </div>
                            <div class="col-lg-6">
                                <p class="font-weight-bold"> Total: INR<br>{{ $total }}
                                    .00/-</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row px-3 ">
                            <div class="col-lg-12 col-sm-12 col-12 text-center "></div>
                            @isset($cart)
                                 <a href="checkout" class="btn btn-primary btn-block">Checkout</button>
                            @endisset                           
                                <a href="cart" class="btn btn-primary btn-block">Cart</a>
                        </div>

                    </div>
                </div>
            </li>

            {{-- <a class="nav-link text-white pr-5 btn-info btn" href="cart.php"><i class="fas fa-cart-plus fa-1x "></i> Cart <span class="badge badge-warning">
          <?php echo $count; ?>
      </span></a> --}}
        </form>
    </div>
</nav>
