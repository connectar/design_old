<section class="msg_setting_sec">
    <div class="box">
        <div class="box-body ribbon-box">
            <div class="ribbon-two ribbon-two-info"><span>تنبيه هام</span></div>
            <p class="text-center text-white mb-2">
                <span class="text-primary fs-17">خدمة رسائل الوتساب خدمة مدفوعة</span>
                يجب ان يكون لديك رصيد كافى لاستمرار الخدمة.
            </p>
            <p class="text-center text-white mb-2">
                منصة الواتساب لا تتيح أكثر من رسالة أو إشعار إلى نفس الرقم
                <span class="fs-17 text-danger">
                    إلا بعد مرور دقيقة إلى دقيقتين.
                </span>
            </p>
            <p class="mb-0 text-center text-white">
                يرجى ملاحظة أن
                <span class="text-primary">
                    تكلفة الرسالة ستخصم من رصيدك حتى ولم تصل.
                </span>
            </p>
        </div>
    </div>
    <div class="box border-success m-0">

        <div class="box-body py-0">
            <div class="box border-success bg-dark m-0">
                <div class="col-sm-12 custom-margin-mobile">
                    <div class="d-flex justify-content-lg-start p-4">
                        <div class="mx-2">
                            <div class="form-group">
                                <labe>
                                    <input type="checkbox" wire:model="send_whatsapp">
                                    {{ __('datatable.enable_whatsapp_toggle') }}
                                    <span class="text-danger">
                                        ( {{ __('datatable.price_whatsapp_message') }} = {{ $wp_message_price }}
                                        {{ \Illuminate\Support\Facades\Auth::user()->network->billing_currency }} )
                                    </span>
                                </labe>
                            </div>
                            <div class="form-group">
                                <labe>
                                    <input type="checkbox" wire:model="send_sms">
                                    {{ __('datatable.enable_sms_toggle') }}
                                    <span class="text-danger">
                                        ( {{ __('datatable.price_whatsapp_message') }} = {{ $sms_message_price }}
                                        {{ \Illuminate\Support\Facades\Auth::user()->network->billing_currency }} )
                                    </span>
                                </labe>
                            </div>
                            <div class="form-group">
                                <labe>
                                    <input type="checkbox" wire:model="send_transaction_sms">
                                    {{ __('datatable.enable_sms_transaction_toggle') }}
                                    <span class="text-danger">
                                        ( {{ __('datatable.price_whatsapp_message') }} = {{ $sms_message_price }}
                                        {{ \Illuminate\Support\Facades\Auth::user()->network->billing_currency }} )
                                    </span>
                                </labe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-right sub_btn">
                    <button class="btn btn-sm btn-success" wire:click="click">{{ __('site.general_save') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>
