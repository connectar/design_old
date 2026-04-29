@extends('backend.layouts.manger')

@section('content')
    <div class="db-browser-wrap" id="orphansApp">
        <div class="db-header">
            <div class="db-header-main">
                <h2 class="db-title">
                    <i class="fa fa-bug me-2"></i>
                    {{ __('database_browser.orphans_page_title') }}
                </h2>
                <p class="db-subtitle">{{ __('database_browser.orphans_subtitle') }}</p>
            </div>
            <div class="db-header-stats">
                <div class="db-stat">
                    <span class="db-stat-label">{{ __('database_browser.driver') }}</span>
                    <span class="db-stat-value" dir="ltr">{{ strtoupper($driver) }}</span>
                </div>
                <div class="db-stat">
                    <span class="db-stat-label">{{ __('database_browser.database') }}</span>
                    <span class="db-stat-value" dir="ltr">{{ $database }}</span>
                </div>
                <div class="db-stat">
                    <a href="{{ route('managers.database.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fa fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} me-1"></i>
                        {{ __('database_browser.back_to_tables') }}
                    </a>
                </div>
            </div>
        </div>

        @include('backend.managers.database.partials.styles')

        <div class="card db-card mb-3">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fa fa-search me-1"></i>
                    {{ __('database_browser.orphans_audit_title') }}
                </h5>
                <p class="text-muted small mb-3">{{ __('database_browser.orphans_audit_help') }}</p>

                <button id="auditBtn" class="btn btn-warning">
                    <i class="fa fa-play me-1"></i>
                    {{ __('database_browser.orphans_audit_run') }}
                </button>

                <div id="auditStatus" class="mt-3"></div>
                <div id="auditResults" class="mt-3"></div>
            </div>
        </div>

        <div class="card db-card mb-3">
            <div class="card-body">
                <h5 class="card-title text-danger">
                    <i class="fa fa-trash me-1"></i>
                    {{ __('database_browser.orphans_cleanup_title') }}
                </h5>
                <p class="text-muted small mb-3">{{ __('database_browser.orphans_cleanup_help') }}</p>

                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="includeSoft">
                    <label class="form-check-label" for="includeSoft">
                        {{ __('database_browser.orphans_include_soft') }}
                    </label>
                </div>

                <button id="dryRunBtn" class="btn btn-outline-warning me-2">
                    <i class="fa fa-eye me-1"></i>
                    {{ __('database_browser.orphans_dry_run') }}
                </button>

                <button id="applyBtn" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cleanupModal">
                    <i class="fa fa-bolt me-1"></i>
                    {{ __('database_browser.orphans_apply') }}
                </button>

                <div id="cleanupStatus" class="mt-3"></div>
                <div id="cleanupResults" class="mt-3"></div>
            </div>
        </div>

        <div class="card db-card">
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fa fa-file-text me-1"></i>
                    {{ __('database_browser.orphans_reports_title') }}
                </h5>
                @if (count($reports) === 0)
                    <p class="text-muted mb-0">{{ __('database_browser.orphans_no_reports') }}</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('database_browser.orphans_report_file') }}</th>
                                    <th>{{ __('database_browser.orphans_report_when') }}</th>
                                    <th class="text-end">{{ __('database_browser.orphans_report_size') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $i => $r)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <a href="{{ route('managers.database.orphans.report', ['file' => $r['name']]) }}"
                                                target="_blank" rel="noopener">
                                                {{ $r['name'] }}
                                            </a>
                                            <a href="{{ route('managers.database.orphans.report', ['file' => str_replace('.md', '.json', $r['name'])]) }}"
                                                target="_blank" rel="noopener" class="ms-2 small text-muted">
                                                (json)
                                            </a>
                                        </td>
                                        <td dir="ltr">{{ \Carbon\Carbon::createFromTimestamp($r['mtime'])->toDateTimeString() }}</td>
                                        <td class="text-end" dir="ltr">{{ number_format($r['size'] / 1024, 1) }} KB</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="cleanupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fa fa-warning me-1"></i>
                        {{ __('database_browser.orphans_apply_confirm_title') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('database_browser.orphans_apply_confirm_body') }}</p>
                    <p class="text-muted small">
                        {{ __('database_browser.orphans_apply_confirm_phrase') }}
                        <code>حذف البيانات اليتيمة</code>
                    </p>
                    <input type="text" id="confirmPhrase" class="form-control" placeholder="حذف البيانات اليتيمة">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('database_browser.orphans_cancel') }}
                    </button>
                    <button type="button" id="confirmApplyBtn" class="btn btn-danger" disabled>
                        <i class="fa fa-trash me-1"></i>
                        {{ __('database_browser.orphans_confirm_delete') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const csrf = '{{ csrf_token() }}';
            const auditUrl = '{{ route('managers.database.orphans.audit') }}';
            const cleanupUrl = '{{ route('managers.database.orphans.cleanup') }}';

            const auditBtn = document.getElementById('auditBtn');
            const auditStatus = document.getElementById('auditStatus');
            const auditResults = document.getElementById('auditResults');

            const dryRunBtn = document.getElementById('dryRunBtn');
            const applyBtn = document.getElementById('applyBtn');
            const includeSoft = document.getElementById('includeSoft');
            const cleanupStatus = document.getElementById('cleanupStatus');
            const cleanupResults = document.getElementById('cleanupResults');

            const confirmPhrase = document.getElementById('confirmPhrase');
            const confirmApplyBtn = document.getElementById('confirmApplyBtn');

            const REQUIRED_PHRASE = 'حذف البيانات اليتيمة';

            confirmPhrase.addEventListener('input', () => {
                confirmApplyBtn.disabled = confirmPhrase.value.trim() !== REQUIRED_PHRASE;
            });

            function fmt(n) { return Number(n).toLocaleString(); }

            function setBusy(btn, busy) {
                btn.disabled = busy;
                btn.dataset.original = btn.dataset.original || btn.innerHTML;
                btn.innerHTML = busy
                    ? '<i class="fa fa-spinner fa-spin me-1"></i> {{ __('database_browser.orphans_running') }}'
                    : btn.dataset.original;
            }

            function alertBox(kind, html) {
                return '<div class="alert alert-' + kind + ' mt-2">' + html + '</div>';
            }

            function renderAuditTable(report) {
                if (!report.findings || report.findings.length === 0) {
                    return alertBox('success', '<i class="fa fa-check me-1"></i>{{ __('database_browser.orphans_clean') }}');
                }
                let html = '';
                html += '<div class="table-responsive"><table class="table table-sm table-striped table-hover">';
                html += '<thead class="table-dark"><tr>';
                html += '<th>#</th><th>Child</th><th>Parent</th><th>Src</th>';
                html += '<th class="text-end">Hard</th><th class="text-end">Soft</th>';
                html += '<th>Cause / Fix</th></tr></thead><tbody>';
                report.findings.forEach((f, i) => {
                    html += '<tr>';
                    html += '<td>' + (i + 1) + '</td>';
                    html += '<td><code>' + f.child_table + '.' + f.child_column + '</code></td>';
                    html += '<td><code>' + f.parent_table + '.' + f.parent_column + '</code></td>';
                    html += '<td><span class="badge bg-secondary">' + f.source + '</span></td>';
                    html += '<td class="text-end ' + (f.hard_orphans > 0 ? 'text-danger fw-bold' : '') + '">' + fmt(f.hard_orphans) + '</td>';
                    html += '<td class="text-end ' + (f.soft_orphans > 0 ? 'text-warning' : '') + '">' + fmt(f.soft_orphans) + '</td>';
                    html += '<td class="small">';
                    html += '<div><strong class="text-danger">السبب:</strong> ' + f.likely_cause + '</div>';
                    html += '<div class="text-success"><strong>الحل:</strong> ' + f.suggested_fix + '</div>';
                    html += '</td>';
                    html += '</tr>';
                });
                html += '</tbody></table></div>';
                return html;
            }

            function renderCleanup(report) {
                const mode = report.dry_run ? 'DRY-RUN' : 'APPLIED';
                let html = '<div class="alert alert-' + (report.dry_run ? 'warning' : 'success') + '">';
                html += '<strong>' + mode + ':</strong> ';
                html += (report.dry_run
                    ? '{{ __('database_browser.orphans_would_delete') }} '
                    : '{{ __('database_browser.orphans_deleted') }} ')
                    + '<strong>' + fmt(report.total_deleted) + '</strong> '
                    + '{{ __('database_browser.orphans_rows') }}'
                    + ' (' + report.ms + ' ms)';
                html += '</div>';

                const entries = Object.entries(report.deleted || {}).filter(([_, c]) => c > 0);
                if (entries.length > 0) {
                    html += '<div class="table-responsive"><table class="table table-sm">';
                    html += '<thead><tr><th>Relation</th><th class="text-end">' + (report.dry_run ? 'Would delete' : 'Deleted') + '</th></tr></thead><tbody>';
                    entries.sort((a, b) => b[1] - a[1]);
                    entries.forEach(([k, v]) => {
                        html += '<tr><td><code>' + k + '</code></td><td class="text-end fw-bold">' + fmt(v) + '</td></tr>';
                    });
                    html += '</tbody></table></div>';
                }
                return html;
            }

            async function postJson(url, body) {
                const res = await fetch(url, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify(body || {}),
                });
                let data;
                try { data = await res.json(); } catch (e) { data = { ok: false, error: 'Bad response' }; }
                if (!res.ok) data.ok = false;
                return data;
            }

            auditBtn.addEventListener('click', async () => {
                setBusy(auditBtn, true);
                auditStatus.innerHTML = '';
                auditResults.innerHTML = '';
                const data = await postJson(auditUrl, {});
                setBusy(auditBtn, false);

                if (!data.ok) {
                    auditStatus.innerHTML = alertBox('danger', '<i class="fa fa-times me-1"></i>' + (data.error || 'Failed'));
                    return;
                }
                const r = data.report;
                let summary = '<div class="row g-2">';
                summary += '<div class="col-md-3"><div class="card text-center p-2"><small class="text-muted">{{ __('database_browser.orphans_relations_checked') }}</small><div class="fs-4 fw-bold">' + fmt(r.totals.relations_checked) + '</div></div></div>';
                summary += '<div class="col-md-3"><div class="card text-center p-2 ' + (r.totals.relations_with_orphans > 0 ? 'border-danger' : 'border-success') + '"><small class="text-muted">{{ __('database_browser.orphans_with_orphans') }}</small><div class="fs-4 fw-bold ' + (r.totals.relations_with_orphans > 0 ? 'text-danger' : 'text-success') + '">' + fmt(r.totals.relations_with_orphans) + '</div></div></div>';
                summary += '<div class="col-md-3"><div class="card text-center p-2"><small class="text-muted">{{ __('database_browser.orphans_hard') }}</small><div class="fs-4 fw-bold text-danger">' + fmt(r.totals.hard_orphans_total) + '</div></div></div>';
                summary += '<div class="col-md-3"><div class="card text-center p-2"><small class="text-muted">{{ __('database_browser.orphans_soft') }}</small><div class="fs-4 fw-bold text-warning">' + fmt(r.totals.soft_orphans_total) + '</div></div></div>';
                summary += '</div>';

                let extra = '';
                if (data.files && data.files.md) {
                    extra = '<div class="mt-2"><a href="{{ route('managers.database.orphans.index') }}" class="btn btn-sm btn-outline-secondary">'
                        + '<i class="fa fa-refresh me-1"></i>{{ __('database_browser.orphans_refresh_reports') }}</a></div>';
                }

                auditStatus.innerHTML = summary + extra;
                auditResults.innerHTML = renderAuditTable(r);
            });

            dryRunBtn.addEventListener('click', async () => {
                setBusy(dryRunBtn, true);
                cleanupStatus.innerHTML = '';
                cleanupResults.innerHTML = '';
                const data = await postJson(cleanupUrl, { apply: false, include_soft: includeSoft.checked });
                setBusy(dryRunBtn, false);
                if (!data.ok) {
                    cleanupStatus.innerHTML = alertBox('danger', data.error || 'Failed');
                    return;
                }
                cleanupResults.innerHTML = renderCleanup(data.report);
            });

            confirmApplyBtn.addEventListener('click', async () => {
                setBusy(confirmApplyBtn, true);
                const data = await postJson(cleanupUrl, {
                    apply: true,
                    include_soft: includeSoft.checked,
                    confirm: confirmPhrase.value.trim(),
                });
                setBusy(confirmApplyBtn, false);

                const modal = bootstrap.Modal.getInstance(document.getElementById('cleanupModal'));
                if (modal) modal.hide();
                confirmPhrase.value = '';
                confirmApplyBtn.disabled = true;

                if (!data.ok) {
                    cleanupStatus.innerHTML = alertBox('danger', data.error || 'Failed');
                    return;
                }
                cleanupResults.innerHTML = renderCleanup(data.report);
            });
        })();
    </script>
@endsection
