<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from maraviyainfotech.com/projects/ekka/ekka-v37/ekka-html/demo-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Sep 2024 14:16:21 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    
    <title>Proxima Beyond Decor</title>
    <meta name="keywords" content="apparel, catalog, clean, ecommerce, ecommerce HTML, electronics, fashion, html eCommerce, html store, minimal, multipurpose, multipurpose ecommerce, online store, responsive ecommerce template, shops"/>
    <meta name="description" content="Best ecommerce html template for single and multi vendor store.">
    <meta name="author" content="ashishmaraviya">
    
    <!-- site Favicon -->
    <link rel="icon" href="{{ asset('FE/assets/images/favicon/favicon-3.png') }}" sizes="32x32"/>
    <link rel="apple-touch-icon" href="{{ asset('FE/assets/images/favicon/favicon-3.png') }}"/>
    <meta name="msapplication-TileImage" content="{{ asset('FE/assets/images/favicon/favicon-3.png') }}"/>
    
    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{ asset('FE/assets/css/vendor/ecicons.min.css') }}"/>
    
    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="{{ asset('FE/assets/css/plugins/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('FE/assets/css/plugins/jquery-ui.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('FE/assets/css/plugins/slick.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('FE/assets/css/plugins/bootstrap.css') }}"/>
    
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('FE/assets/css/app.css') }}"/>

</head>
<body>
<div id="ec-overlay">
    <div class="ec-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<!-- Header start  -->
<header class="ec-header">
    <!-- Ec Header Bottom  Start -->
    <div class="ec-header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row">
                <div class="header-bottom-flex">
                    <!-- Ec Header Logo Start -->
                    <div class="align-self-center ec-header-logo ">
                        <div class="header-logo">
                            <a href="index.html">
                                <img src="{{ asset('FE/assets/images/logo/logo-3.png') }}"
                                     alt="Site Logo"/>
                                <img class="dark-logo"
                                     src="{{ asset('FE/assets/images/logo/dark-logo-3.png') }}" alt="Site Logo"
                                     style="display: none;"/>
                            </a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->
                    
                    <!-- Ec Header Search Start -->
                    <div class="align-self-center ec-header-search">
                        <div class="header-search">
                            <form class="ec-search-group-form" action="#">
                                <div class="ec-search-select-inner">
                                    <select name="category">
                                        <option selected>All</option>
                                        @foreach(\App\Models\Category::all() as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input class="form-control" placeholder="I’m searching for..." type="text">
                                <button class="search_submit" type="submit">Search
                                    <i class="fi-rr-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Ec Header Search End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Header Button End -->
    <!-- Header responsive Bottom  Start -->
    <div class="ec-header-bottom d-lg-none">
        <div class="container position-relative">
            <div class="row ">
                
                <!-- Ec Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="index.html">
                            <img src="{{ asset('FE/assets/images/logo/logo-3.png') }}" alt="Site Logo"/>
                            <img
                                    class="dark-logo" src="{{ asset('FE/assets/images/logo/dark-logo-3.png') }}" alt="Site Logo"
                                    style="display: none;"/>
                        </a>
                    </div>
                </div>
                <!-- Ec Header Logo End -->
                <!-- Ec Header Search Start -->
                <div class="col align-self-center ec-header-search">
                    <div class="header-search">
                        <form class="ec-search-group-form" action="#">
                            <div class="ec-search-select-inner">
                                <select name="category">
                                    <option selected>All</option>
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input class="form-control" placeholder="I’m searching for..." type="text">
                            <button class="search_submit" type="submit">
                                <i class="fi-rr-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Ec Header Search End -->
            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  End -->
    <!-- EC Main Menu Start -->
    <div id="ec-main-menu-desk" class="sticky-nav">
        <div class="container position-relative">
            <div class="row">
                <div class="ec-main-menu-block align-self-center d-none d-lg-block">
                    <div class="ec-main-menu p-3">
                        <h4 style="color: white">Welcome To the Proxima Beyond Decor</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Main Menu End -->
</header>
<!-- Header End  -->

<!-- Main Slider Start -->
<div class="ec-main-slider section section-space-mb">
    <div class="ec-slider">
        <div class="ec-slide-item d-flex slide-1">
            <img src="{{ asset('FE/assets/images/main-slider-banner/arrow-7.png') }}" class="main_banner_arrow_img" alt=""/>
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                        <div class="ec-slide-content slider-animation">
                            <h2 class="ec-slide-stitle">Stylish & comfort</h2>
                            <h1 class="ec-slide-title">Living Sofas</h1>
                            <p>Introducing Apple Watch Series 4. Fundamentally redesigned and re-engineered to help you stay even more active, healthy, and connected.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ec-slide-item d-flex slide-2">
            <img src="{{ asset('FE/assets/images/main-slider-banner/arrow-8.png') }}" class="main_banner_arrow_img" alt=""/>
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                        <div class="ec-slide-content slider-animation">
                            <h2 class="ec-slide-stitle">Stylish & comfort</h2>
                            <h1 class="ec-slide-title">Living Couch</h1>
                            <p>Introducing Apple Watch Series 4. Fundamentally redesigned and re-engineered to help you stay even more active, healthy, and connected.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ec-slide-item d-flex slide-3">
            <img src="{{ asset('FE/assets/images/main-slider-banner/arrow-9.png') }}" class="main_banner_arrow_img" alt=""/>
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                        <div class="ec-slide-content slider-animation">
                            <h2 class="ec-slide-stitle">Stylish & comfort</h2>
                            <h1 class="ec-slide-title">Garden Chair</h1>
                            <p>Introducing Apple Watch Series 4. Fundamentally redesigned and re-engineered to help you stay even more active, healthy, and connected.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->

<!--  services Section Start -->

<!--services Section End -->

<!-- Footer Start -->
<footer class="ec-footer">
    <div class="footer-container">
        <div class="footer-bottom text-center">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Footer Copyright Start -->
                    <div class="col footer-copy">
                        <div class="footer-bottom-copy ">
                            <div class="ec-copy">Copyright ©
                                <span id="copyright_year"></span>
                                <a class="site-name text-upper"
                                   href="{{ route('home') }}">Proxima Beyond Decor
                                </a>
                                . All Rights Reserved
                            </div>
                        </div>
                    </div>
                    <!-- Footer Copyright End -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->


<!-- Newsletter Modal Start -->

<!-- Vendor JS -->
<script src="{{ asset('FE/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>

<!--Plugins JS-->
<script src="{{ asset('FE/assets/js/plugins/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/plugins/countdownTimer.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('FE/assets/js/plugins/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/plugins/slick.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/plugins/infiniteslidev2.js') }}"></script>

<!-- Main Js -->
<script src="{{ asset('FE/assets/js/demo-3.js') }}"></script>

</body>
</html>