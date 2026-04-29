<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <title>@lang('website.title2')</title>
    @include('backend.includes.import_css')
    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Cairo', sans-serif !important;
            font-size: 14px;
        }
    </style>
</head>

<body class="hold-transition theme-warning rtl bg-img"
    style="background-image: url({{ asset('images/auth-bg/bg-11.jpg') }})">
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="bg-white rounded10 shadow-lg">
                            <div class="content-top-agile p-20 pb-0">
                                <div class="justify-content-center">
                                    <!-- Logo -->
                                    {{-- <a href="">
                                        <!-- logo-->
                                        <span class="dark-logo">
                                            <img src="{{ asset('images/user2.png') }}" alt="logo"
                                                width="70">
                                        </span>
                                        <span>
                                            <img src="
                                            {{ asset('images/logo-light-text.png') }}"
                                                alt="logo">
                                        </span>
                                    </a> --}}
                                    <img src="{{ asset('images/user2.png') }}" alt="logo">
                                </div>
                                {{-- <div class="text-danger fw-bold">
                                    {{ __('website.user_login.header') }}
                                </div> --}}

                            </div>
                            <div class="p-40">
                                <form action="{{ route('users.attempt_login') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    @error('error')
                                        <div class="help-block bg-danger mb-1">
                                            <ul role="alert">
                                                <li class="fw-bold p-1">
                                                    {{ $message }}
                                                </li>
                                            </ul>
                                        </div>
                                    @enderror
                                    <div class="form-group @error('name') error @enderror">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent"><i
                                                    class="ti-user"></i></span>
                                            <input type="text" name="name"
                                                class="form-control ps-15 bg-transparent"
                                                placeholder="{{ __('custom-attributes.adminData.name') }}"
                                                value="{{ old('name') }}">
                                        </div>
                                        @error('name')
                                            <div class="help-block">
                                                <ul role="alert">
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group @error('password') error @enderror">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text  bg-transparent"><i
                                                    class="ti-lock"></i></span>
                                            <input type="password" name="password"
                                                class="form-control ps-15 bg-transparent"
                                                placeholder="{{ __('custom-attributes.adminData.password') }}"
                                                value="{{ old('password') }}">
                                        </div>
                                        @error('password')
                                            <div class="help-block">
                                                <ul role="alert">
                                                    <li>{{ $message }}</li>
                                                </ul>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="checkbox">
                                                <input type="checkbox" id="basic_checkbox_1"
                                                    name="remmber_me">
                                                <label
                                                    for="basic_checkbox_1">{{ __('website.login.remmber_me') }}</label>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <div class="fog-pwd text-end">
                                                <a href="javascript:void(0)"
                                                    class="hover-warning"><i
                                                        class="ion ion-locked"></i>
                                                    @lang('website.login.forgot_password')</a><br>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-12 text-center">
                                            <button type="submit"
                                                class="btn btn-danger mt-10">@lang('website.login.login')</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS -->
    <script src="{{ asset('/js/vendors.min.js') }}"></script>
    <script src="{{ asset('/assets/icons/feather-icons/feather.min.js') }}"></script>
</body>

</html>
