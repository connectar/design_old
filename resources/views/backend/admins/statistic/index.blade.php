@extends('backend.layouts.livewire.admin')

@push('livewire_styles')
    <!--amcharts -->
    <link href="https://www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    {{--
<livewire:ping-ip-address ></livewire:ping-ip-address>
 --}}

    <div class="row">
        <div class="col-12">
            <div class="box box-slided-up">
                <div class="box-header with-border">
                    <li class="flag-icon flag-icon-ps mx-2 " style="font-size:28px;"></li>
                    <h4 class="box-title" style="font-size:22px;">فلسطين حرة - <strong
                            class="text-danger">FreePalestine</strong></h4>
                </div>
                <ul class="box-controls pull-right my-2">
                    <li><a class="box-btn-close" href="#"></a></li>
                    <li><a class="box-btn-slide" href="#"></a></li>
                    <li><a class="box-btn-fullscreen" href="#"></a></li>
                </ul>

                <div class="box-body pt-0">
                    <h4>
                        دعاء لاهلنا في فلسطين
                    </h4>
                    <ul>
                        <li>
                            اللهم انتصر لهم واربط على قلوبهم وردَّهم إلى ديارهم ومسجدهم آمنين، اللهم واشدد على أعدائهم حتى
                            يروا العذاب الأليم.
                        </li>
                        <li>
                            اللهم احرس أهل غزة بعينك التي لا تنام.
                        </li>
                        <li>
                            اللهم حرر المسجد الأقصى، واجبر كسرهم، واشف مرضاهم، وتقبل شهدائهم برحمتك.
                        </li>
                        <li>
                            اللهمَّ انصر الإسلام والمسلمين في فلسطين وأعزَّهم، اللهم اجعل النصر قريبًا واجعل الفرجَ يأتيهم.
                        </li>
                        <li>
                            اللهمَّ اجعل فلسطين ملاذًا آمنًا لأهلها، وارفع عنهم الظلم والاضطهاد، وانصرهم على أعدائهم.
                        </li>
                        <li>
                            اللهمَّ ارفع الأذى عن أهل فلسطين وانصرهم على الظالمين، واجعلهم يعيشون في سلام وعدل وحرية.
                        </li>
                        <li>
                            اللهم ارحم شهداءَ فلسطين واجعلهم في عليين، وشفِ صدورَ أهلها وأنزل السكينةَ عليهم، اللهم اجعلهم
                            أُمةً واحدة تتكاتف في وجه العدو وتحقق النصر المؤزر، يا مُجيب الدعاء يا كريم.
                        </li>
                        <li>
                            نستودعك يا الله بأهلنا وأحبابنا في فلسطين الحبيبة، تلك الدّيار المُقدّسة التي باركت بها وما
                            حولها أن تحفظها من كل سوء وشر.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- <div class="box">
            <div class="box-body ribbon-box">
                <div class="ribbon-two ribbon-two-info"><span>رسالة</span></div>
                <div class="text-center">
                    <p class="mb-0 text-white">
                        <span class="text-primary fs-18" style="line-height: 1.9;">
                            هام لجميع العملاء
                        </span>
                    </p>
                    <p class="mb-0 text-white">
                        <span class="text-primary fs-18" style="line-height: 1.9;">
                            تم نقل سيرفر السيستم لزيادة سرعة استجابة السيرفر
                        </span>
                    </p>
                    <p class="mb-0 text-white">
                        <span class="text-primary fs-18 " style="line-height: 1.9;">
                            برجاء عمل اعادة تركيب للسيرفرات الخاصة بكم
                            <a href="https://chat.whatsapp.com/KejzV6RE3zP1eC4bqEsyHG">
                                <li class="fa fa-whatsapp fa-2x p-2"></li>
                                او المتابعة مع الدعم الفنى على جروب الوتساب
                            </a>
                        </span>
                    </p>
                </div>
            </div> <!-- end box-body -->
        </div> --}}
        @include('backend.admins.DisplayNotifications.home')
        <div class="box">
            <div class="box-body ribbon-box">
                <div class="ribbon-two ribbon-two-info"><span>رسالة</span></div>
                <p class="mb-0 text-center text-white">
                    <span class="text-primary fs-17">
                        هام لجميع العملاء
                    </span>
                    <span class="fs-17">
                        الدعم الفنى متاح دائما من خلال هذا الرقم
                    </span>
                <div class="text-center">
                    م/محسن محمد
                    <span class="fs-20 px-3 text-danger">
                        01026177689
                    </span>
                </div>
                <div class="text-center">
                    م/حسين عيد
                    <span class="fs-20 px-3 text-danger">
                        01080239650
                    </span>
                </div>
                <div class="text-center">
                    <span class="fs-17 text-primary">
                        فون او تساب
                    </span>
                    <a href="https://chat.whatsapp.com/D20g7KXF9Y557uRzPDa9OW">
                        <span class="fs-17 ">
                            او من خلال جروب الوتساب
                            <li class="fa fa-whatsapp fa-2x"></li>
                        </span>
                    </a>
                </div>
                </p>
            </div>
        </div>
        <div class="box">
            <div class="box-body">
                <div class="p-2 text-center b-1 b-primary bg-dark">
                    <div class="py-1 mb-1">
                        <a class="btn btn-sm btn-success" href="{{ route('download_hotspot') }}">
                            تحميل صفحة الهوت سبوت
                        </a>
                    </div>
                    <p>
                        لدفع الاشتراك الخاص بالسيستم علي خدمة فودافون كاش <span class="text-danger fs-18">010<span
                                class="text-warning">122</span>122<span class="text-warning">94</span></span> لشرح
                        التحويل التلقائي
                        <a class="btn btn-sm btn-primary" href="https://youtu.be/WHebz6FIeig" target="_blank">اضغط
                            هنا</a>
                        للدعم الفني والاستفسارات من خلال صفحتنا علي الفيس بوك
                        <a href="https://fb.com/connect4ar" class="btn btn-sm btn-primary" target="_blank">من هنا</a>
                        أومن خلال الأرقام التالية
                        <span class="fs-18 text-warning">01026177689</span> محسن
                        {{-- <span class="text-warning fs-18">01008256588</span> زيزو --}}
                    </p>
                </div>

                <div class="row justify-content-between">
                    <div class="col-xxxl-8 col-xl-7 col-12">
                        <div class="row px-40">
                            @foreach ($statistic as $key => $div)
                                <div class="col-lg-3 col-md-6 col-12">
                                    <a href="{{ route($div['route']) }}">
                                        <div class="box {{ $div['box'] }} bg-brick-dark rounded30 mb-md-30 mt-10 mb-0">
                                            <div class="box-body">
                                                <div class="text-center">
                                                    <i class="{{ $div['icon'] }} fs-30 text-white" title="BTC"></i>
                                                    <h4 class="fs-14" style="white-space: nowrap;">
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
                                        <div class="box box-body pull-up {{ $div['box'] }} bg-deathstar-white">
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

        @include('backend.admins.statistic.includes.charts')
        @include('backend.admins.statistic.includes.progress')
        @include('backend.admins.statistic.includes.info')

        <div class="col-12">
            <div class="box">
                <div class="box-body text-center">
                    <h2 class="fs-18">
                        {{ trans('new_trans.soon') }}
                    </h2>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/pages/dashboard5.js') }}"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/gauge.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/amstock.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/themes/patterns.js" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>
    {{-- float --}}
    <script src="{{ asset('assets/vendor_components/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/Flot/jquery.flot.categories.js') }}"></script>

    <script src="{{ asset('assets/includes/statistics_index.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/jquery-knob/js/jquery.knob.js') }}"></script>
    <script>
        // Check if the message has been read from the local storage
        // if (localStorage.getItem('AlertMessageRead') === 'true') {
        //     document.getElementById('messageBox').style.display = 'none';
        // }

        // Add click event listener to the close icon
        // document.querySelector('#AlertMessageReadBtn').addEventListener('click', function() {
        //     // Set local storage variable to indicate that the message has been read
        //     localStorage.setItem('AlertMessageRead', 'true');

        //     // Hide the message box
        //     document.getElementById('messageBox').style.display = 'none';
        // });
    </script>
@endpush
