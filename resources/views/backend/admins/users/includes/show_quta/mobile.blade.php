<div class="d-block d-md-none">
    @if ($tabActive == 1)
        @if ($ledgerAvailable)
            <div class="px-2 py-2 small">
                <div class="mb-2">{{ __('site.user_index.quta_usage.five_month_total') }}:
                    <strong>{{ $this->formatBytes($fiveMonth['total_bytes'] ?? 0, 2) }}</strong>
                </div>
                <div class="row g-1 mb-2">
                    <div class="col-6">
                        <input type="date" class="form-control form-control-sm" wire:model.live="filterDateFrom" />
                    </div>
                    <div class="col-6">
                        <input type="date" class="form-control form-control-sm" wire:model.live="filterDateTo" />
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary btn-sm w-100" wire:click="applyDateRange">
                            {{ __('site.user_index.quta_usage.apply_range') }}
                        </button>
                    </div>
                </div>
                <div class="mb-2">{{ __('site.user_index.quta_usage.range_total') }}:
                    {{ $this->mb($rangeSummary['total_bytes'] ?? 0) }}
                </div>
            </div>
            @foreach ($dailyRows as $row)
                <div class="col-12 mb-2">
                    <div class="box box-bordered border-dark">
                        <div class="box-header py-1">{{ $row->usage_date }}</div>
                        <div class="box-body py-2">
                            <span class="badge badge-danger d-block mb-1" dir="auto">{{ $this->formatBytes($row->download_bytes, 2) }}</span>
                            <span class="badge badge-green d-block mb-1" dir="auto">{{ $this->formatBytes($row->upload_bytes, 2) }}</span>
                            <span class="badge badge-warning d-block" dir="auto">{{ $this->formatBytes($row->total_bytes, 2) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
            <details class="mt-2 px-2">
                <summary class="fw-bold py-2">{{ __('site.user_index.quta_usage.previous_month_toggle') }}</summary>
                @foreach ($this->previousMonthRows as $row)
                    <div class="box box-bordered border-secondary mb-2">
                        <div class="box-header py-1 small">{{ $row->usage_date }}</div>
                        <div class="box-body py-1 small" dir="auto">
                            {{ $this->formatBytes($row->total_bytes, 2) }}
                        </div>
                    </div>
                @endforeach
            </details>
        @elseif (count($legacyGroupedUsage) > 0)
            <p class="text-warning small px-2">{{ __('site.user_index.quta_usage.ledger_fallback_hint') }}</p>
            <div class="px-2 py-2">
                <div class="row">
                    @foreach ($legacyGroupedUsage as $model)
                        <div class="col-12">
                            <div class="box box-bordered border-dark">
                                <div class="box-header py-1">
                                    التاريخ : <span class="text-warning" dir="auto">{{ $model->acctstarttime }}</span>
                                </div>
                                <div class="box-body py-2">
                                    <span class="badge badge-dark d-block mb-1" dir="auto">{{ $model->render()->download() }}</span>
                                    <span class="badge badge-dark d-block mb-1" dir="auto">{{ $model->render()->upload() }}</span>
                                    <span class="badge badge-dark d-block" dir="auto">{{ $model->render()->total() }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-4">
                <x-datatable.empty-records />
            </div>
        @endif
    @else
        @if (count($olderUsage) > 0)
            <div class="px-2 py-2">
                <div class="row">
                    @foreach ($olderUsage as $model)
                        <div class="col-12">
                            <div class="box box-bordered border-dark">
                                <div class="box-header py-1">
                                    <div>
                                        وقت البدء : <span class="text-warning" dir="auto">
                                            {{ $model->render()->from() }}
                                        </span>
                                    </div>
                                    <div>
                                        وقت الانتهاء : <span class="text-danger" dir="auto">
                                            {{ $model->render()->to() }}
                                        </span>
                                    </div>
                                </div>
                                <div class="box-body py-2">
                                    <span class="badge badge-dark d-block mb-1" dir="auto">{{ $model->render()->download() }}</span>
                                    <span class="badge badge-dark d-block mb-1" dir="auto">{{ $model->render()->upload() }}</span>
                                    <span class="badge badge-dark d-block" dir="auto">{{ $model->render()->total() }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-4">
                <x-datatable.empty-records />
            </div>
        @endif
    @endif
</div>
