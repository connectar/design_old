<div class="box border-success m-0" x-data="cardsTabSettings">
    <div class="box-body py-0">
        <div class="row">
{{--
            <div class="col-md-6 my-4">
                <div class="box border-success bg-dark m-0 ">
                    <div class="box-body text-center">
                        <h5 class="card-title text-primary mb-4">
                            {{ __('site.cards_tab_settings.title') }}
                        </h5>
                        <div class="bg-light p-1">
                            الرجاء الاحتفاظ برقم الكارت لاستخدامه بشكل متكرر أو اوقف الماك
                            العشوائي
                            في هاتف العميل
                        </div>
                        <div class="mt-3">
                            <button
                                class="btn btn-sm {{ __('site.cards_tab_settings.class_' . $allowUserToLoginByMac) }}"
                                @click="doProccess('{{ $message }}','{{ $allowUserToLoginByMac }}')">
                                {{ __('site.cards_tab_settings.' . $allowUserToLoginByMac) }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 my-4">
                <div class="box border-success bg-dark m-0">
                    <div class="box-body text-center">
                        <h5 class="card-title text-primary mb-4">
                            {{ __('site.cards_tab_settings.title2') }}
                        </h5>
                        <div class="bg-light p-1">
                            عند تفعيل هذه الخاصية يتم استخدام الكارت مره واحدة و الدخول علي الكارت من جهاز واحد
                            - (اول جهاز سجل دخول بالكارت)
                        </div>
                        <div class="mt-3">
                            <button
                                class="btn btn-sm {{ __('site.cards_tab_settings.class_' . $allowUserToLoginByMacOneTime) }}" @click="doProccess('{{ $messageOneCard }}', 'one_user_per_card')">
                                {{ __('site.cards_tab_settings.' . $allowUserToLoginByMacOneTime) }}
                            </button>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="col-md-12 my-4">
                <div class="box border-success bg-dark m-0">
                    <div class="box-body text-center">
                        <h5 class="card-title text-primary mb-4">
                            {{ __('site.cards_tab_settings.title4') }}
                        </h5>
                        <div class="bg-light p-1">
                            عند تفعيل هذه الخاصية سيتم تح
                        </div>
                        <div class="mt-3">
                            <button
                                class="btn btn-sm {{ __('site.cards_tab_settings.class_' . $allowUserToLoginByMacOneTime) }}" @click="doProccess('{{ $messageOneCard }}', 'one_user_per_card')">
                                {{ __('site.cards_tab_settings.' . $allowUserToLoginByMacOneTime) }}
                            </button>
                        </div>
                    </div>
                </div>
            </div> --}}


            {{-- <div class="row pt-2">
                <div class="col-md-8">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-server"></i>
                                <span class="px-2">{{ __('datatable.choose_card_restriction_way') }}</span>
                            </div>
                            <select class="form-select" wire:model="selectedNas">
                                @foreach (['عن طريق الراديوس', 'عن طريق الماك', 'عن طريق الجلسة'] as $index => $nas)
                                    <option value="">{{ $nas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-12 my-4">
                <form method="POST" wire:submit="updateHotspotCardRestrictWay">
                <div class="box border-success bg-dark m-0">
                    <div class="col-sm-12 py-3 custom-margin-mobile">
                        <h5 for="message" class="p-4 text-primary">
                            {{ __('datatable.choose_card_restriction_way') }}
                        </h5>
                        <div class="pb-4 mx-4" >
                            <div class="col-md-9 mb-2 pb-2">
                                <input name="invoiceStatus" wire:model="hotspot_card_restrict_way"
                                    type="radio" id="radio_32"
                                    class="with-gap radio-col-success" value="{{ App\ENUMS\HotspotCardLoginRestrictionWayEnum::RESTRICT_WITH_ONE_TIME_REGISTRATION }}">
                                <label for="radio_32">
                                    {{ trans('new_trans.hotspot_card_restrict_ways.one_time_registration') }}
                                </label>
                                <p class="pt-3 px-3 text-sm text-primary text-sm" style="line-height: 1.9;">
                                    هذه الطريقة تُحافظ على رقم ماك الجهاز الأول المستخدم للكارت،
                                    مما يمنع التسجيل باستخدام الكارت مرة أخرى، إلا إذا تم تغيير ماك الجهاز مما يتطلب إعادة تعيينه يدويا من قبل المدير.
                                </p>
                            </div>
                            <div class="py-4 my-2 border-top  border-bottom col-md-9">
                                <input name="invoiceStatus" wire:model="hotspot_card_restrict_way"
                                    type="radio" id="radio_36"
                                    class="with-gap radio-col-success" value="{{ App\ENUMS\HotspotCardLoginRestrictionWayEnum::RESTRICT_WITH_CARD_REGISTRATION_WITH_MAC_RESET }}">
                                <label for="radio_36">
                                    {{ trans('new_trans.hotspot_card_restrict_ways.card_registration_with_mac_reset') }}
                                </label>
                                <p class="pt-3 px-3 text-sm text-primary text-sm" style="line-height: 1.9;">
                                    يعد هذه الطريقة قوية لمنع تسجيل أكثر من شخص في وقت واحد. يُعتبر الكارت رقم سري يجب أن يكون مع حامل الكارت دائمًا وعدم مشاركته مع آخرين. عند إدخال رقم الكارت مرة أخرى، يتم إعادة تعيين الماك لهذا الكارت بالماك الجديد الخاص بالجهاز المستخدم في إدخال الكارت، ويتم طرد المستخدم الآخر بدون تدخل من مدير الشبكة.
                                </p>
                            </div>
                            <div class="pt-4 col-md-9 border-bottom pb-4">
                                <input name="invoiceStatus" wire:model="hotspot_card_restrict_way"
                                type="radio" id="radio_38"
                                class="with-gap radio-col-success" value="{{ App\ENUMS\HotspotCardLoginRestrictionWayEnum::RESTRICT_WITH_UPDATE_MAC_ONE_SESSION }}">
                                <label for="radio_38">
                                    {{ trans('new_trans.hotspot_card_restrict_ways.allow_update_mac_one_session') }}
                                    <span class="px-1">
                                        -
                                    </span>
                                    <span class="text-success ">
                                        [ الطريقة المقترحة ]
                                    </span>
                                </label>
                                <p class="pt-3 px-3 text-sm text-primary text-sm" style="line-height: 1.9;">
                                    بتلك الطريقة يمكنك منع دخول اكثر من جهاز مع عدم التقيد بماك واحد
                                </p>
                            </div>
                            <div class="pt-4 col-md-9 border-bottom pb-4">
                                <input name="invoiceStatus" wire:model="hotspot_card_restrict_way"
                                type="radio" id="radio_39"
                                class="with-gap radio-col-success" value="{{ App\ENUMS\HotspotCardLoginRestrictionWayEnum::RESTRICT_WITH_OLD_WAY }}">
                                <label for="radio_39">
                                    {{ trans('new_trans.hotspot_card_restrict_ways.allow_login_with_old_way') }}
                                </label>
                                <p class="pt-3 px-3 text-sm text-primary text-sm" style="line-height: 1.9;">
                                    تم اضافتها بناء علي رغبة بعض العملاء سيتم تسجيل الدخول بالكارت وتسجيل الماك بعد الخروج من الكارت والدخول مره اخري
                                </p>
                            </div>
                            <div class="pt-4 col-md-9 border-bottom pb-4">
                                <input name="invoiceStatus" wire:model="hotspot_card_restrict_way"
                                    type="radio" id="radio_35"
                                    class="with-gap radio-col-success" value="{{ App\ENUMS\HotspotCardLoginRestrictionWayEnum::RESTRICT_WITH_ALLOW_LOGIN_WITH_MACS }}">
                                <label for="radio_35">
                                    {{ trans('new_trans.hotspot_card_restrict_ways.allow_login_by_mac') }}
                                </label>
                            </div>
                            <div class="pt-4 col-md-9">
                                <input name="invoiceStatus" wire:model="hotspot_card_restrict_way"
                                type="radio" id="radio_37"
                                class="with-gap radio-col-success" value="{{ App\ENUMS\HotspotCardLoginRestrictionWayEnum::RESTRICT_WITH_ALLOW_LOGIN_WITH_CARD_WITHOUT_MAC }}">
                                <label for="radio_37">
                                    {{ trans('new_trans.hotspot_card_restrict_ways.allow_login_with_card_without_mac') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4 ">
                    <button class="btn btn-success col-12 col-md-2" type="submit" wire:submit="updateHotspotCardRestrictWay">
                        حفظ
                    </button>
                </div>
                </form>
            </div>


        </div>
    </div>
</div>
