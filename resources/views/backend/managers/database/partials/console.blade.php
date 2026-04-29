@php
    $__dbConsoleI18n = [
        'no_rows' => __('database_browser.no_rows'),
        'console_run' => __('database_browser.console_run'),
        'console_took_template' => __('database_browser.console_took', [
            'ms' => '__MS__',
            'returned' => '__RETURNED__',
            'total' => '__TOTAL__',
        ]),
        'console_truncated' => __('database_browser.console_truncated', ['max' => 500]),
    ];
@endphp
<div class="alert alert-warning d-flex align-items-start gap-2">
    <i class="fa fa-info-circle mt-1"></i>
    <div>
        <strong>{{ __('database_browser.console_title') }}</strong><br>
        <small>{{ __('database_browser.console_hint') }}</small>
    </div>
</div>

<div class="mb-2">
    <textarea id="db-console-sql" class="form-control db-console-input" dir="ltr"
        placeholder="SELECT * FROM {{ $table ?? 'table_name' }} LIMIT 50;">SELECT * FROM {{ $table ?? '' }} LIMIT 50;</textarea>
</div>
<div class="mb-3 d-flex gap-2">
    <button type="button" class="btn btn-success" id="db-console-run">
        <i class="fa fa-play me-1"></i> {{ __('database_browser.console_run') }}
    </button>
    <button type="button" class="btn btn-outline-secondary" id="db-console-clear">
        <i class="fa fa-eraser me-1"></i> {{ __('database_browser.console_clear') }}
    </button>
    <span class="ms-auto small text-muted" id="db-console-meta"></span>
</div>

<div id="db-console-result"></div>

<script>
    (function () {
        if (window.__dbConsoleBound) return;
        window.__dbConsoleBound = true;

        function ready(fn) {
            if (document.readyState !== 'loading') fn();
            else document.addEventListener('DOMContentLoaded', fn);
        }

        ready(function () {
            var sqlInput = document.getElementById('db-console-sql');
            var runBtn = document.getElementById('db-console-run');
            var clearBtn = document.getElementById('db-console-clear');
            var resultBox = document.getElementById('db-console-result');
            var meta = document.getElementById('db-console-meta');
            var url = {!! json_encode(route('managers.database.query')) !!};
            var i18n = {!! json_encode($__dbConsoleI18n, JSON_UNESCAPED_UNICODE) !!};
            var token = (document.querySelector('meta[name="csrf-token"]') || {}).content || '';
            if (!sqlInput || !runBtn) return;

            function escape(s) {
                if (s === null || s === undefined) return '<span class="text-muted fst-italic">NULL</span>';
                return String(s)
                    .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            }

            function renderTable(payload) {
                if (!payload.ok) {
                    resultBox.innerHTML = '<div class="alert alert-danger"><strong>Error:</strong> '
                        + escape(payload.error || 'Unknown error') + '</div>';
                    meta.textContent = '';
                    return;
                }
                meta.textContent = (i18n.console_took_template || '')
                    .replace('__MS__', payload.took_ms || 0)
                    .replace('__RETURNED__', payload.returned || 0)
                    .replace('__TOTAL__', payload.total || 0);

                if (!payload.rows || payload.rows.length === 0) {
                    resultBox.innerHTML = '<div class="alert alert-info">' + escape(i18n.no_rows) + '</div>';
                    return;
                }

                var html = '<div class="db-row-scroll"><table class="table table-sm table-striped table-hover db-row-table mb-0"><thead><tr>';
                payload.columns.forEach(function (c) {
                    html += '<th><span dir="ltr">' + escape(c) + '</span></th>';
                });
                html += '</tr></thead><tbody>';
                payload.rows.forEach(function (row) {
                    html += '<tr>';
                    payload.columns.forEach(function (c) {
                        var v = row[c];
                        var cls = '';
                        var disp;
                        if (v === null || v === undefined) {
                            cls = 'cell-null';
                            disp = 'NULL';
                        } else if (typeof v === 'boolean') {
                            cls = 'cell-bool';
                            disp = v ? 'true' : 'false';
                        } else if (typeof v === 'number') {
                            cls = 'cell-num';
                            disp = String(v);
                        } else if (typeof v === 'object') {
                            disp = JSON.stringify(v);
                        } else {
                            disp = String(v);
                        }
                        var trunc = disp.length > 80;
                        var shown = trunc ? disp.substring(0, 80) + '…' : disp;
                        html += '<td class="' + cls + '" dir="auto">'
                            + (trunc
                                ? '<span class="cell-trunc" title="' + escape(disp) + '">' + escape(shown) + '</span>'
                                : escape(shown))
                            + '</td>';
                    });
                    html += '</tr>';
                });
                html += '</tbody></table></div>';

                if (payload.truncated) {
                    html += '<div class="alert alert-warning mt-2 mb-0 py-2">'
                        + escape(i18n.console_truncated) + '</div>';
                }
                resultBox.innerHTML = html;
            }

            runBtn.addEventListener('click', function () {
                var sql = (sqlInput.value || '').trim();
                if (!sql) return;
                runBtn.disabled = true;
                runBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i>...';
                resultBox.innerHTML = '';
                meta.textContent = '';

                var fd = new FormData();
                fd.append('sql', sql);
                if (token) fd.append('_token', token);

                fetch(url, {
                    method: 'POST',
                    body: fd,
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': token },
                    credentials: 'same-origin'
                })
                    .then(function (r) { return r.json().then(function (j) { return { status: r.status, body: j }; }); })
                    .then(function (res) { renderTable(res.body); })
                    .catch(function (e) {
                        resultBox.innerHTML = '<div class="alert alert-danger">'
                            + escape(e && e.message ? e.message : 'Network error') + '</div>';
                    })
                    .finally(function () {
                        runBtn.disabled = false;
                        runBtn.innerHTML = '<i class="fa fa-play me-1"></i> ' + escape(i18n.console_run);
                    });
            });

            clearBtn.addEventListener('click', function () {
                sqlInput.value = '';
                resultBox.innerHTML = '';
                meta.textContent = '';
                sqlInput.focus();
            });

            sqlInput.addEventListener('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                    e.preventDefault();
                    runBtn.click();
                }
            });
        });
    })();
</script>
