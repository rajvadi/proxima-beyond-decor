<!DOCTYPE html>
<html lang="en" dir="ltr" class="light-style layout-menu-fixed">
<head>
    @php
        $app_setting = \App\Models\Setting::first();
    @endphp
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>{{ $app_setting->app_name ?? 'Cricket' }} | @yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ $app_setting->app_favicon_url ?? asset('assets/images/favicon.png') }}" />
    @include('admin.layouts.logged.css')
    @yield('style')
    <style>
        .swal2-container.swal2-center {
            align-items: center;
            z-index: 99999;
        }
    </style>
</head>
<body>
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('admin.layouts.logged.header')
        
        <div class="page-body-wrapper">
            @include('admin.layouts.logged.sidebar')
            <div class="page-body">
                @yield('content')
            </div>
            @include('admin.layouts.logged.footer')
            @include('admin.layouts.logged.script')
        </div>
    </div>
</body>
</html>
