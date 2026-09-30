@extends('layouts.main')

@section('title', $product['name'] . ' | Best Buy Canada')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="mainContent">
    <div class="pdpLayout">
        <!-- LEFT: Image Gallery -->
        <div class="pdpGallery" id="productGallery">
            <div class="thumbList">
                @foreach($product['images'] as $index => $image)
                    <button class="thumbItem {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                        <img src="{{ $image }}" alt="View {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>
            <div class="mainImageWrap">
                <button class="navArrow prev" aria-label="Previous image"><i class="fa-solid fa-chevron-left"></i></button>
                <img class="mainProductImg" id="mainProductImage" src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}" data-images="{{ json_encode($product['images']) }}">
                <button class="navArrow next" aria-label="Next image"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>

        <!-- RIGHT: Product Info -->
        <div class="pdpInfo">
            <div class="productMeta">
                <span>Model Code: <strong>{{ $product['code'] }}</strong></span>
            </div>

            <h1>{{ $product['name'] }}</h1>

            <div class="priceBlock">
                <div class="priceLeft">
                    <div class="priceMain">{{ number_format($product['price'] * 25000, 0, ',', '.') }} đ</div>
                </div>
            </div>

            <!-- Big Add to Cart -->
            <button class="btnAddToCartLarge" data-id="{{ $product['id'] }}">Add to Cart</button>
        </div>
    </div>

    <!-- Overview -->
    <section class="pdpSection overviewSection">
        <h2>Overview</h2>
        <p>{{ $product['overview'] }}</p>
    </section>
    
    <!-- Description -->
    <section class="pdpSection">
        <h2>Description</h2>
        <p>{{ $product['description'] }}</p>
    </section>
</div>
@endsection
