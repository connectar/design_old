<header class="main-header">
    <div class="d-flex align-items-center logo-box justify-content-start">
        <!-- Logo -->
        <a href="" class="logo">
            <!-- logo-->
            <div class="logo-mini w-40">
                <span class="light-logo">
                    <img src="{{ asset('images/logo-letter.png') }}" alt="logo" width="40px" height="40px">
                </span>
                <span class="dark-logo">
                    <img src="{{ asset('images/logo-letter.png') }}" alt="logo" width="40px" height="40px">
                </span>
            </div>
            <span class="text-primary px-2 fs-20">
                {{ trans('new_trans.site_title') }}
            </span>
        </a>
    </div>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="app-menu">
            <ul class="header-megamenu nav">
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light btn-sm"
                        data-toggle="push-menu" role="button">
                        <i data-feather="align-left"></i>
                    </a>
                </li>
            </ul>
        </div>
        @if (Auth::guard('admin')->check())
            <li class="btn-group d-lg-inline-flex ">
                <div class="app-menu">
                    <div class=" mx-5">
                        <a href="{{ route('back_to.main.dashboard') }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-arrow-left px-1"></i>
                            الرجوع للنظام
                        </a>
                    </div>
                </div>
            </li>
        @endif
    </nav>
</header>

@push('styles')
    <style>
        @media (max-width: 415px) {
            .xs-none {
                display: none;
            }
        }
    </style>
@endpush
