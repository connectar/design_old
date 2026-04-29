@extends('backend.layouts.manger')

@php
    /** @var array $stats */
    $sum = $stats['summary'] ?? [];
    $rows = $stats['table_rows'] ?? [];
@endphp

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        .mig-hub { font-family: 'Cairo', sans-serif; direction: rtl; text-align: right; color: #f1f5f9; background: #2e2a4f; border-radius: 16px; padding: 26px 18px 32px; margin-bottom: 20px; max-width: 880px; margin-left: auto; margin-right: auto; }
        .mig-hub[dir="ltr"] { direction: ltr; text-align: left; }
        .mig-hub * { box-sizing: border-box; }
        .mig-hub h1 { margin: 0 0 6px; font-size: 1.65rem; font-weight: 800; color: #fff; }
        .mig-hub .mig-sub { margin: 0 0 22px; font-size: 0.9rem; color: rgba(255,255,255,0.55); }
        .mig-card { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 18px 18px 16px; margin-bottom: 16px; }
        .mig-card-head { display: flex; align-items: center; gap: 10px; font-weight: 700; font-size: 1.02rem; margin-bottom: 14px; color: #fff; }
        .mig-row2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        @media (max-width: 700px) { .mig-row2 { grid-template-columns: 1fr; } }
        .mig-lbl { display: block; font-size: 0.88rem; font-weight: 600; color: rgba(255,255,255,0.78); margin-bottom: 6px; }
        .mig-lbl-tag { display: inline-block; font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; color: #a5b4fc; background: rgba(99,102,241,0.2); border: 1px solid rgba(129,140,248,0.35); padding: 2px 8px; border-radius: 6px; margin-inline-end: 6px; vertical-align: middle; }
        .mig-readonly-field { width: 100%; padding: 12px 14px; background: rgba(255,255,255,0.09); border: 1px solid rgba(129,140,248,0.45); border-radius: 12px; color: #f8fafc; font-size: 0.92rem; min-height: 46px; cursor: text; box-shadow: inset 0 1px 0 rgba(255,255,255,0.06); transition: border-color 0.2s, box-shadow 0.2s; }
        .mig-readonly-field:hover { border-color: rgba(165,180,252,0.65); background: rgba(255,255,255,0.1); }
        .mig-readonly-field:focus { outline: none; border-color: #a5b4fc; box-shadow: 0 0 0 2px rgba(129,140,248,0.35), inset 0 1px 0 rgba(255,255,255,0.08); }
        .mig-readonly-field.mig-mono { font-family: ui-monospace, monospace; direction: ltr; text-align: left; }
        .mig-readonly-field::placeholder { color: rgba(255,255,255,0.35); }
        .mig-hint { font-size: 0.75rem; color: rgba(255,255,255,0.42); margin-top: 6px; line-height: 1.45; }
        .mig-link { color: #7dd3fc; font-size: 0.85rem; font-weight: 600; text-decoration: underline; }
        .mig-link:hover { color: #bae6fd; }
        .mig-conn-line { font-size: 0.82rem; color: rgba(255,255,255,0.55); margin-top: 10px; display: flex; align-items: center; flex-wrap: wrap; gap: 8px; }
        .mig-pill { display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; border-radius: 999px; font-size: 0.78rem; font-weight: 700; }
        .mig-pill-ok { background: rgba(16,185,129,0.2); color: #6ee7b7; border: 1px solid rgba(16,185,129,0.35); }
        .mig-pill-bad { background: rgba(239,68,68,0.15); color: #fca5a5; border: 1px solid rgba(239,68,68,0.35); }
        .mig-input-real { width: 100%; padding: 12px 14px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.14); border-radius: 12px; color: #fff; font-family: inherit; font-size: 0.95rem; outline: none; }
        .mig-input-real:focus { border-color: rgba(99,102,241,0.6); }
        .mig-input-real::placeholder { color: rgba(255,255,255,0.35); }
        .mig-btn { border: none; border-radius: 12px; padding: 11px 22px; font-family: inherit; font-size: 0.9rem; font-weight: 700; cursor: pointer; color: #fff; display: inline-flex; align-items: center; gap: 6px; transition: opacity 0.2s, transform 0.15s; }
        .mig-btn:disabled { opacity: 0.45; cursor: not-allowed; }
        .mig-btn-cyan { background: linear-gradient(135deg, #06b6d4, #0891b2); }
        .mig-btn-orange { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .mig-btn-green { background: linear-gradient(135deg, #10b981, #059669); }
        .mig-btn-amber { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .mig-btn-red { background: linear-gradient(135deg, #ef4444, #b91c1c); }
        .mig-btn-purple { background: linear-gradient(135deg, #667eea, #764ba2); }
        .mig-btn-purple:hover:not(:disabled) { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(102, 126, 234, 0.35); }
        .mig-btn-row { display: flex; flex-wrap: wrap; gap: 10px; justify-content: flex-end; margin-top: 12px; }
        .mig-btn-row.mig-row-start { justify-content: flex-start; }
        a.mig-btn { text-decoration: none; }
        .mig-customer { display: none; margin-top: 14px; padding: 12px 14px; border-radius: 12px; background: rgba(16,185,129,0.12); border: 1px solid rgba(16,185,129,0.25); align-items: center; gap: 12px; }
        .mig-customer.mig-on { display: flex; }
        .mig-av { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg,#10b981,#059669); display:flex; align-items:center; justify-content:center; font-weight:800; color:#fff; flex-shrink:0; }
        .mig-customer h4 { margin: 0 0 4px; font-size: 0.95rem; color: #fff; }
        .mig-customer p { margin: 0; font-size: 0.8rem; color: rgba(255,255,255,0.5); }
        .mig-stats3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 14px; }
        @media (max-width: 600px) { .mig-stats3 { grid-template-columns: 1fr; } }
        .mig-sc { background: rgba(0,0,0,0.18); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 14px 10px; text-align: center; }
        .mig-sc .n { font-size: 1.6rem; font-weight: 900; line-height: 1.1; }
        .mig-sc .n-b { color: #818cf8; } .mig-sc .n-g { color: #34d399; } .mig-sc .n-p { color: #c084fc; }
        .mig-sc .lb { font-size: 0.78rem; color: rgba(255,255,255,0.5); font-weight: 600; margin-top: 4px; }
        .mig-sc .fr { font-size: 0.72rem; color: rgba(255,255,255,0.38); margin-top: 4px; }
        .mig-tbl { width: 100%; border-collapse: separate; border-spacing: 0 5px; font-size: 0.84rem; }
        .mig-tbl th { background: rgba(99,102,241,0.22); padding: 10px 10px; font-weight: 700; color: rgba(255,255,255,0.9); }
        .mig-tbl th:first-child { border-radius: 0 10px 10px 0; }
        .mig-tbl th:last-child { border-radius: 10px 0 0 10px; }
        .mig-tbl td { padding: 10px 10px; background: rgba(255,255,255,0.04); }
        .mig-tbl tr:hover td { background: rgba(255,255,255,0.07); }
        .mig-tbl td:first-child { border-radius: 0 10px 10px 0; }
        .mig-tbl td:last-child { border-radius: 10px 0 0 10px; }
        .mig-bar { height: 6px; background: rgba(255,255,255,0.1); border-radius: 99px; overflow: hidden; margin-top: 4px; }
        .mig-bar > i { display: block; height: 100%; border-radius: 99px; transition: width 0.5s ease; }
        .mig-toast { position: fixed; top: 70px; left: 50%; transform: translateX(-50%) translateY(-100px); z-index: 99999; padding: 11px 22px; border-radius: 12px; font-weight: 700; font-family: 'Cairo',sans-serif; transition: transform 0.4s ease; color: #fff; box-shadow: 0 10px 28px rgba(0,0,0,0.35); }
        .mig-toast.mig-show { transform: translateX(-50%) translateY(0); }
        .mig-toast.ok { background: rgba(16,185,129,0.95); }
        .mig-toast.err { background: rgba(239,68,68,0.95); }
        .mig-foot { text-align: center; margin-top: 14px; }
        .mig-alert .alert { margin-bottom: 12px; }
        .mig-active-banner { display: none; border: 1px solid rgba(129,140,248,0.45); background: rgba(99,102,241,0.12); border-radius: 12px; padding: 14px 14px 12px; margin-bottom: 12px; }
        .mig-active-banner.mig-on { display: block; }
        .mig-active-stale { color: #fcd34d; font-size: 0.78rem; font-weight: 700; margin-top: 8px; }
        .mig-active-row { display: flex; flex-wrap: wrap; gap: 10px 18px; align-items: center; margin-top: 10px; font-size: 0.88rem; }
        .mig-active-row strong { color: #e2e8f0; }

        /* Danger zone */
        .mig-danger-card { border: 1.5px solid rgba(239,68,68,0.55); background: rgba(127,29,29,0.18); border-radius: 16px; padding: 18px; margin-top: 22px; }
        .mig-danger-card .mig-card-head { color: #fca5a5; }
        .mig-danger-intro { font-size: 0.85rem; color: rgba(254,226,226,0.85); margin-bottom: 12px; line-height: 1.6; }
        .mig-danger-stats { display: flex; gap: 14px; flex-wrap: wrap; margin: 10px 0 14px; font-size: 0.82rem; }
        .mig-danger-stat { background: rgba(0,0,0,0.25); padding: 8px 12px; border-radius: 10px; border: 1px solid rgba(239,68,68,0.25); }
        .mig-danger-stat strong { color: #fecaca; font-size: 1.05rem; }

        /* Wipe modal */
        .mig-modal-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,0.7); z-index: 99000; display: none; align-items: center; justify-content: center; padding: 16px; }
        .mig-modal-backdrop.mig-on { display: flex; }
        .mig-modal { background: #1e1b3a; color: #f1f5f9; border-radius: 18px; padding: 24px; width: 100%; max-width: 560px; border: 2px solid rgba(239,68,68,0.55); box-shadow: 0 20px 60px rgba(0,0,0,0.6); font-family: 'Cairo', sans-serif; direction: rtl; text-align: right; max-height: 92vh; overflow-y: auto; }
        .mig-modal[dir="ltr"] { direction: ltr; text-align: left; }
        .mig-modal h2 { margin: 0 0 12px; font-size: 1.25rem; color: #fecaca; font-weight: 800; }
        .mig-modal-warn { background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.35); border-radius: 10px; padding: 12px; font-size: 0.88rem; color: #fecaca; margin-bottom: 14px; line-height: 1.6; }
        .mig-modal-tables { background: rgba(0,0,0,0.3); border-radius: 10px; padding: 10px; max-height: 140px; overflow-y: auto; font-family: ui-monospace, monospace; font-size: 0.72rem; color: rgba(255,255,255,0.65); margin-bottom: 14px; direction: ltr; text-align: left; }
        .mig-modal-tables span { display: inline-block; padding: 2px 8px; margin: 2px; background: rgba(239,68,68,0.12); border-radius: 6px; }
        .mig-modal label { display: block; font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.85); margin-bottom: 6px; }
        .mig-modal input[type="text"] { width: 100%; padding: 11px 14px; background: rgba(0,0,0,0.35); border: 2px solid rgba(255,255,255,0.18); border-radius: 10px; color: #fff; font-family: 'Cairo', sans-serif; font-size: 0.95rem; outline: none; margin-bottom: 14px; transition: border-color 0.2s; }
        .mig-modal input[type="text"]:focus { border-color: rgba(239,68,68,0.7); }
        .mig-modal input[type="text"].mig-match { border-color: rgba(16,185,129,0.7); }
        .mig-modal-phrase { display: inline-block; padding: 4px 10px; background: rgba(239,68,68,0.18); border: 1px dashed rgba(239,68,68,0.55); border-radius: 8px; font-weight: 800; color: #fecaca; margin: 0 4px; user-select: all; }
        .mig-modal-check { display: flex; align-items: flex-start; gap: 8px; font-size: 0.85rem; color: rgba(255,255,255,0.85); margin-bottom: 16px; cursor: pointer; line-height: 1.5; }
        .mig-modal-check input { margin-top: 3px; flex-shrink: 0; }
        .mig-modal-actions { display: flex; gap: 10px; justify-content: flex-end; flex-wrap: wrap; }
    </style>
@endpush

@section('content')
    <div class="col-12">
        <div id="mig-toast" class="mig-toast" role="status"></div>

        <div class="mig-hub mig-alert" @if(App::getLocale() !== 'ar') dir="ltr" @endif>
            <h1>{{ __('customer_migration.simple_page_title') }}</h1>
            <p class="mig-sub">{{ __('customer_migration.simple_page_subtitle') }}</p>

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
            @if (! $enabled)
                <div class="alert alert-danger">{{ __('customer_migration.disabled') }}</div>
            @endif

            {{-- 1: Domains (read-only inputs — focusable, edit on pairing page) --}}
            <div class="mig-card">
                <div class="mig-card-head"><span aria-hidden="true">🌐</span> {{ __('customer_migration.card_domain_title') }}</div>
                <p class="mig-hint" style="margin-top:-6px;margin-bottom:12px;">
                    <span class="mig-lbl-tag">{{ __('customer_migration.saved_values_badge') }}</span>
                    {{ __('customer_migration.readonly_fields_explain') }}
                </p>
                <div class="mig-row2">
                    <div>
                        <label class="mig-lbl" for="mig-ro-legacy">📌 {{ __('customer_migration.readonly_legacy_domain') }}</label>
                        <input type="text" id="mig-ro-legacy" class="mig-readonly-field mig-mono" readonly tabindex="0"
                            value="{{ e($effectiveLegacyDomain !== '' ? $effectiveLegacyDomain : ($effectiveLegacyBaseUrl !== '' ? $effectiveLegacyBaseUrl : '')) }}"
                            placeholder="—">
                    </div>
                    <div>
                        <label class="mig-lbl" for="mig-ro-newdom">📌 {{ __('customer_migration.readonly_new_domain') }}</label>
                        <input type="text" id="mig-ro-newdom" class="mig-readonly-field mig-mono" readonly tabindex="0"
                            value="{{ e($effectiveNewSystemDomain !== '' ? $effectiveNewSystemDomain : '') }}"
                            placeholder="—">
                    </div>
                </div>
                @if ($effectiveNewSystemUrl !== '')
                    <p class="mig-hint mig-mono" dir="ltr" style="margin-top: 12px;">
                        {{ __('customer_migration.hub_derived_public_url_caption') }}
                        <span style="color:#bae6fd;">{{ e($effectiveNewSystemUrl) }}</span>
                    </p>
                @else
                    <p class="mig-hint" style="margin-top: 12px;">{{ __('customer_migration.hub_derived_public_url_empty') }}</p>
                @endif
                <div class="mig-btn-row mig-row-start">
                    <a href="{{ route('managers.settings.customer-migration.pairing-edit') }}" class="mig-btn mig-btn-purple">
                        💾 {{ __('customer_migration.btn_save_pairing') }}
                    </a>
                    <button type="button" class="mig-btn mig-btn-cyan" id="cm-conn-refresh-btn">
                        🔍 {{ __('customer_migration.connectivity_refresh') }}
                    </button>
                </div>
                <p class="mig-hint mb-0">
                    <a class="mig-link" href="{{ route('managers.settings.customer-migration.pairing-edit') }}">{{ __('customer_migration.pairing_edit_link_short') }}</a>
                    — {{ __('customer_migration.hub_readonly_hint') }}
                </p>
                <div class="mig-conn-line">
                    <span>{{ __('customer_migration.connectivity_to_legacy') }}:</span>
                    <span id="cm-conn-legacy">…</span>
                </div>
                <div class="mig-conn-line">
                    <span>{{ __('customer_migration.connectivity_to_new_public') }}:</span>
                    <span id="cm-conn-new">…</span>
                </div>
            </div>

            {{-- 2: Billing + verify --}}
            <div class="mig-card">
                <div class="mig-card-head"><span aria-hidden="true">💳</span> {{ __('customer_migration.card_billing_title') }}</div>
                <form method="post" action="{{ route('managers.settings.customer-migration.start') }}" id="mig-start-form">
                    @csrf
                    <span class="mig-lbl">🔑 {{ __('customer_migration.billing_code') }}</span>
                    <input type="text" name="billing_code" id="billing_code" class="mig-input-real" maxlength="64" dir="ltr"
                        value="{{ old('billing_code') }}" required autocomplete="off" placeholder="{{ __('customer_migration.billing_placeholder') }}">
                    <p class="mig-hint">{{ __('customer_migration.billing_code_help') }}</p>
                    <div class="mig-btn-row">
                        <button type="button" class="mig-btn mig-btn-orange" id="cm-btn-verify">
                            ✅ {{ __('customer_migration.btn_verify_short') }}
                        </button>
                    </div>
                    <div id="mig-customer" class="mig-customer" aria-live="polite">
                        <div class="mig-av" id="mig-av">؟</div>
                        <div>
                            <h4 id="mig-cname">—</h4>
                            <p id="mig-cmeta">—</p>
                        </div>
                    </div>
                </form>
            </div>

            {{-- 3: Start transfer --}}
            <div class="mig-card">
                <div class="mig-card-head"><span aria-hidden="true">🚀</span> {{ __('customer_migration.card_start_title') }}</div>
                <p class="mig-hint">{{ __('customer_migration.card_start_hint') }}</p>
                <div class="mig-btn-row">
                    <button type="submit" form="mig-start-form" class="mig-btn mig-btn-green" @if (! $enabled) disabled @endif>
                        🚀 {{ __('customer_migration.start') }}
                    </button>
                </div>
                <p class="mig-hint mb-0">{{ __('customer_migration.queue_hint') }}</p>
            </div>

            <div class="mig-card mig-active-banner" id="mig-active-wrap" aria-live="polite">
                <div class="mig-card-head"><span aria-hidden="true">⚡</span> {{ __('customer_migration.active_job_title') }}</div>
                <p class="mig-hint" style="margin-top:-6px;">{{ __('customer_migration.active_job_intro') }}</p>
                <p class="mig-active-stale" id="mig-active-stale" style="display:none;"></p>
                <div class="mig-active-row">
                    <span><strong>{{ __('customer_migration.active_job_billing') }}:</strong> <span class="mig-mono" dir="ltr" id="mig-active-bc">—</span></span>
                    <span><strong>{{ __('customer_migration.active_job_status') }}:</strong> <span id="mig-active-st">—</span></span>
                    <span><strong>{{ __('customer_migration.active_job_progress') }}:</strong> <span id="mig-active-pct">0</span>%</span>
                    <span id="mig-active-phase-wrap" style="display:none;"><strong>{{ __('customer_migration.active_job_phase') }}:</strong> <span id="mig-active-ph">—</span></span>
                </div>
                <div class="mig-btn-row mig-row-start" style="margin-top:14px;">
                    <button type="button" class="mig-btn mig-btn-amber" id="mig-btn-pause" disabled>⏸ {{ __('customer_migration.btn_pause') }}</button>
                    <button type="button" class="mig-btn mig-btn-green" id="mig-btn-resume" disabled>▶ {{ __('customer_migration.btn_resume') }}</button>
                    <button type="button" class="mig-btn mig-btn-red" id="mig-btn-cancel" disabled>✕ {{ __('customer_migration.btn_cancel') }}</button>
                    <a href="#" class="mig-btn mig-btn-cyan" id="mig-active-detail" style="display:none;" target="_blank" rel="noopener noreferrer">{{ __('customer_migration.active_job_link') }}</a>
                </div>
            </div>

            {{-- 4: Stats --}}
            <div class="mig-card" id="mig-stats-card">
                <div class="mig-card-head"><span aria-hidden="true">📊</span> {{ __('customer_migration.stats_title') }}</div>
                <p class="mig-hint">{{ __('customer_migration.stats_live_hint') }}</p>
                <div class="mig-stats3" id="mig-stats-summary">
                    <div class="mig-sc">
                        <div class="n n-b" id="mig-s-cli">{{ (int) ($sum['clients']['done'] ?? 0) }}</div>
                        <div class="lb">{{ __('customer_migration.stats_clients_short') }}</div>
                        <div class="fr" id="mig-s-cli-fr">{{ (int) ($sum['clients']['done'] ?? 0) }} / {{ (int) ($sum['clients']['total'] ?? 1) }}</div>
                    </div>
                    <div class="mig-sc">
                        <div class="n n-g" id="mig-s-car">{{ (int) ($sum['cards']['done'] ?? 0) }}</div>
                        <div class="lb">{{ __('customer_migration.stats_cards_label') }}</div>
                        <div class="fr" id="mig-s-car-fr">{{ (int) ($sum['cards']['done'] ?? 0) }} / {{ (int) ($sum['cards']['total'] ?? 1) }}</div>
                    </div>
                    <div class="mig-sc">
                        <div class="n n-p" id="mig-s-dis">{{ (int) ($sum['distributors']['done'] ?? 0) }}</div>
                        <div class="lb">{{ __('customer_migration.stats_distributors_label') }}</div>
                        <div class="fr" id="mig-s-dis-fr">{{ (int) ($sum['distributors']['done'] ?? 0) }} / {{ (int) ($sum['distributors']['total'] ?? 45) }}</div>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <table class="mig-tbl" id="mig-stats-table">
                        <thead>
                            <tr>
                                <th>{{ __('customer_migration.stats_col_type') }}</th>
                                <th>{{ __('customer_migration.stats_col_done') }}</th>
                                <th>{{ __('customer_migration.stats_col_total') }}</th>
                                <th>{{ __('customer_migration.stats_col_pct') }}</th>
                                <th>{{ __('customer_migration.stats_col_bar') }}</th>
                            </tr>
                        </thead>
                        <tbody id="mig-stats-tbody">
                            @foreach ($rows as $r)
                                <tr data-key="{{ $r['key'] }}">
                                    <td><strong>{{ $r['label'] }}</strong></td>
                                    <td>{{ (int) $r['done'] }}</td>
                                    <td>{{ (int) $r['total'] }}</td>
                                    <td><strong style="color:{{ $r['color'] }}">{{ (int) $r['pct'] }}%</strong></td>
                                    <td style="min-width:100px;">
                                        <div class="mig-bar"><i style="width:{{ (int) $r['pct'] }}%;background:{{ $r['color'] }}"></i></div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="mig-hint mb-0">{{ __('customer_migration.stats_demo_note') }}</p>
            </div>

            <div class="mig-foot">
                <a class="mig-link" href="{{ route('managers.scrape.index') }}">{{ __('customer_migration.jobs_log_link') }}</a>
            </div>

            {{-- DANGER ZONE: wipe all networks --}}
            @php
                $wipeTablesList = $wipeTenantTables ?? [];
                $wipeCountsList = $wipeCounts ?? [];
                $wipeTotalRows = (int) array_sum(array_filter($wipeCountsList, fn ($v) => $v >= 0));
                $wipeNonEmptyTables = count(array_filter($wipeCountsList, fn ($v) => $v > 0));
            @endphp
            <div class="mig-card mig-danger-card">
                <div class="mig-card-head"><span aria-hidden="true">🚨</span> {{ __('customer_migration.danger_zone_title') }}</div>
                <p class="mig-danger-intro">{{ __('customer_migration.danger_zone_intro') }}</p>

                <div class="mig-card" style="background: rgba(0,0,0,0.18); margin-bottom: 0;">
                    <div class="mig-card-head" style="font-size: 0.95rem;">
                        <span aria-hidden="true">🗑</span> {{ __('customer_migration.wipe_card_title') }}
                    </div>
                    <p class="mig-hint" style="margin-top:-6px;">{{ __('customer_migration.wipe_card_intro') }}</p>

                    <div class="mig-danger-stats">
                        <div class="mig-danger-stat">
                            {{ __('customer_migration.wipe_total_rows', ['n' => number_format($wipeTotalRows)]) }}
                        </div>
                        <div class="mig-danger-stat">
                            <strong>{{ $wipeNonEmptyTables }}</strong> / {{ count($wipeTablesList) }}
                            {{ __('customer_migration.wipe_tables_preview', ['n' => count($wipeTablesList)]) }}
                        </div>
                    </div>

                    <div class="mig-btn-row mig-row-start">
                        <button type="button" class="mig-btn mig-btn-red" id="mig-btn-wipe-open"
                            @if ($wipeTotalRows === 0) disabled title="No data to wipe" @endif>
                            {{ __('customer_migration.wipe_btn_open') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Wipe confirmation modal --}}
    <div class="mig-modal-backdrop" id="mig-wipe-modal" role="dialog" aria-modal="true" aria-labelledby="mig-wipe-modal-title">
        <div class="mig-modal" @if(App::getLocale() !== 'ar') dir="ltr" @endif>
            <h2 id="mig-wipe-modal-title">🚨 {{ __('customer_migration.wipe_modal_title') }}</h2>

            <div class="mig-modal-warn">
                {!! __('customer_migration.wipe_modal_warning', [
                    'rows' => '<strong>'.number_format($wipeTotalRows).'</strong>',
                    'tables' => '<strong>'.$wipeNonEmptyTables.'</strong>',
                ]) !!}
            </div>

            <div class="mig-modal-tables" aria-label="Tables list">
                @foreach ($wipeTablesList as $t)
                    @php $cnt = (int) ($wipeCountsList[$t] ?? 0); @endphp
                    <span @if ($cnt > 0) style="background: rgba(239,68,68,0.2); color:#fecaca;" @endif>
                        {{ $t }}@if ($cnt > 0) ({{ number_format($cnt) }}) @endif
                    </span>
                @endforeach
            </div>

            <form method="post" action="{{ route('managers.settings.customer-migration.wipe-all-networks') }}" id="mig-wipe-form">
                @csrf
                <label for="mig-wipe-phrase">
                    {{ __('customer_migration.wipe_modal_phrase_label') }}
                    <span class="mig-modal-phrase">{{ __('customer_migration.wipe_confirm_phrase') }}</span>
                </label>
                <input type="text" id="mig-wipe-phrase" name="confirm_phrase"
                    autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false"
                    data-expected="{{ __('customer_migration.wipe_confirm_phrase') }}">

                <label class="mig-modal-check" for="mig-wipe-check">
                    <input type="checkbox" id="mig-wipe-check" name="confirm_checkbox" value="1">
                    <span>{{ __('customer_migration.wipe_modal_checkbox') }}</span>
                </label>

                <div class="mig-modal-actions">
                    <button type="button" class="mig-btn mig-btn-purple" id="mig-wipe-cancel">
                        {{ __('customer_migration.wipe_modal_cancel') }}
                    </button>
                    <button type="submit" class="mig-btn mig-btn-red" id="mig-wipe-submit" disabled>
                        {{ __('customer_migration.wipe_modal_submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @php
        $customerMigrationScriptJobStatusLabels = [
            'pending' => __('customer_migration.job_status_pending'),
            'exporting' => __('customer_migration.job_status_exporting'),
            'importing' => __('customer_migration.job_status_importing'),
            'paused' => __('customer_migration.job_status_paused'),
            'completed' => __('customer_migration.job_status_completed'),
            'failed' => __('customer_migration.job_status_failed'),
            'partial' => __('customer_migration.job_status_partial'),
            'cancelled' => __('customer_migration.job_status_cancelled'),
        ];
        $customerMigrationScriptPhaseLabels = [
            'network' => __('customer_migration.phase_network'),
            'offers' => __('customer_migration.phase_offers'),
            'nas' => __('customer_migration.phase_nas'),
            'users' => __('customer_migration.phase_users'),
            'card_groups' => __('customer_migration.phase_card_groups'),
            'cards' => __('customer_migration.phase_cards'),
            'invoices' => __('customer_migration.phase_invoices'),
            'finalize' => __('customer_migration.phase_finalize'),
        ];
    @endphp
    <script>
        (function () {
            var statsUrl = @json(route('managers.settings.customer-migration.stats-json'));
            var connUrl = @json(route('managers.settings.customer-migration.connectivity'));
            var verifyUrl = @json(route('managers.settings.customer-migration.verify-both'));
            var migUrls = @json($migrationJobUrlTemplates ?? []);
            var jobStatusLabels = @json($customerMigrationScriptJobStatusLabels);
            var phaseLabels = @json($customerMigrationScriptPhaseLabels);
            var staleHint = @json(__('customer_migration.active_job_stale_hint'));
            var csrf = document.querySelector('meta[name="csrf-token"]');
            var csrfV = csrf ? csrf.getAttribute('content') : '';

            function toast(msg, err) {
                var t = document.getElementById('mig-toast');
                if (!t) return;
                t.textContent = msg;
                t.className = 'mig-toast ' + (err ? 'err' : 'ok');
                requestAnimationFrame(function () { t.classList.add('mig-show'); });
                setTimeout(function () { t.classList.remove('mig-show'); }, 2800);
            }

            @if (session('status'))
            toast(@json(session('status')), false);
            @endif

            function esc(s) {
                return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
            }

            function pill(ok, text) {
                var c = ok ? 'mig-pill mig-pill-ok' : 'mig-pill mig-pill-bad';
                return '<span class="' + c + '">' + esc(text) + '</span>';
            }

            function runConn() {
                var a = document.getElementById('cm-conn-legacy');
                var b = document.getElementById('cm-conn-new');
                if (a) a.textContent = '…';
                if (b) b.textContent = '…';
                fetch(connUrl, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, credentials: 'same-origin' })
                    .then(function (r) { return r.json(); })
                    .then(function (d) {
                        if (a) a.innerHTML = pill(!!(d.legacy && d.legacy.ok), (d.legacy && d.legacy.status_label) || '');
                        if (b) b.innerHTML = pill(!!(d.new_system && d.new_system.ok), (d.new_system && d.new_system.status_label) || '');
                    })
                    .catch(function () {
                        if (a) a.innerHTML = pill(false, @json(__('customer_migration.connectivity_request_failed')));
                        if (b) b.innerHTML = '';
                    });
            }

            function tplUrl(t, id) {
                if (!t || id == null) return '';
                return String(t).split('__JOB__').join(String(id));
            }

            var activeJobId = null;

            function setActiveJobControls(aj) {
                var wrap = document.getElementById('mig-active-wrap');
                var staleEl = document.getElementById('mig-active-stale');
                var bc = document.getElementById('mig-active-bc');
                var st = document.getElementById('mig-active-st');
                var pct = document.getElementById('mig-active-pct');
                var phWrap = document.getElementById('mig-active-phase-wrap');
                var ph = document.getElementById('mig-active-ph');
                var btnP = document.getElementById('mig-btn-pause');
                var btnR = document.getElementById('mig-btn-resume');
                var btnC = document.getElementById('mig-btn-cancel');
                var det = document.getElementById('mig-active-detail');
                if (!wrap) return;
                if (!aj || !aj.id) {
                    wrap.classList.remove('mig-on');
                    activeJobId = null;
                    if (staleEl) { staleEl.style.display = 'none'; staleEl.textContent = ''; }
                    return;
                }
                activeJobId = aj.id;
                wrap.classList.add('mig-on');
                if (bc) bc.textContent = aj.billing_code || '';
                if (st) st.textContent = jobStatusLabels[aj.status] || aj.status;
                if (pct) pct.textContent = aj.progress_percent != null ? String(aj.progress_percent) : '0';
                if (aj.next_import_phase && phWrap && ph) {
                    phWrap.style.display = '';
                    ph.textContent = phaseLabels[aj.next_import_phase] || aj.next_import_phase;
                } else if (phWrap) {
                    phWrap.style.display = 'none';
                }
                if (staleEl) {
                    if (aj.stale_pending) {
                        staleEl.style.display = 'block';
                        staleEl.textContent = staleHint;
                    } else {
                        staleEl.style.display = 'none';
                        staleEl.textContent = '';
                    }
                }
                var running = aj.status === 'pending' || aj.status === 'exporting' || aj.status === 'importing';
                var paused = aj.status === 'paused';
                if (btnP) { btnP.disabled = !running; }
                if (btnR) { btnR.disabled = !paused; }
                if (btnC) { btnC.disabled = !(running || paused); }
                if (det && migUrls.show) {
                    det.href = tplUrl(migUrls.show, aj.id);
                    det.style.display = 'inline-flex';
                }
            }

            function postJobAction(url) {
                return fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfV,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin',
                    body: '{}'
                }).then(function (r) { return r.json().then(function (j) { return { ok: r.ok, j: j }; }); });
            }

            function applyStats(d) {
                if (!d || !d.summary || !d.table_rows) return;
                if ('active_job' in d) {
                    setActiveJobControls(d.active_job);
                }
                var s = d.summary;
                document.getElementById('mig-s-cli').textContent = s.clients.done;
                document.getElementById('mig-s-cli-fr').textContent = s.clients.done + ' / ' + s.clients.total;
                document.getElementById('mig-s-car').textContent = s.cards.done;
                document.getElementById('mig-s-car-fr').textContent = s.cards.done + ' / ' + s.cards.total;
                document.getElementById('mig-s-dis').textContent = s.distributors.done;
                document.getElementById('mig-s-dis-fr').textContent = s.distributors.done + ' / ' + s.distributors.total;
                var tb = document.getElementById('mig-stats-tbody');
                if (!tb) return;
                tb.innerHTML = '';
                d.table_rows.forEach(function (r) {
                    var tr = document.createElement('tr');
                    tr.setAttribute('data-key', r.key);
                    tr.innerHTML = '<td><strong>' + esc(r.label) + '</strong></td><td>' + r.done + '</td><td>' + r.total + '</td><td><strong style="color:' + esc(r.color) + '">' + r.pct + '%</strong></td><td style="min-width:100px;"><div class="mig-bar"><i style="width:' + r.pct + '%;background:' + esc(r.color) + '"></i></div></td>';
                    tb.appendChild(tr);
                });
            }

            function pollStats() {
                fetch(statsUrl, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }, credentials: 'same-origin' })
                    .then(function (r) { return r.json(); })
                    .then(applyStats)
                    .catch(function () {});
            }

            runConn();
            setInterval(runConn, 30000);
            var connBtn = document.getElementById('cm-conn-refresh-btn');
            if (connBtn) connBtn.addEventListener('click', runConn);
            setInterval(pollStats, 5000);
            pollStats();

            var btnPause = document.getElementById('mig-btn-pause');
            var btnResume = document.getElementById('mig-btn-resume');
            var btnCancel = document.getElementById('mig-btn-cancel');
            var ctrlOk = @json(__('customer_migration.control_ok_toast'));
            var ctrlErr = @json(__('customer_migration.control_err_toast'));
            if (btnPause) btnPause.addEventListener('click', function () {
                if (!activeJobId || !migUrls.pause) return;
                postJobAction(tplUrl(migUrls.pause, activeJobId)).then(function (x) {
                    toast(x.ok ? ctrlOk : (x.j && x.j.message ? String(x.j.message) : ctrlErr), !x.ok);
                    pollStats();
                }).catch(function () { toast(ctrlErr, true); });
            });
            if (btnResume) btnResume.addEventListener('click', function () {
                if (!activeJobId || !migUrls.resume) return;
                postJobAction(tplUrl(migUrls.resume, activeJobId)).then(function (x) {
                    toast(x.ok ? ctrlOk : (x.j && x.j.message ? String(x.j.message) : ctrlErr), !x.ok);
                    pollStats();
                }).catch(function () { toast(ctrlErr, true); });
            });
            if (btnCancel) btnCancel.addEventListener('click', function () {
                if (!activeJobId || !migUrls.cancel) return;
                if (!window.confirm(@json(__('customer_migration.cancel_confirm')))) return;
                postJobAction(tplUrl(migUrls.cancel, activeJobId)).then(function (x) {
                    toast(x.ok ? ctrlOk : (x.j && x.j.message ? String(x.j.message) : ctrlErr), !x.ok);
                    pollStats();
                }).catch(function () { toast(ctrlErr, true); });
            });

            var billingEl = document.getElementById('billing_code');
            var verifyBtn = document.getElementById('cm-btn-verify');
            var cust = document.getElementById('mig-customer');
            var av = document.getElementById('mig-av');
            var nm = document.getElementById('mig-cname');
            var mt = document.getElementById('mig-cmeta');
            var foundL = @json(__('customer_migration.explore_found'));
            var missL = @json(__('customer_migration.explore_not_found'));
            var needB = @json(__('customer_migration.billing_required_tools'));
            var failL = @json(__('customer_migration.connectivity_request_failed'));
            var lblLeg = @json(__('customer_migration.verify_legacy_label'));
            var lblLoc = @json(__('customer_migration.verify_local_label'));

            function fmtNet(net) {
                if (!net || typeof net !== 'object') return '';
                var p = [];
                if (net.name) p.push(String(net.name));
                if (net.plan_name) p.push(String(net.plan_name));
                if (net.customer_name) p.push(String(net.customer_name));
                return p.join(' · ');
            }

            if (verifyBtn) verifyBtn.addEventListener('click', function () {
                var bc = billingEl && billingEl.value ? String(billingEl.value).trim() : '';
                if (!bc) { toast(needB, true); return; }
                fetch(verifyUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfV,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ billing_code: bc })
                }).then(function (r) { return r.json().then(function (j) { return { ok: r.ok, j: j }; }); })
                    .then(function (x) {
                        if (x.ok && x.j.legacy && x.j.legacy.network && x.j.legacy.network.name) {
                            var leg = x.j.legacy.network;
                            var n = String(leg.name);
                            av.textContent = n.charAt(0) || '?';
                            nm.textContent = n;
                            var parts = ['billing_code: ' + bc, lblLeg + ': ' + fmtNet(leg)];
                            if (x.j.local && x.j.local.network) {
                                parts.push(lblLoc + ': ' + fmtNet(x.j.local.network));
                            }
                            mt.textContent = parts.join(' · ');
                            cust.classList.add('mig-on');
                            toast(@json(__('customer_migration.verify_ok_toast')), false);
                        } else {
                            cust.classList.remove('mig-on');
                            var err = (x.j.legacy_error && String(x.j.legacy_error)) || (x.j.message && String(x.j.message)) || failL;
                            toast(err, true);
                        }
                    })
                    .catch(function () { toast(failL, true); });
            });
        })();
    </script>

    {{-- Wipe-all-networks modal logic --}}
    <script>
        (function () {
            var openBtn = document.getElementById('mig-btn-wipe-open');
            var modal = document.getElementById('mig-wipe-modal');
            var cancelBtn = document.getElementById('mig-wipe-cancel');
            var phraseInput = document.getElementById('mig-wipe-phrase');
            var checkbox = document.getElementById('mig-wipe-check');
            var submitBtn = document.getElementById('mig-wipe-submit');
            var form = document.getElementById('mig-wipe-form');
            if (!openBtn || !modal || !phraseInput || !checkbox || !submitBtn || !form) return;

            var expected = (phraseInput.getAttribute('data-expected') || '').trim();

            function normalize(s) {
                return String(s || '').replace(/\s+/g, ' ').trim();
            }

            function refreshGate() {
                var match = normalize(phraseInput.value) === normalize(expected) && normalize(expected) !== '';
                phraseInput.classList.toggle('mig-match', match);
                submitBtn.disabled = !(match && checkbox.checked);
            }

            function openModal() {
                phraseInput.value = '';
                checkbox.checked = false;
                refreshGate();
                modal.classList.add('mig-on');
                setTimeout(function () { phraseInput.focus(); }, 80);
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.classList.remove('mig-on');
                document.body.style.overflow = '';
            }

            openBtn.addEventListener('click', openModal);
            cancelBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', function (e) {
                if (e.target === modal) closeModal();
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && modal.classList.contains('mig-on')) closeModal();
            });

            phraseInput.addEventListener('input', refreshGate);
            checkbox.addEventListener('change', refreshGate);

            form.addEventListener('submit', function (e) {
                if (submitBtn.disabled) {
                    e.preventDefault();
                    return;
                }
                submitBtn.disabled = true;
                submitBtn.textContent = '⏳ …';
            });
        })();
    </script>
@endpush
