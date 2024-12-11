<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
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
                <?php session(['selected' => 0]); ?>
        <h3>Shipping Details </h3>
        <input type="text" name="email" value="Email: {{ auth()->user()->email }}" disabled>
        <input type="text" name="email" value="Country: {{ session('existingInformation')->country }}" disabled>
        <input type="text" name="email" value="City: {{ session('existingInformation')->city }}" disabled>
        <input type="text" name="email" value="Street Address: {{ session('existingInformation')->address }}" disabled>
        <input type="text" name="email" value="Phone Number: {{ session('existingInformation')->phone_number }}" disabled>
        <input type="text" name="email" value="Shipping Method: {{ session('shipping_method')}}" disabled>
        <?php session(['receipt'=>0])?>

        <h3 >Payment Method</h3>
        <form action="{{ route('payment.store') }}" method="POST">
            @csrf
            <div>
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" placeholder="between 13 and 19 digits. Test:4111111111111111 or 5500000000000004" value="4111111111111111{{ old('card_number') }}" required>
                @error('card_number')
                <span class="text-danger" style="color: red;">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="holder_name">Card Name</label>
                <input type="text" id="holder_name" name="holder_name" placeholder="at least 3 characters. Test:fares or ahmed" value="fares{{ old('holder_name') }}" required>
                @error('holder_name')
                <span class="text-danger" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="expiration">Expiration (MM/YY)</label>
                <input type="text" id="expiration" name="expiration" placeholder="MM/YY format. Test:12/25" value="12/25{{ old('expiration') }}" required>
                @error('expiration')
                <span class="text-danger" style="color: red;">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="3 or 4 digits. Test:123" value="123{{ old('cvv') }}" required>
                @error('cvv')
                <span class="text-danger" style="color: red;">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit">Pay Now ${{session('aftermethod')}}</button>
        </form>

   @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif
        <form  action="{{route('shipping.show')}}"  method="GET">
            @csrf
            <button type="submit">Back to shipping</button>
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
            <p>Shipping: {{session('shipping_method')}}</p>
            <p>Total: ${{ session('aftermethod') }}</p>
        @else
            <input type="text" name="coupon_code" placeholder="coupon code: No coupon used" disabled>
            <p>Shipping: {{session('shipping_method')}}</p>
            <p>Total: ${{ session('aftermethod') }}</p>
        @endif
    </div>
</div>
