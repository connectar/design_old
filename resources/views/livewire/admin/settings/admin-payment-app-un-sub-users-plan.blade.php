<div>
    <div class="col-12 mb-3">
        <div class="alert alert-dismissible fade show shadow border-0 m-0" role="alert"
            style="background: linear-gradient(135deg, #f8d7da 0%, #ffe5e7 100%); border-right: 5px solid #f44336 !important; padding: 1.5rem; border-radius: 12px;">
            <div class="d-flex align-items-start">
                <!-- Icon -->
                <div class="flex-shrink-0 me-3 ms-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px; background-color: #f44336;">
                        <i class="fa fa-exclamation-triangle fa-2x text-white"></i>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex-grow-1 pt-1">
                    <h4 class="alert-heading fw-bold mb-3" style="font-size: 1.4rem; color: #c62828;">
                        تنبيه هام - متطلبات الخدمة
                    </h4>

                    <!-- Requirements -->
                    <div class="mb-3">
                        <div class="d-flex align-items-start mb-2">
                            <span class="badge bg-danger ms-2 mt-1" style="font-size: 0.75rem;">1</span>
                            <p class="mb-0" style="font-size: 1.05rem; line-height: 1.6; color: #333;">
                                <strong>الهاتف المخصص:</strong> استخدام هاتف مخصص للخدمة بعيداً عن الهاتف الشخصي
                            </p>
                        </div>
                        <div class="d-flex align-items-start mb-2">
                            <span class="badge bg-danger ms-2 mt-1" style="font-size: 0.75rem;">2</span>
                            <p class="mb-0" style="font-size: 1.05rem; line-height: 1.6; color: #333;">
                                <strong>فودافون كاش:</strong> التأكد من تفعيل خدمة فودافون كاش على الخط
                            </p>
                        </div>
                        <div class="d-flex align-items-start mb-2">
                            <span class="badge bg-danger ms-2 mt-1" style="font-size: 0.75rem;">3</span>
                            <p class="mb-0" style="font-size: 1.05rem; line-height: 1.6; color: #333;">
                                <strong>واتساب:</strong> تسجيل تطبيق واتساب بنفس رقم المحفظة
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <div class="box-footer bg-light">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <div class="alert alert-warning mt-2 py-2 px-3" role="alert" style="font-size: 16px;">
                    🎉 هذه الخدمة مجانية لفترة محدودة فقط !!
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('download.payment_app') }}" class="btn btn-warning btn-sm px-3">
                    <i class="fa fa-download mx-1"></i> تحميل التطبيق
                </a>

                <button type="button" class="btn btn-danger btn-sm px-3"
                    onclick="window.open('https://youtu.be/VngTychue3k', '_blank')">
                    <i class="fa fa-youtube mx-1"></i> فيديو الشرح
                </button>

                <button type="button" class="btn btn-info btn-sm px-3"
                    onclick="window.open('https://play.google.com/store/apps/details?id=davideinzaghi.Disabilita_Spegnimento_Schermo_Lite&hl=ar', '_blank')">
                    <i class="fa fa-google mx-1"></i>
                    منع ايقاف الشاشة
                </button>
            </div>
        </div>
    </div>

    <form wire:submit="saveSettings">
        <div class="box border-success m-0">
            <div class="box-body bg-dark border-light py-0 my-4" x-data="{
                hotspot_plan: {
                    offer_speed: @entangle('hotspot_plan.offer_speed').defer
                },
                changeSpeed(input, value) {
                    this.hotspot_plan.offer_speed = value;
                }
            }">
                {{-- Hotspot Plan Settings --}}
                <div class="row">
                    <div class="col-12">
                        <h5 class="fw-bold pb-2 mt-3 mb-3">
                            <i class="fa fa-wifi mx-2 text-primary"></i>إعدادات باقات الهوت سبوت للمستخدمين غير المسجلين
                        </h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fa fa-money-bill mx-1 text-primary"></i>سعر الجيجا الواحدة
                        </label>
                        <div class="input-group shadow-sm">
                            <input type="number" wire:model="hotspot_plan.price_per_gb" class="form-control"
                                placeholder="10" min="0.1" step="0.1">
                            <span class="input-group-text">جنيه / جيجا</span>
                        </div>
                        <small class="text-muted">سعر الجيجابايت الواحدة بالجنيه المصري</small>
                        @error('hotspot_plan.price_per_gb')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fa fa-clock mx-1 text-primary"></i>مدة صلاحية البطاقة
                        </label>
                        <div class="input-group shadow-sm">
                            <input type="number" wire:model="hotspot_plan.validity_days" class="form-control"
                                placeholder="30" min="1">
                            <span class="input-group-text">يوم</span>
                        </div>
                        <small class="text-muted">عدد الأيام التي تظل فيها البطاقة صالحة</small>
                        @error('hotspot_plan.validity_days')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <x-offer-speed class="col-md-8" name="hotspot_plan.offer_speed"
                            speed-title="{{ __('adding.offer.speed') }}" x-model="hotspot_plan.offer_speed" />
                        <small class="text-muted">أقصى سرعة تحميل للمستخدم (اتركه فارغاً لسرعة غير محدودة)</small>
                        @error('hotspot_plan.offer_speed')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fa fa-money-bill mx-1 text-primary"></i>
                            الحد الاقصي للاستهلاك
                        </label>
                        <div class="input-group shadow-sm">
                            <input type="number" wire:model="hotspot_plan.max_quta" class="form-control"
                                placeholder="10" min="0.1" step="0.1">
                            <span class="input-group-text">جيجا</span>
                        </div>
                        <small class="text-muted">
                            هي اقصي كمية ممكنة للكارت ان يستخدمها للبطاقة (اقصي كمية للتحميل والرفع لكارت الهوتسبوت)
                        </small>
                        @error('hotspot_plan.max_quta')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-semibold d-block">
                            <i class="fa fa-power-off mx-1 text-primary"></i>حالة النظام
                        </label>
                        <div class="card mt-2 border border-dark">
                            <div class="card-body px-3 py-1">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-semibold">تفعيل نظام الهوت سبوت</span>
                                    <label class="switch switch-success mb-0">
                                        <input type="checkbox" wire:model="hotspot_plan.enabled">
                                        <span class="switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle mx-2"></i>
                            <strong>مثال:</strong> إذا دفع المستخدم 10 جنيه وسعر الجيجا = 5 جنيه، سيحصل على بطاقة بـ 2
                            جيجا
                        </div>
                    </div>
                </div>

            </div>

            <div class="box-footer bg-light">
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fa fa-save mx-2"></i>{{ __('website.update') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        function addUnSubUserOffer(initialSpeed = '') {
            return {
                hotspot_plan: {
                    offer_speed: initialSpeed
                },
                changeSpeed(input, value) {
                    // Update the input field value
                    const element = document.querySelector('[name="' + input + '"]');
                    if (element) {
                        element.value = value;
                    }

                    // Update local Alpine data
                    this.hotspot_plan.offer_speed = value;

                    // Directly update Livewire property
                    this.$wire.set('hotspot_plan.offer_speed', value);
                }
            }
        }
    </script>
@endpush
