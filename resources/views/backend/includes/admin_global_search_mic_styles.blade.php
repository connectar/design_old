@push('styles')
    <style>
        /**
         * Mic buttons project-wide: blue icon/border by default, red while listening (.active / aria-pressed).
         * Covers .admin-voice-search-mic (datatables JS) and .admin-global-search-mic (header/modal).
         */
        button.admin-voice-search-mic,
        button.admin-global-search-mic {
            line-height: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 2;
            position: relative;
            background-color: rgba(13, 110, 253, 0.12) !important;
            border: 2px solid #0d6efd !important;
            color: #0d6efd !important;
            outline: none;
            box-shadow: none;
        }

        button.admin-voice-search-mic i.fa,
        button.admin-global-search-mic i.fa {
            color: #0d6efd !important;
        }

        button.admin-voice-search-mic {
            min-width: 2.35rem;
            min-height: 2rem;
            padding: 0.35rem 0.45rem !important;
            font-size: 1.15rem !important;
        }

        button.admin-global-search-mic {
            min-width: 3rem;
            min-height: 3rem;
            padding: 0.55rem 0.7rem !important;
            font-size: 1.5rem !important;
        }

        button.admin-voice-search-mic:hover,
        button.admin-voice-search-mic:focus,
        button.admin-global-search-mic:hover,
        button.admin-global-search-mic:focus {
            background-color: rgba(13, 110, 253, 0.22) !important;
            border-color: #0a58ca !important;
            color: #084298 !important;
        }

        button.admin-voice-search-mic:hover i.fa,
        button.admin-voice-search-mic:focus i.fa,
        button.admin-global-search-mic:hover i.fa,
        button.admin-global-search-mic:focus i.fa {
            color: #084298 !important;
        }

        button.admin-voice-search-mic.active,
        button.admin-voice-search-mic[aria-pressed='true'],
        button.admin-global-search-mic.active,
        button.admin-global-search-mic[aria-pressed='true'] {
            background-color: rgba(220, 53, 69, 0.2) !important;
            border-color: #dc3545 !important;
            color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.35);
        }

        button.admin-voice-search-mic.active i.fa,
        button.admin-voice-search-mic[aria-pressed='true'] i.fa,
        button.admin-global-search-mic.active i.fa,
        button.admin-global-search-mic[aria-pressed='true'] i.fa {
            color: #dc3545 !important;
        }

        /* هيدر داكن: أزرق أفتح للوضوح */
        .main-header .admin-global-search-mic {
            background-color: rgba(91, 155, 255, 0.2) !important;
            border-color: #5b9fff !important;
            color: #7eb8ff !important;
        }

        .main-header .admin-global-search-mic i.fa {
            color: #7eb8ff !important;
        }

        .main-header .admin-global-search-mic:hover,
        .main-header .admin-global-search-mic:focus {
            background-color: rgba(91, 155, 255, 0.3) !important;
            border-color: #8ec5ff !important;
            color: #cfe2ff !important;
        }

        .main-header .admin-global-search-mic:hover i.fa,
        .main-header .admin-global-search-mic:focus i.fa {
            color: #cfe2ff !important;
        }

        .main-header .admin-global-search-mic.active,
        .main-header .admin-global-search-mic[aria-pressed='true'] {
            background-color: rgba(220, 53, 69, 0.25) !important;
            border-color: #ff6b6b !important;
            color: #ff6b6b !important;
        }

        .main-header .admin-global-search-mic.active i.fa,
        .main-header .admin-global-search-mic[aria-pressed='true'] i.fa {
            color: #ff6b6b !important;
        }

        /* —— Global search modal (suggestions UI) —— */
        .ags-modal .ags-search-icon-end {
            background: rgba(255, 193, 7, 0.12) !important;
            color: #ffc107 !important;
            min-width: 3rem;
            justify-content: center;
            font-size: 1.15rem;
        }

        .ags-modal .ags-input-group .form-control {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(255, 255, 255, 0.2);
            color: #f1f5f9;
            font-size: 1rem;
        }

        .ags-modal .ags-input-group .form-control::placeholder {
            color: rgba(241, 245, 249, 0.45);
        }

        .ags-modal .ags-input-group .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 193, 7, 0.5);
            color: #fff;
            box-shadow: 0 0 0 0.15rem rgba(255, 193, 7, 0.2);
        }

        /* مودال داكن: ميك أوضح بأزرق أفتح */
        .ags-modal .ags-input-group .input-group-append .admin-global-search-mic {
            border-radius: 0;
            background-color: rgba(91, 155, 255, 0.18) !important;
            border-color: #5b9fff !important;
            color: #7eb8ff !important;
        }

        .ags-modal .ags-input-group .input-group-append .admin-global-search-mic i.fa {
            color: #7eb8ff !important;
        }

        .ags-modal .ags-input-group .input-group-append .admin-global-search-mic:hover,
        .ags-modal .ags-input-group .input-group-append .admin-global-search-mic:focus {
            background-color: rgba(91, 155, 255, 0.28) !important;
            border-color: #8ec5ff !important;
            color: #b6d4fe !important;
        }

        .ags-modal .ags-input-group .input-group-append .admin-global-search-mic:hover i.fa,
        .ags-modal .ags-input-group .input-group-append .admin-global-search-mic:focus i.fa {
            color: #b6d4fe !important;
        }

        .ags-modal .ags-input-group .input-group-append .admin-global-search-mic.active,
        .ags-modal .ags-input-group .input-group-append .admin-global-search-mic[aria-pressed='true'] {
            background-color: rgba(220, 53, 69, 0.25) !important;
            border-color: #ff6b6b !important;
            color: #ff6b6b !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.4);
        }

        .ags-modal .ags-input-group .input-group-append .admin-global-search-mic.active i.fa,
        .ags-modal .ags-input-group .input-group-append .admin-global-search-mic[aria-pressed='true'] i.fa {
            color: #ff6b6b !important;
        }

        .ags-hint {
            background: rgba(23, 162, 184, 0.12);
            border: 1px solid rgba(23, 162, 184, 0.35);
            color: rgba(226, 232, 240, 0.9);
            line-height: 1.5;
        }

        .ags-results {
            max-height: 58vh;
            overflow-y: auto;
            padding-left: 2px;
            padding-right: 2px;
        }

        .ags-section-head {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #ffc107;
            margin-bottom: 0.65rem;
            padding-bottom: 0.35rem;
            border-bottom: 2px solid rgba(255, 193, 7, 0.35);
        }

        .ags-section-head i {
            opacity: 0.9;
        }

        .ags-items {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        .ags-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0.85rem;
            border-radius: 0.5rem;
            text-decoration: none !important;
            color: #e2e8f0 !important;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: background 0.15s ease, border-color 0.15s ease, transform 0.12s ease;
        }

        .ags-item:hover,
        .ags-item:focus {
            background: rgba(255, 193, 7, 0.1);
            border-color: rgba(255, 193, 7, 0.35);
            color: #fff !important;
            transform: translateX(-3px);
        }

        html[dir='rtl'] .ags-item:hover,
        html[dir='rtl'] .ags-item:focus {
            transform: translateX(3px);
        }

        .ags-item-icon {
            flex-shrink: 0;
            width: 2.25rem;
            height: 2.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.4rem;
            background: rgba(13, 110, 253, 0.25);
            color: #6ea8fe;
            font-size: 1rem;
        }

        .ags-item-body {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .ags-item-title {
            font-weight: 600;
            font-size: 0.95rem;
            word-break: break-word;
        }

        .ags-item-sub {
            font-size: 0.82rem;
            color: rgba(226, 232, 240, 0.65) !important;
        }

        .ags-item-meta {
            flex-shrink: 0;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .ags-item-chevron {
            flex-shrink: 0;
            opacity: 0.35;
            font-size: 0.85rem;
            transition: opacity 0.15s ease;
        }

        .ags-item:hover .ags-item-chevron {
            opacity: 0.85;
        }

        html[dir='rtl'] .ags-item-chevron.rtl-chevron {
            transform: scaleX(-1);
        }

        .ags-empty {
            background: rgba(255, 255, 255, 0.03);
            border: 1px dashed rgba(255, 255, 255, 0.12);
        }

        .ags-modal .ags-users-table-wrap {
            background: rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        .ags-modal .ags-users-table {
            color: #e2e8f0;
            font-size: 0.88rem;
            margin-bottom: 0;
        }

        .ags-modal .ags-users-table thead th {
            border-color: rgba(255, 255, 255, 0.1);
            vertical-align: middle;
            font-weight: 600;
        }

        .ags-modal .ags-users-table tbody td {
            border-color: rgba(255, 255, 255, 0.08);
            vertical-align: middle;
        }

        .ags-modal .ags-user-row a.text-white {
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .ags-modal .ags-user-row .user-status {
            min-width: 8.5rem;
        }

        /**
         * إصلاح النقرات: chilli_style + main.css يقيّدان li إلى 35px و search-bx بـ overflow:hidden
         * inclip للأزرار/الميك فيصبح النقر يمر للخلف أو لا يصل للزر.
         */
        .main-header .navbar-custom-menu .navbar-nav > li.global-search-nav-cluster {
            height: auto !important;
            min-height: 35px;
            max-height: none !important;
            overflow: visible !important;
            align-items: center;
        }

        .main-header .app-menu .search-bx.global-search-header-bx {
            overflow: visible !important;
            max-width: min(420px, 92vw) !important;
        }

        .main-header .app-menu .search-bx.global-search-header-bx .input-group {
            flex-wrap: nowrap;
            align-items: stretch;
        }

        /**
         * المودال (jetstream-modal) بـ z-index: 999999 ويغطي الهيدر؛ نرفع حاوية البحث/الميك فوقه.
         */
        .main-header .global-search-nav-cluster > .global-search-header-controls {
            position: relative;
            z-index: 1000020;
            pointer-events: auto;
        }

        .main-header .global-search-header-controls .admin-global-search-mic {
            z-index: 3;
        }
    </style>
@endpush
