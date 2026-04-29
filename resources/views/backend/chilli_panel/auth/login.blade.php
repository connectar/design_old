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
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendor_components/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/ibm_fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css?id=65874569') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css?id=3444') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cairo_fonts.css') }}">
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
    style="background-image: url({{ asset($settings['background']) }})">
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="bg-white rounded10 shadow-lg">
                            <div class="content-top-agile p-20 pb-0">
                                @if (empty($settings['photo']) && empty($settings['name']))
                                    <div class="justify-content-center">
                                        <span class="fs-40 text-info">Wifi</span>
                                        <sup style="top:-14px">
                                            <i class="text-dark fa fa-wifi fs-26"
                                                aria-hidden="true"></i>
                                        </sup>

                                        <span class="fs-40 text-info">Cafe</span>
                                    </div>
                                @endif

                                @isset($settings['photo'])
                                    <img src="{{ asset($settings['photo']) }}"
                                        class="b-1 border-primary rounded-circle" width="85px"
                                        height="85px">
                                @endisset
                                @isset($settings['name'])
                                    <div class="justify-content-center">
                                        <span class="fs-20 text-info">
                                            {{ $settings['name'] }}
                                        </span>

                                    </div>
                                @endisset
                                @if (in_array($data['res'], ['notyet', 'failed', 'logoff']))
                                    @if (count($drinks) > 0)
                                        @include('backend.chilli_panel.auth.includes.drinks_modal')
                                    @endif
                                @endif

                            </div>
                            <div class="p-20">
                                <div class="text-left">

                                </div>
                                @if (in_array($data['res'], ['notyet', 'failed', 'logoff']))
                                    @include('backend.chilli_panel.auth.includes.form')
                                @endif

                                @if (in_array($data['res'], ['already', 'success']))
                                    @include('backend.chilli_panel.auth.includes.info')
                                @endif
                            </div>
                            <div class="text-center">
                                <div class="justify-content-center bg-dark">
                                    @isset($settings['phone'])
                                        <span>
                                            للاتصال:
                                        </span>
                                        <span class="fs-18">
                                            {{ $settings['phone'] }}
                                        </span>
                                    @endisset
                                    @if ($settings['phone_other'] && !empty($settings['phone_other']))
                                        - <span class="fs-18">
                                            {{ $settings['phone_other'] }}
                                        </span>
                                    @endif
                                </div>
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
