<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style ></style>
</head>
<body>
<?php session(['selected' => 0]); ?>
<?php session(['shipping_method' =>0]);?>
<?php session(['NewT' => 0]); ?>
<?php session(['coupon_code'=> 0]);?>
<?php session(['aftermethod' =>0]); ?>
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

    <img width="1520"  src="{{ asset('images/heading.png') }}" alt="Example Image">

</header>
<h2 class="title-h2">Product Table</h2>

<div class="section-products">
    @foreach($products as $product)
        <a href="{{ route('product.show', $product->id) }}" class="product-link">
            <div class="product-card">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                <div class="product-name">{{ $product->name }}</div>
                <div class="product-price">${{ number_format($product->price, 2) }}</div>
            </div>
        </a>
    @endforeach
</div>
        <img class="section-popular" src="{{ asset('images/section-popular.png') }}" alt="Example Image">
        <img class="section-benefits" src="{{ asset('images/section-benefits.png') }}" alt="Example Image">
        <img class="section-testimonials" src="{{ asset('images/section-testimonials.png') }}" alt="Example Image">

    <img class="footer-widgets" src="{{ asset('images/footer-widgets.png') }}" alt="Example Image">

</body>
</html>
