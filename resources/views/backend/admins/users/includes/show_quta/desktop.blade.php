<div class="d-none d-md-block">
    <div class="table-responsive">
        @if ($tabActive == 1)
            @if ($ledgerAvailable)
                <div class="px-2 py-3 border-bottom border-secondary">
                    <div class="row g-2 align-items-end mb-2">
                        <div class="col-md-4">
                            <label class="small text-muted mb-0">{{ __('site.user_index.quta_usage.five_month_total') }}</label>
                            <div class="fw-bold fs-18">{{ $this->formatBytes($fiveMonth['total_bytes'] ?? 0, 2) }}</div>
                            <div class="small text-muted">{{ $this->mb($fiveMonth['total_bytes'] ?? 0) }}</div>
                        </div>
                        <div class="col-md-8">
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label class="small mb-0">{{ __('site.user_index.quta_usage.range_from') }}</label>
                                    <input type="date" class="form-control form-control-sm" wire:model.live="filterDateFrom" />
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-0">{{ __('site.user_index.quta_usage.range_to') }}</label>
                                    <input type="date" class="form-control form-control-sm" wire:model.live="filterDateTo" />
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary btn-sm mt-3 w-100" wire:click="applyDateRange">
                                        {{ __('site.user_index.quta_usage.apply_range') }}
                                    </button>
                                </div>
                            </div>
                            <div class="mt-2 small">
                                {{ __('site.user_index.quta_usage.range_total') }}:
                                <strong>{{ $this->formatBytes($rangeSummary['total_bytes'] ?? 0, 2) }}</strong>
                                — {{ $this->mb($rangeSummary['total_bytes'] ?? 0) }}
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped text-center table-sm mb-0">
                    <thead>
                        <tr>
                            <th>{{ __('site.user_index.quta_usage.col_day') }}</th>
                            <th>{{ __('site.user_index.quta_usage.col_download') }}</th>
                            <th>{{ __('site.user_index.quta_usage.col_upload') }}</th>
                            <th>{{ __('site.user_index.quta_usage.col_total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dailyRows as $row)
                            <tr>
                                <td><span class="badge badge-success">{{ $row->usage_date }}</span></td>
                                <td dir="auto">{{ $this->formatBytes($row->download_bytes, 2) }}</td>
                                <td dir="auto">{{ $this->formatBytes($row->upload_bytes, 2) }}</td>
                                <td dir="auto"><span class="badge badge-warning">{{ $this->formatBytes($row->total_bytes, 2) }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted small">{{ __('site.user_index.quta_usage.no_days_in_range') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <details class="mt-3 px-2">
                    <summary class="fw-bold cursor-pointer py-2 user-select-none">
                        {{ __('site.user_index.quta_usage.previous_month_toggle') }}
                    </summary>
                    <table class="table table-striped text-center table-sm">
                        <thead>
                            <tr>
                                <th>{{ __('site.user_index.quta_usage.col_day') }}</th>
                                <th>{{ __('site.user_index.quta_usage.col_download') }}</th>
                                <th>{{ __('site.user_index.quta_usage.col_upload') }}</th>
                                <th>{{ __('site.user_index.quta_usage.col_total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->previousMonthRows as $row)
                                <tr>
                                    <td><span class="badge badge-info">{{ $row->usage_date }}</span></td>
                                    <td dir="auto">{{ $this->formatBytes($row->download_bytes, 2) }}</td>
                                    <td dir="auto">{{ $this->formatBytes($row->upload_bytes, 2) }}</td>
                                    <td dir="auto">{{ $this->formatBytes($row->total_bytes, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </details>
            @else
                <p class="text-warning small px-2">{{ __('site.user_index.quta_usage.ledger_fallback_hint') }}</p>
                @if (count($legacyGroupedUsage) > 0)
                    <table class="table table-striped text-center">
                        <x-table-thead :columns="__('datatable.user_quta_usage')" />
                        <tbody>
                            @foreach ($legacyGroupedUsage as $model)
                                <tr>
                                    <td>
                                        <span class="badge badge-success">
                                            {{ $model->acctstarttime }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger" dir="auto">
                                            {{ $model->render()->download() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-green" dir="auto">
                                            {{ $model->render()->upload() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-warning" dir="auto">
                                            {{ $model->render()->total() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-primary">
                                            {{ $model->render()->uptime() }}
                                        </span>
                                    </td>
                                    <td>—</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-4">
                        <x-datatable.empty-records />
                    </div>
                @endif
            @endif
        @else
            @if (count($olderUsage) > 0)
                <table class="table table-striped text-center no-padding">
                    <x-table-thead :columns="__('datatable.user_quta_usage_older_months')" />
                    <tbody>
                        @foreach ($olderUsage as $model)
                            <tr>
                                <td>
                                    <span class="badge badge-success">
                                        {{ $model->render()->from() }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $model->render()->to() }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-danger" dir="auto">
                                        {{ $model->render()->download() }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-green" dir="auto">
                                        {{ $model->render()->upload() }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-warning" dir="auto">
                                        {{ $model->render()->total() }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-primary">
                                        {{ $model->render()->uptime() }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-4">
                    <x-datatable.empty-records />
                </div>
            @endif
        @endif
    </div>
</div>
