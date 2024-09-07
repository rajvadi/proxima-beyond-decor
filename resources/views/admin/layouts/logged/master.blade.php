<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Proxima Beyond Decor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    @include('admin.layouts.logged.css')
    @yield('style')
</head>
<body data-sidebar="dark">
    <div id="layout-wrapper">
        @include('admin.layouts.logged.header')
        
        @include('admin.layouts.logged.sidebar')
        <div class="main-content">
            @yield('content')
            @include('admin.layouts.logged.footer')
        </div>
    </div>
    @include('admin.layouts.logged.script')
</body>
</html>
