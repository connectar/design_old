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
            <div class="box-body bg-dark border-light py-0 my-4">

                {{-- Contact Numbers --}}
                <div class="row">
                    <div class="col-12">
                        <h5 class="fw-bold pb-2 mt-4 mb-3">
                            <i class="fa fa-phone mx-2 text-success"></i>أرقام التواصل
                        </h5>
                    </div>

                    <div class="col-12">
                        @foreach ($contact_numbers as $index => $number)
                            <div class="row mb-3">
                                <div class="col-md-8 col-lg-6 mx-auto">
                                    <div class="input-group shadow-sm">
                                        <span class="input-group-text bg-success text-white">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                        <input type="text" class="form-control"
                                            wire:model="contact_numbers.{{ $index }}"
                                            placeholder="أدخل رقم الهاتف (مثال: +201234567890)" dir="ltr">
                                        @if (count($contact_numbers) > 1)
                                            <button type="button" class="btn btn-danger"
                                                wire:click="removeNumber({{ $index }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                    @error('contact_numbers.' . $index)
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        @endforeach

                        <div class="row">
                            <div class="col-md-8 col-lg-6 mx-auto">
                                <button type="button" class="btn btn-secondary btn-sm mb-4" wire:click="addNumber">
                                    <i class="fa fa-plus mx-1"></i>إضافة رقم جديد
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Battery Alerts --}}
                <div class="row">
                    <div class="col-12">
                        <h5 class="fw-bold pb-2 mt-3 mb-3">
                            <i class="fa fa-battery-half mx-2 text-warning"></i>تنبيهات البطارية
                        </h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fa fa-percentage mx-1 text-warning"></i>نسبة البطارية
                        </label>
                        <div class="input-group shadow-sm">
                            <input type="number" wire:model="battery_alerts.threshold" class="form-control"
                                placeholder="20" min="1" max="100">
                            <span class="input-group-text">%</span>
                        </div>
                        <small class="text-muted">عند وصول البطارية لهذه النسبة سيتم إرسال تنبيه</small>
                        @error('battery_alerts.threshold')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fa fa-clock mx-1 text-warning"></i>الفاصل بين المكالمات
                        </label>
                        <div class="input-group shadow-sm">
                            <input type="number" wire:model="battery_alerts.call_interval_minutes"
                                class="form-control" placeholder="30" min="1">
                            <span class="input-group-text">دقيقة</span>
                        </div>
                        <small class="text-muted">الوقت بين كل محاولة اتصال والأخرى</small>
                        @error('battery_alerts.call_interval_minutes')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fa fa-redo mx-1 text-warning"></i>عدد المحاولات
                        </label>
                        <div class="input-group shadow-sm">
                            <input type="number" wire:model="battery_alerts.call_retry_attempts"
                                class="form-control" placeholder="3" min="1" max="10">
                            <span class="input-group-text">محاولة</span>
                        </div>
                        <small class="text-muted">عدد محاولات الاتصال قبل التوقف</small>
                        @error('battery_alerts.call_retry_attempts')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold d-block">
                            <i class="fa fa-bell mx-1 text-warning"></i>حالة التنبيهات
                        </label>
                        <div class="card mt-2 border border-dark">
                            <div class="card-body px-3 py-1">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-semibold">تفعيل تنبيهات البطارية</span>
                                    <label class="switch switch-success mb-0">
                                        <input type="checkbox" wire:model="battery_alerts.notify_enabled">
                                        <span class="switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Internet Alerts --}}
                <div class="row">
                    <div class="col-12">
                        <h5 class="fw-bold pb-2 mt-3 mb-3">
                            <i class="fa fa-wifi mx-2 text-success"></i>تنبيهات الإنترنت
                        </h5>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            مدة الانقطاع
                        </label>
                        <div class="input-group shadow-sm">
                            <input type="number" wire:model="internet_alerts.disconnect_threshold_minutes"
                                class="form-control" placeholder="10" min="1">
                            <span class="input-group-text">دقيقة</span>
                        </div>
                        <small class="text-muted">مدة انقطاع الإنترنت قبل إرسال التنبيه</small>
                        @error('internet_alerts.disconnect_threshold_minutes')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fa fa-clock mx-1 text-info"></i>الفاصل بين المكالمات
                        </label>
                        <div class="input-group shadow-sm">
                            <input type="number" wire:model="internet_alerts.call_interval_minutes"
                                class="form-control" placeholder="30" min="1">
                            <span class="input-group-text">دقيقة</span>
                        </div>
                        <small class="text-muted">الوقت بين كل محاولة اتصال والأخرى</small>
                        @error('internet_alerts.call_interval_minutes')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            <i class="fa fa-redo mx-1 text-info"></i>عدد المحاولات
                        </label>
                        <div class="input-group shadow-sm">
                            <input type="number" wire:model="internet_alerts.call_retry_attempts"
                                class="form-control" placeholder="3" min="1" max="10">
                            <span class="input-group-text">محاولة</span>
                        </div>
                        <small class="text-muted">عدد محاولات الاتصال قبل التوقف</small>
                        @error('internet_alerts.call_retry_attempts')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold d-block">
                            <i class="fa fa-bell mx-1 text-info"></i>حالة التنبيهات
                        </label>
                        <div class="card border border-dark mt-2">
                            <div class="card-body px-3 py-1">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-semibold">تفعيل تنبيهات الإنترنت</span>
                                    <label class="switch switch-success mb-0">
                                        <input type="checkbox" wire:model="internet_alerts.notify_enabled">
                                        <span class="switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
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
