@extends('layouts.main')

@section('title', 'Best Buy: Mua sắm trực tuyến, Ưu đãi & Tiết kiệm | Best Buy Canada')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
<section class="applePromoContainer">
    <!-- Top Bento Promo Grid -->
    <div class="promoBentoGrid">
        <!-- Left Big Card (iPhone 18 Pro) -->
        <div class="promoCard largeCard darkTheme">
            <div class="cardHeader">
                <i class="fa-brands fa-apple"></i> <span>iPhone 18 <strong class="proBadge">PRO</strong></span>
            </div>
            <div class="cardMainContent">
                <h2>Tiến xa hơn cùng Pro.</h2>
                <p>Thu cũ đổi mới và nâng cấp. Nhận thẻ quà tặng lên đến $1.500 khi mua iPhone mới.*</p>
                <a href="{{ url('/detail') }}" class="btnBlue">Đặt trước ngay</a>
            </div>
            <div class="cardImageContainer">
                <img src="https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=600&q=80" alt="iPhone 18 Pro">
            </div>
        </div>

        <!-- Right Stacked Cards -->
        <div class="promoRightStack">
            <!-- Top Right Watch Card -->
            <div class="promoCard mediumCard darkTheme">
                <div class="cardLeftText">
                    <div class="cardHeader">
                        <i class="fa-brands fa-apple"></i> <span>WATCH SERIES 12</span>
                    </div>
                    <h3>Kiệt tác từ trái tim.</h3>
                    <p>Thu cũ đổi mới Apple Watch hiện tại của bạn và nhận thẻ quà tặng lên đến $565.*</p>
                    <a href="{{ url('/detail') }}" class="btnWhiteOutline">Đặt trước ngay</a>
                </div>
                <div class="cardImageContainer">
                    <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=400&q=80" alt="Apple Watch">
                </div>
            </div>

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

    <!-- Explore the latest from Apple Section -->
    <div class="exploreSection">
        <h3>Khám phá các sản phẩm mới nhất từ Apple</h3>
        <div class="exploreGrid">
            <!-- Item 1 -->
            <div class="exploreItem">
                <div class="exploreHeader"><i class="fa-brands fa-apple"></i> iPhone Duo</div>
                <div class="exploreImg">
                    <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=300&q=80" alt="iPhone Duo">
                </div>
                <p>Thu cũ đổi mới và nâng cấp. Nhận thẻ quà tặng lên đến $1.500 cho thiết bị mới...</p>
            </div>
            <!-- Item 2 -->
            <div class="exploreItem">
                <div class="exploreHeader"><i class="fa-brands fa-apple"></i> WATCH ULTRA 4</div>
                <div class="exploreImg">
                    <img src="https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=300&q=80" alt="Watch Ultra 4">
                </div>
                <p>Nhận thẻ quà tặng Best Buy lên đến $565 khi đổi Apple Watch hợp lệ...</p>
            </div>
            <!-- Item 3 -->
            <div class="exploreItem">
                <div class="exploreHeader"><i class="fa-brands fa-apple"></i> AirPods 5</div>
                <div class="exploreImg">
                    <img src="https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?w=300&q=80" alt="AirPods 5">
                </div>
                <p>Khám phá sự kỳ diệu của công nghệ chống ồn chủ động.</p>
            </div>
            <!-- Item 4 -->
            <div class="exploreItem">
                <div class="exploreHeader"><i class="fa-brands fa-apple"></i> Mac mini</div>
                <div class="exploreImg">
                    <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=300&q=80" alt="Mac mini">
                </div>
                <p>Nhỏ gọn nhưng toàn năng. Mạnh mẽ với chip M6 và M5 Pro.</p>
            </div>
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
                    <img src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}">
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

        <!-- Grid 18 danh mục (6 cột x 3 hàng) -->
        <div class="categoryGrid">
            <!-- Row 1 -->
            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?w=300&q=80" alt="Apple">
                </div>
                <span>Apple</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=300&q=80" alt="TVs, Home Theatre">
                </div>
                <span>Tivi, Rạp hát tại gia & Phụ kiện</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=300&q=80" alt="Computers and Tablets">
                </div>
                <span>Máy tính & Máy tính bảng</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=300&q=80" alt="Computer Accessories">
                </div>
                <span>Phụ kiện máy tính</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1546435770-a3e426bf472b?w=300&q=80" alt="Headphones and Speakers">
                </div>
                <span>Tai nghe & Loa di động</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=300&q=80" alt="Wearable Technology">
                </div>
                <span>Thiết bị đeo thông minh</span>
            </a>

            <!-- Row 2 -->
            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=300&q=80" alt="Cell Phones">
                </div>
                <span>Điện thoại & Phụ kiện</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=300&q=80" alt="Major Appliances">
                </div>
                <span>Thiết bị gia dụng lớn</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1570222094114-d054a817e56b?w=300&q=80" alt="Small Kitchen Appliances">
                </div>
                <span>Đồ gia dụng nhà bếp</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1558317374-067fb5f30001?w=300&q=80" alt="Vacuums">
                </div>
                <span>Máy hút bụi</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1606813907291-d86efa9b94db?w=300&q=80" alt="Video Games">
                </div>
                <span>Video Game, Máy chơi game & Phụ kiện</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=300&q=80" alt="PC Gaming">
                </div>
                <span>PC Gaming</span>
            </a>

            <!-- Row 3 -->
            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1558002038-1055907df827?w=300&q=80" alt="Smart Home">
                </div>
                <span>Nhà thông minh</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1617103996702-96ff29b1c467?w=300&q=80" alt="Cooling and Air Quality">
                </div>
                <span>Làm mát & Lọc không khí</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=300&q=80" alt="Personal Care">
                </div>
                <span>Chăm sóc cá nhân</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&q=80" alt="Travel and Luggage">
                </div>
                <span>Du lịch, Vali & Túi xách</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1566576912321-d58ddd7a6088?w=300&q=80" alt="Toys and Games">
                </div>
                <span>Đồ chơi & Thiết bị học tập</span>
            </a>

            <a href="{{ url('/category') }}" class="categoryItem">
                <div class="categoryImgBox">
                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=300&q=80" alt="Furniture">
                </div>
                <span>Nội thất</span>
            </a>
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

<!-- KHỐI 1: RATE PLANS -->
<section class="ratePlansContainer">
    <div class="ratePlansWrapper">
        <h2 class="plansTitle">Các gói cước hot nhất hiện có.</h2>
        <p class="plansSubtext">Khám phá các gói cước này cùng nhiều ưu đãi độc quyền tại cửa hàng. Liên hệ chuyên viên tư vấn để biết chi tiết.</p>
        
        <div class="plansBtnHolder">
            <a href="#" class="btnExplorePlans">Xem tất cả gói cước</a>
        </div>

        <div class="plansGrid">
            <!-- Plan 1 -->
            <div class="planCard">
                <div class="planImgBox">
                    <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=400&q=80" alt="Freedom Mobile 10GB">
                </div>
                <h3>$35/tháng | 10GB | Freedom Mobile.*</h3>
                <p>Gói cước có thể sử dụng tại Canada, Hoa Kỳ, Mexico và 120 quốc gia khác.</p>
            </div>

            <!-- Plan 2 -->
            <div class="planCard">
                <div class="planImgBox">
                    <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=400&q=80" alt="Freedom Mobile 125GB">
                </div>
                <h3>$45/tháng | 125GB | Freedom Mobile.*</h3>
                <p>Gói cước có thể sử dụng tại Canada, Hoa Kỳ, Mexico và 120 quốc gia khác.</p>
            </div>

            <!-- Plan 3 -->
            <div class="planCard">
                <div class="planImgBox">
                    <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=400&q=80" alt="Freedom Mobile 175GB">
                </div>
                <h3>$50/tháng | 175GB | Freedom Mobile.*</h3>
                <p>Gói cước có thể sử dụng tại Canada, Hoa Kỳ, Mexico và 120 quốc gia khác.</p>
            </div>

            <!-- Plan 4 -->
            <div class="planCard">
                <div class="planImgBox">
                    <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&q=80" alt="Fido Koodo Virgin">
                </div>
                <h3>$55/tháng | 60GB | Fido, Koodo, Virgin Plus.*</h3>
                <p>Gói cước có thể sử dụng tại Canada, Hoa Kỳ và Mexico.</p>
            </div>
        </div>
    </div>
</section>

<!-- KHỐI 2: MORE DEALS (PRODUCT CAROUSEL) -->
<section class="moreDealsContainer">
    <div class="moreDealsWrapper">
        <h2 class="dealsTitle">Khám phá thêm nhiều ưu đãi hấp dẫn từ bộ sưu tập đa dạng</h2>
        
        <div class="dealsCarouselHolder">
            <div class="dealsGrid">
                <!-- Product 1 -->
                <div class="productCard">
                    <div class="productImgBox">
                        <img src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?w=300&q=80" alt="Gaming PC">
                    </div>
                    <div class="productInfo">
                        <h4 class="productName">Quoted Tech Shield Gaming PC - RTX 5070, AMD Ryzen 7 7800X3D,...</h4>
                        <div class="productRating">
                            <div class="stars">★★★★★</div>
                            <span class="ratingCount">(6)</span>
                        </div>
                        <span class="saveBadge">TIẾT KIỆM $800</span>
                        <div class="productPrice">$2,699.99</div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="productCard">
                    <div class="productImgBox">
                        <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=300&q=80" alt="Surface Laptop">
                    </div>
                    <div class="productInfo">
                        <h4 class="productName">Hàng tân trang (Tốt) - Microsoft Surface Laptop 5 13.5" Cảm ứng - Int...</h4>
                        <div class="productRating">
                            <div class="stars">★★★★★</div>
                            <span class="ratingCount">(3)</span>
                        </div>
                        <span class="saveBadge">TIẾT KIỆM $1,300</span>
                        <div class="productPrice">$599.99</div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="productCard">
                    <div class="productImgBox">
                        <img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=300&q=80" alt="HP Laptop">
                    </div>
                    <div class="productInfo">
                        <h4 class="productName">HP 255 G10 Business Laptop 15.6" FHD - AMD Ryzen 3 7320U - 16GB...</h4>
                        <div class="productRating">
                            <div class="stars">★★★★★</div>
                            <span class="ratingCount">(1)</span>
                        </div>
                        <span class="saveBadge">TIẾT KIỆM $280</span>
                        <div class="productPrice">$739.99</div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="productCard">
                    <div class="productImgBox">
                        <img src="https://images.unsplash.com/photo-1558317374-067fb5f30001?w=300&q=80" alt="Electric Scooter">
                    </div>
                    <div class="productInfo">
                        <h4 class="productName">Kukirin G4 Electric Scooter, 11" Tubeless tire, Full Suspension, Up to 75 K...</h4>
                        <div class="productRating">
                            <div class="stars">★★★★★</div>
                            <span class="ratingCount">(7)</span>
                        </div>
                        <span class="saveBadge">TIẾT KIỆM $550</span>
                        <div class="productPrice">$1,299.00</div>
                    </div>
                </div>

                <!-- Product 5 -->
                <div class="productCard">
                    <div class="productImgBox">
                        <img src="https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=300&q=80" alt="Smart Projector">
                    </div>
                    <div class="productInfo">
                        <h4 class="productName">JMGO N3 4K UHD Triple Laser Smart Projector | 1.3x Optical Zoom, 300"...</h4>
                        <div class="productRating">
                            <div class="stars">★★★★★</div>
                            <span class="ratingCount">(14)</span>
                        </div>
                        <span class="saveBadge">TIẾT KIỆM $1,000</span>
                        <div class="productPrice">$999.00</div>
                    </div>
                </div>

                <!-- Product 6 -->
                <div class="productCard">
                    <div class="productImgBox">
                        <img src="https://images.unsplash.com/photo-1558317374-067fb5f30001?w=300&q=80" alt="Dyson Vacuum">
                    </div>
                    <div class="productInfo">
                        <h4 class="productName">Hàng tân trang (Xuất sắc) - Dyson V15 Detect Máy hút bụi không dây cho nhiều...</h4>
                        <div class="productRating">
                            <div class="stars">★★★★★</div>
                            <span class="ratingCount">(755)</span>
                        </div>
                        <span class="saveBadge">TIẾT KIỆM $340</span>
                        <div class="productPrice">$459.99</div>
                    </div>
                </div>

                <!-- Product 7 -->
                <div class="productCard">
                    <div class="productImgBox">
                        <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=300&q=80" alt="Lenovo PC">
                    </div>
                    <div class="productInfo">
                        <h4 class="productName">Lenovo Legion Gen 10 Gaming PC - RTX 5070...</h4>
                        <div class="productRating">
                            <div class="stars">★★★★★</div>
                        </div>
                        <div class="productPrice">$5,084.99</div>
                    </div>
                </div>
            </div>

            <!-- Next Arrow Button -->
            <button class="carouselArrow nextBtn" aria-label="Tiếp theo">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<section class="promoBannersContainer">
    <!-- Banner 1: Back to School -->
    <div class="featureBannerCard btsGradient">
        <!-- Cột trái: Tiêu đề & Nút bấm -->
        <div class="bannerInfoCol">
            <h2 class="bannerTitle">Mùa tựu trường</h2>
            <p class="bannerDesc">Lựa chọn hàng đầu cho phòng ký túc xá, văn phòng và hơn thế nữa.</p>
            <a href="#" class="btnBannerWhite">Mua sắm ngay</a>
        </div>

        <!-- Cột phải: Carousel sản phẩm -->
        <div class="bannerCarouselCol">
            <button class="bannerNavBtn prevBtn" aria-label="Trước">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div class="bannerProductsGrid">
                <!-- SP 1 -->
                <div class="bannerProductCard">
                    <div class="cardImgHolder">
                        <img src="https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=300&q=80" alt="Samsung Galaxy Tab">
                    </div>
                    <div class="cardDetails">
                        <h4 class="prodTitle">Samsung Galaxy Tab A11+ (Plus) 11" 128GB...</h4>
                        <div class="prodRating">
                            <span class="stars">★★★★★</span>
                            <span class="count">(180)</span>
                        </div>
                        <span class="badgeSave">TIẾT KIỆM $80</span>
                        <div class="prodPrice">$269.99</div>
                    </div>
                </div>

                <!-- SP 2 -->
                <div class="bannerProductCard">
                    <div class="cardImgHolder">
                        <img src="https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=300&q=80" alt="MX Keys S">
                    </div>
                    <div class="cardDetails">
                        <h4 class="prodTitle">MX Keys S Bluetooth Combo - MX Keys S...</h4>
                        <div class="prodRating">
                            <span class="stars">★★★★★</span>
                            <span class="count">(639)</span>
                        </div>
                        <div class="prodPrice">$299.99</div>
                    </div>
                </div>

                <!-- SP 3 -->
                <div class="bannerProductCard">
                    <div class="cardImgHolder">
                        <img src="https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=300&q=80" alt="HP OmniStudio">
                    </div>
                    <div class="cardDetails">
                        <h4 class="prodTitle">HP OmniStudio All-in-One Desktop 27" FHD...</h4>
                        <div class="prodRating">
                            <span class="stars">★★★★★</span>
                            <span class="count">(83)</span>
                        </div>
                        <span class="badgeSave">TIẾT KIỆM $50</span>
                        <div class="prodPrice">$1,199.99</div>
                    </div>
                </div>

                <!-- SP 4 -->
                <div class="bannerProductCard">
                    <div class="cardImgHolder">
                        <img src="https://images.unsplash.com/photo-1558317374-067fb5f30001?w=300&q=80" alt="Segway Scooter">
                    </div>
                    <div class="cardDetails">
                        <h4 class="prodTitle">Segway E3 Electric Scooter (800W Motor...</h4>
                        <div class="prodRating">
                            <span class="stars">★★★★★</span>
                            <span class="count">(56)</span>
                        </div>
                        <div class="prodPrice">$699.99</div>
                    </div>
                </div>
            </div>

            <button class="bannerNavBtn nextBtn" aria-label="Tiếp theo">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <!-- Banner 2: Get the Latest and Greatest Tech -->
    <div class="featureBannerCard techGradient">
        <!-- Cột trái: Tiêu đề & Nút bấm -->
        <div class="bannerInfoCol">
            <div class="badgeIcon"><i class="fa-solid fa-sparkles"></i></div>
            <h2 class="bannerTitle">Đón đầu xu hướng công nghệ đỉnh cao.</h2>
            <a href="#" class="btnBannerWhite">Khám phá thêm</a>
        </div>

        <!-- Cột phải: Carousel sản phẩm -->
        <div class="bannerCarouselCol">
            <button class="bannerNavBtn prevBtn" aria-label="Trước">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div class="bannerProductsGrid">
                <!-- SP 1 -->
                <div class="bannerProductCard">
                    <div class="cardImgHolder">
                        <img src="https://images.unsplash.com/photo-1508685096489-7aacd43bd3b1?w=300&q=80" alt="Apple Watch">
                    </div>
                    <div class="cardDetails">
                        <h4 class="prodTitle">Apple Watch Series 12 (GPS + Cellular) 46m...</h4>
                        <div class="prodRating">
                            <span class="stars emptyStars">☆☆☆☆☆</span>
                            <span class="count">(0)</span>
                        </div>
                        <div class="prodPrice">$749.99</div>
                    </div>
                </div>

                <!-- SP 2 -->
                <div class="bannerProductCard">
                    <div class="cardImgHolder">
                        <img src="https://images.unsplash.com/photo-1600294037681-c80b4cb5b434?w=300&q=80" alt="AirPods 5">
                    </div>
                    <div class="cardDetails">
                        <h4 class="prodTitle">Apple AirPods 5 In-Ear Active Noise Cancelli...</h4>
                        <div class="prodRating">
                            <span class="stars">★★★★★</span>
                            <span class="count">(1)</span>
                        </div>
                        <div class="prodPrice">$209.99</div>
                    </div>
                </div>

                <!-- SP 3 -->
                <div class="bannerProductCard">
                    <div class="cardImgHolder">
                        <img src="https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=300&q=80" alt="Samsung Galaxy S26FE">
                    </div>
                    <div class="cardDetails">
                        <h4 class="prodTitle">Samsung Galaxy S26FE 128GB - Graphite -...</h4>
                        <div class="prodRating">
                            <span class="stars emptyStars">☆☆☆☆☆</span>
                            <span class="count">(0)</span>
                        </div>
                        <div class="prodPrice">$1,049.99</div>
                    </div>
                </div>

                <!-- SP 4 -->
                <div class="bannerProductCard">
                    <div class="cardImgHolder">
                        <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=300&q=80" alt="Mac mini">
                    </div>
                    <div class="cardDetails">
                        <h4 class="prodTitle">Apple Mac mini 512GB (MHQN4VC/A) Apple...</h4>
                        <div class="prodRating">
                            <span class="stars emptyStars">☆☆☆☆☆</span>
                            <span class="count">(0)</span>
                        </div>
                        <div class="prodPrice">$2,399.99</div>
                    </div>
                </div>
            </div>

            <button class="bannerNavBtn nextBtn" aria-label="Tiếp theo">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>
@endsection
