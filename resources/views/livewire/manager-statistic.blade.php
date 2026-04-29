<div class="manager-statistic" wire:poll.60s="recompute">
    {{-- ===================== HEADER ===================== --}}
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
        <div>
            <h4 class="mb-0 fw-bold text-primary">
                <i class="fa fa-bar-chart mx-1"></i>
                الإحصائيات العامة
            </h4>
            <small class="text-muted">
                محدّثة:
                {{ \Illuminate\Support\Carbon::now()->translatedFormat('l، j F Y — H:i') }}
            </small>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" wire:click="recompute"
            wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="recompute">
                <i class="fa fa-refresh"></i>
                تحديث الأرقام
            </span>
            <span wire:loading wire:target="recompute">
                <i class="fa fa-spinner fa-spin"></i>
                جارٍ الحساب...
            </span>
        </button>
    </div>

    {{-- ===================== ROW 1 — SERVERS & NETWORKS ===================== --}}
    <div class="row g-2 mb-2">
        <div class="col-6 col-lg-3">
            <div class="info-box bg-success text-white border-0">
                <span class="info-box-icon push-bottom rounded">
                    <i class="fa fa-snowflake-o fa-spin"></i>
                </span>
                <div class="info-box-content text-start">
                    <span class="info-box-text fw-bold">سيرفرات متصلة</span>
                    <span class="info-box-number">{{ number_format($snapshot['servers_connected']) }}</span>
                    <small class="text-white-50 d-block">
                        <a href="{{ route('managers.servers.index') }}" class="text-white-50 text-decoration-underline">
                            عرض الكل
                        </a>
                    </small>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="info-box bg-danger text-white border-0">
                <span class="info-box-icon push-bottom rounded">
                    <i class="fa fa-circle"></i>
                </span>
                <div class="info-box-content text-start">
                    <span class="info-box-text fw-bold">سيرفرات غير متصلة</span>
                    <span class="info-box-number">{{ number_format($snapshot['servers_disconnected']) }}</span>
                    <small class="text-white-50 d-block">
                        إجمالي السيرفرات:
                        {{ number_format($snapshot['servers_connected'] + $snapshot['servers_disconnected']) }}
                    </small>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="info-box bg-primary text-white border-0">
                <span class="info-box-icon push-bottom rounded">
                    <i class="fa fa-bolt"></i>
                </span>
                <div class="info-box-content text-start">
                    <span class="info-box-text fw-bold">شبكات نشطة</span>
                    <span class="info-box-number">{{ number_format($snapshot['networks_active']) }}</span>
                    <small class="text-white-50 d-block">
                        <a href="{{ route('managers.networks.index') }}" class="text-white-50 text-decoration-underline">
                            عرض الشبكات
                        </a>
                    </small>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="info-box bg-warning text-white border-0">
                <span class="info-box-icon push-bottom rounded">
                    <i class="fa fa-ban"></i>
                </span>
                <div class="info-box-content text-start">
                    <span class="info-box-text fw-bold">شبكات غير نشطة</span>
                    <span class="info-box-number">{{ number_format($snapshot['networks_inactive']) }}</span>
                    <small class="text-white-50 d-block">
                        إجمالي الشبكات:
                        {{ number_format($snapshot['networks_active'] + $snapshot['networks_inactive']) }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== ROW 2 — USERS & CARDS ===================== --}}
    <div class="row g-2 mb-3">
        <div class="col-12 col-lg-6">
            <div class="info-box bg-info text-white border-0">
                <span class="info-box-icon push-bottom rounded">
                    <i class="fa fa-users"></i>
                </span>
                <div class="info-box-content text-start">
                    <span class="info-box-text fw-bold">اليوزرات على السيستم</span>
                    <span class="info-box-number">{{ number_format($snapshot['users']) }}</span>
                    <small class="text-white-50 d-block">المشتركين المفعّلين في كل الشبكات</small>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="info-box bg-secondary text-white border-0">
                <span class="info-box-icon push-bottom rounded">
                    <i class="fa fa-id-card-o"></i>
                </span>
                <div class="info-box-content text-start">
                    <span class="info-box-text fw-bold">كروت الهوت اسبوت</span>
                    <span class="info-box-number">{{ number_format($snapshot['cards']) }}</span>
                    <small class="text-white-50 d-block">كروت تم تفعيلها وحالتها ليست disabled</small>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== ROW 3 — MONTH-OVER-MONTH ===================== --}}
    <div class="row g-2">
        @php
            $thisMonthLabel = \Illuminate\Support\Carbon::now()->translatedFormat('F Y');
            $prevMonthLabel = \Illuminate\Support\Carbon::now()->subMonthNoOverflow()->translatedFormat('F Y');
        @endphp

        {{-- NEW CLIENTS --}}
        @php
            $new = $monthly['new_clients'];
            $newDelta = $new['delta'];
        @endphp
        <div class="col-12 col-lg-6">
            <div class="box border-0 shadow-sm">
                <div class="box-header bg-light-primary py-2">
                    <h6 class="mb-0 fw-bold">
                        <i class="fa fa-user-plus text-success mx-1"></i>
                        عملاء جدد هذا الشهر
                    </h6>
                </div>
                <div class="box-body p-3">
                    <div class="d-flex align-items-baseline gap-2 flex-wrap">
                        <span class="display-5 fw-bold text-success">
                            {{ number_format($new['current']) }}
                        </span>
                        <span class="text-muted">عميل</span>
                        @if ($newDelta > 0)
                            <span class="badge badge-success rounded-pill ms-auto">
                                <i class="fa fa-arrow-up"></i>
                                +{{ number_format($newDelta) }}
                            </span>
                        @elseif ($newDelta < 0)
                            <span class="badge badge-danger rounded-pill ms-auto">
                                <i class="fa fa-arrow-down"></i>
                                {{ number_format($newDelta) }}
                            </span>
                        @else
                            <span class="badge badge-secondary rounded-pill ms-auto">
                                <i class="fa fa-minus"></i>
                                بدون تغيير
                            </span>
                        @endif
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between small">
                        <span>
                            <strong>{{ $thisMonthLabel }}</strong>:
                            {{ number_format($new['current']) }}
                        </span>
                        <span class="text-muted">
                            <strong>{{ $prevMonthLabel }}</strong>:
                            {{ number_format($new['previous']) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- LOST CLIENTS --}}
        @php
            $lost = $monthly['lost_clients'];
            $lostDelta = $lost['delta'];
        @endphp
        <div class="col-12 col-lg-6">
            <div class="box border-0 shadow-sm">
                <div class="box-header bg-light-danger py-2">
                    <h6 class="mb-0 fw-bold">
                        <i class="fa fa-user-times text-danger mx-1"></i>
                        عملاء لم يجدّدوا الاشتراك
                    </h6>
                </div>
                <div class="box-body p-3">
                    <div class="d-flex align-items-baseline gap-2 flex-wrap">
                        <span class="display-5 fw-bold text-danger">
                            {{ number_format($lost['current']) }}
                        </span>
                        <span class="text-muted">شبكة</span>
                        {{-- For lost clients, fewer than last month is GOOD --}}
                        @if ($lostDelta < 0)
                            <span class="badge badge-success rounded-pill ms-auto">
                                <i class="fa fa-arrow-down"></i>
                                {{ number_format($lostDelta) }}
                            </span>
                        @elseif ($lostDelta > 0)
                            <span class="badge badge-danger rounded-pill ms-auto">
                                <i class="fa fa-arrow-up"></i>
                                +{{ number_format($lostDelta) }}
                            </span>
                        @else
                            <span class="badge badge-secondary rounded-pill ms-auto">
                                <i class="fa fa-minus"></i>
                                بدون تغيير
                            </span>
                        @endif
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between small">
                        <span>
                            <strong>{{ $thisMonthLabel }}</strong>:
                            {{ number_format($lost['current']) }}
                        </span>
                        <span class="text-muted">
                            <strong>{{ $prevMonthLabel }}</strong>:
                            {{ number_format($lost['previous']) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .manager-statistic .info-box {
            min-height: 100px;
            box-shadow: 0 .25rem .5rem rgba(0, 0, 0, .08);
            transition: transform .15s ease, box-shadow .15s ease;
        }
        .manager-statistic .info-box:hover {
            transform: translateY(-1px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .14);
        }
        .manager-statistic .info-box-number {
            font-size: 1.65rem;
            font-weight: 700;
        }
        .manager-statistic .bg-light-primary {
            background-color: rgba(13, 110, 253, .08) !important;
        }
        .manager-statistic .bg-light-danger {
            background-color: rgba(220, 53, 69, .08) !important;
        }
        .manager-statistic .display-5 {
            font-size: 2.2rem;
            line-height: 1;
        }
    </style>
@endpush
