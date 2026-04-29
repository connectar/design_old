@extends('backend.layouts.manger')

@section('content')
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border py-2">
                <h4 class="card-title">
                    <i class="fa fa-database"></i>
                    {{ __('database_migration.page_title') }}
                </h4>
            </div>
            <div class="box-body">
                <div class="alert alert-info">
                    <p>{{ __('database_migration.intro') }}</p>
                    <p class="mb-0"><strong>{{ __('database_migration.queue_note') }}</strong></p>
                </div>
                <div class="alert alert-danger">
                    {{ __('database_migration.warning') }}
                </div>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-warning">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @isset($preflight)
                    <h5>{{ __('database_migration.preflight_title') }}</h5>
                    <div
                        class="alert {{ $preflight['ok'] ? 'alert-success' : 'alert-warning' }} mb-3">
                        <ul class="mb-0 list-unstyled">
                            @foreach ($preflight['items'] as $item)
                                <li class="mb-2">
                                    <i class="fa {{ $item['ok'] ? 'fa-check text-success' : 'fa-times text-danger' }}"
                                        aria-hidden="true"></i>
                                    <strong>{{ $item['label'] }}</strong>
                                    <span class="text-muted small d-block ms-3">{{ $item['detail'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @if (! $preflight['ok'])
                        <p class="text-danger small">{{ __('database_migration.preflight_block_hint') }}</p>
                    @endif
                @endisset

                <h5>{{ __('database_migration.env_help') }}</h5>
                <ul>
                    <li><code>PG_DB_HOST</code>, <code>PG_DB_PORT</code>, <code>PG_DB_DATABASE</code>,
                        <code>PG_DB_USERNAME</code>, <code>PG_DB_PASSWORD</code>, <code>PG_DB_SCHEMA</code>
                        (or <code>PG_MIGRATE_*</code>)</li>
                    <li><code>DB_MIGRATE_SOURCE_HOST</code>, <code>DB_MIGRATE_SOURCE_PORT</code>,
                        <code>DB_MIGRATE_SOURCE_DATABASE</code>, <code>DB_MIGRATE_SOURCE_USERNAME</code>,
                        <code>DB_MIGRATE_SOURCE_PASSWORD</code>, <code>DB_MIGRATE_SOURCE_SOCKET</code> —
                        MariaDB source when <code>DB_*</code> / <code>DB_PORT</code> point at PostgreSQL (e.g.
                        <code>DB_PORT=5432</code>); if <code>DB_PORT</code> is 5432 and source port is unset,
                        source defaults to <code>3306</code></li>
                    <li><code>MYSQLDUMP_PATH</code> — mysqldump binary (optional)</li>
                    <li><code>DB_MIGRATE_SOURCE_CONNECTION</code> (default <code>mysql_migrate_source</code> — no
                        <code>DATABASE_URL</code>), <code>DB_MIGRATE_TARGET_CONNECTION</code> (default
                        <code>pgsql_migrate</code>)</li>
                    <li><code>DB_MIGRATE_PG_USE_SESSION_REPLICATION_ROLE</code> — default <code>true</code>; set
                        <code>false</code> on managed Postgres if you want to skip the <code>SET</code> attempt
                        entirely (optional; failure is already non-fatal).</li>
                </ul>

                <form method="post" action="{{ route('managers.settings.database-migration.start') }}" class="mt-3">
                    @csrf
                    <div class="form-check mb-3">
                        <input type="checkbox" name="confirm" id="confirm" value="1" class="form-check-input" required>
                        <label class="form-check-label" for="confirm">{{ __('database_migration.confirm_text') }} —
                            {{ __('database_migration.confirm_label') }}</label>
                    </div>
                    <button type="submit" class="btn btn-primary"
                        @if (isset($preflight) && ! $preflight['ok']) disabled aria-disabled="true" @endif>
                        {{ __('database_migration.submit') }}
                    </button>
                </form>

                <div id="db-migrate-progress-card" class="box mt-3" style="display: none;">
                    <div class="box-header with-border py-2">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fa fa-spinner fa-spin me-1 d-none" id="db-migrate-spinner" aria-hidden="true"></i>
                            {{ __('database_migration.progress_title') }}
                        </h5>
                    </div>
                    <div class="box-body">
                        <div class="progress mb-2" style="height: 28px;">
                            <div id="db-migrate-progress-bar"
                                class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                role="progressbar" style="width: 0%;" aria-valuenow="0">0%</div>
                        </div>
                        <p class="mb-1"><strong>{{ __('database_migration.progress_phase') }}:</strong>
                            <span id="db-migrate-phase">—</span></p>
                        <p class="mb-1"><strong>{{ __('database_migration.progress_table') }}:</strong>
                            <code id="db-migrate-table">—</code></p>
                        <p class="mb-1"><strong>{{ __('database_migration.progress_tables_count') }}:</strong>
                            <span id="db-migrate-count">—</span></p>
                        <p class="mb-1"><strong>{{ __('database_migration.progress_elapsed') }}:</strong>
                            <span id="db-migrate-elapsed">—</span></p>
                        <p class="mb-0"><strong>{{ __('database_migration.progress_eta') }}:</strong>
                            <span id="db-migrate-eta">—</span></p>
                        <div id="db-migrate-error" class="alert alert-danger mt-2 mb-0 d-none small"></div>
                        <p id="db-migrate-done-hint" class="text-muted small mb-0 mt-2 d-none">
                            {{ __('database_migration.progress_done_reload') }}</p>
                    </div>
                </div>

                @if (is_array($lastResult))
                    <hr>
                    <h5>{{ __('database_migration.last_run') }}</h5>
                    <p>
                        <strong>{{ __('database_migration.run_id') }}:</strong> {{ $lastResult['run_id'] ?? '-' }} —
                        @if (! empty($lastResult['ok']))
                            <span class="text-success">{{ __('database_migration.status_ok') }}</span>
                        @else
                            <span class="text-danger">{{ __('database_migration.status_fail') }}</span>
                        @endif
                    </p>
                    @if (! empty($lastResult['error']))
                        <div class="alert alert-danger">
                            <strong>{{ __('database_migration.fatal_error_label') }}:</strong>
                            {{ $lastResult['error'] }}
                        </div>
                    @endif
                    @if (! empty($lastResult['has_table_errors']))
                        <div class="alert alert-danger">{{ __('database_migration.issues_table_errors') }}</div>
                    @endif
                    @if (! empty($lastResult['has_row_mismatches']))
                        <div class="alert alert-warning">{{ __('database_migration.issues_mismatches') }}</div>
                    @endif
                    @if (! empty($lastResult['run_id']))
                        <p>
                            <a class="btn btn-sm btn-outline-secondary"
                                href="{{ route('managers.settings.database-migration.download', ['run' => $lastResult['run_id'], 'file' => 'mysql_schema_no_data.sql']) }}">
                                {{ __('database_migration.download_schema') }}
                            </a>
                            <a class="btn btn-sm btn-outline-secondary"
                                href="{{ route('managers.settings.database-migration.download', ['run' => $lastResult['run_id'], 'file' => 'migration.log']) }}">
                                {{ __('database_migration.download_log') }}
                            </a>
                            <a class="btn btn-sm btn-outline-primary"
                                href="{{ route('managers.settings.database-migration.download', ['run' => $lastResult['run_id'], 'file' => 'match_report.json']) }}">
                                {{ __('database_migration.download_match_report') }}
                            </a>
                        </p>
                        <p class="text-muted small mb-0">{{ __('database_migration.match_report_hint') }}</p>
                    @endif
                    @if (! empty($lastResult['tables']) && is_array($lastResult['tables']))
                        <h5 class="mt-3">{{ __('database_migration.compare_title') }}</h5>
                        <div style="max-height: 480px; overflow: auto; font-size: 12px;">
                            <table class="table table-sm table-bordered table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('database_migration.th_table') }}</th>
                                        <th class="text-end">{{ __('database_migration.th_mysql_rows') }}</th>
                                        <th class="text-end">{{ __('database_migration.th_pg_rows') }}</th>
                                        <th class="text-end">{{ __('database_migration.th_copied') }}</th>
                                        <th class="text-end">{{ __('database_migration.th_cols_mysql') }}</th>
                                        <th class="text-end">{{ __('database_migration.th_cols_pg') }}</th>
                                        <th class="text-end">{{ __('database_migration.th_cols_shared') }}</th>
                                        <th>{{ __('database_migration.th_status') }}</th>
                                        <th>{{ __('database_migration.th_note') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lastResult['tables'] as $t)
                                        @php
                                            $match = $t['match'] ?? '';
                                            $sr = $t['source_rows'] ?? null;
                                            $tr = $t['target_rows'] ?? null;
                                        @endphp
                                        <tr @class([
                                            'table-danger' => $match === 'error',
                                            'table-warning' => $match === 'mismatch',
                                        ])>
                                            <td><code>{{ $t['table'] ?? '' }}</code></td>
                                            <td class="text-end">
                                                {{ is_numeric($sr) && (int) $sr >= 0 ? number_format((int) $sr) : __('database_migration.na') }}
                                            </td>
                                            <td class="text-end">
                                                @if ($tr === null)
                                                    {{ __('database_migration.na') }}
                                                @else
                                                    {{ is_numeric($tr) && (int) $tr >= 0 ? number_format((int) $tr) : __('database_migration.na') }}
                                                @endif
                                            </td>
                                            <td class="text-end">{{ number_format((int) ($t['rows_copied'] ?? $t['rows'] ?? 0)) }}</td>
                                            <td class="text-end">{{ (int) ($t['cols_mysql'] ?? 0) }}</td>
                                            <td class="text-end">{{ (int) ($t['cols_pg'] ?? 0) }}</td>
                                            <td class="text-end">{{ (int) ($t['cols_shared'] ?? 0) }}</td>
                                            <td>
                                                @switch($match)
                                                    @case('ok')
                                                        <span class="text-success fw-bold">{{ __('database_migration.match_ok') }}</span>
                                                        @break
                                                    @case('mismatch')
                                                        <span class="text-warning fw-bold">{{ __('database_migration.match_mismatch') }}</span>
                                                        @break
                                                    @case('skipped')
                                                        <span class="text-muted">{{ __('database_migration.match_skipped') }}</span>
                                                        @break
                                                    @case('error')
                                                        <span class="text-danger fw-bold">{{ __('database_migration.match_error') }}</span>
                                                        @break
                                                    @default
                                                        <span class="text-muted">{{ __('database_migration.na') }}</span>
                                                @endswitch
                                            </td>
                                            <td class="small">
                                                @if (! empty($t['error']))
                                                    {{ ($t['error'] ?? '') === 'count_query_failed' ? __('database_migration.count_query_failed') : $t['error'] }}
                                                @elseif (! empty($t['reason']))
                                                    {{ __('database_migration.reason_' . $t['reason']) }}
                                                @else
                                                    {{ __('database_migration.na') }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            const progressUrl = @json(route('managers.settings.database-migration.progress'));
            const startPollFlag = @json((bool) session('db_migrate_queued'));
            let queuedHint = startPollFlag;
            if (startPollFlag) {
                try {
                    sessionStorage.setItem('db_migrate_watch', '1');
                } catch (e) {}
            }
            const waitQueueText = @json(__('database_migration.progress_waiting_queue'));
            const L = {
                sec: @json(__('database_migration.unit_sec')),
                min: @json(__('database_migration.unit_min')),
                na: @json(__('database_migration.na')),
                etaUnknown: @json(__('database_migration.progress_eta_unknown')),
            };

            const card = document.getElementById('db-migrate-progress-card');
            const bar = document.getElementById('db-migrate-progress-bar');
            const spinner = document.getElementById('db-migrate-spinner');
            const errEl = document.getElementById('db-migrate-error');
            const doneHint = document.getElementById('db-migrate-done-hint');
            if (!card || !bar) return;

            let pollInterval = null;

            function fmtSec(s) {
                if (s == null || s < 0) return L.na;
                s = Math.floor(s);
                if (s < 60) return s + ' ' + L.sec;
                const m = Math.floor(s / 60);
                const r = s % 60;
                return m + ' ' + L.min + (r ? ' ' + r + ' ' + L.sec : '');
            }

            function stopPoll() {
                if (pollInterval) {
                    clearInterval(pollInterval);
                    pollInterval = null;
                }
            }

            function startPoll() {
                if (pollInterval) return;
                pollInterval = setInterval(fetchProgress, 2000);
            }

            function setRunningUi(on) {
                if (spinner) spinner.classList.toggle('d-none', !on);
                bar.classList.toggle('progress-bar-animated', on);
                bar.classList.toggle('progress-bar-striped', on);
            }

            function applyProgress(d) {
                const state = d.state || 'idle';
                const pct = Math.min(100, Math.max(0, parseInt(d.percent, 10) || 0));

                if (state === 'idle') {
                    if (queuedHint) {
                        card.style.display = '';
                        setRunningUi(true);
                        bar.classList.remove('bg-danger', 'bg-success');
                        bar.classList.add('bg-warning');
                        bar.style.width = '3%';
                        bar.textContent = '…';
                        document.getElementById('db-migrate-phase').textContent = waitQueueText;
                        document.getElementById('db-migrate-table').textContent = '—';
                        document.getElementById('db-migrate-count').textContent = '—';
                        document.getElementById('db-migrate-elapsed').textContent = '—';
                        document.getElementById('db-migrate-eta').textContent = L.etaUnknown;
                        errEl.classList.add('d-none');
                        doneHint.classList.add('d-none');
                    } else {
                        stopPoll();
                        card.style.display = 'none';
                    }
                    return;
                }

                if (state === 'running') {
                    queuedHint = false;
                    card.style.display = '';
                    setRunningUi(true);
                    bar.style.width = pct + '%';
                    bar.textContent = pct + '%';
                    bar.setAttribute('aria-valuenow', String(pct));
                    bar.classList.remove('bg-danger', 'bg-success');
                    bar.classList.add('bg-warning');
                    document.getElementById('db-migrate-phase').textContent = d.phase_label || d.phase || '—';
                    document.getElementById('db-migrate-table').textContent = d.current_table || '—';
                    const td = d.tables_total != null ? d.tables_total : 0;
                    const dd = d.tables_done != null ? d.tables_done : 0;
                    document.getElementById('db-migrate-count').textContent = dd + ' / ' + td;
                    document.getElementById('db-migrate-elapsed').textContent = fmtSec(d.elapsed_seconds);
                    document.getElementById('db-migrate-eta').textContent =
                        d.eta_seconds != null ? fmtSec(d.eta_seconds) : L.etaUnknown;
                    errEl.classList.add('d-none');
                    errEl.textContent = '';
                    doneHint.classList.add('d-none');
                    return;
                }

                stopPoll();
                setRunningUi(false);

                if (state === 'done' || state === 'failed') {
                    card.style.display = '';
                    bar.style.width = '100%';
                    bar.textContent = '100%';
                    bar.setAttribute('aria-valuenow', '100');
                    bar.classList.remove('progress-bar-animated', 'progress-bar-striped', 'bg-warning');
                    bar.classList.add(state === 'done' ? 'bg-success' : 'bg-danger');
                    document.getElementById('db-migrate-phase').textContent = d.phase_label || d.phase || '—';
                    document.getElementById('db-migrate-table').textContent = '—';
                    document.getElementById('db-migrate-count').textContent =
                        (d.tables_done != null ? d.tables_done : 0) + ' / ' + (d.tables_total != null ? d.tables_total : 0);
                    document.getElementById('db-migrate-elapsed').textContent = fmtSec(d.elapsed_seconds);
                    document.getElementById('db-migrate-eta').textContent = '—';
                    if (state === 'failed' && d.error) {
                        errEl.textContent = d.error;
                        errEl.classList.remove('d-none');
                    } else {
                        errEl.classList.add('d-none');
                    }
                    if (state === 'done') {
                        doneHint.classList.remove('d-none');
                        let shouldReload = false;
                        try {
                            shouldReload = sessionStorage.getItem('db_migrate_watch') === '1';
                            if (shouldReload) {
                                sessionStorage.removeItem('db_migrate_watch');
                            }
                        } catch (e) {}
                        if (shouldReload) {
                            setTimeout(function() {
                                window.location.reload();
                            }, 2500);
                        }
                    }
                    return;
                }

                card.style.display = 'none';
            }

            function fetchProgress() {
                fetch(progressUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                    .then(function(r) {
                        return r.json();
                    })
                    .then(function(d) {
                        applyProgress(d);
                        if (d.state === 'running') startPoll();
                        if (d.state === 'done' || d.state === 'failed') stopPoll();
                    })
                    .catch(function() {});
            }

            fetchProgress();
            if (startPollFlag) startPoll();
        })();
    </script>
@endpush
