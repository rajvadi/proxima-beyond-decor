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
    <style>
        #product-list {
            float: left;
            list-style: none;
            margin-top: -3px;
            padding: 0;
            width: 71%;
            position: absolute;
        }

        #product-list li {
            padding: 10px;
            background: #f0f0f0;
            border-bottom: #bbb9b9 1px solid;
        }

        #product-list li:hover {
            background: #ece3d2;
            cursor: pointer;
        }
    </style>
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
    <script>
        $(document).ready(function() {
            $("#pcode").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('product.code.search') }}",
                    data: 'keyword=' + $(this).val() + '&cid=' + $("#cid").val(),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $("#pcode").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                    },
                    success: function(data) {
                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);
                        $("#pcode").css("background", "#FFF");
                    }
                });
            });
        });
        function selectProduct(val) {
            $("#pcode").val(val);
            $("#suggesstion-box").hide();
            // submit the form
            $("#product_search").submit();
        }
        
        // onclick of anywhere in the page hide the product list
        $(document).on('click', function() {
            $("#suggesstion-box").hide();
        });
    </script>
    @yield('script')
</body>
</html>