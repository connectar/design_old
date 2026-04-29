<div>
    <div class="gcb-wrap">
        <div class="gcb-card">
            <div class="gcb-header">
                <div>
                    <h3 class="gcb-title">
                        <i class="fa fa-ban"></i>
                        {{ __('general_chat.blocks_title') }}
                    </h3>
                    <div class="gcb-sub">{{ __('general_chat.blocks_subtitle') }}</div>
                </div>
                <a href="{{ url()->previous() }}" class="gcb-back">
                    <i class="fa fa-arrow-left"></i>
                    {{ __('general_chat.back') }}
                </a>
            </div>

            @if (! $canManage)
                <div class="gcb-denied">
                    <i class="fa fa-lock"></i>
                    <div>{{ __('general_chat.manager_only') }}</div>
                </div>
            @else
                <div class="gcb-body">
                    <div class="gcb-search-row">
                        <div class="gcb-search-input-wrap">
                            <i class="fa fa-search"></i>
                            <input type="text" class="gcb-search-input"
                                   placeholder="{{ __('general_chat.search_placeholder') }}"
                                   wire:model.live.debounce.400ms="search">
                            @if ($search !== '')
                                <button type="button" class="gcb-search-clear"
                                        wire:click="$set('search', '')">
                                    <i class="fa fa-times"></i>
                                </button>
                            @endif
                        </div>
                        <select class="gcb-duration-select" wire:model.live="newBlockDuration">
                            <option value="day">{{ __('general_chat.block_day') }}</option>
                            <option value="week">{{ __('general_chat.block_week') }}</option>
                            <option value="month">{{ __('general_chat.block_month') }}</option>
                            <option value="permanent">{{ __('general_chat.block_permanent') }}</option>
                        </select>
                    </div>

                    @if ($searchResult)
                        <div class="gcb-search-result">
                            @php
                                $initial = mb_strtoupper(mb_substr(trim($searchResult['name']), 0, 1));
                                $color = 'hsl(' . (crc32((string) $searchResult['id']) % 360) . ', 55%, 45%)';
                            @endphp
                            <div class="gcb-result-avatar"
                                 style="{{ $searchResult['avatar_url'] ? '' : ('background:' . $color . ';') }}">
                                @if ($searchResult['avatar_url'])
                                    <img src="{{ $searchResult['avatar_url'] }}" alt="">
                                @else
                                    <span>{{ $initial }}</span>
                                @endif
                            </div>
                            <div class="gcb-result-info">
                                <div class="gcb-result-name">{{ $searchResult['name'] }}</div>
                                <div class="gcb-result-meta">
                                    @if ($searchResult['billing_code'])
                                        <span><i class="fa fa-hashtag"></i> {{ $searchResult['billing_code'] }}</span>
                                    @endif
                                    @if ($searchResult['phone'])
                                        <span dir="ltr"><i class="fa fa-phone"></i> {{ $searchResult['phone'] }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="gcb-result-action">
                                @if ($searchResult['already_blocked'])
                                    <span class="gcb-chip gcb-chip-active">
                                        <i class="fa fa-ban"></i>
                                        {{ __('general_chat.already_blocked') }}
                                    </span>
                                @else
                                    <button type="button" class="gcb-block-now-btn"
                                            wire:click="blockFromSearch({{ $searchResult['id'] }})"
                                            wire:confirm="{{ __('general_chat.confirm_block_generic') }}">
                                        <i class="fa fa-ban"></i>
                                        {{ __('general_chat.block_now') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    @elseif ($search !== '')
                        <div class="gcb-search-empty">
                            <i class="fa fa-user-slash"></i>
                            {{ __('general_chat.no_customer_found') }}
                        </div>
                    @endif

                    <div class="gcb-list-title">
                        <i class="fa fa-list"></i>
                        {{ __('general_chat.current_blocks') }}
                        <span class="gcb-count">{{ $blocks->total() }}</span>
                    </div>

                    @forelse ($blocks as $block)
                        @php
                            $admin = $block->admin;
                            $name = $admin?->fullname ?: ($admin?->name ?: '#'.$block->admin_id);
                            $code = null;
                            if ($admin && $admin->network_id) {
                                try {
                                    $code = (string) \App\Models\Network::getBillingCode($admin->network_id);
                                } catch (\Throwable $e) {
                                    $code = null;
                                }
                            }
                            $isPerm = $block->blocked_until === null;
                            $isActive = $block->isActive();
                            $initial = mb_strtoupper(mb_substr(trim($name), 0, 1));
                            $color = 'hsl(' . (crc32((string) $block->admin_id) % 360) . ', 55%, 45%)';
                            $avatarUrl = $admin?->avatarUrl();
                        @endphp
                        <div class="gcb-row {{ $isActive ? '' : 'gcb-row-inactive' }}"
                             wire:key="blk-{{ $block->id }}">
                            <div class="gcb-row-avatar"
                                 style="{{ $avatarUrl ? '' : ('background:' . $color . ';') }}">
                                @if ($avatarUrl)
                                    <img src="{{ $avatarUrl }}" alt="">
                                @else
                                    <span>{{ $initial }}</span>
                                @endif
                            </div>
                            <div class="gcb-row-info">
                                <div class="gcb-row-name">{{ $name }}</div>
                                <div class="gcb-row-meta">
                                    @if ($code)
                                        <span><i class="fa fa-hashtag"></i> {{ $code }}</span>
                                    @endif
                                    @if ($admin?->phone)
                                        <span dir="ltr"><i class="fa fa-phone"></i> {{ $admin->phone }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="gcb-row-status">
                                @if ($isPerm)
                                    <span class="gcb-chip gcb-chip-permanent">
                                        <i class="fa fa-infinity"></i>
                                        {{ __('general_chat.block_permanent') }}
                                    </span>
                                @elseif ($isActive)
                                    <span class="gcb-chip gcb-chip-active">
                                        <i class="fa fa-clock"></i>
                                        {{ $block->blocked_until?->translatedFormat('j M Y H:i') }}
                                    </span>
                                @else
                                    <span class="gcb-chip gcb-chip-expired">
                                        <i class="fa fa-check"></i>
                                        {{ __('general_chat.block_expired') }}
                                    </span>
                                @endif
                                @if ($block->blockedBy)
                                    <span class="gcb-by">
                                        {{ __('general_chat.blocked_by') }}
                                        {{ $block->blockedBy->fullname ?: $block->blockedBy->name }}
                                    </span>
                                @endif
                            </div>
                            <div class="gcb-row-action">
                                <button type="button" class="gcb-unblock-btn"
                                        wire:click="unblock({{ $block->id }})"
                                        wire:confirm="{{ __('general_chat.confirm_unblock') }}">
                                    <i class="fa fa-unlock"></i>
                                    {{ __('general_chat.unblock') }}
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="gcb-empty">
                            <i class="fa fa-check-circle"></i>
                            <div>{{ __('general_chat.no_blocks_yet') }}</div>
                        </div>
                    @endforelse

                    <div class="gcb-pagination">
                        {{ $blocks->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    @once
        @push('styles')
            <style>
                .gcb-wrap { padding: 12px 0; }
                .gcb-card {
                    max-width: 1024px;
                    margin: 0 auto;
                    background: #fff;
                    border-radius: 16px;
                    box-shadow: 0 10px 40px rgba(0,0,0,.08);
                    overflow: hidden;
                }
                .gcb-header {
                    padding: 16px 20px;
                    background: linear-gradient(135deg, #991b1b 0%, #7f1d1d 100%);
                    color: #fff;
                    display: flex; align-items: center; justify-content: space-between;
                }
                .gcb-title { font-size: 16px; margin: 0; color: #fff; font-weight: 700; display: flex; align-items: center; gap: 8px; }
                .gcb-sub { font-size: 12px; color: rgba(255,255,255,.8); margin-top: 4px; }
                .gcb-back {
                    padding: 8px 14px;
                    background: rgba(255,255,255,.15);
                    color: #fff; border-radius: 10px;
                    font-size: 13px; display: flex; align-items: center; gap: 6px;
                    text-decoration: none;
                    transition: background .15s ease;
                }
                .gcb-back:hover { background: rgba(255,255,255,.25); color: #fff; text-decoration: none; }

                .gcb-denied { padding: 40px 20px; text-align: center; color: #64748b; font-size: 14px; }
                .gcb-denied i { font-size: 36px; color: #f59e0b; margin-bottom: 10px; }

                .gcb-body { padding: 18px; }

                .gcb-search-row { display: flex; gap: 10px; align-items: stretch; margin-bottom: 14px; flex-wrap: wrap; }
                .gcb-search-input-wrap {
                    flex: 1; min-width: 240px;
                    position: relative; display: flex; align-items: center;
                    background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 12px;
                    padding: 0 12px;
                }
                .gcb-search-input-wrap > i { color: #94a3b8; }
                .gcb-search-input {
                    flex: 1; border: 0; background: transparent;
                    padding: 12px 10px; font-size: 14px; outline: none;
                }
                .gcb-search-clear {
                    background: transparent; border: 0; color: #94a3b8;
                    cursor: pointer; padding: 6px;
                }
                .gcb-search-clear:hover { color: #0f172a; }

                .gcb-duration-select {
                    border: 1px solid #e5e7eb; border-radius: 12px;
                    padding: 0 14px; background: #fff;
                    font-size: 13px; min-width: 130px;
                }

                .gcb-search-result {
                    display: flex; align-items: center; gap: 12px;
                    padding: 14px; margin-bottom: 14px;
                    background: #fffbeb;
                    border: 1px dashed #f59e0b;
                    border-radius: 14px;
                }
                .gcb-search-empty {
                    padding: 14px; margin-bottom: 14px;
                    background: #fef2f2; border: 1px dashed #fecaca;
                    color: #991b1b; border-radius: 14px;
                    text-align: center; font-size: 13px;
                }
                .gcb-search-empty i { margin-inline-end: 6px; }

                .gcb-result-avatar, .gcb-row-avatar {
                    width: 46px; height: 46px; border-radius: 50%;
                    background: #64748b; color: #fff;
                    display: flex; align-items: center; justify-content: center;
                    font-size: 18px; font-weight: 700; flex-shrink: 0;
                    overflow: hidden;
                }
                .gcb-result-avatar img, .gcb-row-avatar img { width: 100%; height: 100%; object-fit: cover; }
                .gcb-result-info, .gcb-row-info { flex: 1; min-width: 0; }
                .gcb-result-name, .gcb-row-name { font-size: 14px; font-weight: 700; color: #0f172a; }
                .gcb-result-meta, .gcb-row-meta {
                    font-size: 12px; color: #64748b;
                    display: flex; gap: 14px; flex-wrap: wrap; margin-top: 4px;
                }
                .gcb-result-meta span i, .gcb-row-meta span i { margin-inline-end: 4px; }

                .gcb-block-now-btn {
                    padding: 9px 16px;
                    background: #b91c1c; color: #fff;
                    border: 0; border-radius: 10px;
                    font-size: 13px; font-weight: 600;
                    cursor: pointer;
                    display: flex; align-items: center; gap: 6px;
                }
                .gcb-block-now-btn:hover { background: #991b1b; }

                .gcb-list-title {
                    font-size: 13px; font-weight: 700; color: #0f172a;
                    margin: 18px 0 10px;
                    display: flex; align-items: center; gap: 8px;
                }
                .gcb-count {
                    background: #f1f5f9; color: #475569;
                    padding: 2px 10px; border-radius: 999px;
                    font-size: 11px;
                }

                .gcb-row {
                    display: flex; align-items: center; gap: 12px;
                    padding: 12px 14px; border: 1px solid #f1f5f9;
                    border-radius: 12px; margin-bottom: 8px;
                    background: #fff;
                    transition: background .15s ease;
                }
                .gcb-row:hover { background: #f8fafc; }
                .gcb-row-inactive { opacity: .65; }

                .gcb-row-status {
                    display: flex; flex-direction: column; gap: 4px;
                    align-items: flex-end; text-align: end;
                }

                .gcb-chip {
                    display: inline-flex; align-items: center; gap: 5px;
                    padding: 4px 10px; border-radius: 999px;
                    font-size: 11px; font-weight: 600;
                }
                .gcb-chip-permanent { background: #7f1d1d; color: #fff; }
                .gcb-chip-active { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
                .gcb-chip-expired { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }

                .gcb-by { font-size: 10px; color: #94a3b8; }

                .gcb-unblock-btn {
                    padding: 8px 14px;
                    background: #ecfdf5; color: #065f46;
                    border: 1px solid #a7f3d0; border-radius: 10px;
                    font-size: 12px; font-weight: 600;
                    cursor: pointer; display: flex; align-items: center; gap: 6px;
                }
                .gcb-unblock-btn:hover { background: #10b981; color: #fff; border-color: #10b981; }

                .gcb-empty {
                    text-align: center; padding: 40px 20px;
                    color: #94a3b8; font-size: 14px;
                }
                .gcb-empty i { font-size: 42px; color: #10b981; margin-bottom: 10px; }

                .gcb-pagination { margin-top: 14px; display: flex; justify-content: center; }

                @media (max-width: 576px) {
                    .gcb-row { flex-wrap: wrap; }
                    .gcb-row-status { align-items: flex-start; }
                }
            </style>
        @endpush
    @endonce
</div>
