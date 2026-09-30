<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Web mới')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    @yield('styles')
</head>
<body>
    <div id="root">
        <header class="headerContainer" role="banner">
            <div class="upperToolbar">
                <nav aria-label="Trạng thái đơn hàng, Blog, Best Buy Doanh nghiệp và Tiếng Pháp">
                    <ul class="navList">
                        <li><a href="{{ url('/backend/product/create') }}">Quản trị</a></li>
                        <li><a href="#">Trạng thái đơn hàng</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Doanh nghiệp</a></li>
                        <li><a href="#">Tiếng Pháp</a></li>
                    </ul>
                </nav>
            </div>

            <div class="mainHeader">
                <div class="logoContainer">
                    <a class="logoLink" href="{{ url('/') }}" aria-label="Trang chủ Best Buy Canada">
                        <svg aria-hidden="false" viewBox="0 0 1518.5 528.45" class="logo">
                            <g>
                                <path fill="#fff" d="M1273.46,43.91h-156.58c-6.88,34.81-13.76,69.62-20.64,104.42,42.93-26.36,96.9-27.55,140.91-3.1,43.83,24.35,71.3,70.53,71.8,120.7h-35.53c-.44-38.92-23.28-74.26-58.54-90.58-35.54-16.45-77.61-10.78-107.6,14.52-3.4-10.72-9.2-25.02-19.36-40.08-8.14-12.07-16.78-21.23-24.02-27.86,7.53-38.37,15.05-76.73,22.58-115.1h186.98v37.08Z"></path>
                                <g>
                                    <polygon fill="#fff200" points="1240.73 303.38 1518.36 303.38 1518.36 525.73 1240.67 525.73 1171.58 460.66 1171.58 368.92 1240.73 303.38"></polygon>
                                    <path fill="#1d252c" d="M1226.79,414.39c0,7.59-6.15,13.74-13.74,13.74s-13.74-6.15-13.74-13.74,6.15-13.74,13.74-13.74,13.74,6.15,13.74,13.74h0Z"></path>
                                </g>
                                <path fill="#fff" d="M1133.8,361.69v40.08c0-.43-14.58-5.74-16.05-6.45-5.37-2.59-10.56-5.55-15.53-8.84-9.92-6.58-18.95-14.48-26.83-23.39-16.05-18.14-27.3-40.37-32.57-64-6.5-29.17,4.29-60.91-6.8-89.14-8.19-20.85-26.44-36.7-47.61-43.49-14-4.49-29.21-5-43.39-1.01-22.07,6.2-39.93,22.38-49,43.35-19.99,46.12,5.02,88.62,45.39,111.46l-25.3,24.8c-31.95-14.2-58.55-52.41-61.69-87.65-3.19-35.8,6.55-72.42,32.14-98.46,21.87-22.25,52.92-34.62,84.09-33.76,56.27,1.56,100.86,48.44,105.29,103.61,1.57,19.57-2.01,39.31,1.33,58.79,5.68,33.07,27.44,60.47,56.53,74.09Z"></path>
                                <path fill="#fff" d="M1005.62,309.56l-173.8,183.14v33.04h353.44l-39.36-37.09h-257.66l133.2-140.51c.4-.42.48-1.05.2-1.56-3.11-5.77-3.61-5.32-6.83-12.18-3.24-6.9-6.38-18.57-7.56-24.39-.15-.76-1.1-1.03-1.63-.46Z"></path>
                                <path fill="#fff" d="M1165.41,319.53l.4-20.34c.01-.76-.71-1.31-1.43-1.09l-28.15,8.48c-.9.27-1.71-.62-1.35-1.49l3.92-9.58c.18-.45.05-.97-.32-1.28l-30.63-25.36c-.68-.56-.46-1.66.38-1.92l6.77-2.08c.63-.19.95-.88.7-1.49l-7.88-18.98c-.34-.82.36-1.69,1.23-1.52l17.04,3.22c.61.12,1.19-.29,1.3-.9l1.44-8.05c.15-.86,1.19-1.21,1.84-.63l20.27,18.32c.83.75,2.12-.05,1.82-1.12l-9.62-34.44c-.25-.9.65-1.69,1.51-1.32l12.23,5.2c.56.24,1.21-.02,1.45-.58l10.28-23.32c.39-.89,1.65-.88,2.04,0l10.12,23.26c.24.56.89.82,1.46.58l12.09-5.15c.86-.37,1.76.42,1.51,1.32l-9.62,34.58c-.3,1.08,1,1.87,1.82,1.12l20.25-18.43c.65-.59,1.7-.23,1.85.64l1.37,8.01c.1.61.69,1.02,1.3.91l17.14-3.15c.87-.16,1.57.71,1.23,1.52l-7.89,19c-.25.6.07,1.29.69,1.49l6.79,2.14c.84.27,1.05,1.36.37,1.92l-30.48,25.23c-.38.31-.5.83-.32,1.28l3.92,9.57c.35.87-.45,1.76-1.35,1.49l-28.3-8.49c-.72-.22-1.45.33-1.43,1.09l.4,20.34c.01.62-.49,1.13-1.11,1.13h-5.96c-.62,0-1.13-.51-1.11-1.13Z"></path>
                            </g>
                        </svg>
                    </a>
                </div>

                <div class="searchBar">
                    <form id="searchForm" action="#" method="GET">
                        <input type="text" placeholder="Tìm kiếm tại Best Buy" aria-label="Tìm kiếm tại Best Buy">
                        <button type="submit" aria-label="Tìm kiếm"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>

                <div class="userActions">
                    <div class="location">
                        <i class="fa-solid fa-store"></i>
                        <span>Tp. Hồ Chí Minh</span>
                    </div>
                    <a href="{{ url('/cart') }}" class="cartLink">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="cartCount">0</span>
                    </a>
                </div>
            </div>

            <nav class="categoryNav">
                <ul>
                    <li><a href="/" class="menuBtn"><i class="fa-solid fa-bars"></i> Trang chủ</a></li>
                    @if(isset($categories) && count($categories) > 0)
                        @foreach(array_slice($categories, 0, 4) as $cat)
                            <li class="navItemWithSub">
                                <a href="{{ url('/category/' . $cat['slug']) }}">{{ $cat['tên'] }}</a>
                                @if(isset($cat['subcategories']) && count($cat['subcategories']) > 0)
                                    <ul class="submenu">
                                        @foreach($cat['subcategories'] as $sub)
                                            <li><a href="{{ url('/category/' . $cat['slug']) }}">{{ $sub['tên'] }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    @endif

                </ul>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="siteFooter">
            <div class="footerValueProps">
                <div class="valuePropsWrapper">
                    <div class="propItem">
                        <i class="fa-solid fa-clock-rotate-left propIcon"></i>
                        <span class="propText">Nhận tại cửa hàng<br>Nhanh chóng & Dễ dàng</span>
                    </div>
                    <div class="propItem">
                        <i class="fa-solid fa-truck-fast propIcon"></i>
                        <span class="propText">Miễn phí vận chuyển<br>cho đơn hàng trên $35</span>
                    </div>
                    <div class="propItem">
                        <i class="fa-solid fa-circle-dollar-to-slot propIcon"></i>
                        <span class="propText">Cam kết<br>Giá thấp nhất</span>
                    </div>
                    <div class="propItem">
                        <i class="fa-solid fa-wand-magic-sparkles propIcon"></i>
                        <span class="propText">Công nghệ<br>Mới nhất & Tốt nhất</span>
                    </div>
                </div>
            </div>

            <div class="footerMain">
                <div class="footerMainWrapper">
                    <div class="footerLinksGrid">
                        <div class="footerCol">
                            <h4 class="colTitle">Hỗ trợ khách hàng</h4>
                            <ul class="colList">
                                <li><a href="#">Liên hệ với chúng tôi</a></li>
                                <li><a href="#">Trung tâm hỗ trợ</a></li>
                                <li><a href="#">Trả hàng & Đổi hàng</a></li>
                                <li><a href="#">Thẻ quà tặng Best Buy</a></li>
                                <li><a href="#">Về Best Buy Marketplace</a></li>
                            </ul>

                            <h4 class="colTitle mtSection">Về chúng tôi</h4>
                            <ul class="colList">
                                <li><a href="#">Tuyển dụng</a></li>
                                <li><a href="#">Thông tin công ty</a></li>
                                <li><a href="#">Vì cộng đồng</a></li>
                                <li><a href="#">Phòng tin tức</a></li>
                                <li><a href="#">Cam kết bảo vệ môi trường</a></li>
                                <li><a href="#">Best Buy Hoa Kỳ</a></li>
                            </ul>
                        </div>

                        <div class="footerCol">
                            <h4 class="colTitle">Tài khoản My Best Buy</h4>
                            <ul class="colList">
                                <li><a href="#">Trạng thái đơn hàng</a></li>
                                <li><a href="#">Quản lý tài khoản</a></li>
                                <li><a href="#">Trung tâm tùy chỉnh</a></li>
                                <li><a href="#">Yêu cầu thông tin cá nhân</a></li>
                            </ul>

                            <h4 class="colTitle mtSection">Hợp tác với chúng tôi</h4>
                            <ul class="colList">
                                <li><a href="#">Quảng cáo với Best Buy</a></li>
                                <li><a href="#">Trở thành đối tác liên kết</a></li>
                                <li><a href="#">Bán hàng trên Best Buy Marketplace</a></li>
                            </ul>
                        </div>

                        <div class="footerCol">
                            <h4 class="colTitle">Dịch vụ</h4>
                            <ul class="colList">
                                <li><a href="#">Geek Squad</a></li>
                                <li><a href="#">Hội viên Best Buy</a></li>
                                <li><a href="#">Bảo vệ Best Buy</a></li>
                                <li><a href="#">Gói đăng ký hàng tháng</a></li>
                                <li><a href="#">Trả góp Best Buy</a></li>
                                <li><a href="#">Chương trình Thu cũ đổi mới</a></li>
                            </ul>

                            <h4 class="colTitle mtSection">Ứng dụng di động</h4>
                            <ul class="colList">
                                <li><a href="#"><i class="fa-brands fa-android"></i> Ứng dụng Android</a></li>
                                <li><a href="#"><i class="fa-brands fa-apple"></i> Ứng dụng iOS</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="footerNewsletterCol">
                        <h3 class="newsTitle">Hãy là người đầu tiên biết</h3>
                        <p class="newsDesc">Đăng ký để cập nhật những ưu đãi hot nhất, sản phẩm mới nhất và các sự kiện giảm giá độc quyền.</p>
                        <a href="#" class="newsInfoLink">thông tin của tôi như thế nào? <i class="fa-solid fa-chevron-down"></i></a>

                        <form class="subscribeForm" onsubmit="event.preventDefault();">
                            <input type="email" placeholder="Địa chỉ Email" required class="emailInput">
                            <button type="submit" class="btnSignUp">Đăng ký</button>
                        </form>

                        <div class="socialIcons">
                            <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a>
                            <a href="#" aria-label="X (Twitter)"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>
                </div>

                <div class="footerBottom">
                    <p class="copyrightText">© Best Buy Canada Ltd. Suite #102, 425 West 6th Avenue, Vancouver, BC V5Y 1L3</p>
                    <ul class="legalLinks">
                        <li><a href="#">Điều khoản & Điều kiện</a></li>
                        <li><a href="#">Điều kiện sử dụng</a></li>
                        <li><a href="#">Chính sách trực tuyến</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Chính sách Cookie</a></li>
                        <li><a href="#">Chính sách tiếp cận</a></li>
                        <li><a href="#">Điều khoản & Điều kiện Geek Squad</a></li>
                        <li><a href="#">Thu hồi sản phẩm</a></li>
                        <li><a href="#">Tín dụng</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('scripts')
</body>
</html>