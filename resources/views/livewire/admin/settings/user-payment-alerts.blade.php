<div x-data="{
    payment_alerts: @entangle('payment_alerts').defer,
    permanent_alerts: @entangle('permanent_alerts').defer
}">

    <form wire:submit="saveSettings">
        <div class="box p-0 border-dark ">
            <div class="box-body p-0">

                <div class="row">
                    {{-- Permanent Alerts --}}
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="fw-bold pb-2 mt-3 mb-3">
                                    <i class="fa fa-bell mx-2 text-info"></i>التنبيهات الدائمة
                                </h5>
                                <p class="text-muted mb-3">
                                    <i class="fa fa-info-circle mx-1"></i>
                                    هذه التنبيهات ستظهر للمستخدمين بشكل دائم في لوحة التحكم
                                </p>
                            </div>

                            <template x-if="permanent_alerts.length === 0">
                                <div class="col-12 mb-3">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle mx-1"></i>
                                        لا توجد تنبيهات دائمة. يمكنك إضافة تنبيه دائم جديد.
                                    </div>
                                </div>
                            </template>

                            <template x-for="(alert, index) in permanent_alerts" :key="'permanent-' + index">
                                <div class="col-12 mb-4">
                                    <div class="card bg-dark shadow-sm border-2 border-dark">
                                        <div
                                            class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-semibold">
                                                <i class="fa fa-bell mx-2"></i>تنبيه
                                                {{-- دائم رقم <span x-text="index + 1"></span> --}}
                                            </h6>
                                            {{-- <button type="button" class="btn btn-sm btn-danger"
                                                @click="$wire.removePermanentAlert(index)">
                                                <i class="fa fa-trash"></i> حذف
                                            </button> --}}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">
                                                        <i class="fa fa-heading mx-1"></i>عنوان التنبيه
                                                    </label>
                                                    <input type="text" class="form-control" x-model="alert.title"
                                                        placeholder="مثال: معلومات الدفع">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">
                                                        <i class="fa fa-palette mx-1"></i>نوع التنبيه
                                                    </label>
                                                    <select class="form-select" x-model="alert.type">
                                                        <option value="info">معلومات (أزرق)</option>
                                                        <option value="success">نجاح (أخضر)</option>
                                                        <option value="warning">تحذير (أصفر)</option>
                                                        <option value="danger">خطر (أحمر)</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label class="form-label fw-semibold">
                                                        <i class="fa fa-comment-alt mx-1"></i>نص الرسالة
                                                    </label>
                                                    <textarea class="form-control" rows="3" x-model="alert.message" placeholder="اكتب رسالة التنبيه هنا..."></textarea>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <div class="card border border-dark">
                                                        <div class="card-body px-3 py-2">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
                                                                <span class="fw-semibold">
                                                                    <i class="fa fa-power-off mx-2"></i>تفعيل هذا
                                                                    التنبيه
                                                                </span>
                                                                <label class="switch switch-success mb-0">
                                                                    <input type="checkbox" x-model="alert.enabled">
                                                                    <span class="switch-indicator"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Live Preview for Permanent Alert --}}
                                                {{-- Live Preview for Permanent Alert --}}
                                                <div class="col-12"
                                                    x-show="alert.enabled && (alert.title || alert.message)">
                                                    <div class="card bg-light">
                                                        <div class="card-header">
                                                            <small class="text-muted">
                                                                <i class="fa fa-eye mx-1"></i>معاينة مباشرة
                                                            </small>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="alert alert-dismissible fade show shadow border-0 m-0"
                                                                role="alert":style="`background: linear-gradient(135deg,${alert.type === 'warning' ? '#fff3cd 0%, #fffbea 100%' : alert.type === 'danger' ? '#f8d7da 0%, #ffe5e7 100%' : alert.type === 'success' ? '#d1e7dd 0%, #e8f5e9 100%' : '#cff4fc 0%, #e7f6fd 100%'}); border-right: 5px solid ${alert.type === 'warning' ? '#ff9800' : alert.type === 'danger' ? '#f44336' : alert.type === 'success' ? '#4caf50' : '#2196f3'} !important;padding: 1.5rem;`">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-shrink-0 me-3 ms-2">
                                                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                                            :style="`width: 60px; height: 60px; background-color:${alert.type === 'warning' ? '#ff9800' : alert.type === 'danger' ? '#f44336' : alert.type === 'success' ? '#4caf50' : '#2196f3'};`">
                                                                            <i class="fa fa-2x text-white"
                                                                                :class="{
                                                                                    'fa-exclamation-triangle': alert
                                                                                        .type === 'warning',
                                                                                    'fa-exclamation-circle': alert
                                                                                        .type === 'danger',
                                                                                    'fa-check-circle': alert
                                                                                        .type === 'success',
                                                                                    'fa-info-circle': alert
                                                                                        .type === 'info'
                                                                                }">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 pt-1">
                                                                        <h4 class="alert-heading fw-bold mb-3"
                                                                            :style="`font-size: 1.4rem; color:${alert.type === 'warning' ? '#e65100' : alert.type === 'danger' ? '#c62828' : alert.type === 'success' ? '#2e7d32' : '#1565c0'};`"
                                                                            x-text="alert.title || 'عنوان التنبيه'">
                                                                        </h4>
                                                                        <p class="mb-2"
                                                                            style="font-size: 1.1rem; line-height: 1.6; color: #333;"
                                                                            x-text="alert.message || 'نص رسالة التنبيه'">
                                                                        </p>
                                                                        <small class="d-block mt-3 pt-3 border-top"
                                                                            style="border-color: rgba(0,0,0,0.1) !important; color: #555;">
                                                                            <i class="fa fa-infinity me-2"></i>تنبيه
                                                                            دائم
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            {{-- <div class="col-12 mb-4">
                                <button type="button" class="btn btn-info" @click="$wire.addPermanentAlert()">
                                    <i class="fa fa-plus mx-1"></i>إضافة تنبيه دائم جديد
                                </button>
                            </div> --}}
                        </div>
                    </div>
                    {{-- Payment Due Alerts --}}
                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="fw-bold pb-2 mt-4 mb-3">
                                    <i class="fa fa-calendar mx-2 text-warning"></i>تنبيهات موعد الدفع
                                </h5>
                                <p class="text-muted mb-3">
                                    <i class="fa fa-info-circle mx-1"></i>
                                    هذه التنبيهات ستظهر للمستخدمين قبل انتهاء اشتراكهم بعدد الأيام المحددة
                                </p>
                            </div>

                            <template x-for="(alert, index) in payment_alerts" :key="index">
                                <div class="col-12 mb-4">
                                    <div class="card  bg-dark  p-0 m-0 shadow-sm border-2 border-dark">
                                        <div
                                            class="card-header bg-light d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-semibold">
                                                <i class="fa fa-bell mx-2"></i>تنبيه
                                                {{-- رقم <span x-text="index + 1"></span> --}}
                                            </h6>
                                            {{-- <button type="button" class="btn btn-sm btn-danger"
                                                x-show="payment_alerts.length > 1" @click="$wire.removePaymentAlert(index)">
                                                <i class="fa fa-trash"></i> حذف
                                            </button> --}}
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">
                                                        <i class="fa fa-heading mx-1"></i>عنوان التنبيه
                                                    </label>
                                                    <input type="text" class="form-control" x-model="alert.title"
                                                        placeholder="مثال: تذكير بموعد الدفع">
                                                    @error('payment_alerts.*.title')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label fw-semibold">
                                                        <i class="fa fa-palette mx-1"></i>نوع التنبيه
                                                    </label>
                                                    <select class="form-select" x-model="alert.type">
                                                        <option value="info">معلومات (أزرق)</option>
                                                        <option value="success">نجاح (أخضر)</option>
                                                        <option value="warning">تحذير (أصفر)</option>
                                                        <option value="danger">خطر (أحمر)</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label fw-semibold">
                                                        <i class="fa fa-calendar-alt mx-1"></i>عرض قبل انتهاء الاشتراك
                                                    </label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control"
                                                            x-model.number="alert.show_days_before" placeholder="7"
                                                            min="0" max="365">
                                                        <span class="input-group-text">يوم</span>
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <label class="form-label fw-semibold">
                                                        <i class="fa fa-comment-alt mx-1"></i>نص الرسالة
                                                    </label>
                                                    <textarea class="form-control" rows="3" x-model="alert.message" placeholder="اكتب رسالة التنبيه هنا..."></textarea>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <div class="card border border-dark">
                                                        <div class="card-body px-3 py-2">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between">
                                                                <span class="fw-semibold">
                                                                    <i class="fa fa-power-off mx-2"></i>تفعيل هذا
                                                                    التنبيه
                                                                </span>
                                                                <label class="switch switch-success mb-0">
                                                                    <input type="checkbox" x-model="alert.enabled">
                                                                    <span class="switch-indicator"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Live Preview for Payment Alert --}}
                                                <div class="col-12"
                                                    x-show="alert.enabled && (alert.title || alert.message)">
                                                    <div class="card bg-light">
                                                        <div class="card-header">
                                                            <small class="text-muted">
                                                                <i class="fa fa-eye mx-1"></i>معاينة مباشرة
                                                            </small>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="alert alert-dismissible fade show shadow border-0 m-0"
                                                                role="alert":style="`background: linear-gradient(135deg,${alert.type === 'warning' ? '#fff3cd 0%, #fffbea 100%' : alert.type === 'danger' ? '#f8d7da 0%, #ffe5e7 100%' : alert.type === 'success' ? '#d1e7dd 0%, #e8f5e9 100%' : '#cff4fc 0%, #e7f6fd 100%'}); border-right: 5px solid ${alert.type === 'warning' ? '#ff9800' : alert.type === 'danger' ? '#f44336' : alert.type === 'success' ? '#4caf50' : '#2196f3'} !important;padding: 1.5rem;`">
                                                                <div class="d-flex align-items-start">
                                                                    <div class="flex-shrink-0 me-3 ms-2">
                                                                        <div class="rounded-circle d-flex align-items-center justify-content-center"
                                                                            :style="`width: 60px; height: 60px; background-color:${alert.type === 'warning' ? '#ff9800' : alert.type === 'danger' ? '#f44336' : alert.type === 'success' ? '#4caf50' : '#2196f3'};`">
                                                                            <i class="fa fa-2x text-white"
                                                                                :class="{
                                                                                    'fa-exclamation-triangle': alert
                                                                                        .type === 'warning',
                                                                                    'fa-exclamation-circle': alert
                                                                                        .type === 'danger',
                                                                                    'fa-check-circle': alert
                                                                                        .type === 'success',
                                                                                    'fa-info-circle': alert
                                                                                        .type === 'info'
                                                                                }">
                                                                            </i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 pt-1">
                                                                        <h4 class="alert-heading fw-bold mb-3":style="`font-size: 1.4rem; color:${alert.type === 'warning' ? '#e65100' : alert.type === 'danger' ? '#c62828' : alert.type === 'success' ? '#2e7d32' : '#1565c0'};`"
                                                                            x-text="alert.title || 'عنوان التنبيه'">
                                                                        </h4>
                                                                        <p class="mb-3"
                                                                            style="font-size: 1.1rem; line-height: 1.6; color: #333;"
                                                                            x-text="alert.message || 'نص رسالة التنبيه'">
                                                                        </p>
                                                                        <div class="d-flex align-items-center mt-3 pt-3 border-top"
                                                                            style="border-color: rgba(0,0,0,0.1) !important;">
                                                                            <i class="fa fa-calendar mx-2"
                                                                                :style="`color: ${alert.type === 'warning' ? '#f57c00' : alert.type === 'danger' ? '#d32f2f' : alert.type === 'success' ? '#388e3c' : '#1976d2'}; font-size: 1.1rem;`">
                                                                            </i>
                                                                            <span
                                                                                style="font-size: 1rem; color: #555;">
                                                                                <strong>موعد التجديد:</strong>
                                                                                <span
                                                                                    x-text="(() => {
                                                                                    const today = new Date();
                                                                                    const renewalDate = new Date(today);
                                                                                    renewalDate.setDate(today.getDate() + (alert.show_days_before || 0));
                                                                                    const year = renewalDate.getFullYear();
                                                                                    const month = String(renewalDate.getMonth() + 1).padStart(2, '0');
                                                                                    const day = String(renewalDate.getDate()).padStart(2, '0');
                                                                                    return `${year}-${month}-${day} (بعد ${alert.show_days_before || 0} يوم)`;
                                                                                })()"></span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="alert"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            {{-- <div class="col-12 mb-4">
                                <button type="button" class="btn btn-dark" @click="$wire.addPaymentAlert()">
                                    <i class="fa fa-plus mx-1"></i>إضافة تنبيه موعد دفع جديد
                                </button>
                            </div> --}}
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
