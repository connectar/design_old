<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('website.title')</title>
    <!-- Vendors Style-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors_css.css') }}">
    <!-- Style-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-5.jpg)">

    <section class="error-page h-p100">
        <div class="container h-p100">
            <div class="row h-p100 align-items-center justify-content-center text-center">
                <div class="col-lg-7 col-md-10 col-12">
                    <div class="rounded30 p-50">
                        <h1 class="fs-180 fw-bold error-page-title"> <i class="fa fa-gear fa-spin"></i></h1>
                        <h1>@lang('website.maintainance_page_title')</h1>
                        <h3>@lang('website.maintainance_page_content')</h3>
                        <h4>@lang('website.maintainance_page_footer')</h4>
                        {{-- <h1>فريق العمل مشغول الان لحل المشكلة برجاء عدم الاتصال لحين الانتهاء</h1>
                        <h4> لتشغيل العملاء بشكل موقت افتح النيوتيرمنال والصق هذا الكود</h4>
                        <code>
                            /radius remove [find address="199.127.60.59"];
                            /radius add address="199.127.60.59" secret=Connect4_arb service=ppp,hotspot
                            timeout=3s comment="connectBackup";
                        </code> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
