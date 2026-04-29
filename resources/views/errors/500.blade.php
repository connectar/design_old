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
                                    <i class="fa fa-close text-danger"></i>
                                    حدث خطا وتم ابلاغ المدير برجاء اعادة المحاولة خلال خمس
                                    دقائق من الان
                                </span>
                                <a href="" class="btn btn-sm btn-success">
                                    اعد المحاولة
                                </a>
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
