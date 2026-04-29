@push('styles')
    <style>
        .db-browser-wrap { padding: 0 4px; }
        .db-header {
            display: flex; flex-wrap: wrap; justify-content: space-between; align-items: stretch;
            gap: 16px; padding: 18px 22px; margin-bottom: 18px;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.18), rgba(102, 16, 242, 0.18));
            border: 1px solid rgba(13, 110, 253, 0.35); border-radius: 14px;
        }
        .db-header-main { flex: 1 1 280px; min-width: 240px; }
        .db-title { margin: 0 0 6px; font-weight: 800; font-size: 1.4rem; }
        .db-subtitle { margin: 0; opacity: 0.85; font-size: 0.92rem; }
        .db-header-stats { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
        .db-stat {
            background: rgba(0,0,0,0.28); border: 1px solid rgba(255,255,255,0.12);
            border-radius: 10px; padding: 8px 14px; min-width: 110px;
            display: flex; flex-direction: column; gap: 2px; line-height: 1.1;
        }
        .db-stat-label { font-size: 0.72rem; opacity: 0.75; text-transform: uppercase; letter-spacing: 0.5px; }
        .db-stat-value { font-size: 1.05rem; font-weight: 700; }

        .db-card { border-radius: 12px; overflow: hidden; }
        .db-tables-list .db-table-name {
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace; font-weight: 600;
            text-decoration: none;
        }
        .db-tables-list .db-table-name:hover { text-decoration: underline; }

        .db-toolbar { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 12px; }
        .db-toolbar .form-control, .db-toolbar .form-select { width: auto; min-width: 140px; }

        .db-row-table th, .db-row-table td {
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-size: 0.82rem; white-space: nowrap; vertical-align: top;
        }
        .db-row-table th { background: #1f2937 !important; color: #fff; position: sticky; top: 0; z-index: 2; }
        .db-row-table th a { color: #fff; text-decoration: none; }
        .db-row-table td.cell-null { color: #94a3b8; font-style: italic; }
        .db-row-table td.cell-bool { font-weight: 700; }
        .db-row-table td.cell-num { color: #2dd4bf; text-align: right; }
        .db-row-table td .cell-trunc {
            display: inline-block; max-width: 360px; overflow: hidden; text-overflow: ellipsis;
            vertical-align: middle;
        }
        .db-row-scroll { max-height: 70vh; overflow: auto; border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; }

        .db-tabs .nav-link { border-radius: 0; font-weight: 600; }
        .db-tabs .nav-link.active { background: #0d6efd; color: #fff !important; }

        .db-meta-table th { width: 200px; }

        .db-console-input { font-family: ui-monospace, monospace; min-height: 110px; }

        @media (max-width: 768px) {
            .db-header { padding: 14px; }
            .db-header-stats { width: 100%; }
            .db-stat { flex: 1 1 calc(50% - 5px); min-width: 0; }
        }
    </style>
@endpush
