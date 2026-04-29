@extends('backend.layouts.manger')

@section('content')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-1"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @livewire('manager-network-index')
    @livewire('network-panel')

    {{-- Wipe-all-networks confirmation modal (kept outside the Livewire
         component so the component still has a single root element). --}}
    @auth('admin')
        @php
            $__wipeAdmin = auth('admin')->user();
            $__canWipe = $__wipeAdmin && in_array($__wipeAdmin->type, [
                \App\ENUMS\AdminTypeEnum::TYPE_MANGER,
                \App\ENUMS\AdminTypeEnum::TYPE_SUPER_MANGER,
            ], true);
        @endphp
        @if ($__canWipe)
            @php
                $__wiper = app(\App\Services\Migration\NetworkDataWiper::class);
                $__wipeTables = \App\Services\Migration\NetworkDataWiper::TENANT_TABLES;
                $__wipeCounts = $__wiper->collectCounts();
                $__wipeTotalRows = (int) array_sum(array_filter($__wipeCounts, fn ($v) => $v >= 0));
                $__wipeNonEmpty = count(array_filter($__wipeCounts, fn ($v) => $v > 0));
                $__wipePhrase = (string) __('customer_migration.wipe_confirm_phrase');
            @endphp
            <div class="modal fade" id="wipeAllNetworksModal" tabindex="-1"
                aria-labelledby="wipeAllNetworksModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-danger">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title fw-bold" id="wipeAllNetworksModalLabel">
                                <i class="fa fa-exclamation-triangle me-1"></i>
                                {{ __('customer_migration.wipe_modal_title') }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route('managers.settings.customer-migration.wipe-all-networks') }}"
                            id="wipeAllNetworksForm">
                            @csrf
                            <div class="modal-body">
                                <div class="alert alert-danger">
                                    {!! __('customer_migration.wipe_modal_warning', [
                                        'rows' => '<strong>'.number_format($__wipeTotalRows).'</strong>',
                                        'tables' => '<strong>'.$__wipeNonEmpty.'</strong>',
                                    ]) !!}
                                </div>

                                <div class="mb-3">
                                    <small class="text-muted d-block mb-2">
                                        {{ __('customer_migration.wipe_tables_preview', ['n' => count($__wipeTables)]) }}
                                    </small>
                                    <div style="max-height:140px;overflow-y:auto;background:rgba(0,0,0,0.04);border-radius:8px;padding:8px;direction:ltr;text-align:left;font-size:11px;font-family:ui-monospace,monospace;">
                                        @foreach ($__wipeTables as $__t)
                                            @php $__cnt = (int) ($__wipeCounts[$__t] ?? 0); @endphp
                                            <span class="badge {{ $__cnt > 0 ? 'bg-danger' : 'bg-secondary' }} me-1 mb-1"
                                                style="opacity:{{ $__cnt > 0 ? 1 : 0.55 }}">
                                                {{ $__t }}@if ($__cnt > 0) ({{ number_format($__cnt) }}) @endif
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="wipe_confirm_phrase" class="form-label fw-bold">
                                        {{ __('customer_migration.wipe_modal_phrase_label') }}
                                    </label>
                                    <div class="alert alert-warning text-center fw-bold py-2 mb-2"
                                        style="user-select:all;">
                                        {{ $__wipePhrase }}
                                    </div>
                                    <input type="text" class="form-control form-control-lg" id="wipe_confirm_phrase"
                                        name="confirm_phrase" autocomplete="off" autocapitalize="off"
                                        autocorrect="off" spellcheck="false" data-expected="{{ $__wipePhrase }}"
                                        dir="auto">
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="wipe_confirm_checkbox"
                                        name="confirm_checkbox" value="1">
                                    <label class="form-check-label" for="wipe_confirm_checkbox">
                                        {{ __('customer_migration.wipe_modal_checkbox') }}
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    {{ __('customer_migration.wipe_modal_cancel') }}
                                </button>
                                <button type="submit" class="btn btn-danger fw-bold" id="wipeAllNetworksSubmit"
                                    disabled>
                                    <i class="fa fa-trash me-1"></i>
                                    {{ __('customer_migration.wipe_modal_submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/distributor_index.js') }}"></script>
    <script>
        (function () {
            if (window.__wipeAllNetworksBound) return;
            window.__wipeAllNetworksBound = true;
            document.addEventListener('DOMContentLoaded', function () {
                var phraseInput = document.getElementById('wipe_confirm_phrase');
                var checkbox = document.getElementById('wipe_confirm_checkbox');
                var submitBtn = document.getElementById('wipeAllNetworksSubmit');
                var form = document.getElementById('wipeAllNetworksForm');
                if (!phraseInput || !checkbox || !submitBtn || !form) return;

                var expected = (phraseInput.getAttribute('data-expected') || '').trim();

                function normalize(s) {
                    return String(s || '').replace(/\s+/g, ' ').trim();
                }

                function refreshGate() {
                    var match = normalize(phraseInput.value) === normalize(expected) && normalize(expected) !== '';
                    phraseInput.classList.toggle('is-valid', match);
                    phraseInput.classList.toggle('is-invalid', phraseInput.value.length > 0 && !match);
                    submitBtn.disabled = !(match && checkbox.checked);
                }

                phraseInput.addEventListener('input', refreshGate);
                checkbox.addEventListener('change', refreshGate);

                var modalEl = document.getElementById('wipeAllNetworksModal');
                if (modalEl) {
                    modalEl.addEventListener('shown.bs.modal', function () {
                        phraseInput.value = '';
                        checkbox.checked = false;
                        refreshGate();
                        phraseInput.focus();
                    });
                }

                form.addEventListener('submit', function (e) {
                    if (submitBtn.disabled) {
                        e.preventDefault();
                        return;
                    }
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-1"></i> ...';
                });
            });
        })();
    </script>
@endpush
