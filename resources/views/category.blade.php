@extends('layouts.main')

@section('title', 'Best Buy Canada - Category')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="mainContent">
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
                    @if(isset($categories) && count($categories) > 0)
                        @foreach($categories as $cat)
                        <li>
                            <a href="{{ url('/category/' . $cat['slug']) }}" @if(isset($slug) && $slug == $cat['slug']) style="font-weight:700; color:#0046be;" @endif>
                                {{ $cat['tên'] }}
                            </a>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <!-- Current Offers -->
            <div class="filterSection">
                <div class="filterHeader">
                    <h3>Current Offers</h3>
                    <i class="fa-solid fa-chevron-up"></i>
                </div>
                <ul class="checkboxList">
                    <li>
                        <label><input type="checkbox"> On Sale <span>(123,859)</span></label>
                    </li>
                    <li>
                        <label><input type="checkbox"> Top Deals <span>(703)</span></label>
                    </li>
                    <li>
                        <label><input type="checkbox"> Latest and Greatest <span>(71)</span></label>
                    </li>
                    <li>
                        <label><input type="checkbox"> On Clearance <span>(430)</span></label>
                    </li>
                    <li>
                        <label><input type="checkbox"> Open Box <span>(2,836)</span></label>
                    </li>
                    <li>
                        <label><input type="checkbox"> Refurbished <span>(14,314)</span></label>
                    </li>
                    <li>
                        <label><input type="checkbox"> Best Buy Exclusive <span>(312)</span></label>
                    </li>
                    <li>
                        <label><input type="checkbox"> Online Only <span>(173,181)</span></label>
                    </li>
                </ul>
            </div>

            <!-- Brand -->
            <div class="filterSection">
                <div class="filterHeader">
                    <h3>Brand</h3>
                    <i class="fa-solid fa-chevron-up"></i>
                </div>
                <div class="filterSearch">
                    <input type="text" placeholder="Search Brand">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <ul class="checkboxList scrollableList">
                    <li><label><input type="checkbox"> HP <span>(3,512)</span></label></li>
                    <li><label><input type="checkbox"> Dell <span>(2,945)</span></label></li>
                    <li><label><input type="checkbox"> Lenovo <span>(2,103)</span></label></li>
                    <li><label><input type="checkbox"> Apple <span>(1,856)</span></label></li>
                    <li><label><input type="checkbox"> ASUS <span>(1,421)</span></label></li>
                    <li><label><input type="checkbox"> Acer <span>(1,102)</span></label></li>
                    <li><label><input type="checkbox"> Microsoft <span>(845)</span></label></li>
                    <li><label><input type="checkbox"> Samsung <span>(712)</span></label></li>
                </ul>
            </div>

            <!-- Customer Rating -->
            <div class="filterSection">
                <div class="filterHeader">
                    <h3>Customer Rating</h3>
                    <i class="fa-solid fa-chevron-up"></i>
                </div>
                <ul class="ratingFilterList">
                    <li>
                        <label>
                            <input type="checkbox">
                            <span class="stars">★★★★★</span>
                            <span class="ratingLabel">4 & Up <span>(45,210)</span></span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox">
                            <span class="stars">★★★★☆</span>
                            <span class="ratingLabel">3 & Up <span>(52,845)</span></span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox">
                            <span class="stars">★★★☆☆</span>
                            <span class="ratingLabel">2 & Up <span>(58,102)</span></span>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox">
                            <span class="stars">★★☆☆☆</span>
                            <span class="ratingLabel">1 & Up <span>(62,456)</span></span>
                        </label>
                    </li>
                </ul>
            </div>

            <!-- Price -->
            <div class="filterSection">
                <div class="filterHeader">
                    <h3>Price</h3>
                    <i class="fa-solid fa-chevron-up"></i>
                </div>
                <ul class="checkboxList">
                    <li><label><input type="checkbox"> $100 - $249.99 <span>(12,451)</span></label></li>
                    <li><label><input type="checkbox"> $250 - $499.99 <span>(8,321)</span></label></li>
                    <li><label><input type="checkbox"> $500 - $749.99 <span>(5,102)</span></label></li>
                    <li><label><input type="checkbox"> $750 - $999.99 <span>(3,456)</span></label></li>
                    <li><label><input type="checkbox"> $1000 & Up <span>(2,103)</span></label></li>
                </ul>
                <div class="priceRangeInputs">
                    <input type="text" placeholder="$ Min">
                    <span>to</span>
                    <input type="text" placeholder="$ Max">
                    <button type="button"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>

            <!-- Discount -->
            <div class="filterSection">
                <div class="filterHeader">
                    <h3>Discount</h3>
                    <i class="fa-solid fa-chevron-up"></i>
                </div>
                <ul class="checkboxList">
                    <li><label><input type="checkbox"> All Discounted Items <span>(123,859)</span></label></li>
                    <li><label><input type="checkbox"> 50% Off or More <span>(15,210)</span></label></li>
                    <li><label><input type="checkbox"> 40% Off or More <span>(22,845)</span></label></li>
                    <li><label><input type="checkbox"> 30% Off or More <span>(35,102)</span></label></li>
                    <li><label><input type="checkbox"> 20% Off or More <span>(48,456)</span></label></li>
                    <li><label><input type="checkbox"> 10% Off or More <span>(62,103)</span></label></li>
                </ul>
            </div>
        </aside>

        <!-- RIGHT: Results + Product Grid -->
        <div class="productListing">
            <!-- Toolbar -->
            <div class="listingToolbar">
                <div class="resultsCount">{{ count($products) }} results</div>
                <div class="toolbarControls">
                    <label class="toggleLabel">
                        <input type="checkbox" class="toggleInput">
                        <div class="toggleSwitch"></div>
                        <span>In Stock</span>
                    </label>
                    <label class="toggleLabel">
                        <input type="checkbox" class="toggleInput">
                        <div class="toggleSwitch"></div>
                        <span>Best Buy Only</span>
                    </label>
                    <div class="sortControl">
                        <label>Sort</label>
                        <select>
                            <option>Best Match</option>
                            <option>Price Low to High</option>
                            <option>Price High to Low</option>
                            <option>Highest Rated</option>
                        </select>
                    </div>
                </div>
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
                            <span class="ratingCount">(128)</span>
                        </div>
                        <div class="productPrice">
                            <span class="currentPrice">${{ number_format($product['price'], 2) }}</span>
                            @if(isset($product['old_price']))
                                <span class="saveBadge">SAVE ${{ number_format($product['old_price'] - $product['price'], 2) }}</span>
                            @endif
                        </div>
                        <p class="availability">Available Online</p>
                        <button class="btnAddToCart" data-id="{{ $product['id'] }}">
                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                        </button>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
