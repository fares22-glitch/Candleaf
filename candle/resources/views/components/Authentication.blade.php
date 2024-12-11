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
    <title>Authentication</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
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
            <h2>Contact</h2>
            <form action="{{route('information.store')}}"   method="POST">
                @csrf
                <label for="">Your Email</label>
                <input type="text" name="email" value="{{ auth()->user()->email }}" disabled>

{{--                <label>--}}
{{--                    <input type="checkbox"> Add me to the newsletter for a 10% discount--}}
{{--                </label>--}}

                <h3>Shipping Address</h3>
                <input type="text" name="address" placeholder="Street Address" required>
                <input type="text" name="phone_number" placeholder="Phone Number" required>
                <input type="text" name="city" placeholder="City" required>
                <input type="text" name="postal_code" placeholder="Postal / Zip Code" required>
                <input type="text" name="country" placeholder="Country/Region" required>
                <?php session(['selected' => 0]); ?>
                <?php session(['shipping_method' =>'null']);?>


                <label>
                    <input type="checkbox" name="save_for_checkout" {{ old('save_for_checkout') ? 'checked' : '' }}>
                    Save this information for fast checkout
                </label>
                @if(count(session('shipcart', [])) === 0)
                    <button type="submit" disabled>Go to shipping</button>
                    <p style="color: red;">Cart is empty! Add products to cart to continue</p>
                @else
                    <button type="submit">Go to shipping</button>
                @endif
            </form>
                <form  action="{{route('cart.show')}}" method="GET">
                    @csrf
                <button type="submit">Back to cart</button>

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

            <form action="{{ route('applyCoupon') }}" method="POST">
                @csrf
                <input type="text" name="coupon_code" placeholder="Enter coupon code" required>
                <button type="submit">Add code</button>
            </form>
            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @elseif(session('error'))
                <p style="color: red;">{{ session('error') }}</p>
            @endif

            <p>Subtotal: ${{ number_format($subtotal, 2) }}</p>
            <p>Shipping: Calculated at the next step</p>
        @if(session('coupon_code'))
                <p>Coupon Applied: {{ session('coupon_code') }}</p>
                <p>Discount: ${{ number_format(session('discount', 0), 2) }}</p>
                    <?php session(['NewT' => $subtotal -  (number_format(session('discount', 0), 2))]); ?>
                <p>Total after Discount: ${{$subtotal -  (number_format(session('discount', 0), 2))}}</p>
            @else
                <p>Total: ${{ number_format($subtotal, 2) }}</p>
                    <?php session(['NewT' => $subtotal] ); ?>

            @endif
        </div>

    </div>

</body>
</html>
