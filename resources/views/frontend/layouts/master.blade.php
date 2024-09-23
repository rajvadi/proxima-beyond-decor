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
    <link rel="shortcut icon" href="{{ asset('FE/assets/img/logo/favicon.ico') }}">
    @include('frontend.layouts.css')
    @yield('style')
</head>
<body class="body-bg-6">
    <!-- Loader -->
    <div id="cr-overlay">
        <span class="loader"></span>
    </div>
    @include('frontend.layouts.header')
    @yield('content')
    @include('frontend.layouts.footer')
    <!-- Tab to top -->
    <a href="#Top" class="back-to-top result-placeholder">
        <i class="ri-arrow-up-line"></i>
        <div class="back-to-top-wrap">
            <svg viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
            </svg>
        </div>
    </a>
    @include('frontend.layouts.script')
    @yield('script')
</body>
</html>