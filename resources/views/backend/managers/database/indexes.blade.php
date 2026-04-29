@extends('backend.layouts.manger')

@section('content')
    <div class="db-browser-wrap" id="indexesApp">
        <div class="db-header">
            <div class="db-header-main">
                <h2 class="db-title">
                    <i class="fa fa-bolt me-2"></i>
                    {{ __('database_browser.indexes_page_title') }}
                </h2>
                <p class="db-subtitle">{{ __('database_browser.indexes_subtitle') }}</p>
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
                    {{ __('database_browser.indexes_audit_title') }}
                </h5>
                <p class="text-muted small mb-3">{{ __('database_browser.indexes_audit_help') }}</p>

                <button id="auditBtn" class="btn btn-info">
                    <i class="fa fa-play me-1"></i>
                    {{ __('database_browser.indexes_audit_run') }}
                </button>

                <div id="auditStatus" class="mt-3"></div>
                <div id="auditResults" class="mt-3"></div>
            </div>
        </div>

        <div class="card db-card mb-3">
            <div class="card-body">
                <h5 class="card-title text-success">
                    <i class="fa fa-magic me-1"></i>
                    {{ __('database_browser.indexes_generate_title') }}
                </h5>
                <p class="text-muted small mb-3">{{ __('database_browser.indexes_generate_help') }}</p>

                <button id="generateBtn" class="btn btn-success">
                    <i class="fa fa-file-code-o me-1"></i>
                    {{ __('database_browser.indexes_generate_run') }}
                </button>

                <div id="generateStatus" class="mt-3"></div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const csrf = '{{ csrf_token() }}';
            const auditUrl = '{{ route('managers.database.indexes.audit') }}';
            const generateUrl = '{{ route('managers.database.indexes.generate') }}';

            const auditBtn = document.getElementById('auditBtn');
            const auditStatus = document.getElementById('auditStatus');
            const auditResults = document.getElementById('auditResults');

            const generateBtn = document.getElementById('generateBtn');
            const generateStatus = document.getElementById('generateStatus');

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

            function renderAudit(report) {
                let html = '';
                html += '<div class="row g-2 mb-3">';
                html += '<div class="col-md-3"><div class="card text-center p-2"><small class="text-muted">{{ __('database_browser.indexes_tables_scanned') }}</small><div class="fs-4 fw-bold">' + fmt(report.totals.tables) + '</div></div></div>';
                html += '<div class="col-md-3"><div class="card text-center p-2 ' + (report.totals.missing_single > 0 ? 'border-warning' : '') + '"><small class="text-muted">{{ __('database_browser.indexes_missing_single') }}</small><div class="fs-4 fw-bold ' + (report.totals.missing_single > 0 ? 'text-warning' : 'text-success') + '">' + fmt(report.totals.missing_single) + '</div></div></div>';
                html += '<div class="col-md-3"><div class="card text-center p-2 ' + (report.totals.missing_composite > 0 ? 'border-warning' : '') + '"><small class="text-muted">{{ __('database_browser.indexes_missing_composite') }}</small><div class="fs-4 fw-bold ' + (report.totals.missing_composite > 0 ? 'text-warning' : 'text-success') + '">' + fmt(report.totals.missing_composite) + '</div></div></div>';
                html += '<div class="col-md-3"><div class="card text-center p-2"><small class="text-muted">{{ __('database_browser.indexes_total_recos') }}</small><div class="fs-4 fw-bold text-info">' + fmt(report.totals.total_recommendations) + '</div></div></div>';
                html += '</div>';

                if (report.totals.total_recommendations === 0) {
                    html += alertBox('success', '<i class="fa fa-check me-1"></i>{{ __('database_browser.indexes_clean') }}');
                    return html;
                }

                if (report.missing_single && report.missing_single.length) {
                    html += '<h6 class="mt-3">{{ __('database_browser.indexes_section_single') }}</h6>';
                    html += '<div class="table-responsive"><table class="table table-sm table-hover">';
                    html += '<thead class="table-dark"><tr><th>#</th><th>Table</th><th>Column</th><th>Reason</th></tr></thead><tbody>';
                    report.missing_single.forEach((r, i) => {
                        html += '<tr><td>' + (i + 1) + '</td><td><code>' + r.table + '</code></td><td><code>' + r.column + '</code></td><td class="small">' + r.reason + '</td></tr>';
                    });
                    html += '</tbody></table></div>';
                }

                if (report.missing_composite && report.missing_composite.length) {
                    html += '<h6 class="mt-3">{{ __('database_browser.indexes_section_composite') }}</h6>';
                    html += '<div class="table-responsive"><table class="table table-sm table-hover">';
                    html += '<thead class="table-dark"><tr><th>#</th><th>Table</th><th>Columns</th><th>Reason</th></tr></thead><tbody>';
                    report.missing_composite.forEach((r, i) => {
                        html += '<tr><td>' + (i + 1) + '</td><td><code>' + r.table + '</code></td><td><code>' + r.columns.join(', ') + '</code></td><td class="small">' + r.reason + '</td></tr>';
                    });
                    html += '</tbody></table></div>';
                }

                return html;
            }

            async function postJson(url) {
                const res = await fetch(url, {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: '{}',
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
                const data = await postJson(auditUrl);
                setBusy(auditBtn, false);
                if (!data.ok) {
                    auditStatus.innerHTML = alertBox('danger', '<i class="fa fa-times me-1"></i>' + (data.error || 'Failed'));
                    return;
                }
                auditResults.innerHTML = renderAudit(data.report);
            });

            generateBtn.addEventListener('click', async () => {
                if (!confirm('{{ __('database_browser.indexes_generate_confirm') }}')) return;
                setBusy(generateBtn, true);
                generateStatus.innerHTML = '';
                const data = await postJson(generateUrl);
                setBusy(generateBtn, false);
                if (!data.ok) {
                    generateStatus.innerHTML = alertBox('danger', '<i class="fa fa-times me-1"></i>' + (data.error || 'Failed'));
                    return;
                }
                if (!data.generated) {
                    generateStatus.innerHTML = alertBox('success', data.message);
                    return;
                }
                let html = '<div class="alert alert-success">';
                html += '<i class="fa fa-check me-1"></i>';
                html += '{{ __('database_browser.indexes_generated_ok') }}: <strong>' + data.count + '</strong> indexes';
                html += '<br><code>' + data.file + '</code>';
                html += '<br><small class="text-muted">' + data.next_step + '</small>';
                html += '</div>';
                generateStatus.innerHTML = html;
            });
        })();
    </script>
@endsection
