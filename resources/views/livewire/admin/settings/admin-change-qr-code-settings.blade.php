<form wire:submit="saveQrCodeSettings">
    <div class="box border-success m-0">
        <div class="box-body py-0">

            <div class="col-md-12 my-4">
                <div class="box border-success bg-dark m-0">
                    <div class="col-sm-12  custom-margin-mobile">
                        <div class="d-flex justify-content-lg-start px-4 pt-4">
                            <div class=" mx-2">
                                <div class="form-group">
                                    <label class="switch switch-success">
                                        <input type="checkbox" wire:click="$toggle('is_qr_allowed')"
                                            @if ($is_qr_allowed) checked @endif>
                                        <span class="switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <h5 for="message" class=" text-primary pt-1">
                                {{ __('datatable.allow_qr_code') }}
                            </h5>
                        </div>
                            <span class="d-block text-primary  px-4 mx-4 pt-2">
                                **
                                اذا كنت تستعمل صفحة هوتسبوت مختلفة عن صفحة سيستم كونكت فور عرب فيجب عليك اضافة قاري QR CODE للصفحة عن طريق اضافة هذا السطر في ملف login.html
                                <h5 class="text-success text-center text-xl pt-3 pb-4">
                                    {{ '<script src="https://connect4ar.com/qr/connect4ar_scan_qr_btn.js"></script>' }}
                                </h5>
                            </span>
                        @error('is_qr_allowed')
                            <span class="error text-danger">
                                * {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            @if ($is_qr_allowed)
            <div class="col-md-12 my-4">
                <form method="POST" wire:submit="updatedIsQrAllowed">
                    <div class="box border-success bg-dark m-0">
                        <div class="col-sm-12 py-3 custom-margin-mobile">
                            <h5 for="message" class="p-4 text-primary">
                                {{ __('datatable.choose_qr_way') }}
                            </h5>
                            <div class="pb-4 mx-4">
                                <div class="col-md-9 mb-2 pb-2">
                                    <input wire:model="qr_type" type="radio" id="radio_34"
                                        class="with-gap radio-col-success"
                                        value="{{ App\ENUMS\NetworkQrCodeWayEnum::QR_TYPE_USERNAME }}">
                                    <label for="radio_34">
                                        {{ trans('new_trans.qr_code_way.username_way') }}
                                    </label>
                                    <p class="pt-3 px-3 text-sm text-primary text-sm" style="line-height: 1.9;">
                                        يتم تجهيز رمز الاستجابة باسم المستخدم ويمكن للعميل عند مسح ال QR Code
                                        عن طريق ماسح ال QR
                                        الخاص بالسيستم عند دمجه مع صفحة الهوسبوت الدخول بشكل تلقائي
                                    </p>
                                    {{-- <span class="text-success  px-3 ">
                                        (لا يمكن الدخول عن طريق اي ماسح باركود مختلف عن ماسح باركود السيستم)
                                    </span> --}}
                                </div>
                            </div>
                            <div class="pb-4 mx-4">
                                <div class="col-md-9 mb-2 pb-2">
                                    <input wire:model="qr_type" type="radio" id="radio_33"
                                        class="with-gap radio-col-success"
                                        value="{{ App\ENUMS\NetworkQrCodeWayEnum::QR_TYPE_HOTSPOT_LOGIN_URL }}">
                                    <label for="radio_33">
                                        {{ trans('new_trans.qr_code_way.hotspot_login_url_way') }}
                                    </label>
                                    <p class="pt-3 px-3 text-sm text-primary text-sm" style="line-height: 1.9;">
                                        يتم تجهيز رمز الاستجابة برابط تسجيل الدخول المستخدم واسم المستخدم ويمكن للعميل
                                        عند مسح ال QR Code
                                        عن طريق اي ماسح لل QR
                                        الدخول بشكل تلقائي
                                    </p>
                                    <span class="text-success  px-3 ">
                                        (يجب ان تدخل رابط صفحة تسجيل الدخول للهوتسبوت الخاصة بك داخل الشبكة)
                                    </span>
                                </div>
                                @if ($qr_type == App\ENUMS\NetworkQrCodeWayEnum::QR_TYPE_HOTSPOT_LOGIN_URL)
                                    <div class="col-md-6 col-sm-6  px-3 ">
                                        <div class="form-group row">
                                            <label for="qr_hotspot_login_url" class="form-label">
                                                {{ __('new_trans.qr_code_way.qr_url') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <input class="form-control" type="text"
                                                        wire:model.lazy="qr_hotspot_login_url" dir="auto"
                                                        placeholder="http://10.0.0.1/login">
                                                </div>
                                                @error('qr_hotspot_login_url')
                                                    <span class="error text-danger">
                                                        * {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4 ">
                        <button class="btn btn-success col-12 col-md-2" type="submit" wire:loading.attr="disabled"
                            wire:submit="saveQrCodeSettings">
                            حفظ
                        </button>
                    </div>
            </div>
            @endif



        </div>
    </div>
</form>
