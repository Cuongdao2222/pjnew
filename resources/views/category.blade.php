@extends('layouts.main')

@section('title', 'Best Buy Canada - Category')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="listingLayout">
    <!-- LEFT SIDEBAR - Filters -->
    <aside class="filterSidebar">
        <!-- Categories -->
        <div class="filterSection">
            <div class="filterHeader">
                <h3>Categories</h3>
                <i class="fa-solid fa-chevron-up"></i>
            </div>
            <ul class="categoryList">
                <li><a href="#">Laptops & MacBooks <span>14,266</span></a></li>
                <li><a href="#">Desktop Computers <span>7,079</span></a></li>
                <li><a href="#">Tablets & iPads <span>2,866</span></a></li>
                <li><a href="#">Handheld Gaming PCs <span>156</span></a></li>
                <li><a href="#">Computer Accessories <span>119,889</span></a></li>
                <li><a href="#">Tablet & iPad Accessories <span>13,084</span></a></li>
                <li><a href="#">Hard Drives & Storage Devices <span>3,361</span></a></li>
                <li><a href="#">PC Components <span>6,845</span></a></li>
                <li><a href="#">Wi-Fi and Networking <span>9,466</span></a></li>
                <li><a href="#">Printers, Scanners & Fax <span>2,577</span></a></li>
                <li><a href="#">Monitors <span>2,368</span></a></li>
                <li><a href="#">Software <span>723</span></a></li>
                <li><a href="#">Servers & Accessories <span>101</span></a></li>
            </ul>
        </div>

        <!-- Shipping and Pickup -->
        <div class="filterSection">
            <div class="filterHeader">
                <h3>Shipping and Pickup</h3>
                <i class="fa-solid fa-chevron-up"></i>
            </div>
            <ul class="checkboxList">
                <li>
                    <label>
                        <input type="checkbox"> Get it Shipped
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox"> Pick Up at Nearby Stores
                    </label>
                </li>
            </ul>
        </div>

        <!-- Status -->
        <div class="filterSection">
            <div class="filterHeader">
                <h3>Status</h3>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>

        <!-- Current Offers -->
        <div class="filterSection">
            <div class="filterHeader">
                <h3>Current Offers</h3>
                <i class="fa-solid fa-chevron-up"></i>
            </div>
            <ul class="checkboxList">
                <li>
                    <label>
                        <input type="checkbox"> On Sale <span>(123,859)</span>
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox"> Top Deals <span>(703)</span>
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox"> Latest and Greatest <span>(71)</span>
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox"> On Clearance <span>(430)</span>
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox"> Open Box <span>(2,836)</span>
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox"> Refurbished <span>(14,314)</span>
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox"> Best Buy Exclusive <span>(312)</span>
                    </label>
                </li>
                <li>
                    <label>
                        <input type="checkbox"> Online Only <span>(173,181)</span>
                    </label>
                </li>
            </ul>
        </div>
    </aside>

    <!-- RIGHT: Results + Product Grid -->
    <div class="productListing">
        <!-- Toolbar -->
        <div class="listingToolbar">
            <div class="resultsCount">{{ count($products) }} results</div>
        </div>

        <!-- Product Grid -->
        <div class="productGrid">
            @foreach($products as $product)
            <article class="productCard">
                <div class="productImageWrap">
                    <img src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}">
                </div>
                <div class="productInfo">
                    <h3 class="productTitle">
                        <a href="{{ url('/detail/' . $product['slug']) }}">{{ $product['name'] }}</a>
                    </h3>
                    <div class="productRating">
                        <span class="stars">★★★★★</span>
                    </div>
                    <div class="productPrice">
                        <span class="currentPrice">${{ number_format($product['price'], 2) }}</span>
                    </div>
                    <button class="btnAddToCart" data-id="{{ $product['id'] }}">
                        <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                    </button>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</div>
@endsection
