<!DOCTYPE html>
<html lang="ar">

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
    @stack('livewire_styles')
</head>

<body class="hold-transition theme-warning dark-skin rtl">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-12">

                        <div class="box bt-3 border-danger text-center bg-dark">
                            <div class="box-header no-border py-0">
                                <h2 class="text-primary">
                                    @lang('website.title')
                                </h2>
                            </div>
                            <div class="box-body">
                                <span class="fw-bold text-danger fs-20">
                                    <i class="fa fa-close text-danger px-1"></i>
                                    طلب غير صحيح
                                    عليك بارسال رابط صفحة تسجيل الدخول للهوتسبوت عند الضغط علي زرار مسح الQR Code
                                    مثال
                                </span>
                                <span class="fw-bold text-success d-block fs-14">
                                    https://connect4ar.com/qr/login?redirect_url=http://10.0.0.1/login
                                </span>

                                <div>
                                    <span class="fw-bold text-success fs-20">
                                        لا تنسى الصلاة على النبى
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
