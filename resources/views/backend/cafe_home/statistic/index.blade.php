@extends('backend.layouts.livewire.admin')

@push('livewire_styles')
    <!--amcharts -->
    <link href="https://www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class="p-2 text-center b-1 b-primary bg-dark">
                        <div class="py-1 mb-1">
                            <a class="btn btn-sm btn-success" href="{{ route('download_hotspot') }}">
                                تحميل صفحة الهوت سبوت
                            </a>
                        </div>
                        <p>
                            لدفع الاشتراك الخاص بالسيستم علي خدمة فودافون كاش <span
                                class="text-danger fs-18">010<span
                                    class="text-warning">122</span>122<span
                                    class="text-warning">94</span></span> لشرح
                            التحويل التلقائي
                            <a class="btn btn-sm btn-primary" href="https://youtu.be/WHebz6FIeig"
                                target="_blank">اضغط
                                هنا</a>
                            للدعم الفني والاستفسارات من خلال صفحتنا علي الفيس بوك
                            <a href="https://fb.com/connect4ar" class="btn btn-sm btn-primary"
                                target="_blank">من هنا</a>
                            أومن خلال الأرقام التالية
                            <span class="fs-18 text-warning">01026177689</span> محسن
                            <span class="text-warning fs-18">01008256588</span> زيزو
                        </p>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-xxxl-8 col-xl-7 col-12">
                            <div class="row px-40">
                                @foreach ($statistic as $key => $div)
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <a href="{{ route($div['route']) }}">
                                            <div
                                                class="box {{ $div['box'] }} bg-brick-dark rounded30 mb-md-30 mt-10 mb-0">
                                                <div class="box-body">
                                                    <div class="text-center">
                                                        <i class="{{ $div['icon'] }} fs-30 text-white"
                                                            title="BTC"></i>
                                                        <h4 class="fs-14"
                                                            style="white-space: nowrap;">
                                                            {{ $div['title'] }}
                                                        </h4>
                                                    </div>
                                                    <div class="mt-140 mt-xs-10 text-center">
                                                        <h3 class="fs-30 fw-600">
                                                            {{ $statistic_primary[$loop->index] }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xxxl-4 col-xl-5 col-12">
                            <div class="row mt-30">
                                @foreach ($secondary as $key => $div)
                                    <div class="col-md-6 col-12">
                                        <a href="{{ route('admins.users.index', $div['route_param']) }}">
                                            <div
                                                class="box box-body pull-up {{ $div['box'] }} bg-deathstar-white">
                                                <div class="flexbox">
                                                    <span class="{{ $div['icon'] }} fs-40"></span>
                                                    <span class="fw-200 fs-26">
                                                        {{ $statistic_secondary[$loop->index] }}
                                                    </span>
                                                </div>
                                                <div class="text-end">
                                                    {{ $div['title'] }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include(
            'backend.admins.statistic.includes.charts'
        )
        @include(
            'backend.admins.statistic.includes.progress'
        )
        @include('backend.admins.statistic.includes.info')

        <div class="col-12">
            <div class="box">
                <div class="box-body text-center">
                    <h2 class="fs-18">
                        قريبا !
                    </h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="{{ asset('js/pages/dashboard5.js')}}"></script> --}}
    <script src="https://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/gauge.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/amstock.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript">
    </script>
    <script src="https://www.amcharts.com/lib/3/themes/patterns.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>
    {{-- float --}}
    <script src="{{ asset('assets/vendor_components/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/Flot/jquery.flot.categories.js') }}"></script>

    <script src="{{ asset('assets/includes/statistics_index.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/jquery-knob/js/jquery.knob.js') }}"></script>
@endpush
