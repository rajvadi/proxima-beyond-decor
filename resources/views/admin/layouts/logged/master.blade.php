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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
            else
            {
                $('#blah').attr('src', '{{ asset('assets/images/users/user-dummy-img.jpg') }}');
            }
        }
        setTimeout(function() {
            var alert = document.getElementById('autoDismissAlert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(function() {
                    alert.remove(); // Removes the alert from DOM after fade-out
                }, 300); // Adjust this timing if needed
            }
        }, 2000);
    </script>
</body>
</html>
