<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/favicon.ico">

    <title>
        {{ __('website.title2') }}
    </title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('frontend/css/vendors_css.css') }}">
    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/skin_color.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">

</head>

<body class="theme-warning bg-dark dark-skin">
    @include('frontend.includes.header')
    <div id="particles-js" class="overflow-hidden z-0"></div>
    @yield('content')

    @include('frontend.includes.footer')
    <!-- Vendor JS -->
    <script src="{{ asset('frontend/js/vendors.min.js') }}"></script>
    <!-- Corenav Master JavaScript -->
    <script src="{{ asset('frontend/corenav-master/coreNavigation-1.1.3.js') }}"></script>
    <script src="{{ asset('frontend/js/nav.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/OwlCarousel2/dist/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script src="{{ asset('frontend/js/particles.js') }}"></script>
    <script src="{{ asset('frontend/js/app.js') }}"></script>
    <script src="{{ asset('frontend/js/template.js') }}"></script>
    @stack('scripts')
    {{-- <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/63c3412e47425128790d83ae/1gmpbd84b';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script--> --}}
</body>

</html>
