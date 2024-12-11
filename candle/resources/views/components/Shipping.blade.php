<?php
App\Http\Controllers\InformationController::class;
?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shipping</title>
    <link rel="stylesheet" href="{{ asset('css/shipping.css') }}">
</head>
<body>
<header class="heading">
    <div class="nav-desktop">
        <div>
            <button class="logo-b" onclick="window.location.href='/'">
                <img class="logo" src="{{ asset('images/logo.png') }}" alt="Example Image">
            </button>
        </div>
    </div>
</header>

<div class="cart-container">
    <div class="left-section">

        <h3 >Shipping Method</h3>
            <form action="{{ route('shipping.save') }}"  method="POST">
                @csrf
                <div class="shipping">
                    <input class="round-checkbox" type="radio" name="shipping" value="standard" required>
                    <div class="typee">Standard Shipping</div>
                    <div class="pricee">Free</div>
                </div>
                <div class="shipping">
                    <input class="round-checkbox" type="radio" name="shipping" value="middle">
                    <div class="typee">Middle Shipping</div>
                    <div class="pricee">Paid: adding $4</div>
                </div>
                <div class="shipping">
                    <input class="round-checkbox" type="radio" name="shipping" value="vip">
                    <div class="typee">VIP Shipping</div>
                    <div class="pricee">Paid: adding $10</div>
                </div>
                <button type="submit">Save and Continue</button>
            </form>

        <form action="{{ route('pay.show') }}" method="POST">
            @csrf

            <h3>Shipping Details </h3>
            <input type="text" name="email" value="Contact: {{ auth()->user()->email }}" disabled>
            <input type="text" name="email" value="Country: {{ session('existingInformation')->country }}" disabled>
            <input type="text" name="email" value="City: {{ session('existingInformation')->city }}" disabled>
            <input type="text" name="email" value="Street Address: {{ session('existingInformation')->address }}" disabled>
            <input type="text" name="email" value="Phone Number: {{ session('existingInformation')->phone_number }}" disabled>
            @if(session('selected'))
                 <button type="submit">Go to payment</button>
            @else
                <p style="color: red;">please select shipping method to continue</p>
                <button type="submit" disabled>Go to payment</button>
            @endif
        </form>
        <form action="{{route('cart.details')}}" method="GET">
            @csrf
            <button type="submit">Back to details</button>
        </form>
    </div>

    <div class="right-section">
        <table  class="table">
            <h3>Cart</h3>
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach((session('shipcart')) as $item)
                <tr>
                    <td>
                        <img  src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }} ">
                        <p>{{ $item->product->name }}</p>
                    </td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                    <td>
                        <span>{{ $item->quantity }}</span>
                    </td>
                    <td>${{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @if(session('coupon_code'))
            <input type="text" name="coupon_code" placeholder="coupon code: {{session('coupon_code')}}" disabled>
            <p>Coupon Applied: {{ session('coupon_code') }}</p>
        @if( session('shipping_method')==='standard')
                <p>Shipping: {{session('shipping_method')}} Free</p>
                    <?php session(['aftermethod' => session('NewT')]); ?>
                <p>Total: ${{ session('aftermethod') }}</p>

            @elseif(session('shipping_method')==='middle')
                <p>Shipping: {{session('shipping_method')}} $4</p>
                    <?php session(['aftermethod' => session('NewT') + 4 ]); ?>
                <p>Total: ${{ session('aftermethod') }}</p>

            @elseif(session('shipping_method')==='vip')
                <p>Shipping: {{session('shipping_method')}} $10</p>
                    <?php session(['aftermethod' => session('NewT') + 10 ]); ?>
                <p>Total: ${{ session('aftermethod') }}</p>

            @else
                <p>Shipping: Shipping method not specified!</p>
                <p>Total: ${{ session('NewT')}}</p>

            @endif
        @else
        <input type="text" name="coupon_code" placeholder="coupon code: No coupon used" disabled>
            @if( session('shipping_method')==='standard')
                <p>Shipping: {{session('shipping_method')}} Free</p>
                    <?php session(['aftermethod' => session('NewT')]); ?>
                <p>Total: ${{ session('aftermethod') }}</p>

            @elseif(session('shipping_method')==='middle')
                <p>Shipping: {{session('shipping_method')}} $4</p>
                    <?php session(['aftermethod' => session('NewT') + 4 ]); ?>
                <p>Total: ${{ session('aftermethod') }}</p>

            @elseif(session('shipping_method')==='vip')
                <p>Shipping: {{session('shipping_method')}} $10</p>
                    <?php session(['aftermethod' => session('NewT') + 10 ]); ?>
                <p>Total: ${{ session('aftermethod') }}</p>

            @else
                <p>Shipping: Shipping method not specified!</p>
                <p>Total: ${{ session('NewT')}}</p>

            @endif
        @endif
    </div>
</div>

</body>
</html>
