<div wire:poll.5s class="lsp-live">
    @php
        $statusBadge = static function (?string $status): string {
            return match ($status) {
                'completed' => 'success',
                'failed' => 'danger',
                'paused' => 'warning',
                'running' => 'primary',
                'cancelled' => 'dark',
                default => 'secondary',
            };
        };
        $formatDuration = static function (?int $sec): string {
            if ($sec === null || $sec < 0) {
                return '—';
            }
            if ($sec < 60) {
                return $sec.' ث';
            }
            if ($sec < 3600) {
                return floor($sec / 60).' د '.($sec % 60).' ث';
            }
            $h = floor($sec / 3600);
            $m = floor(($sec % 3600) / 60);
            return $h.' س '.$m.' د';
        };
    @endphp

    <style>
        .lsp-live .lsp-card { border-radius: 12px; }
        .lsp-live .lsp-card .card-header {
            background: linear-gradient(135deg,#6366f1,#4338ca);
            color: #fff;
            border-bottom: none;
        }
        .lsp-live .lsp-stat {
            border-radius: 12px;
            padding: 14px 16px;
            color: #fff;
            min-height: 92px;
            display: flex; align-items: center; gap: 12px;
        }
        .lsp-live .lsp-stat .ic {
            width: 46px; height: 46px;
            border-radius: 10px;
            background: rgba(255,255,255,0.18);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
        }
        .lsp-live .lsp-stat .label { font-size: 13px; opacity: 0.95; font-weight: 600; }
        .lsp-live .lsp-stat .value { font-size: 24px; font-weight: 800; line-height: 1.1; }
        .lsp-live .lsp-stat .sub   { font-size: 11px; opacity: 0.85; margin-top: 2px; }
        .lsp-blue   { background: linear-gradient(135deg,#3b82f6,#1e40af); }
        .lsp-green  { background: linear-gradient(135deg,#10b981,#047857); }
        .lsp-amber  { background: linear-gradient(135deg,#f59e0b,#b45309); }
        .lsp-red    { background: linear-gradient(135deg,#ef4444,#991b1b); }
        .lsp-purple { background: linear-gradient(135deg,#8b5cf6,#5b21b6); }
        .lsp-gray   { background: linear-gradient(135deg,#64748b,#334155); }

        .lsp-live .progress { height: 24px; border-radius: 8px; }
        .lsp-live .progress-bar { font-weight: 700; font-size: 13px; }

        .lsp-live .lsp-current {
            border: 2px dashed #6366f1;
            border-radius: 12px;
            padding: 14px 16px;
            background: #eef2ff;
        }
        .lsp-live .lsp-current .label { font-size: 12px; color: #4338ca; font-weight: 700; }
        .lsp-live .lsp-current .value { font-size: 16px; color: #1e1b4b; font-weight: 700; word-break: break-word; }
        .lsp-live .lsp-current code { color: #4338ca; background: #fff; padding: 2px 6px; border-radius: 4px; }

        .lsp-live .table thead th {
            background: #f9fafb;
            font-weight: 700;
            font-size: 12px;
            text-align: center;
        }
        .lsp-live .table tbody td { vertical-align: middle; text-align: center; padding: 8px; font-size: 13px; }
        .lsp-live .table tbody tr.row-running { background: #eef2ff; }
        .lsp-live .table tbody tr.row-failed  { background: #fef2f2; }

        .lsp-live .lsp-empty {
            padding: 40px 12px; text-align: center; color: #6b7280; font-size: 14px;
        }

        .lsp-live .lsp-pulse {
            display: inline-block; width: 10px; height: 10px;
            border-radius: 50%; background: #10b981;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: lsp-pulse 1.4s infinite;
            margin-inline-end: 6px;
        }
        @keyframes lsp-pulse {
            0%   { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70%  { box-shadow: 0 0 0 12px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
    </style>

    {{-- ── Header / link to full dashboard ── --}}
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap" style="gap:.5rem;">
        <h4 class="mb-0">
            <i class="fa fa-broadcast-tower text-primary"></i>
            {{ __('legacy_sync.live.title') }}
            @if ($isActive)
                <span class="lsp-pulse"></span>
                <span class="badge badge-success">{{ __('legacy_sync.live.live_now') }}</span>
            @endif
        </h4>
        <a href="{{ route('managers.legacy-sync.index') }}" class="btn btn-sm btn-outline-primary">
            <i class="fa fa-cogs"></i> {{ __('legacy_sync.live.open_dashboard') }}
        </a>
    </div>

    @if (! $latestRun)
        <div class="card lsp-card shadow-sm">
            <div class="card-body lsp-empty">
                <i class="fa fa-inbox fa-3x mb-3 text-muted d-block"></i>
                <strong>{{ __('legacy_sync.live.no_runs_yet') }}</strong>
                <p class="text-muted mt-2 mb-0">{{ __('legacy_sync.live.no_runs_hint') }}</p>
                <a href="{{ route('managers.legacy-sync.index') }}" class="btn btn-primary mt-3">
                    <i class="fa fa-rocket"></i> {{ __('legacy_sync.live.start_now') }}
                </a>
            </div>
        </div>
    @else
        @php
            $rBadge = $statusBadge($latestRun->status);
        @endphp

        {{-- ── Run header ── --}}
        <div class="card lsp-card shadow-sm mb-3">
            <div class="card-header py-2 d-flex align-items-center flex-wrap" style="gap:.5rem;">
                <strong class="me-2">
                    <i class="fa fa-rocket"></i>
                    {{ __('legacy_sync.live.run') }} #{{ $latestRun->id }}
                </strong>
                <span class="badge badge-light text-dark">
                    {{ __('legacy_sync.live.mode_'.$latestRun->mode) }}
                </span>
                <span class="badge badge-{{ $rBadge }}">
                    {{ __('legacy_sync.status.'.$latestRun->status) }}
                </span>
                @if ($latestRun->started_at)
                    <small class="ms-auto" style="opacity:.85;">
                        <i class="fa fa-clock"></i>
                        {{ __('legacy_sync.live.started_at') }}: {{ $latestRun->started_at->format('Y-m-d H:i') }}
                    </small>
                @endif
            </div>
            <div class="card-body">
                {{-- Progress bar --}}
                <div class="progress mb-3">
                    <div class="progress-bar progress-bar-striped {{ $latestRun->status === 'running' ? 'progress-bar-animated' : '' }} bg-{{ $rBadge }}"
                         role="progressbar"
                         style="width: {{ $stats['percent'] }}%"
                         aria-valuenow="{{ $stats['percent'] }}"
                         aria-valuemin="0" aria-valuemax="100">
                        {{ $stats['percent'] }}% &middot;
                        {{ number_format($stats['done']) }} / {{ number_format($stats['total']) }}
                        {{ __('legacy_sync.live.networks') }}
                    </div>
                </div>

                {{-- Stat boxes --}}
                <div class="row g-2">
                    <div class="col-6 col-md-3 mb-2">
                        <div class="lsp-stat lsp-blue">
                            <div class="ic"><i class="fa fa-network-wired"></i></div>
                            <div>
                                <div class="label">{{ __('legacy_sync.live.total_networks') }}</div>
                                <div class="value">{{ number_format($stats['total']) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-2">
                        <div class="lsp-stat lsp-green">
                            <div class="ic"><i class="fa fa-check"></i></div>
                            <div>
                                <div class="label">{{ __('legacy_sync.live.done') }}</div>
                                <div class="value">{{ number_format($stats['done']) }}</div>
                                <div class="sub">{{ __('legacy_sync.live.from_total', ['total' => number_format($stats['total'])]) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-2">
                        <div class="lsp-stat lsp-amber">
                            <div class="ic"><i class="fa fa-spinner"></i></div>
                            <div>
                                <div class="label">{{ __('legacy_sync.live.currently_running') }}</div>
                                <div class="value">{{ number_format($stats['running']) }}</div>
                                <div class="sub">{{ __('legacy_sync.live.queued') }}: {{ number_format($stats['queued']) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-2">
                        <div class="lsp-stat lsp-{{ $stats['failed'] > 0 ? 'red' : 'gray' }}">
                            <div class="ic"><i class="fa fa-times-circle"></i></div>
                            <div>
                                <div class="label">{{ __('legacy_sync.live.failed') }}</div>
                                <div class="value">{{ number_format($stats['failed']) }}</div>
                                @if (($stats['cancelled'] ?? 0) > 0)
                                    <div class="sub">{{ __('legacy_sync.status.cancelled') }}: {{ number_format($stats['cancelled']) }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 mb-2">
                        <div class="lsp-stat lsp-purple">
                            <div class="ic"><i class="fa fa-database"></i></div>
                            <div>
                                <div class="label">{{ __('legacy_sync.live.total_rows') }}</div>
                                <div class="value">{{ number_format($stats['rows_copied']) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 mb-2">
                        <div class="lsp-stat lsp-blue">
                            <div class="ic"><i class="fa fa-hourglass-half"></i></div>
                            <div>
                                <div class="label">{{ __('legacy_sync.live.eta') }}</div>
                                <div class="value">{{ $formatDuration($stats['eta_seconds']) }}</div>
                                <div class="sub">{{ __('legacy_sync.live.eta_hint') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Currently syncing --}}
                @if ($currentNetwork)
                    <div class="lsp-current mt-2">
                        <div class="d-flex flex-wrap" style="gap: 1.25rem;">
                            <div>
                                <div class="label">
                                    <span class="lsp-pulse"></span>
                                    {{ __('legacy_sync.live.currently_syncing') }}
                                </div>
                                <div class="value">
                                    {{ $currentNetwork->network_name ?: __('legacy_sync.live.no_name') }}
                                    <small class="text-muted">
                                        ({{ __('legacy_sync.cols.legacy_id') }}: {{ $currentNetwork->legacy_network_id }})
                                    </small>
                                </div>
                            </div>
                            <div>
                                <div class="label">{{ __('legacy_sync.cols.billing_code') }}</div>
                                <div class="value">{{ $currentNetwork->billing_code ?: '—' }}</div>
                            </div>
                            <div>
                                <div class="label">{{ __('legacy_sync.cols.current_table') }}</div>
                                <div class="value">
                                    @if ($currentNetwork->current_table)
                                        @php
                                            $phaseKey = \App\Services\LegacySync\NetworkSchema::phaseKeyFor($currentNetwork->current_table);
                                        @endphp
                                        <code>{{ $currentNetwork->current_table }}</code>
                                        @if ($phaseKey)
                                            <span class="badge badge-info ms-1">
                                                {{ __('legacy_sync.phases.'.$phaseKey) }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div class="label">{{ __('legacy_sync.cols.rows_copied') }}</div>
                                <div class="value">{{ number_format($currentNetwork->rows_copied_total) }}</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- ── Recent networks table ── --}}
        <div class="card lsp-card shadow-sm mb-3">
            <div class="card-header py-2">
                <strong>
                    <i class="fa fa-list"></i>
                    {{ __('legacy_sync.live.recent_networks') }}
                </strong>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('legacy_sync.cols.legacy_id') }}</th>
                            <th>{{ __('legacy_sync.cols.billing_code') }}</th>
                            <th>{{ __('legacy_sync.cols.network') }}</th>
                            <th>{{ __('legacy_sync.cols.current_table') }}</th>
                            <th>{{ __('legacy_sync.cols.rows_copied') }}</th>
                            <th>{{ __('legacy_sync.cols.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentNetworks as $row)
                            @php
                                $rowClass = match ($row->status) {
                                    'running' => 'row-running',
                                    'failed' => 'row-failed',
                                    default => '',
                                };
                                $rowBadge = $statusBadge($row->status);
                            @endphp
                            <tr class="{{ $rowClass }}">
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->legacy_network_id }}</td>
                                <td>{{ $row->billing_code ?: '—' }}</td>
                                <td style="text-align: start;">{{ $row->network_name ?: '—' }}</td>
                                <td>
                                    @if ($row->current_table)
                                        <code>{{ $row->current_table }}</code>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>{{ number_format($row->rows_copied_total) }}</td>
                                <td>
                                    <span class="badge badge-{{ $rowBadge }}">
                                        {{ __('legacy_sync.status.'.$row->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="lsp-empty">{{ __('legacy_sync.all.empty') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- ── History of recent finished runs ── --}}
    @if ($history->count() > 0)
        <div class="card lsp-card shadow-sm">
            <div class="card-header py-2">
                <strong>
                    <i class="fa fa-history"></i>
                    {{ __('legacy_sync.live.recent_runs') }}
                </strong>
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('legacy_sync.live.mode') }}</th>
                            <th>{{ __('legacy_sync.cols.status') }}</th>
                            <th>{{ __('legacy_sync.live.networks') }}</th>
                            <th>{{ __('legacy_sync.live.started') }}</th>
                            <th>{{ __('legacy_sync.live.finished') }}</th>
                            <th>{{ __('legacy_sync.live.duration') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $h)
                            @php
                                $hBadge = $statusBadge($h->status);
                                $duration = ($h->started_at && $h->completed_at)
                                    ? $h->completed_at->diffInSeconds($h->started_at)
                                    : null;
                            @endphp
                            <tr>
                                <td>#{{ $h->id }}</td>
                                <td>{{ __('legacy_sync.live.mode_'.$h->mode) }}</td>
                                <td><span class="badge badge-{{ $hBadge }}">{{ __('legacy_sync.status.'.$h->status) }}</span></td>
                                <td>{{ number_format($h->done_networks) }} / {{ number_format($h->total_networks) }}</td>
                                <td>{{ optional($h->started_at)->format('Y-m-d H:i') ?? '—' }}</td>
                                <td>{{ optional($h->completed_at)->format('Y-m-d H:i') ?? '—' }}</td>
                                <td>{{ $formatDuration($duration) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <small class="d-block text-muted text-center mt-2">
        <i class="fa fa-sync-alt"></i>
        {{ __('legacy_sync.auto_refresh') }}
    </small>
</div>
