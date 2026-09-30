@extends('layouts.main')

@section('title', 'Mua sắm trực tuyến, Ưu đãi & Tiết kiệm ')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
@php
    $latestProduct = isset($newProducts) && count($newProducts) > 0 ? $newProducts[0] : (isset($products) && count($products) > 0 ? $products[0] : null);
    $secondLatestProduct = isset($newProducts) && count($newProducts) > 1 ? $newProducts[1] : (isset($products) && count($products) > 1 ? $products[1] : null);
@endphp

<section class="applePromoContainer">
    <!-- Top Bento Promo Grid -->
    <div class="promoBentoGrid">
        <!-- Left Big Card (Latest Product) -->
        @if($latestProduct)
        <div class="promoCard largeCard darkTheme">
            <div class="cardHeader">
                <i class="fa-solid fa-sparkles"></i> <span>SẢN PHẨM MỚI NHẤT</span>
            </div>
            <div class="cardMainContent">
                <h2>{{ $latestProduct['name'] }}</h2>
                <p>{{ Str::limit($latestProduct['overview'] ?? $latestProduct['description'], 100) }}</p>
                <a href="{{ url('/detail/' . $latestProduct['slug']) }}" class="btnBlue">Xem chi tiết</a>
            </div>
            <div class="cardImageContainer">
                <a href="{{ url('/detail/' . $latestProduct['slug']) }}">
                    <img src="{{ $latestProduct['images'][0] }}" alt="{{ $latestProduct['name'] }}">
                </a>
            </div>
        </div>
        @endif

        <!-- Right Stacked Cards -->
        <div class="promoRightStack">
            <!-- Top Right Watch Card -->
            @if($secondLatestProduct)
            <div class="promoCard mediumCard darkTheme">
                <div class="cardLeftText">
                    <div class="cardHeader">
                        <i class="fa-solid fa-sparkles"></i> <span>SẢN PHẨM MỚI</span>
                    </div>
                    <h3>{{ $secondLatestProduct['name'] }}</h3>
                    <p>{{ Str::limit($secondLatestProduct['overview'] ?? $secondLatestProduct['description'], 80) }}</p>
                    <a href="{{ url('/detail/' . $secondLatestProduct['slug']) }}" class="btnWhiteOutline">Xem chi tiết</a>
                </div>
                <div class="cardImageContainer">
                    <a href="{{ url('/detail/' . $secondLatestProduct['slug']) }}">
                        <img src="{{ $secondLatestProduct['images'][0] }}" alt="{{ $secondLatestProduct['name'] }}">
                    </a>
                </div>
            </div>
            @endif

            <!-- Bottom Right Two Small Cards -->
            <div class="promoSmallGrid">
                <div class="promoCard smallCard blueGradient">
                    <h4>Khám phá những ưu đãi hot nhất tuần, tất cả tại một nơi.</h4>
                    <a href="#" class="btnWhite">Mua ngay</a>
                </div>
                <div class="promoCard smallCard purpleGradient">
                    <h4>Tiết kiệm lớn cho mọi thứ bạn cần trong mùa tựu trường.</h4>
                    <a href="#" class="btnWhite">Mua ngay</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Explore the latest Products Section -->
    <div class="exploreSection">
        <h3>Khám phá các sản phẩm mới nhất</h3>
        <div class="exploreGrid">
            @if(isset($newProducts))
                @foreach(array_slice($newProducts, 0, 4) as $product)
                <div class="exploreItem">
                    <div class="exploreHeader"><i class="fa-solid fa-sparkles"></i> {{ $product['name'] }}</div>
                    <div class="exploreImg">
                        <a href="{{ url('/detail/' . $product['slug']) }}">
                            <img src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}">
                        </a>
                    </div>
                    <p>{{ Str::limit($product['overview'] ?? $product['name'], 70) }}</p>
                    <a href="{{ url('/detail/' . $product['slug']) }}" class="exploreLink" style="font-size:12px; font-weight:bold; color:#0046be; text-decoration:none; margin-top:8px;">Xem chi tiết <i class="fa-solid fa-chevron-right"></i></a>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<section class="hottestOffersContainer">
    <div class="hottestOffersWrapper">
        <h2 class="sectionTitle">Ưu đãi hot nhất hôm nay</h2>

        <div class="offersGrid">
            @foreach(array_slice($products, 0, 4) as $product)
            <div class="offerCard">
                <div class="offerImgHolder">
                    <a href="{{ url('/detail/' . $product['slug']) }}">
                        <img src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}">
                    </a>
                </div>
                <div class="offerContent">
                    <h3 class="offerTitle">
                        <a href="{{ url('/detail/' . $product['slug']) }}" style="color:white; text-decoration:none;">{{ $product['name'] }}</a>
                    </h3>
                    <p class="offerSubtext">Giá: ${{ number_format($product['price'], 2) }}</p>
                    <a href="{{ url('/detail/' . $product['slug']) }}" class="offerLink">Mua ngay <i class="fa-solid fa-chevron-right"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="shopByCategoryContainer">
    <div class="shopByCategoryWrapper">
        <h2 class="categorySectionTitle">Mua sắm theo danh mục</h2>

        <!-- Grid danh mục từ categories.json -->
        <div class="categoryGrid">
            @if(isset($categories) && count($categories) > 0)
                @foreach($categories as $category)
                <a href="{{ url('/category/' . $category['slug']) }}" class="categoryItem">
                    <div class="categoryImgBox">
                        <img src="{{ $category['đường dẫn ảnh'] }}" alt="{{ $category['tên'] }}">
                    </div>
                    <span>{{ $category['tên'] }}</span>
                </a>
                @endforeach
            @endif
        </div>
    </div>

    <!-- My Best Buy Exclusive Banner -->
    <div class="myBestBuyBanner">
        <div class="bannerContent">
            <p><strong>Mở khóa ưu đãi độc quyền.</strong></p>
            <a href="#" class="bannerLink">Khám phá ưu đãi <i class="fa-solid fa-chevron-right"></i></a>
        </div>
    </div>
</section>

<!-- KHỐI 2: MORE DEALS (PRODUCT CAROUSEL) -->
<section class="moreDealsContainer">
    <div class="moreDealsWrapper">
        <h2 class="dealsTitle">Sản phẩm độc quyền</h2>

        <div class="dealsCarouselHolder">
            <!-- Prev Arrow Button -->
            <button class="carouselArrow prevBtn" aria-label="Trước">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div class="dealsGrid">
                @if(isset($exclusiveProducts))
                    @foreach($exclusiveProducts as $product)
                    <div class="productCard">
                        <div class="productImgBox">
                            <a href="{{ url('/detail/' . $product['slug']) }}">
                                <img src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}">
                            </a>
                        </div>
                        <div class="productInfo">
                            <h4 class="productName">
                                <a href="{{ url('/detail/' . $product['slug']) }}" style="color:inherit; text-decoration:none;">{{ $product['name'] }}</a>
                            </h4>
                            <div class="productRating">
                                <div class="stars">★★★★★</div>
                            </div>
                            <span class="saveBadge">ĐỘC QUYỀN</span>
                            <div class="productPrice">${{ number_format($product['price'], 2) }}</div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            <!-- Next Arrow Button -->
            <button class="carouselArrow nextBtn" aria-label="Tiếp theo">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<section class="promoBannersContainer">
    @php
        $first4Categories = isset($categories) ? array_slice($categories, 0, 4) : [];
    @endphp

    @foreach($first4Categories as $cat)
    @php
        $catProducts = [];
        if (isset($products)) {
            foreach ($products as $p) {
                if (isset($p['category']) && $p['category'] == $cat['slug']) {
                    $catProducts[] = $p;
                }
            }
        }
    @endphp
    <!-- Feature Banner for Category: {{ $cat['tên'] }} -->
    <div class="featureBannerCard btsGradient">
        <!-- Cột trái: Tiêu đề & Nút bấm -->
        <div class="bannerInfoCol">
            <h2 class="bannerTitle">{{ $cat['tên'] }}</h2>
            <p class="bannerDesc">Khám phá các sản phẩm {{ $cat['tên'] }} chất lượng cao với ưu đãi tốt nhất.</p>
            <a href="{{ url('/category/' . $cat['slug']) }}" class="btnBannerWhite">Mua sắm ngay</a>
        </div>

        <!-- Cột phải: Carousel sản phẩm -->
        <div class="bannerCarouselCol">
            <button class="bannerNavBtn prevBtn" aria-label="Trước">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div class="bannerProductsGrid">
                @foreach($catProducts as $product)
                <div class="bannerProductCard">
                    <div class="cardImgHolder">
                        <a href="{{ url('/detail/' . $product['slug']) }}">
                            <img src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}">
                        </a>
                    </div>
                    <div class="cardDetails">
                        <h4 class="prodTitle">
                            <a href="{{ url('/detail/' . $product['slug']) }}" style="color:inherit; text-decoration:none;">{{ $product['name'] }}</a>
                        </h4>
                        <div class="prodRating">
                            <span class="stars">★★★★★</span>
                        </div>
                        <div class="prodPrice">${{ number_format($product['price'], 2) }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <button class="bannerNavBtn nextBtn" aria-label="Tiếp theo">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
    @endforeach
</section>
@endsection
