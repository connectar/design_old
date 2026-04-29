<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Meta tags and Favicon --}}
    @include('frontend.theme_two.layouts.meta_and_favicon')
    {{-- /Meta tags and Favicon --}}

    <title>
        {{ __('website.title2') }}
    </title>

    {{-- CSS links and header links --}}
    @include('frontend.theme_two.layouts.links')
    {{-- /CSS links and header links --}}
</head>

<body dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

    {{-- butterfly effect --}}
    <!--
        <div class="butterfly-container">
            <img src="{{ asset('new_frontend_theme/images/logo.png') }}" class="butterfly" alt="Butterfly">
        </div>
  -->
    {{-- /butterfly effect --}}

    @include('frontend.theme_two.layouts.header')

    <!--  Page content section -->
    <div style="min-height: 87vh;background-color: #e9c12a">
        @yield('content')
    </div>
    <!-- /page content section -->

    @include('frontend.theme_two.layouts.footer')

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
    @stack('modals')

    {{-- javascript and footer scripts --}}
    @include('frontend.theme_two.layouts.footer_scripts')
    {{-- /javascript and footer scripts --}}
</body>

<script type="text/javascript">
    (function(c, l, a, r, i, t, y) {
        c[a] = c[a] || function() {
            (c[a].q = c[a].q || []).push(arguments)
        };
        t = l.createElement(r);
        t.async = 1;
        t.src = "https://www.clarity.ms/tag/" + i;
        y = l.getElementsByTagName(r)[0];
        y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "pqy1sa0bnm");
</script>

</html>
