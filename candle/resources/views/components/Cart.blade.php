<?php
namespace App\Http\Controllers\CartController;
use App\Models\Cart;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
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
            <img class="cart"  src="{{ asset('images/Cart.png') }}" alt="Example Image">
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

    <div  class="container">
        <h2 class="itemm">Your cart items</h2>
        <a href="{{ route('product.fetch') }}" >Back to shopping</a>
        <table  class="table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td>
                        <img  src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }} ">
                        <p>{{ $item->product->name }}</p>
                        <a href="{{ route('cart.remove', $item->id) }}">Remove</a>
                    </td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                    <td>
                        <span>{{ $item->quantity }}</span>
                    </td>
                    <td>${{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
            <td></td>
            <td></td>
            <td></td>
            <td>
                @auth()
                    <form  action="{{route('cart.details')}}" method="GET">
                        @csrf
                        <h3 >Sub-total: ${{ number_format($cartItems->sum('total'), 2) }}</h3>
                        <button>Check-out</button>
                    </form>
                @endauth
            </td>
            </tbody>

        </table>

        <div>


        </div>
    </div>
</body>

</html>
