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
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class=" col-md-5 mx-auto">
                        <div class="mb-3 mx-4">
                            <label for="date-range"
                                class="form-label p-2">{{ __('new_trans.printed_at') . ' ' . __('new_trans.from') . ' ' . __('new_trans.to') }}
                                :</label>
                            <input type="text" id="date-range" wire:model.prevent.debounce.500ms="printed_at_range"
                                autocomplete="off" class="form-control" placeholder="{{ __('new_trans.choose_date') }}">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    @if ($step == 1)
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="text-primary">
                                    عفوا هذة الصفحة خاصة بالموزع فقط لمعرفه رصيده والديون الخاصة به
                                    والارباح
                                </h2>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12">
                                <p>
                                    مرحبا ,
                                    <span class="text-primary">
                                        {{ $distributor->fullname ?? '' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-12">
                                <div class="box box-body pull-up bg-dark bg-brick-dark">
                                    <div class="flexbox">
                                        <span class="fa fa-dollar fs-40"></span>
                                        <span class="fw-200 fs-30">
                                            {{ $account ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        رصيد يوم
                                        <strong>{{ date('Y-m-d', strtotime($this->account_date)) }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="box box-body pull-up bg-success bg-brick-dark">
                                    <div class="flexbox">
                                        <span class="fa fa-dollar fs-40"></span>
                                        <span class="fw-200 fs-30">
                                            {{ $sales ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        المبيعات
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="box box-body pull-up bg-warning bg-deathstar-white">
                                    <div class="flexbox">
                                        <span class="fa fa-dollar fs-40"></span>
                                        <span class="fw-200 fs-30">
                                            {{ $transactional_sales ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        مبيعات التحويلات
                                        ( لا تضاف الى صافى الارباح )
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="box box-body pull-up bg-warning bg-deathstar-white">
                                    <div class="flexbox">
                                        <span class="fa fa-dollar fs-40"></span>
                                        <span class="fw-200 fs-30">
                                            {{ $transactional_profit ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        ارباح التحويلات
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="box box-body pull-up bg-danger bg-deathstar-white">
                                    <div class="flexbox">
                                        <span class="fa fa-dollar fs-40"></span>
                                        <span class="fw-200 fs-30">
                                            {{ $current_month_expenses_total ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        المصروفات
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="box box-body pull-up bg-primary bg-deathstar-white">
                                    <div class="flexbox">
                                        <span class="fa fa-money fs-40"></span>
                                        <span class="fw-200 fs-30">
                                            {{ $profit_for_distributor ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        الارباح
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="box box-body pull-up bg-info bg-deathstar-white">
                                    <div class="flexbox">
                                        <span class="fa fa-money fs-40"></span>
                                        <span class="fw-200 fs-30">
                                            {{ $debts_for_distibutor ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        المتأخرات
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="box box-body pull-up bg-info bg-deathstar-white">
                                    <div class="flexbox">
                                        <span class="fa fa-money fs-40"></span>
                                        <span class="fw-200 fs-30">
                                            {{ $profit_for_manager ?? 0 }}
                                        </span>
                                    </div>
                                    <div class="text-end">
                                        الصافى لـمدير الشبكة
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/ar.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fp = flatpickr('#date-range', {
                dateFormat: 'Y-m-d',
                enableTime: false,
                mode: 'range',
                locale: 'ar',
                defaultDate: ['{{ $from_date }}', '{{ $to_date }}'],
                onReady: function(selectedDates, dateStr, instance) {
                    replaceMonthNamesWithNumbers(instance);
                },
                onMonthChange: function(selectedDates, dateStr, instance) {
                    replaceMonthNamesWithNumbers(instance);
                },
                onValueUpdate: function(selectedDates, dateStr, instance) {
                    replaceMonthNamesWithNumbers(instance);
                }
            });

            function replaceMonthNamesWithNumbers(instance) {
                // Get the month dropdown element
                const monthDropdown = instance.calendarContainer.querySelector('.flatpickr-monthDropdown-months');

                // Get all the month options inside the dropdown
                const monthOptions = monthDropdown.querySelectorAll('option');

                // Replace each month name with the corresponding month number
                monthOptions.forEach(function(option, index) {
                    option.textContent = index + 1; // Month numbers start from 1, so we add 1 to the index
                });
            }
        });
    </script>
@endpush
