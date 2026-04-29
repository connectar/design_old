{{--
    فلاتر إحصائيات NAS — نفس أسلوب شريط الفلاتر في managers/invoices (صف + نطاق تاريخ واحد).
    المتغيرات: $nas, $filter, $consumption_date_from, $consumption_date_to, $consumption_months
--}}
@php
    $df = isset($consumption_date_from) && $consumption_date_from !== null ? (string) $consumption_date_from : '';
    $dt = isset($consumption_date_to) && $consumption_date_to !== null ? (string) $consumption_date_to : '';
    $monthsHidden = (int) ($consumption_months ?? 3);
    $monthsHidden = max(1, min(36, $monthsHidden));
    $hasRequestDates = $df !== '' && $dt !== '';
@endphp

<form id="userStatistic" method="GET" action="{{ url()->current() }}" class="mb-3">
    <div class="container-fluid py-3 px-3">
        <div class="row align-items-end">
            <div class="col-xl-4 col-md-6 col-12 mb-3 mb-xl-0">
                <span class="text-primary d-block mb-1">
                    <i class="fa fa-server text-primary me-1"></i>
                    {{ __('site.nas_statistics.nas_label') }}
                </span>
                <select id="selectedNas" class="form-control bg-lightest text-white" name="filter">
                    @foreach ($nas as $index => $nasRow)
                        <option value="{{ $nasRow['serial'] }}" @selected((int) $filter === (int) $nasRow['serial'])>
                            {{ $nasRow['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-xl-5 col-md-6 col-12 mb-3 mb-xl-0">
                <label class="form-label mb-1 text-white" for="nasStatPeriodPreset">
                    {{ __('site.nas_statistics.period_shortcuts_label') }}
                </label>
                <select id="nasStatPeriodPreset" class="form-control mb-2" autocomplete="off">
                    <option value="this_month">{{ __('site.nas_statistics.period_preset_this_month') }}</option>
                    <option value="last_3" @selected(!$hasRequestDates)>{{ __('site.nas_statistics.period_preset_last_3') }}</option>
                    <option value="last_6">{{ __('site.nas_statistics.period_preset_last_6') }}</option>
                    <option value="last_12">{{ __('site.nas_statistics.period_preset_last_12') }}</option>
                    <option value="custom" @selected($hasRequestDates)>{{ __('site.nas_statistics.period_preset_custom') }}</option>
                </select>
                <label class="form-label mb-1 text-white" for="nas-stat-date-range">
                    {{ __('new_trans.started_at') }}
                    <span class="text-primary small">{{ __('site.nas_statistics.consumption_period_sub') }}</span>
                </label>
                <input type="text" id="nas-stat-date-range" class="form-control" autocomplete="off"
                    placeholder="{{ __('new_trans.choose_date') }}">
                <input type="hidden" name="date_from" id="nas_stat_date_from" value="{{ $df }}">
                <input type="hidden" name="date_to" id="nas_stat_date_to" value="{{ $dt }}">
                <input type="hidden" name="months" id="nas_stat_months" value="{{ $monthsHidden }}">
            </div>
            <div class="col-xl-3 col-md-12 col-12">
                <label class="form-label d-xl-block d-none mb-1">&nbsp;</label>
                <button type="submit" class="btn btn-primary btn-block">{{ __('site.nas_statistics.apply') }}</button>
            </div>
        </div>
        <p class="small text-muted mb-0 mt-2">{{ __('site.nas_statistics.period_hint_short') }}</p>
    </div>
</form>

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .flatpickr-day.inRange {
            background: #569ff7 !important;
            border-color: #569ff7 !important;
            color: #fff !important;
            box-shadow: none !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/ar.js"></script>
    <script>
        $(function() {
            var lang = '{{ str_starts_with(app()->getLocale(), 'ar') ? 'ar' : 'en' }}';
            var hasRequestDates = {{ $hasRequestDates ? 'true' : 'false' }};
            var initialFrom = @json($df);
            var initialTo = @json($dt);
            var monthsFallback = {{ $monthsHidden }};
            var syncingFromPreset = false;

            function pad(n) {
                return n < 10 ? '0' + n : '' + n;
            }

            function ymd(d) {
                return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate());
            }

            function endOfToday() {
                var d = new Date();
                d.setHours(0, 0, 0, 0);
                return d;
            }

            function startOfMonth(d) {
                var x = new Date(d);
                x.setDate(1);
                x.setHours(0, 0, 0, 0);
                return x;
            }

            function nasStatRangeForPreset(key) {
                var end = endOfToday();
                var start;
                if (key === 'this_month') {
                    start = startOfMonth(end);
                } else if (key === 'last_3') {
                    start = new Date(end);
                    start.setMonth(start.getMonth() - 3);
                } else if (key === 'last_6') {
                    start = new Date(end);
                    start.setMonth(start.getMonth() - 6);
                } else if (key === 'last_12') {
                    start = new Date(end);
                    start.setMonth(start.getMonth() - 12);
                } else {
                    start = new Date(end);
                    start.setMonth(start.getMonth() - monthsFallback);
                }
                return [start, end];
            }

            function syncHiddens(fp) {
                var f = document.getElementById('nas_stat_date_from');
                var t = document.getElementById('nas_stat_date_to');
                if (!fp || fp.selectedDates.length < 2) {
                    f.value = '';
                    t.value = '';
                    return;
                }
                f.value = fp.formatDate(fp.selectedDates[0], 'Y-m-d');
                t.value = fp.formatDate(fp.selectedDates[1], 'Y-m-d');
            }

            var defaultPair;
            if (hasRequestDates && initialFrom && initialTo) {
                defaultPair = [initialFrom, initialTo];
            } else {
                defaultPair = nasStatRangeForPreset('last_3');
            }

            var presetEl = document.getElementById('nasStatPeriodPreset');

            var fpOpts = {
                dateFormat: 'Y-m-d',
                enableTime: false,
                mode: 'range',
                showMonths: 1,
                shorthandCurrentMonth: true,
                defaultDate: defaultPair,
                onChange: function(selectedDates, dateStr, instance) {
                    syncHiddens(instance);
                    if (!syncingFromPreset && selectedDates.length >= 2 && presetEl) {
                        presetEl.value = 'custom';
                    }
                },
                onReady: function(selectedDates, dateStr, instance) {
                    syncHiddens(instance);
                }
            };
            if (lang === 'ar') {
                fpOpts.locale = 'ar';
            }
            var nasStatFp = flatpickr('#nas-stat-date-range', fpOpts);

            if (presetEl) {
                if (!hasRequestDates) {
                    presetEl.value = 'last_3';
                } else {
                    presetEl.value = 'custom';
                }
                presetEl.addEventListener('change', function() {
                    var v = this.value;
                    if (v === 'custom') {
                        return;
                    }
                    var pair = nasStatRangeForPreset(v);
                    syncingFromPreset = true;
                    nasStatFp.setDate(pair, true);
                    syncHiddens(nasStatFp);
                    syncingFromPreset = false;
                });
            }

            $('#selectedNas').on('change', function() {
                syncHiddens(nasStatFp);
                $('#userStatistic').submit();
            });
        });
    </script>
@endpush
