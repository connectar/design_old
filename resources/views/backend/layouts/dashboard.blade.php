<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @lang('website.title2')
    </title>
    <!-- Vendors Style-->
    @include('backend.includes.import_css')
    @livewireStyles
    @stack('styles')
    @stack('livewire_styles')
</head>

<body
    class="hold-transition theme-warning dark-skin sidebar-mini fixed  {{ App::getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

    <div class="wrapper">
        {{-- <div id="loader"></div> --}}
        @yield('header')
        @yield('menu')
        <div class="content-wrapper">
            <div class="container-full">
                <section class="content px-xs-0">
                    @if (authIsAdmin())@include('backend.admins.DisplayNotifications.popup')@endif
                    @yield('admin_notify')
                    @yield('content')
                </section>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- Content Wrapper. Contains page content -->
        <!-- /.content-wrapper -->
        @include('backend.includes.footer')
        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->

    </div>
    <!-- ./wrapper -->
    <!-- Page Content overlay -->

    <!-- Vendor JS -->
    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/Web-Ticker-master/jquery.webticker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <!-- Crypto Admin App -->
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>
    @livewireScripts
    @include('sweetalert::alert')
    @stack('livewire_scripts')
    @stack('scripts')
    <script src="{{ asset('assets/includes/swal_modal.js?id=' . $updatedCode) }}"></script>
    <script src="{{ asset('assets/includes/alpine_functions.js?id=' . $updatedCode) }}"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    @stack('chat')
</body>

</html>
