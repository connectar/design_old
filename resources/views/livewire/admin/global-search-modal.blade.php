<div class="admin-global-search-lw">
    @php
        use App\ENUMS\QuestionTypeEnum;
    @endphp
    <x-modals.modal show="{{ $show }}" maxWidth="4xl" withBorders="border:1px solid rgba(0,0,0,0.1)">
        <x-slot name="title">
            <div class="ags-modal-title d-flex align-items-center justify-content-between flex-wrap">
                <h2 class="fs-20 text-warning fw-bold mb-0">
                    <i class="fa fa-search ml-1" aria-hidden="true"></i>{{ __('new_trans.global_search.title') }}
                </h2>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="ags-modal text-right" dir="auto">
                <div class="ags-search-row mb-3">
                    <div class="input-group input-group-lg ags-input-group shadow-sm">
                        <input type="search"
                            class="form-control admin-global-search-modal-input border-right-0"
                            wire:model.live.debounce.400ms="search"
                            data-voice-search-skip="1"
                            placeholder="{{ __('new_trans.global_search.placeholder') }}"
                            aria-label="{{ __('new_trans.global_search.title') }}"
                            autocomplete="off">
                        <div class="input-group-append">
                            <button type="button"
                                class="btn admin-global-search-mic border-left-0 js-admin-global-search-modal-mic"
                                title="{{ __('new_trans.voice_search.mic_aria') }}"
                                aria-label="{{ __('new_trans.voice_search.mic_aria') }}"
                                aria-pressed="false">
                                <i class="fa fa-microphone" aria-hidden="true"></i>
                            </button>
                            <span class="input-group-text ags-search-icon-end border-0">
                                <i class="fa fa-search text-warning" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="ags-hint rounded p-3 mb-0 small">
                    <i class="fa fa-info-circle text-info ml-1" aria-hidden="true"></i>
                    {{ __('new_trans.global_search.hint') }}
                </div>

                @if (mb_strlen(trim($search ?? '')) >= 2)
                    <div class="ags-results mt-4">
                        @php
                            $hasAny =
                                $grouped['users']->isNotEmpty() ||
                                $grouped['offers']->isNotEmpty() ||
                                $grouped['nas']->isNotEmpty() ||
                                $grouped['distributors']->isNotEmpty() ||
                                $grouped['questions']->isNotEmpty();
                        @endphp

                        @unless ($hasAny)
                            <div class="ags-empty text-center py-5 rounded">
                                <i class="fa fa-inbox fa-3x text-muted mb-3 d-block opacity-50" aria-hidden="true"></i>
                                <p class="text-muted mb-0 fs-16">{{ __('new_trans.global_search.no_results') }}</p>
                            </div>
                        @endunless

                        @if ($grouped['users']->isNotEmpty())
                            <section class="ags-section mb-4" aria-label="{{ __('new_trans.global_search.section_users') }}">
                                <header class="ags-section-head">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    <span>{{ __('new_trans.global_search.section_users') }}</span>
                                </header>
                                @include('backend.admins.users.includes.global_search_users_table', [
                                    'users' => $grouped['users'],
                                    'tableColumns' => $userIndexTableColumns,
                                ])
                            </section>
                        @endif

                        @if ($grouped['offers']->isNotEmpty())
                            <section class="ags-section mb-4" aria-label="{{ __('new_trans.global_search.section_offers') }}">
                                <header class="ags-section-head">
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <span>{{ __('new_trans.global_search.section_offers') }}</span>
                                </header>
                                <div class="ags-items">
                                    @foreach ($grouped['offers'] as $row)
                                        <a href="{{ route('admins.offers.edit', $row->id) }}" class="ags-item">
                                            <span class="ags-item-icon"><i class="fa fa-tag" aria-hidden="true"></i></span>
                                            <span class="ags-item-body">
                                                <span class="ags-item-title">{{ $row->name }}</span>
                                            </span>
                                            <i class="fa fa-chevron-left ags-item-chevron rtl-chevron" aria-hidden="true"></i>
                                        </a>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        @if ($grouped['nas']->isNotEmpty())
                            <section class="ags-section mb-4" aria-label="{{ __('new_trans.global_search.section_nas') }}">
                                <header class="ags-section-head">
                                    <i class="fa fa-server" aria-hidden="true"></i>
                                    <span>{{ __('new_trans.global_search.section_nas') }}</span>
                                </header>
                                <div class="ags-items">
                                    @foreach ($grouped['nas'] as $row)
                                        <a href="{{ route('admins.nas.show', $row->id) }}" class="ags-item">
                                            <span class="ags-item-icon"><i class="fa fa-hdd-o" aria-hidden="true"></i></span>
                                            <span class="ags-item-body">
                                                <span class="ags-item-title">{{ $row->name ?? '—' }}</span>
                                                <span class="ags-item-sub text-monospace">{{ $row->serial }}</span>
                                            </span>
                                            <i class="fa fa-chevron-left ags-item-chevron rtl-chevron" aria-hidden="true"></i>
                                        </a>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        @if ($grouped['distributors']->isNotEmpty())
                            <section class="ags-section mb-4" aria-label="{{ __('new_trans.global_search.section_distributors') }}">
                                <header class="ags-section-head">
                                    <i class="fa fa-truck" aria-hidden="true"></i>
                                    <span>{{ __('new_trans.global_search.section_distributors') }}</span>
                                </header>
                                <div class="ags-items">
                                    @foreach ($grouped['distributors'] as $row)
                                        <a href="{{ route('admins.distributors.edit', $row->id) }}" class="ags-item">
                                            <span class="ags-item-icon"><i class="fa fa-id-badge" aria-hidden="true"></i></span>
                                            <span class="ags-item-body">
                                                <span class="ags-item-title">{{ $row->name }}</span>
                                                @if ($row->fullname)
                                                    <span class="ags-item-sub">{{ $row->fullname }}</span>
                                                @endif
                                            </span>
                                            @if ($row->phone)
                                                <span class="badge badge-pill badge-secondary ags-item-meta">{{ $row->phone }}</span>
                                            @endif
                                            <i class="fa fa-chevron-left ags-item-chevron rtl-chevron" aria-hidden="true"></i>
                                        </a>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        @if ($grouped['questions']->isNotEmpty())
                            <section class="ags-section mb-4" aria-label="{{ __('new_trans.global_search.section_questions') }}">
                                <header class="ags-section-head">
                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                    <span>{{ __('new_trans.global_search.section_questions') }}</span>
                                </header>
                                <div class="ags-items">
                                    @foreach ($grouped['questions'] as $question)
                                        <a href="{{ route('questions.faqs.show', $question->id) }}" class="ags-item">
                                            <span class="ags-item-icon"><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
                                            <span class="ags-item-body">
                                                <span class="ags-item-title">{{ \Illuminate\Support\Str::limit($question->question ?? '—', 120) }}</span>
                                            </span>
                                            <span class="badge badge-pill badge-info ags-item-meta">{{ QuestionTypeEnum::getTypeLabel($question->type) }}</span>
                                            <i class="fa fa-chevron-left ags-item-chevron rtl-chevron" aria-hidden="true"></i>
                                        </a>
                                    @endforeach
                                </div>
                            </section>
                        @endif
                    </div>
                @endif
            </div>
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-modals.modal>
</div>
