<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thanks</title>
    <link rel="stylesheet" href="{{ asset('css/message.css') }}">
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

        <img class="cir" src="{{ asset('images/CheckCircle.png') }}" alt="Example Image">
        <h1 class="h">Payment Confirmed</h1>
        <p class="stat"> Thank you <span style="color: #56B280">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span> for buying Candleaf. The nature is grateful to you.
            Now that your order is confirmed it will be ready to ship in 2 days.
            Please check your inbox in the future for your order updates.</p>
        <div class="back">
        <form action="{{ route('del.cart') }}">
            <button type="submit">Back to shopping</button>
        </form>

        <form  action="{{route('receipt.show')}}"  method="GET">
            @csrf
            <button type="submit">Print receipt</button>
        </form>
        </div>
    </div>
    @if(session('receipt'))
    <div class="right-section">
        <table  class="table">
            <h3>receipt</h3>
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
        <p>Shipping: {{session('shipping_method')}}</p>
        <p style="color: green">Paid: ${{ session('aftermethod') }}</p>
    </div>

    @endif
</div>
</body>
</html>
