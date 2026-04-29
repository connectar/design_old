@extends('backend.layouts.manger')

@php
    $mjStatusLabels = [
        'pending' => __('customer_migration.job_status_pending'),
        'exporting' => __('customer_migration.job_status_exporting'),
        'importing' => __('customer_migration.job_status_importing'),
        'paused' => __('customer_migration.job_status_paused'),
        'completed' => __('customer_migration.job_status_completed'),
        'failed' => __('customer_migration.job_status_failed'),
        'partial' => __('customer_migration.job_status_partial'),
        'cancelled' => __('customer_migration.job_status_cancelled'),
    ];
    $mjStatusColors = [
        'pending' => '#6b7280',
        'exporting' => '#2563eb',
        'importing' => '#2563eb',
        'paused' => '#f59e0b',
        'completed' => '#16a34a',
        'failed' => '#dc2626',
        'partial' => '#b45309',
        'cancelled' => '#64748b',
    ];
    $mjEntityLabels = [
        'offers' => __('customer_migration.entity_offers'),
        'nas' => __('customer_migration.entity_nas'),
        'users' => __('customer_migration.entity_users'),
        'cards' => __('customer_migration.entity_cards'),
        'invoices' => __('customer_migration.entity_invoices'),
    ];
    $mjEntityIcons = [
        'offers' => 'fa-gift',
        'nas' => 'fa-server',
        'users' => 'fa-users',
        'cards' => 'fa-credit-card',
        'invoices' => 'fa-file-text',
    ];

    $statusKey = (string) $job->status;
    $statusLabel = $mjStatusLabels[$statusKey] ?? $statusKey;
    $statusColor = $mjStatusColors[$statusKey] ?? '#64748b';
    $progressPct = (int) $job->progress_percent;
    $isActive = in_array($statusKey, ['pending', 'exporting', 'importing'], true);
    $isPaused = $statusKey === 'paused';
    $isTerminal = in_array($statusKey, ['completed', 'failed', 'partial', 'cancelled'], true);
    $imported = is_array($job->imported_counts) ? $job->imported_counts : [];
    $legacy = is_array($job->legacy_counts) ? $job->legacy_counts : [];
    $integrity = is_array($job->integrity) ? $job->integrity : [];
    $integrityOk = (bool) ($integrity['ok'] ?? false);
    $integrityHasData = array_key_exists('ok', $integrity);
    $phaseKey = $job->next_import_phase;
    $phaseLabel = $phaseKey ? __('customer_migration.phase_'.$phaseKey) : null;
@endphp

@push('styles')
<style>
    .mj-page .box { border-radius: 12px; }
    .mj-page .box .box-title { font-weight: 700; display: inline-flex; align-items: center; gap: 8px; }
    .mj-page .box .box-title .fa { color: #6366f1; }

    .mj-hero {
        background: linear-gradient(135deg,#1e293b,#312e81);
        color: #fff;
        border-radius: 12px;
        padding: 18px 22px;
        margin-bottom: 16px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 18px;
    }
    .mj-hero .mj-hero-title { flex: 1; min-width: 220px; }
    .mj-hero h3 { margin: 0; color: #fff; font-weight: 800; font-size: 1.3rem; display: flex; align-items: center; gap: 8px; }
    .mj-hero .mj-hero-sub { margin: 4px 0 0; color: rgba(255,255,255,0.65); font-size: 13px; }
    .mj-hero .mj-hero-code {
        font-family: ui-monospace, monospace;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        padding: 2px 10px; border-radius: 6px;
        direction: ltr;
    }
    .mj-hero .mj-status-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 14px; border-radius: 999px;
        color: #fff; font-weight: 700; font-size: 13px;
    }
    .mj-hero .mj-back {
        padding: 8px 14px; border-radius: 8px;
        background: rgba(255,255,255,0.12);
        color: #fff !important; text-decoration: none;
        font-weight: 600; font-size: 13px;
        display: inline-flex; align-items: center; gap: 6px;
    }
    .mj-hero .mj-back:hover { background: rgba(255,255,255,0.2); }

    .mj-progress { height: 14px; border-radius: 8px; background: rgba(255,255,255,0.15); overflow: hidden; margin-top: 12px; }
    .mj-progress > span { display: block; height: 100%; background: linear-gradient(90deg,#10b981,#22d3ee); transition: width .5s; }

    .mj-info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px; }
    .mj-info-cell {
        background: #f9fafb; border: 1px solid #e5e7eb;
        border-radius: 10px; padding: 12px 14px;
    }
    .mj-info-cell .lbl { font-size: 11px; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: .04em; }
    .mj-info-cell .val { font-size: 16px; font-weight: 700; color: #111827; margin-top: 4px; word-break: break-word; }
    .mj-info-cell .val code { font-size: 13px; }

    .mj-entity-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 10px; }
    .mj-entity-card {
        background: #fff; border: 1px solid #e5e7eb; border-radius: 10px;
        padding: 12px; display: flex; align-items: center; gap: 10px;
    }
    .mj-entity-card .ic {
        width: 40px; height: 40px; border-radius: 8px;
        background: #eef2ff; color: #4338ca;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
    }
    .mj-entity-card .lbl { font-size: 12px; color: #6b7280; font-weight: 600; }
    .mj-entity-card .val { font-size: 18px; font-weight: 800; color: #111827; line-height: 1.1; }
    .mj-entity-card .sub { font-size: 11px; color: #9ca3af; }

    .mj-ops { display: flex; flex-wrap: wrap; gap: 8px; }
    .mj-ops .btn { display: inline-flex; align-items: center; gap: 6px; font-weight: 600; }

    .mj-event-list {
        max-height: 440px; overflow-y: auto;
        border: 1px solid #e5e7eb; border-radius: 10px;
        background: #fff;
    }
    .mj-event {
        display: flex; gap: 10px; padding: 10px 14px;
        border-bottom: 1px solid #f1f5f9;
    }
    .mj-event:last-child { border-bottom: none; }
    .mj-event .dot {
        width: 8px; height: 8px; border-radius: 50%;
        margin-top: 7px; flex-shrink: 0; background: #6b7280;
    }
    .mj-event.lvl-info .dot { background: #3b82f6; }
    .mj-event.lvl-warning .dot { background: #f59e0b; }
    .mj-event.lvl-error .dot { background: #ef4444; }
    .mj-event.lvl-success .dot { background: #10b981; }
    .mj-event .msg { flex: 1; min-width: 0; }
    .mj-event .msg .h { font-size: 13px; color: #111827; word-break: break-word; }
    .mj-event .msg .t { font-size: 11px; color: #9ca3af; margin-top: 2px; }
    .mj-event .lvl-tag {
        font-size: 10px; font-weight: 700; padding: 1px 7px;
        border-radius: 4px; text-transform: uppercase;
        background: #e5e7eb; color: #374151; flex-shrink: 0;
        align-self: flex-start;
    }
    .mj-event.lvl-error .lvl-tag { background: #fee2e2; color: #991b1b; }
    .mj-event.lvl-warning .lvl-tag { background: #fef3c7; color: #92400e; }
    .mj-event.lvl-info .lvl-tag { background: #dbeafe; color: #1e40af; }
    .mj-event.lvl-success .lvl-tag { background: #d1fae5; color: #065f46; }

    .mj-report-pre {
        background: #0f172a; color: #e2e8f0;
        padding: 14px; border-radius: 10px;
        max-height: 380px; overflow: auto;
        font-size: 12px; direction: ltr; text-align: left;
    }

    .mj-integrity {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px; border-radius: 10px;
        font-weight: 700; font-size: 13px;
    }
    .mj-integrity.ok { background: #dcfce7; color: #166534; }
    .mj-integrity.partial { background: #fef3c7; color: #92400e; }
    .mj-integrity.pending { background: #f1f5f9; color: #475569; }
</style>
@endpush

@section('content')
<div class="mj-page">
    {{-- Hero --}}
    <div class="mj-hero">
        <div class="mj-hero-title">
            <h3>
                <i class="fa fa-exchange"></i>
                {{ __('customer_migration.page_title') }} #{{ $job->id }}
                <span class="mj-hero-code">{{ $job->billing_code }}</span>
            </h3>
            <p class="mj-hero-sub">
                @if ($network)
                    <i class="fa fa-network-wired"></i> {{ $network->name }}
                @else
                    <i class="fa fa-exclamation-circle"></i>
                    {{ __('customer_migration.no_report') }}
                @endif
            </p>
            <div class="mj-progress">
                <span style="width: {{ max(0, min(100, $progressPct)) }}%;"></span>
            </div>
        </div>
        <div class="d-flex flex-column align-items-end gap-2">
            <span class="mj-status-badge" id="mj-status-badge"
                style="background: {{ $statusColor }};">
                <i class="fa fa-circle"></i>
                <span id="mj-status-label">{{ $statusLabel }}</span>
                <span>· <span id="mj-progress-label">{{ $progressPct }}%</span></span>
            </span>
            <a class="mj-back" href="{{ route('managers.scrape.index') }}">
                <i class="fa fa-arrow-right"></i>
                {{ __('new_trans.back') ?? 'رجوع' }}
            </a>
        </div>
    </div>

    @if ($job->error_message)
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-triangle"></i>
            {{ $job->error_message }}
        </div>
    @endif

    <div class="row g-2">
        {{-- Left column --}}
        <div class="col-lg-7">
            {{-- Network info --}}
            <div class="box">
                <div class="box-header with-border py-2">
                    <h4 class="box-title mb-0">
                        <i class="fa fa-network-wired"></i>
                        {{ __('menu.scrape.network_name') }}
                    </h4>
                </div>
                <div class="box-body">
                    @if ($networkStats)
                        <div class="mj-info-grid">
                            <div class="mj-info-cell">
                                <div class="lbl">{{ __('menu.scrape.network_name') }}</div>
                                <div class="val">{{ $networkStats['name'] ?: '—' }}</div>
                            </div>
                            <div class="mj-info-cell">
                                <div class="lbl">{{ __('customer_migration.billing_code') }}</div>
                                <div class="val"><code>{{ $networkStats['billing_code'] }}</code></div>
                            </div>
                            <div class="mj-info-cell">
                                <div class="lbl">ID</div>
                                <div class="val">#{{ $networkStats['id'] }}</div>
                            </div>
                            <div class="mj-info-cell">
                                <div class="lbl">{{ __('customer_migration.entity_users') }}</div>
                                <div class="val">{{ number_format($networkStats['users']) }}</div>
                            </div>
                            <div class="mj-info-cell">
                                <div class="lbl">{{ __('customer_migration.entity_nas') }}</div>
                                <div class="val">{{ number_format($networkStats['nas']) }}</div>
                            </div>
                            <div class="mj-info-cell">
                                <div class="lbl">{{ __('customer_migration.entity_offers') }}</div>
                                <div class="val">{{ number_format($networkStats['offers']) }}</div>
                            </div>
                        </div>
                        @if (! empty($networkStats['deleted_at']))
                            <div class="alert alert-warning mt-3 mb-0">
                                <i class="fa fa-exclamation-triangle"></i>
                                {{ __('customer_migration.disabled') }} —
                                {{ $networkStats['deleted_at'] }}
                            </div>
                        @endif
                    @else
                        <div class="text-muted">
                            <i class="fa fa-info-circle"></i>
                            {{ __('customer_migration.no_report') }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Imported entities --}}
            <div class="box">
                <div class="box-header with-border py-2">
                    <h4 class="box-title mb-0">
                        <i class="fa fa-database"></i>
                        {{ __('customer_migration.scrape_col_imported') }}
                    </h4>
                </div>
                <div class="box-body">
                    <div class="mj-entity-row">
                        @foreach ($mjEntityLabels as $ek => $elabel)
                            @php
                                $curr = (int) ($imported[$ek] ?? 0);
                                $lg = isset($legacy[$ek]) ? (int) $legacy[$ek] : null;
                            @endphp
                            <div class="mj-entity-card">
                                <div class="ic"><i class="fa {{ $mjEntityIcons[$ek] ?? 'fa-cube' }}"></i></div>
                                <div>
                                    <div class="lbl">{{ $elabel }}</div>
                                    <div class="val">{{ number_format($curr) }}</div>
                                    @if ($lg !== null)
                                        <div class="sub">/ {{ number_format($lg) }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mj-integrity mt-3 {{ ! $integrityHasData ? 'pending' : ($integrityOk ? 'ok' : 'partial') }}">
                        @if (! $integrityHasData)
                            <i class="fa fa-clock-o"></i>
                            {{ __('customer_migration.scrape_integrity_pending') }}
                        @elseif ($integrityOk)
                            <i class="fa fa-check-circle"></i>
                            {{ __('customer_migration.scrape_integrity_ok') }}
                        @else
                            <i class="fa fa-exclamation-triangle"></i>
                            {{ __('customer_migration.scrape_integrity_partial') }}
                        @endif
                    </div>
                </div>
            </div>

            {{-- Report JSON --}}
            @if ($job->report)
                <div class="box">
                    <div class="box-header with-border py-2 d-flex justify-content-between align-items-center">
                        <h4 class="box-title mb-0">
                            <i class="fa fa-file-code-o"></i>
                            {{ __('customer_migration.report') }}
                        </h4>
                        <a href="{{ route('managers.settings.customer-migration.report-json', $job) }}"
                            class="btn btn-sm btn-outline-primary"
                            target="_blank" rel="noopener">
                            <i class="fa fa-download"></i> report.json
                        </a>
                    </div>
                    <div class="box-body">
                        <pre class="mj-report-pre">{{ json_encode($job->report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                </div>
            @endif
        </div>

        {{-- Right column --}}
        <div class="col-lg-5">
            {{-- Operations --}}
            <div class="box">
                <div class="box-header with-border py-2">
                    <h4 class="box-title mb-0">
                        <i class="fa fa-cogs"></i>
                        {{ __('menu.scrape.process') }}
                    </h4>
                </div>
                <div class="box-body">
                    <div class="mj-info-grid mb-3">
                        <div class="mj-info-cell">
                            <div class="lbl">{{ __('customer_migration.status') }}</div>
                            <div class="val">
                                <span id="mj-status-label-inline">{{ $statusLabel }}</span>
                            </div>
                        </div>
                        <div class="mj-info-cell">
                            <div class="lbl">{{ __('customer_migration.progress') }}</div>
                            <div class="val"><span id="mj-progress-label-inline">{{ $progressPct }}</span>%</div>
                        </div>
                        @if ($phaseLabel)
                            <div class="mj-info-cell">
                                <div class="lbl">{{ __('customer_migration.phase') ?? 'Phase' }}</div>
                                <div class="val">{{ $phaseLabel }}</div>
                            </div>
                        @endif
                        @if ($job->started_at)
                            <div class="mj-info-cell">
                                <div class="lbl">{{ __('customer_migration.scrape_col_finished') }}</div>
                                <div class="val">{{ $job->started_at->format('Y-m-d H:i') }}</div>
                            </div>
                        @endif
                        @if ($job->finished_at)
                            <div class="mj-info-cell">
                                <div class="lbl">{{ __('customer_migration.scrape_col_finished') }}</div>
                                <div class="val">{{ $job->finished_at->format('Y-m-d H:i') }}</div>
                            </div>
                        @endif
                        @if ($job->triggeredBy)
                            <div class="mj-info-cell">
                                <div class="lbl">
                                    {{ __('menu.scrape.user') }}
                                </div>
                                <div class="val">
                                    {{ $job->triggeredBy->fullname ?? $job->triggeredBy->name ?? '#'.$job->triggered_by_admin_id }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mj-ops">
                        @if ($isActive)
                            <button type="button" class="btn btn-warning"
                                data-mj-action="pause"
                                data-url="{{ route('managers.settings.customer-migration.job.pause', $job) }}">
                                <i class="fa fa-pause"></i>
                                {{ __('customer_migration.pause') ?? 'إيقاف مؤقت' }}
                            </button>
                        @endif
                        @if ($isPaused)
                            <button type="button" class="btn btn-success"
                                data-mj-action="resume"
                                data-url="{{ route('managers.settings.customer-migration.job.resume', $job) }}">
                                <i class="fa fa-play"></i>
                                {{ __('customer_migration.resume') ?? 'استئناف' }}
                            </button>
                        @endif
                        @if (! $isTerminal)
                            <button type="button" class="btn btn-danger"
                                data-mj-action="cancel"
                                data-url="{{ route('managers.settings.customer-migration.job.cancel', $job) }}">
                                <i class="fa fa-stop"></i>
                                {{ __('customer_migration.cancel') ?? 'إلغاء' }}
                            </button>
                        @endif
                        @if ($job->report)
                            <a href="{{ route('managers.settings.customer-migration.report-json', $job) }}"
                                target="_blank" rel="noopener"
                                class="btn btn-outline-secondary">
                                <i class="fa fa-download"></i> report.json
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Events timeline --}}
            <div class="box">
                <div class="box-header with-border py-2">
                    <h4 class="box-title mb-0">
                        <i class="fa fa-list-alt"></i>
                        {{ __('customer_migration.events') }}
                    </h4>
                </div>
                <div class="box-body p-0">
                    @if ($job->events->count())
                        <div class="mj-event-list">
                            @foreach ($job->events as $ev)
                                <div class="mj-event lvl-{{ strtolower((string) $ev->level) }}">
                                    <div class="dot"></div>
                                    <span class="lvl-tag">{{ $ev->level }}</span>
                                    <div class="msg">
                                        <div class="h">{{ $ev->message }}</div>
                                        <div class="t">{{ $ev->created_at }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-muted p-3">
                            <i class="fa fa-info-circle"></i>
                            —
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    (function () {
        const csrf = '{{ csrf_token() }}';

        function postAction(url, btn) {
            btn.disabled = true;
            const origHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
            fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                }
            })
            .then(r => r.json().then(d => ({ ok: r.ok, data: d })))
            .then(({ ok, data }) => {
                if (!ok) {
                    alert(data.message || 'Error');
                    btn.disabled = false;
                    btn.innerHTML = origHtml;
                } else {
                    setTimeout(() => location.reload(), 400);
                }
            })
            .catch(() => {
                alert('Network error');
                btn.disabled = false;
                btn.innerHTML = origHtml;
            });
        }

        document.querySelectorAll('[data-mj-action]').forEach(btn => {
            btn.addEventListener('click', function () {
                const action = this.dataset.mjAction;
                const url = this.dataset.url;
                if (action === 'cancel' && !confirm('{{ __('customer_migration.confirm_cancel') ?? 'تأكيد الإلغاء؟' }}')) {
                    return;
                }
                postAction(url, this);
            });
        });
    })();
</script>

@if (! in_array($job->status, ['completed', 'failed', 'partial', 'cancelled'], true))
<script>
    (function () {
        const url = @json(route('managers.settings.customer-migration.status', $job));
        const badge = document.getElementById('mj-status-badge');
        const statusLbl = document.getElementById('mj-status-label');
        const statusLblInline = document.getElementById('mj-status-label-inline');
        const progressLbl = document.getElementById('mj-progress-label');
        const progressLblInline = document.getElementById('mj-progress-label-inline');
        const bar = document.querySelector('.mj-progress > span');

        function poll() {
            fetch(url, { headers: { 'Accept': 'application/json' } })
                .then(r => r.json())
                .then(d => {
                    if (statusLbl) statusLbl.textContent = d.status_label || d.status;
                    if (statusLblInline) statusLblInline.textContent = d.status_label || d.status;
                    if (progressLbl) progressLbl.textContent = d.progress_percent + '%';
                    if (progressLblInline) progressLblInline.textContent = d.progress_percent;
                    if (bar) bar.style.width = Math.max(0, Math.min(100, parseInt(d.progress_percent, 10))) + '%';
                    if (!['completed', 'failed', 'partial', 'cancelled'].includes(d.status)) {
                        setTimeout(poll, 2500);
                    } else {
                        setTimeout(() => location.reload(), 800);
                    }
                })
                .catch(() => setTimeout(poll, 4000));
        }
        setTimeout(poll, 1500);
    })();
</script>
@endif
@endpush
@endsection
