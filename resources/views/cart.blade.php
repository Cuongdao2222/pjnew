@extends('layouts.main')

@section('title', 'Your Cart | Best Buy Canada')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
<div class="cartContainer">
    <h1>Your Shopping Cart</h1>
    
    @if(empty($items))
        <p>Your cart is empty.</p>
        <a href="{{ url('/') }}" class="checkoutBtn">Continue Shopping</a>
    @else
        <div class="cartItems">
            @foreach($items as $item)
                <div class="cartItem">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                    <div class="itemInfo">
                        <h3>{{ $item['name'] }}</h3>
                        <p>Giá: {{ number_format($item['price'] * 25000, 0, ',', '.') }} đ</p>
                        <p>Quantity: {{ $item['quantity'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="cartTotal">
            <h3>Total Items: {{ array_sum(array_column($items, 'quantity')) }}</h3>
            <a href="#" class="checkoutBtn">Checkout</a>
        </div>
    @endif
</div>
@endsection
