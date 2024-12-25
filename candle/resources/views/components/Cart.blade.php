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
<style>
    .product-image-container {
        position: relative;
        display: inline-block;
    }
    .product-image-container img {
        width: 150px;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .quantity-control {
        position: absolute;
        top: 53px;
        right: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50px;
    }
    .quantity-control button {
        width: 30px;
        height: 30px;
        font-size: 18px;
        font-weight: bold;
        border: 1px solid #ddd;
        background-color: #fff;
        color: #333;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border-radius: 50%;
    }
    .quantity-control button:hover {
        background-color: #f1f1f1;
    }

    .quantity-control button:disabled {
        background-color: #e0e0e0;
        cursor: not-allowed;
    }
    .quantity-control .Q {
        font-size: 20px;
        font-weight: bold;
        color: #333;
    }
</style>
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
                @if(session('cartCount') > 0)
                    <span class="cart-badge">{{ session('cartCount')}}</span>
                @endif
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
                        <div class="product-image-container">
                        <img  src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }} ">
                        <div class="quantity-control">

                            <form action="{{ route('product.increment', $item->product_id)  }}" method="POST">
                                @csrf
                                <button class="inc" type="submit">+</button>
                            </form>
                            <h2 class="Q">{{ $item->quantity }}</h2>
                            <form action="{{ route('product.decrement', $item->product_id)  }}" method="POST">
                                @csrf
                                <button class="dec" type="submit" @if($item->quantity <= 1) disabled @endif>-</button>
                            </form>
                        </div>
                        </div>
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
