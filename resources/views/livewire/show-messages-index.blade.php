<div class="">
    @if ($page == 'show_alert_7_before_create_invoice')
        <div class="box">
            <div class="box-body ribbon-box">
                <div class="ribbon-two ribbon-two-info"><span>رسالة</span></div>
                <p class="mb-0 pt-20 text-center text-white">
                    <span class="text-primary fs-18">
                        {{ __('site.messages.show.dear_client') }}
                    </span>
                    {{ __('site.messages.alert_day_3.body') }}

                    <span class="text-primary fw-bold fs-18">
                        {{ now()->format('04-m-Y') }}
                    </span>
                    <span>
                        {{ __('site.messages.alert_day_3.start_from') }}
                    </span>
                    <span class="text-primary fw-bold fs-18">
                        {{ now()->format('10-m-Y') }}
                    </span>
                    <span>
                        {{ __('site.messages.alert_day_3.to') }}
                    </span>
                    <span class="text-primary fw-bold fs-18">
                        {{ now()->addMonth()->format('10-m-Y') }}
                    </span>
                    <span class="d-block text-danger">
                        {{ __('site.messages.alert_day_3.alert') }}
                    </span>
                    <span class="d-block my-1">
                        {{ __('site.messages.alert_day_3.fine') }}
                    </span>

                    <button class="btn btn-sm btn-success mt-2" wire:click="messageDeliverd">
                        {{ __('site.messages.show.button') }}
                    </button>
                </p>
            </div> <!-- end box-body-->
        </div>
    @elseif($page == 'nas_block')
        <div class="box">
            <div class="box-body ribbon-box">
                <div class="ribbon-two ribbon-two-info"><span>رسالة</span></div>
                <p class="mb-0 pt-20 text-center text-white">
                    <span class="text-primary fs-17">
                        {{ __('site.messages.show.dear_client') }}
                    </span>
                    <span class="fs-18">
                        {{ __('site.messages.nas_block.body') }}
                    </span>
                    <span class="d-block text-center text-success fs-18">
                        {{ __('site.messages.nas_block.then1') }}
                    </span>
                    <span class="d-block text-center text-danger fs-18">
                        {{ __('site.messages.nas_block.then2') }}
                    </span>

                <div class="text-center">
                    <button class="btn btn-sm btn-success mt-2" wire:click="messageDeliverd">
                        {{ __('site.messages.show.button') }}
                    </button>
                </div>
                </p>
            </div> <!-- end box-body-->
        </div>
    @elseif($page == 'show_invoice_price_changed')
        <div class="box">
            <div class="box-body ribbon-box">
                <div class="ribbon-two ribbon-two-info"><span>رسالة</span></div>
                <p class="mb-0 pt-20 text-center text-white">
                    <span class="text-primary fs-17">
                        {{ __('site.messages.show.dear_client') }}
                    </span>
                    <span class="fs-18">
                        تم زيادة اسعار الاشتراك الشهرى نظرا لزيادة الدولار
                    </span>
                <div class="text-center">
                    <span class="fs-18 text-danger">
                        برجاء الذهاب الى حساب كونكت
                    </span>
                </div>
                <div class="text-center">
                    <span class="fs-18 text-primary">
                        ومراجعه تكلفة الفاتورة قبل التحويل
                    </span>
                </div>

                <div class="text-center">
                    <button class="btn btn-sm btn-success mt-2" wire:click="messageDeliverd">
                        {{ __('site.messages.show.button') }}
                    </button>
                </div>
                </p>
            </div> <!-- end box-body-->
        </div>
    @elseif($page == 'zizo_out')
        <div class="box">
            <div class="box-body ribbon-box">
                <div class="ribbon-two ribbon-two-info"><span>رسالة</span></div>
                <p class="mb-0 pt-20 text-center text-white">
                    <span class="text-primary fs-17">
                        هام لجميع العملاء
                    </span>
                    <span class="fs-18">
                        استاذ زيزو عمرو ليس لة علاقة بالسيستم من اليوم
                        والدعم من خلال الرقم الوحيد
                    </span>
                <div class="text-center">
                    <span class="fs-20 text-danger">
                        01026177689
                    </span>
                </div>
                <div class="text-center">
                    <span class="fs-17 text-primary">
                        فون او تساب
                    </span>
                </div>
                <div class="text-center">
                    <span class="fs-17 text-primary">
                        او من خلال جروب الوتساب
                    </span>
                </div>

                <div class="text-center">
                    <button class="btn btn-sm btn-success mt-2" wire:click="messageDeliverd">
                        {{ __('site.messages.show.button') }}
                    </button>
                </div>
                </p>
            </div> <!-- end box-body-->
        </div>
    @else
        <div class="box">
            <div class="box-body ribbon-box">
                <div class="ribbon-two ribbon-two-info"><span>رسالة</span></div>
                <p class="mb-0 pt-20 text-center text-white">
                    <span class="text-primary fs-18">
                        {{ __('site.messages.show.dear_client') }}
                    </span>
                    {{ __('site.messages.show.body') }}

                    <span dir="auto" class="d-block">
                        <span class="text-warning fs-22">010</span>
                        <span class="text-danger fs-22">122</span>
                        <span class="text-danger fs-22">122</span>
                        <span class="text-warning fs-22">94</span>
                    </span>

                    <button class="btn btn-sm btn-success mt-2" wire:click="messageDeliverd">
                        {{ __('site.messages.show.button') }}
                    </button>
                </p>
            </div> <!-- end box-body-->
        </div>
        <div class="box box-bordered">
            <div class="box-header with-border py-3">
                <h5 class="box-title">
                    {{ __('site.messages.show.explain') }}
                </h5>
            </div>
            <div class="box-body">
                <div class="box border-success">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="iframe-container">
                            <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/x7CQxHXhft8"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    @endif
</div>
