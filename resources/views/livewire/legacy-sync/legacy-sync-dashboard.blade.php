<div wire:poll.5s class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">
            <i class="fas fa-database text-primary"></i>
            {{ __('legacy_sync.title') }}
        </h3>
        <small class="text-muted">{{ __('legacy_sync.subtitle') }}</small>
    </div>

    @if ($flash)
        <div class="alert alert-{{ $flashType === 'success' ? 'success' : ($flashType === 'error' ? 'danger' : 'info') }} alert-dismissible">
            <button type="button" class="close" wire:click="$set('flash', null)" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ $flash }}
        </div>
    @endif

    @if (session('migration_deprecated'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <i class="fas fa-info-circle"></i>
            {{ __('legacy_sync.deprecated_redirect') }}
        </div>
    @endif

    {{-- ─── Connection / source domain card ─── --}}
    <div class="card shadow-sm mb-3 border-{{ $connection && $connection['ok'] ? 'success' : 'danger' }}">
        <div class="card-header bg-light d-flex align-items-center">
            <i class="fas fa-server ml-2"></i>
            <strong>{{ __('legacy_sync.connection.title') }}</strong>
            @if ($connection)
                @if ($connection['ok'])
                    <span class="badge badge-success ml-2">
                        <i class="fas fa-check"></i> {{ __('legacy_sync.connection.connected') }}
                    </span>
                @else
                    <span class="badge badge-danger ml-2">
                        <i class="fas fa-times"></i> {{ __('legacy_sync.connection.disconnected') }}
                    </span>
                @endif
            @endif
        </div>
        <div class="card-body">
            <div class="form-row align-items-end">
                <div class="form-group col-md-6">
                    <label for="legacyDomain" class="mb-1">
                        <strong>{{ __('legacy_sync.connection.domain_label') }}</strong>
                        <small class="text-muted">({{ __('legacy_sync.connection.domain_hint') }})</small>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                        </div>
                        <input type="text"
                               id="legacyDomain"
                               class="form-control"
                               placeholder="connect4ar.com"
                               wire:model.defer="legacyDomain"
                               wire:keydown.enter="saveLegacyDomain">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-primary btn-block"
                            wire:click="saveLegacyDomain"
                            wire:loading.attr="disabled"
                            wire:target="saveLegacyDomain">
                        <i class="fas fa-save"></i> {{ __('legacy_sync.connection.save_btn') }}
                    </button>
                </div>
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-outline-secondary btn-block"
                            wire:click="testConnection"
                            wire:loading.attr="disabled"
                            wire:target="testConnection">
                        <i class="fas fa-sync-alt" wire:loading.class="fa-spin" wire:target="testConnection"></i>
                        {{ __('legacy_sync.connection.test_btn') }}
                    </button>
                </div>
            </div>

            @if ($connection)
                <div class="small text-muted">
                    @if ($connection['ok'])
                        <i class="fas fa-check-circle text-success"></i>
                        {{ $connection['host'] }} · <code>{{ $connection['database'] }}</code>
                        @if (!is_null($connection['networks_count']))
                            · {{ __('legacy_sync.connection.networks_found', ['count' => number_format($connection['networks_count'])]) }}
                        @endif
                    @else
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                        <span class="text-danger">{{ $connection['message'] }}</span>
                    @endif
                </div>
            @endif
        </div>

        @if ($connection && ! $connection['ok'])
            <div class="card-footer bg-light py-2">
                <small class="text-muted d-block mb-1">
                    <strong>{{ __('legacy_sync.connection.fix_hint') }}</strong>
                    <code>.env</code> {{ __('legacy_sync.connection.then_clear') }}:
                </small>
                <pre class="bg-white border rounded p-2 mb-0" style="font-size: 12px;"><code>DB_MIGRATE_SOURCE_PORT=3306
DB_MIGRATE_SOURCE_DATABASE=connect_pro
DB_MIGRATE_SOURCE_USERNAME=your_user
DB_MIGRATE_SOURCE_PASSWORD=your_password</code></pre>
                <small class="text-muted d-block mt-1">
                    {{ __('legacy_sync.connection.host_note') }}
                </small>
            </div>
        @endif
    </div>


    {{-- ─── Diagnostics / errors panel ─── --}}
    @if ($diagnostics)
        @php
            $diagErrors = count($diagnostics['failed_jobs']) + count($diagnostics['network_errors']);
            $workerOk = $diagnostics['worker']['likely_running'];
            $diagBorder = $diagErrors > 0 ? 'danger' : ($workerOk ? 'info' : 'warning');
        @endphp
        <div class="card shadow-sm mb-3 border-{{ $diagBorder }}">
            <div class="card-header bg-light d-flex align-items-center">
                <i class="fas fa-stethoscope ml-2 text-{{ $diagBorder }}"></i>
                <strong>{{ __('legacy_sync.diagnostics.title') }}</strong>
                @if ($diagErrors > 0)
                    <span class="badge badge-danger ml-2">
                        {{ $diagErrors }} {{ __('legacy_sync.diagnostics.errors_found') }}
                    </span>
                @else
                    <span class="badge badge-success ml-2">
                        <i class="fas fa-check"></i> {{ __('legacy_sync.diagnostics.no_errors') }}
                    </span>
                @endif
                <button type="button" class="btn btn-sm btn-outline-secondary ml-auto"
                        wire:click="toggleDiagnostics">
                    <i class="fas fa-{{ $showDiagnostics ? 'eye-slash' : 'eye' }}"></i>
                    {{ $showDiagnostics ? __('legacy_sync.diagnostics.hide') : __('legacy_sync.diagnostics.show') }}
                </button>
            </div>

            @if ($showDiagnostics)
                <div class="card-body">

                    {{-- Queue + worker status --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <small class="text-muted d-block">{{ __('legacy_sync.diagnostics.queue_pending') }}</small>
                            <strong class="h4">{{ number_format($diagnostics['queue']['pending']) }}</strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">{{ __('legacy_sync.diagnostics.queue_reserved') }}</small>
                            <strong class="h4">{{ number_format($diagnostics['queue']['reserved']) }}</strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">{{ __('legacy_sync.diagnostics.oldest_age') }}</small>
                            <strong class="h5">
                                {{ $diagnostics['queue']['oldest_age_seconds'] !== null
                                    ? $diagnostics['queue']['oldest_age_seconds'] . 's'
                                    : '—' }}
                            </strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">{{ __('legacy_sync.diagnostics.worker') }}</small>
                            @if ($workerOk)
                                <span class="badge badge-success">
                                    <i class="fas fa-check"></i> {{ __('legacy_sync.diagnostics.worker_ok') }}
                                </span>
                            @else
                                <span class="badge badge-warning">
                                    <i class="fas fa-exclamation-triangle"></i> {{ __('legacy_sync.diagnostics.worker_stuck') }}
                                </span>
                            @endif
                            <small class="d-block text-muted mt-1">
                                <code>{{ $diagnostics['queue']['connection'] }}</code> /
                                <code>{{ $diagnostics['queue']['queue'] }}</code>
                            </small>
                        </div>
                    </div>
                    @if (! $workerOk && $diagnostics['worker']['hint'])
                        <div class="alert alert-warning py-2">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $diagnostics['worker']['hint'] }}
                        </div>
                    @endif

                    {{-- Failed jobs table --}}
                    @if (count($diagnostics['failed_jobs']) > 0)
                        <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                            <h6 class="text-danger mb-0">
                                <i class="fas fa-bomb"></i>
                                {{ __('legacy_sync.diagnostics.failed_jobs_title') }}
                                ({{ count($diagnostics['failed_jobs']) }})
                            </h6>
                            <button type="button" class="btn btn-sm btn-outline-danger"
                                    wire:click="clearFailedJobs"
                                    onclick="return confirm('{{ __('legacy_sync.diagnostics.confirm_clear_failed') }}')">
                                <i class="fas fa-trash"></i> {{ __('legacy_sync.diagnostics.clear_failed_btn') }}
                            </button>
                        </div>
                        @foreach ($diagnostics['failed_jobs'] as $fj)
                            <details class="mb-2" open>
                                <summary class="bg-light border rounded p-2" style="cursor:pointer;">
                                    <strong>#{{ $fj['id'] }}</strong>
                                    <span class="text-muted">· {{ $fj['failed_at'] }}</span>
                                    <span class="text-danger ml-2">
                                        {{ \Illuminate\Support\Str::limit(strtok($fj['exception'], "\n"), 160) }}
                                    </span>
                                </summary>
                                <div class="position-relative mt-1">
                                    <button type="button" class="btn btn-sm btn-outline-light copy-btn"
                                            onclick="copyLegacyError(this)"
                                            style="position:absolute; top:4px; left:4px; z-index:5;">
                                        <i class="fas fa-copy"></i> {{ __('legacy_sync.diagnostics.copy_btn') }}
                                    </button>
                                    <pre class="legacy-error bg-dark text-white rounded p-2 mb-0 small" style="max-height:280px;overflow:auto;">{{ $fj['exception'] }}</pre>
                                </div>
                            </details>
                        @endforeach
                    @endif

                    {{-- Per-network errors (across all runs) --}}
                    @if (count($diagnostics['network_errors']) > 0)
                        <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                            <h6 class="text-danger mb-0">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ __('legacy_sync.diagnostics.network_errors_title') }}
                                ({{ count($diagnostics['network_errors']) }})
                            </h6>
                            <button type="button" class="btn btn-sm btn-outline-danger"
                                    wire:click="clearNetworkErrors"
                                    onclick="return confirm('{{ __('legacy_sync.diagnostics.confirm_clear_network_errors') }}')">
                                <i class="fas fa-trash"></i>
                                {{ __('legacy_sync.diagnostics.clear_network_errors_btn') }}
                            </button>
                        </div>
                        @foreach ($diagnostics['network_errors'] as $ne)
                            @php $isLatest = $loop->first; @endphp
                            <details class="mb-2" @if ($isLatest) open @endif>
                                <summary class="bg-light border rounded p-2" style="cursor:pointer;">
                                    <strong>{{ __('legacy_sync.cols.network') }}:</strong>
                                    {{ $ne['network_name'] ?: '—' }}
                                    (<code>{{ $ne['billing_code'] ?: '—' }}</code>)
                                    · {{ __('legacy_sync.cols.legacy_id') }}: {{ $ne['network_id'] }}
                                    · {{ __('legacy_sync.stats.run') }}: #{{ $ne['run_id'] }}
                                    @if ($ne['current_table'])
                                        · {{ __('legacy_sync.cols.current_table') }}: <code>{{ $ne['current_table'] }}</code>
                                    @endif
                                    @if ($ne['failed_at'])
                                        <span class="text-muted ml-2">{{ $ne['failed_at'] }}</span>
                                    @endif
                                </summary>
                                @if (trim($ne['error']) === '')
                                    <div class="alert alert-warning small mt-1 mb-0 py-2">
                                        <i class="fas fa-info-circle"></i>
                                        {{ __('legacy_sync.diagnostics.error_empty_hint') }}
                                    </div>
                                @else
                                    <div class="position-relative mt-1">
                                        <button type="button" class="btn btn-sm btn-outline-light copy-btn"
                                                onclick="copyLegacyError(this)"
                                                style="position:absolute; top:4px; left:4px; z-index:5;">
                                            <i class="fas fa-copy"></i> {{ __('legacy_sync.diagnostics.copy_btn') }}
                                        </button>
                                        <pre class="legacy-error bg-dark text-white rounded p-2 mb-0 small" style="max-height:320px;overflow:auto;">{{ $ne['error'] }}</pre>
                                    </div>
                                @endif
                            </details>
                        @endforeach
                    @endif

                    {{-- Log tail --}}
                    <h6 class="text-muted mt-3 mb-2">
                        <i class="fas fa-file-alt"></i>
                        {{ __('legacy_sync.diagnostics.log_tail_title') }}
                        <small><code>{{ $diagnostics['log_tail']['path'] }}</code></small>
                    </h6>
                    @if (! $diagnostics['log_tail']['exists'])
                        <div class="alert alert-secondary py-2 mb-0 small">
                            {{ __('legacy_sync.diagnostics.log_missing') }}
                        </div>
                    @elseif (count($diagnostics['log_tail']['lines']) === 0)
                        <div class="alert alert-secondary py-2 mb-0 small">
                            {{ __('legacy_sync.diagnostics.log_empty') }}
                        </div>
                    @else
                        <pre class="bg-dark text-white rounded p-2 small" style="max-height:300px;overflow:auto;">@foreach ($diagnostics['log_tail']['lines'] as $ln){{ $ln }}
@endforeach</pre>
                    @endif
                </div>
            @endif
        </div>
    @endif

    {{-- ────────────────────────────────────────────────────────── --}}
    {{-- PART 1 — Single network test                              --}}
    {{-- ────────────────────────────────────────────────────────── --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light d-flex align-items-center">
            <i class="fas fa-search text-info ml-2"></i>
            <strong>{{ __('legacy_sync.single.title') }}</strong>
            <span class="badge badge-info badge-pill ml-2">1</span>
        </div>
        <div class="card-body">
            <div class="form-row align-items-end">
                <div class="form-group col-md-5">
                    <label for="billingCode">{{ __('legacy_sync.single.billing_code_label') }}</label>
                    <input type="text"
                           id="billingCode"
                           class="form-control"
                           placeholder="{{ __('legacy_sync.single.billing_code_placeholder') }}"
                           wire:model.defer="billingCode"
                           wire:keydown.enter="fetchPreview">
                </div>
                <div class="form-group col-md-3">
                    <button type="button" class="btn btn-info btn-block"
                            wire:click="fetchPreview"
                            wire:loading.attr="disabled"
                            wire:target="fetchPreview"
                            @disabled($connection && ! $connection['ok'])>
                        <span wire:loading.remove wire:target="fetchPreview">
                            <i class="fas fa-eye"></i> {{ __('legacy_sync.single.preview_btn') }}
                        </span>
                        <span wire:loading wire:target="fetchPreview">
                            <i class="fas fa-spinner fa-spin"></i> {{ __('legacy_sync.loading') }}
                        </span>
                    </button>
                </div>
            </div>

            @if ($previewError)
                <div class="alert alert-warning mt-2 mb-0">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ $previewError }}
                </div>
            @endif

            @if ($preview)
                <div class="border rounded p-3 mt-3 bg-light">
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-muted d-block">{{ __('legacy_sync.preview.network_name') }}</small>
                            <strong class="h5">{{ $preview['network_name'] ?: '—' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">{{ __('legacy_sync.preview.manager_name') }}</small>
                            <strong class="h5">{{ $preview['manager_name'] ?: '—' }}</strong>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">{{ __('legacy_sync.preview.users_count') }}</small>
                            <strong class="h5 text-primary">{{ number_format($preview['users_count']) }}</strong>
                        </div>
                    </div>

                    {{-- Delta-sync watermark info: tells the operator
                         whether the next run will be a fast incremental
                         pass or a full re-scan. --}}
                    @if (! empty($networkMarks) && ($networkMarks['tables_tracked'] ?? 0) > 0)
                        <div class="alert alert-info mt-3 mb-0 py-2">
                            <div class="d-flex flex-wrap align-items-center" style="gap:1rem;">
                                <span>
                                    <i class="fas fa-bolt text-warning"></i>
                                    <strong>{{ __('legacy_sync.delta.next_run_label') }}</strong>
                                    <span class="badge badge-warning">{{ __('legacy_sync.delta.mode_delta') }}</span>
                                </span>
                                <span class="text-muted small">
                                    {{ __('legacy_sync.delta.last_synced_at') }}:
                                    <strong>{{ $networkMarks['last_synced_at'] ?? '—' }}</strong>
                                </span>
                                <span class="text-muted small">
                                    {{ __('legacy_sync.delta.tables_tracked') }}:
                                    <strong>{{ $networkMarks['tables_tracked'] }}</strong>
                                </span>
                                <span class="text-muted small">
                                    {{ __('legacy_sync.delta.rows_in_last_run') }}:
                                    <strong>{{ number_format($networkMarks['rows_in_last_run'] ?? 0) }}</strong>
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-secondary mt-3 mb-0 py-2 small">
                            <i class="fas fa-info-circle"></i>
                            <strong>{{ __('legacy_sync.delta.next_run_label') }}</strong>
                            <span class="badge badge-secondary">{{ __('legacy_sync.delta.mode_full') }}</span>
                            — {{ __('legacy_sync.delta.first_run_hint') }}
                        </div>
                    @endif

                    <div class="row align-items-end mt-3">
                        <div class="form-group col-md-4 mb-md-0">
                            <label class="mb-1 small">
                                <i class="fas fa-tachometer-alt text-info"></i>
                                {{ __('legacy_sync.speed.label') }}
                            </label>
                            <select class="form-control form-control-sm" wire:model.live="speedPreset">
                                <option value="instant">{{ __('legacy_sync.speed.instant') }}</option>
                                <option value="turbo">{{ __('legacy_sync.speed.turbo') }}</option>
                                <option value="fast">{{ __('legacy_sync.speed.fast') }}</option>
                                <option value="normal">{{ __('legacy_sync.speed.normal') }}</option>
                                <option value="slow">{{ __('legacy_sync.speed.slow') }}</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="custom-control custom-checkbox m-0">
                                <input type="checkbox" class="custom-control-input"
                                       id="forceFullSyncCheck"
                                       wire:model.live="forceFullSync">
                                <label class="custom-control-label" for="forceFullSyncCheck">
                                    <i class="fas fa-redo-alt text-muted"></i>
                                    {{ __('legacy_sync.delta.force_full_label') }}
                                    <span class="text-muted small d-block">{{ __('legacy_sync.delta.force_full_hint') }}</span>
                                </label>
                            </label>
                        </div>
                        <div class="col-md-3 text-md-right mt-2 mt-md-0">
                            <button type="button" class="btn btn-success btn-block"
                                    wire:click="startSingle"
                                    wire:loading.attr="disabled"
                                    wire:target="startSingle">
                                <span wire:loading.remove wire:target="startSingle">
                                    <i class="fas fa-play"></i>
                                    {{ $forceFullSync
                                        ? __('legacy_sync.single.start_btn_full')
                                        : __('legacy_sync.single.start_btn') }}
                                </span>
                                <span wire:loading wire:target="startSingle">
                                    <i class="fas fa-spinner fa-spin"></i> {{ __('legacy_sync.loading') }}
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            @if ($singleRun)
                @php
                    $tracker = $singleRun->networks->first();
                    $sStatus = $tracker?->status ?? 'queued';
                    $sBadge = match ($sStatus) {
                        'completed' => 'success',
                        'failed' => 'danger',
                        'running' => 'primary',
                        default => 'secondary',
                    };

                    // Build a "tables done / total expected tables" progress
                    // bar for the single-run tracker. Total = networks (1)
                    // + admins (1) + NETWORK_SCOPED + ADMIN_CHILD_SCOPED
                    // + users (1) + USER_SCOPED.
                    $totalTables = 1
                        + 1
                        + count(\App\Services\LegacySync\NetworkSchema::NETWORK_SCOPED)
                        + count(\App\Services\LegacySync\NetworkSchema::ADMIN_CHILD_SCOPED)
                        + 1
                        + count(\App\Services\LegacySync\NetworkSchema::USER_SCOPED);
                    $doneTables = is_array($tracker?->table_counts) ? count($tracker->table_counts) : 0;
                    $sPercent = $sStatus === 'completed'
                        ? 100
                        : ($totalTables > 0 ? min(100, (int) round($doneTables * 100 / $totalTables)) : 0);
                @endphp
                <div class="border rounded p-3 mt-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>{{ __('legacy_sync.single.run_label', ['id' => $singleRun->id]) }}</strong>
                        <span class="badge badge-{{ $sBadge }}">
                            {{ __('legacy_sync.status.' . $sStatus) }}
                        </span>
                    </div>

                    {{-- Single-run progress bar --}}
                    <div class="progress mt-2" style="height: 18px;">
                        <div class="progress-bar progress-bar-striped {{ $sStatus === 'running' ? 'progress-bar-animated' : '' }} bg-{{ $sBadge }}"
                             role="progressbar"
                             style="width: {{ $sPercent }}%"
                             aria-valuenow="{{ $sPercent }}"
                             aria-valuemin="0"
                             aria-valuemax="100">
                            {{ $sPercent }}% &middot; {{ $doneTables }}/{{ $totalTables }}
                        </div>
                    </div>

                    @if ($tracker)
                        @php
                            $phaseKey = $tracker->current_table
                                ? \App\Services\LegacySync\NetworkSchema::phaseKeyFor($tracker->current_table)
                                : null;
                        @endphp
                        <small class="text-muted d-block mt-2">
                            @if ($phaseKey)
                                <span class="badge badge-info ml-1">
                                    {{ __('legacy_sync.phases.' . $phaseKey) }}
                                </span>
                            @endif
                            {{ __('legacy_sync.single.current_table') }}:
                            <code>{{ $tracker->current_table ?: '—' }}</code>
                            &middot;
                            {{ __('legacy_sync.single.rows_copied') }}:
                            <strong>{{ number_format($tracker->rows_copied_total) }}</strong>
                        </small>
                        @if ($tracker->error_message)
                            <div class="alert alert-danger mt-2 mb-0 py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong><i class="fas fa-bug"></i> {{ __('legacy_sync.diagnostics.tracker_error') }}</strong>
                                    <button type="button" class="btn btn-sm btn-outline-light"
                                            onclick="copyLegacyError(this)">
                                        <i class="fas fa-copy"></i> {{ __('legacy_sync.diagnostics.copy_btn') }}
                                    </button>
                                </div>
                                <pre class="legacy-error bg-dark text-white rounded p-2 mt-1 mb-0 small" style="max-height:240px;overflow:auto;">{{ $tracker->error_message }}</pre>
                            </div>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>

    {{-- ────────────────────────────────────────────────────────── --}}
    {{-- PART 2 — Full sync controls                               --}}
    {{-- ────────────────────────────────────────────────────────── --}}
    <div class="card shadow-sm">
        <div class="card-header bg-light d-flex align-items-center">
            <i class="fas fa-sync-alt text-success ml-2"></i>
            <strong>{{ __('legacy_sync.all.title') }}</strong>
            <span class="badge badge-success badge-pill ml-2">2</span>
        </div>
        <div class="card-body">

            {{-- ── Speed + force-full controls (apply to startAll AND resume) ── --}}
            <div class="border rounded p-3 mb-3 bg-light">
                <div class="form-row align-items-end">
                    <div class="form-group col-md-6 mb-md-0">
                        <label class="mb-1">
                            <i class="fas fa-tachometer-alt text-info"></i>
                            <strong>{{ __('legacy_sync.speed.label') }}</strong>
                        </label>
                        <select class="form-control form-control-lg font-weight-bold" wire:model.live="speedPreset">
                            <option value="instant">⚡ {{ __('legacy_sync.speed.instant') }}</option>
                            <option value="turbo">🚀 {{ __('legacy_sync.speed.turbo') }}</option>
                            <option value="fast">{{ __('legacy_sync.speed.fast') }}</option>
                            <option value="normal">{{ __('legacy_sync.speed.normal') }}</option>
                            <option value="slow">🐢 {{ __('legacy_sync.speed.slow') }}</option>
                        </select>
                        <small class="text-muted d-block mt-1">{{ __('legacy_sync.speed.hint') }}</small>
                    </div>
                    <div class="form-group col-md-6 mb-0">
                        <label class="custom-control custom-checkbox m-0 d-block">
                            <input type="checkbox" class="custom-control-input"
                                   id="forceFullSyncAllCheck"
                                   wire:model.live="forceFullSyncAll">
                            <label class="custom-control-label" for="forceFullSyncAllCheck">
                                <i class="fas fa-redo-alt text-warning"></i>
                                <strong>{{ __('legacy_sync.all.force_full_label') }}</strong>
                                <span class="text-muted small d-block">{{ __('legacy_sync.all.force_full_hint') }}</span>
                            </label>
                        </label>
                    </div>
                </div>
            </div>

            @if (! $allRun)
                <div class="text-center py-4">
                    <p class="text-muted">{{ __('legacy_sync.all.no_active_run') }}</p>
                    <button type="button" class="btn btn-success btn-lg"
                            wire:click="startAll"
                            wire:loading.attr="disabled"
                            wire:target="startAll"
                            @disabled($connection && ! $connection['ok'])
                            onclick="return confirm('{{ __('legacy_sync.all.confirm_start') }}')">
                        <i class="fas fa-rocket"></i>
                        {{ $forceFullSyncAll
                            ? __('legacy_sync.all.start_btn_full')
                            : __('legacy_sync.all.start_btn') }}
                    </button>
                </div>
            @else
                @php
                    $rStatus = $allRun->status;
                    $rBadge = match ($rStatus) {
                        'completed' => 'success',
                        'failed' => 'danger',
                        'paused' => 'warning',
                        'running' => 'primary',
                        default => 'secondary',
                    };
                @endphp

                <div class="row mb-3">
                    <div class="col-md-3 text-center">
                        <small class="text-muted d-block">{{ __('legacy_sync.stats.run') }}</small>
                        <strong class="h4">#{{ $allRun->id }}</strong>
                        <span class="badge badge-{{ $rBadge }} d-block">
                            {{ __('legacy_sync.status.' . $rStatus) }}
                        </span>
                    </div>
                    <div class="col-md-3 text-center">
                        <small class="text-muted d-block">{{ __('legacy_sync.stats.networks') }}</small>
                        <strong class="h4">{{ number_format($stats['done']) }} / {{ number_format($stats['total']) }}</strong>
                        @if ($stats['failed'] > 0)
                            <small class="text-danger d-block">
                                {{ __('legacy_sync.stats.failed') }}: {{ $stats['failed'] }}
                            </small>
                        @endif
                    </div>
                    <div class="col-md-3 text-center">
                        <small class="text-muted d-block">{{ __('legacy_sync.stats.in_progress') }}</small>
                        <strong class="h4 text-primary">{{ $stats['running'] }}</strong>
                        <small class="text-muted d-block">{{ __('legacy_sync.stats.queued') }}: {{ $stats['queued'] }}</small>
                    </div>
                    <div class="col-md-3 text-center">
                        <small class="text-muted d-block">{{ __('legacy_sync.stats.rows_copied') }}</small>
                        <strong class="h4 text-info">{{ number_format($stats['rows_copied']) }}</strong>
                    </div>
                </div>

                <div class="progress mb-3" style="height: 22px;">
                    <div class="progress-bar progress-bar-striped {{ $rStatus === 'running' ? 'progress-bar-animated' : '' }} bg-{{ $rBadge }}"
                         role="progressbar"
                         style="width: {{ $stats['percent'] }}%"
                         aria-valuenow="{{ $stats['percent'] }}"
                         aria-valuemin="0"
                         aria-valuemax="100">
                        {{ $stats['percent'] }}%
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap" style="gap:.5rem;">
                    <div class="d-flex align-items-center" style="gap:.5rem;">
                        @if (in_array($rStatus, ['running', 'pending']))
                            <button type="button" class="btn btn-warning"
                                    wire:click="pauseRun"
                                    wire:loading.attr="disabled"
                                    wire:target="pauseRun">
                                <i class="fas fa-pause"></i> {{ __('legacy_sync.all.pause_btn') }}
                            </button>
                        @elseif ($rStatus === 'paused')
                            <button type="button" class="btn btn-success"
                                    wire:click="resumeRun"
                                    wire:loading.attr="disabled"
                                    wire:target="resumeRun">
                                <i class="fas fa-play"></i> {{ __('legacy_sync.all.resume_btn') }}
                            </button>
                        @endif

                        @if (in_array($rStatus, ['running', 'pending', 'paused']))
                            <button type="button" class="btn btn-outline-danger"
                                    wire:click="cancelActiveRuns"
                                    wire:loading.attr="disabled"
                                    wire:target="cancelActiveRuns"
                                    onclick="return confirm('{{ __('legacy_sync.all.confirm_cancel') }}')">
                                <i class="fas fa-stop-circle"></i> {{ __('legacy_sync.all.cancel_btn') }}
                            </button>
                        @endif
                    </div>
                    <small class="text-muted">{{ __('legacy_sync.auto_refresh') }}</small>
                </div>

                @if ($allRun->last_error)
                    <div class="alert alert-danger mb-3 py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong><i class="fas fa-bug"></i> {{ __('legacy_sync.diagnostics.run_last_error') }}</strong>
                            <button type="button" class="btn btn-sm btn-outline-light"
                                    onclick="copyLegacyError(this)">
                                <i class="fas fa-copy"></i> {{ __('legacy_sync.diagnostics.copy_btn') }}
                            </button>
                        </div>
                        <pre class="legacy-error bg-dark text-white rounded p-2 mt-1 mb-0 small" style="max-height:200px;overflow:auto;">{{ $allRun->last_error }}</pre>
                    </div>
                @endif

                <h6 class="text-muted mb-2">{{ __('legacy_sync.all.recent_activity') }}</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>{{ __('legacy_sync.cols.legacy_id') }}</th>
                                <th>{{ __('legacy_sync.cols.billing_code') }}</th>
                                <th>{{ __('legacy_sync.cols.network') }}</th>
                                <th>{{ __('legacy_sync.cols.users_legacy') }}</th>
                                <th>{{ __('legacy_sync.cols.current_table') }}</th>
                                <th>{{ __('legacy_sync.cols.rows_copied') }}</th>
                                <th>{{ __('legacy_sync.cols.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allRunNetworks as $row)
                                @php
                                    $rowBadge = match ($row->status) {
                                        'completed' => 'success',
                                        'failed' => 'danger',
                                        'running' => 'primary',
                                        'queued' => 'secondary',
                                        default => 'light',
                                    };
                                @endphp
                                @php
                                    $rowPhaseKey = $row->current_table
                                        ? \App\Services\LegacySync\NetworkSchema::phaseKeyFor($row->current_table)
                                        : null;
                                @endphp
                                <tr class="{{ $row->error_message ? 'table-danger' : '' }}">
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->legacy_network_id }}</td>
                                    <td>{{ $row->billing_code ?: '—' }}</td>
                                    <td>{{ $row->network_name ?: '—' }}</td>
                                    <td>{{ number_format($row->users_count_legacy) }}</td>
                                    <td>
                                        <code>{{ $row->current_table ?: '—' }}</code>
                                        @if ($rowPhaseKey)
                                            <span class="badge badge-light ml-1">
                                                {{ __('legacy_sync.phases.' . $rowPhaseKey) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($row->rows_copied_total) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $rowBadge }}">
                                            {{ __('legacy_sync.status.' . $row->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @if ($row->error_message)
                                    <tr>
                                        <td colspan="8" class="bg-light">
                                            <details>
                                                <summary class="text-danger" style="cursor:pointer;">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ __('legacy_sync.diagnostics.show_error') }}
                                                </summary>
                                                <div class="position-relative mt-1">
                                                    <button type="button" class="btn btn-sm btn-outline-light copy-btn"
                                                            onclick="copyLegacyError(this)"
                                                            style="position:absolute; top:4px; left:4px; z-index:5;">
                                                        <i class="fas fa-copy"></i> {{ __('legacy_sync.diagnostics.copy_btn') }}
                                                    </button>
                                                    <pre class="legacy-error bg-dark text-white rounded p-2 mb-0 small" style="max-height:240px;overflow:auto;">{{ $row->error_message }}</pre>
                                                </div>
                                            </details>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-3">
                                        {{ __('legacy_sync.all.empty') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <div class="alert alert-info mt-3 mb-0">
        <i class="fas fa-info-circle"></i>
        {{ __('legacy_sync.worker_hint') }}
        <code>php artisan queue:work database --queue=legacy-sync --sleep=3 --tries=1 --timeout=3600</code>
    </div>
</div>
