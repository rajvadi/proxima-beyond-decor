<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="ecommerce, market, shop, mart, cart, deal, multipurpose, marketplace">
    <meta name="description" content="Carrot - Multipurpose eCommerce HTML Template.">
    <meta name="author" content="ashishmaraviya">
    
    <title>Proxima Beyond Decor</title>
    
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('FE/assets/img/logo/favicon.png') }}">
    
    <!-- Icon CSS -->
    <link rel="stylesheet" href="{{ asset('FE/assets/css/vendor/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/assets/css/vendor/remixicon.css') }}">
    
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('FE/assets/css/vendor/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/assets/css/vendor/aos.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/assets/css/vendor/range-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/assets/css/vendor/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/assets/css/vendor/jquery.slick.css') }}">
    <link rel="stylesheet" href="{{ asset('FE/assets/css/vendor/slick-theme.css') }}">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('FE/assets/css/style.css') }}">
</head>

<body class="body-bg-6">

<!-- Loader -->
<div id="cr-overlay">
    <span class="loader"></span>
</div>

<!-- Header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-header">
                    <a href="index.html" class="cr-logo">
                        <img src="{{ asset('FE/assets/img/logo/logo.png') }}" alt="logo" class="logo">
                        <img src="{{ asset('FE/assets/img/logo/dark-logo.png') }}" alt="logo" class="dark-logo">
                    </a>
                    <form class="cr-search">
                        <input class="search-input" name="pcode" type="text" placeholder="Search For products...">
                        <select class="form-select" name="category" aria-label="Default select example">
                            <option value="" selected>All Categories</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button href="javascript:void(0)" class="search-btn">
                            <i class="ri-search-line"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="cr-fix" id="cr-main-menu-desk">
        <div class="container">
            <div class="text-center mt-3" style="color: #009adc">
                <h4>Welcome To Proxima Beyond Decor</h4>
            </div>
        </div>
    </div>
</header>

<!-- Mobile menu -->
<!-- Hero slider -->
<section class="section-hero next">
    <div class="cr-slider swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="cr-hero-banner cr-banner-image-two">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cr-left-side-contain slider-animation">
                                    <h5><span>100%</span> Organic Fruits</h5>
                                    <h1>Explore fresh & juicy fruits.</h1>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet reiciendis
                                        beatae consequuntur.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="cr-hero-banner cr-banner-image-one">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cr-left-side-contain slider-animation">
                                    <h5><span>100%</span> Organic Vegetables</h5>
                                    <h1>The best way to stuff your wallet.</h1>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet reiciendis
                                        beatae consequuntur.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="cr-hero-banner cr-banner-image-three">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cr-left-side-contain slider-animation">
                                    <h5><span>100%</span> Organic Vegetables</h5>
                                    <h1>The best way to stuff your wallet.</h1>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet reiciendis
                                        beatae consequuntur.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<!-- Footer -->
<footer class="footer bg-off-white">
    <div class="container">
        <div class="cr-last-footer">
            <p>&copy; <span id="copyright_year"></span> <a href="{{ route('home') }}">Proxima Beyond Decor</a>, All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Tab to top -->
<a href="#Top" class="back-to-top result-placeholder">
    <i class="ri-arrow-up-line"></i>
    <div class="back-to-top-wrap">
        <svg viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
</a>

<!-- Vendor Custom -->
<script src="{{ asset('FE/assets/js/vendor/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/vendor/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/vendor/mixitup.min.js') }}"></script>

<script src="{{ asset('FE/assets/js/vendor/range-slider.js') }}"></script>
<script src="{{ asset('FE/assets/js/vendor/aos.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/vendor/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('FE/assets/js/vendor/slick.min.js') }}"></script>

<!-- Main Custom -->
<script src="{{ asset('FE/assets/js/main.js') }}"></script>
</body>


<!-- Mirrored from maraviyainfotech.com/projects/carrot/carrot-v21/carrot-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 Sep 2024 05:48:38 GMT -->
</html>