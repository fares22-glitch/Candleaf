<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header class="heading">
    <div class="nav-desktop">
        <div>
            <button class="logo-b" onclick="window.location.href='/'">
                <img class="logo" src="{{ asset('images/logo.png') }}" alt="Example Image">
            </button>
        </div>
        <div >
            <div class="discovery">Discovery</div>
            <div class="about">About</div>
            <div class="contact-us">Contact us</div>
        </div>

        <button class="but-f">
            <img class="profile" src="{{ asset('images/Profile.png') }}" alt="Example Image">
            @auth
                <p class="first">
                    {{ auth()->user()->first_name }}
                </p>
            @endauth
        </button>
        <button class="but-c">
           @auth()
                <form  action="{{route('cart.show')}}" method="GET">
                    @csrf
                    <button class="but-c" type="submit">
                        <img class="cart" src="{{ asset('images/Cart.png') }}" alt="Cart">
                        @if(session('cartCount') > 0)
                            <span class="cart-badge">{{ session('cartCount')}}</span>
                        @endif
                    </button>
                </form>
            @endauth
            @guest()
                <img class="cart" src="{{ asset('images/Cart.png') }}" alt="Cart">
               @endguest
        </button>

        <div >
            @guest
                <button
                    class="login bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    onclick="window.location.href='/login'"
                    :class="{ 'active': request()->is('login') }">
                    Log In
                </button>

                <button
                    class="register bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    onclick="window.location.href='/register'"
                    :class="{ 'active': request()->is('register') }">
                    Register
                </button>
            @endguest
            @auth
                <form method="POST" action="/logout">
                    @csrf

                    <button class="logout bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    >Log Out</button>
                </form>
            @endauth

        </div>

    </div>

</header>
<<img class="sh-image" src="{{ asset($product->image) }}" alt="{{ $product->name }} ">

<img class="des" src="{{ asset('images/description.png') }}" alt="Example Image">
<img class="details" src="{{ asset('images/details.png') }}" alt="Example Image">
<img class="subscription" src="{{ asset('images/subscription.png') }}" alt="Example Image">

<p class="product-n">{{ $product->name }}</p>
<p class="price">{{ number_format($product->price, 2) }} USD</p>

<div class="quantity">
    <p class="descriptionQ">Quantity</p>
    <div class="quantity-control">

            <form action="{{ route('cart.increment') }}" method="POST">
                @csrf
                <button class="inc" type="submit">+</button>
            </form>
            <h2 class="Q">{{ session('Q', 1) }}</h2>
            <form action="{{ route('cart.decrement') }}" method="POST">
                @csrf
                <button class="dec" type="submit" @if(session('Q', 1) <= 1) disabled @endif>-</button>
            </form>
    </div>
</div>
@auth()
<form action="{{ route('cart.add') }}"  action method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" value="{{ session('Q', 1) }}">

    <button class="buttonCart" type="submit">
        <img class="label" src="{{ asset('images/label.png') }}" alt="Add to Cart">
    </button>
</form>
@endauth
@guest()
    <button onclick="location.href='/login';" class="buttonCart" type="submit">
        Log in to order
    </button>
@endguest

<img class="footer-w" src="{{ asset('images/footer-widgets.png') }}" alt="Example Image">
</body>
</html>
