@php
    /** @var array $statistic */
    $cc = $statistic['consumptionComparison'] ?? null;
    $ccErr = $statistic['consumptionComparisonError'] ?? null;
    $fmt = app(\App\Models\NasAcounting::class);
@endphp
@if ($ccErr)
    <div class="row mt-3">
        <div class="col-12">
            <div class="alert alert-warning mb-0" dir="auto">{{ $ccErr }}</div>
        </div>
    </div>
@elseif ($cc)
    <div class="row mt-3">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        @if ($cc['app_accounting_only'] ?? false)
                            {{ __('site.nas_statistics.consumption_app_only_title') }}
                        @else
                            {{ __('site.nas_statistics.consumption_comparison_title') }}
                        @endif
                    </h4>
                </div>
                <div class="box-body">
                    @if (!($cc['app_accounting_only'] ?? false) && !($cc['radacct_available'] ?? true))
                        <div class="alert alert-info" dir="auto">
                            <div>{{ __('site.nas_statistics.radacct_unavailable_banner') }}</div>
                            <div class="small mt-2" style="opacity: 0.85;">{{ __('site.nas_statistics.radacct_unavailable_admin_hint') }}</div>
                        </div>
                    @endif
                    <p class="text-muted small" dir="auto">{{ $cc['explanation'][str_starts_with(app()->getLocale(), 'ar') ? 'ar' : 'en'] }}</p>
                    <p class="small" dir="auto">
                        {{ __('site.nas_statistics.period_label') }}
                        {{ \Illuminate\Support\Carbon::parse($cc['period']['from'])->toDateString() }}
                        —
                        {{ \Illuminate\Support\Carbon::parse($cc['period']['to'])->toDateString() }}
                    </p>
                    @if ($cc['app_accounting_only'] ?? false)
                        <div class="row text-center mb-3">
                            <div class="col-md-8 col-md-offset-2 mx-auto">
                                <div class="p-3 b-1 border-warning rounded">
                                    <div class="fs-18 fw-600">{{ __('site.nas_statistics.nas_sessions_total') }}</div>
                                    <div class="fs-24" dir="auto">{{ $fmt->formatBytes($cc['nas_acountings']['range_total_bytes'], 2) }}</div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row text-center mb-3">
                            <div class="col-md-6">
                                <div class="p-3 b-1 border-primary rounded">
                                    <div class="fs-18 fw-600">{{ __('site.nas_statistics.radacct_total') }}</div>
                                    @if ($cc['radacct_available'] ?? true)
                                        <div class="fs-24" dir="auto">{{ $fmt->formatBytes($cc['radacct']['range_total_bytes'], 2) }}</div>
                                    @else
                                        <div class="fs-24 text-muted" dir="auto">—</div>
                                        <p class="small text-muted mb-0">{{ __('site.nas_statistics.radacct_unavailable_short') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 b-1 border-warning rounded">
                                    <div class="fs-18 fw-600">{{ __('site.nas_statistics.nas_app_total') }}</div>
                                    <div class="fs-24" dir="auto">{{ $fmt->formatBytes($cc['nas_acountings']['range_total_bytes'], 2) }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @php
                        $peakNasDl = $cc['peak_months_download']['nas_acountings'] ?? [];
                        $peakRadDl = $cc['peak_months_download']['radacct'] ?? [];
                    @endphp
                    @if (count($peakNasDl) > 0 || count($peakRadDl) > 0)
                        <div class="mb-3 p-3 b-1 border-info rounded" style="background: rgba(23, 162, 184, 0.08);">
                            <h5 class="mt-0 mb-2 text-white">{{ __('site.nas_statistics.peak_download_title') }}</h5>
                            @if (count($peakNasDl) > 0)
                                <p class="mb-1 text-white" dir="auto">
                                    <strong>{{ __('site.nas_statistics.peak_download_app_label') }}</strong>
                                    {{ implode('، ', array_column($peakNasDl, 'month')) }}
                                    —
                                    <span class="badge badge-danger">{{ $fmt->formatBytes($peakNasDl[0]['download_bytes'], 2) }}</span>
                                </p>
                            @endif
                            @if (count($peakRadDl) > 0)
                                <p class="mb-0 text-white" dir="auto">
                                    <strong>{{ __('site.nas_statistics.peak_download_radacct_label') }}</strong>
                                    {{ implode('، ', array_column($peakRadDl, 'month')) }}
                                    —
                                    <span class="badge badge-primary">{{ $fmt->formatBytes($peakRadDl[0]['download_bytes'], 2) }}</span>
                                </p>
                            @endif
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped text-center table-bordered">
                            <thead>
                                @if ($cc['app_accounting_only'] ?? false)
                                    <tr>
                                        <th>{{ __('site.nas_statistics.month_col') }}</th>
                                        <th>{{ __('site.nas_statistics.nas_sessions_monthly_col') }}</th>
                                    </tr>
                                @else
                                    <tr>
                                        <th>{{ __('site.nas_statistics.month_col') }}</th>
                                        <th>{{ __('site.nas_statistics.radacct_col') }}</th>
                                        <th>{{ __('site.nas_statistics.nas_app_col') }}</th>
                                    </tr>
                                @endif
                            </thead>
                            <tbody>
                                @if ($cc['app_accounting_only'] ?? false)
                                    @forelse(($cc['monthly_app_rows'] ?? []) as $row)
                                        <tr>
                                            <td><span class="badge badge-info">{{ $row['month'] }}</span></td>
                                            <td dir="auto">{{ $fmt->formatBytes($row['total_bytes'], 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">{{ __('site.nas_statistics.no_monthly_rows') }}</td>
                                        </tr>
                                    @endforelse
                                @else
                                    @forelse ($cc['monthly_comparison'] as $row)
                                        <tr>
                                            <td><span class="badge badge-info">{{ $row['month'] }}</span></td>
                                            <td dir="auto">
                                                @if (!empty($row['radacct']))
                                                    {{ $fmt->formatBytes($row['radacct']['total_bytes'], 2) }}
                                                @else
                                                    —
                                                @endif
                                            </td>
                                            <td dir="auto">
                                                @if (!empty($row['nas_acountings']))
                                                    {{ $fmt->formatBytes($row['nas_acountings']['total_bytes'], 2) }}
                                                @else
                                                    —
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">{{ __('site.nas_statistics.no_monthly_rows') }}</td>
                                        </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
