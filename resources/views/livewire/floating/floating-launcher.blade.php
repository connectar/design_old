<div wire:poll.4s="pollUnread"
     class="fl-launcher-root"
     data-fl-total="{{ $supportUnread + $generalUnread }}"
     x-data="{
        open: (localStorage.getItem('fl_launcher_open') ?? '1') === '1',
        muted: localStorage.getItem('fl_chat_muted') === '1',
        lastTotal: parseInt(localStorage.getItem('fl_last_total') ?? '0', 10) || 0,
        audioCtx: null,

        toggle() {
            this.open = !this.open;
            localStorage.setItem('fl_launcher_open', this.open ? '1' : '0');
        },
        playChime() {
            if (this.muted) return;
            try {
                if (!this.audioCtx) {
                    this.audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                }
                const ctx = this.audioCtx;
                if (ctx.state === 'suspended') { ctx.resume(); }
                const now = ctx.currentTime;
                const gain = ctx.createGain();
                gain.gain.setValueAtTime(0.0001, now);
                gain.gain.exponentialRampToValueAtTime(0.25, now + 0.02);
                gain.gain.exponentialRampToValueAtTime(0.0001, now + 0.55);
                gain.connect(ctx.destination);
                const notes = [880, 1320];
                notes.forEach((freq, i) => {
                    const osc = ctx.createOscillator();
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(freq, now + i * 0.12);
                    osc.connect(gain);
                    osc.start(now + i * 0.12);
                    osc.stop(now + i * 0.12 + 0.30);
                });
            } catch (e) { /* audio not available */ }
        },
        syncFromPoll() {
            const total = parseInt(this.$el.getAttribute('data-fl-total') ?? '0', 10) || 0;
            if (total > this.lastTotal) {
                this.playChime();
            }
            this.lastTotal = total;
            localStorage.setItem('fl_last_total', String(total));
        },
        init() {
            this.$watch('muted', v => {
                localStorage.setItem('fl_chat_muted', v ? '1' : '0');
                window.dispatchEvent(new CustomEvent('fl-mute-changed', { detail: { muted: v } }));
            });
            window.addEventListener('fl-mute-changed', (e) => {
                this.muted = !!e.detail.muted;
            });
            Livewire.hook('morph.updated', () => {
                this.syncFromPoll();
            });
            this.lastTotal = parseInt(this.$el.getAttribute('data-fl-total') ?? '0', 10) || 0;
            localStorage.setItem('fl_last_total', String(this.lastTotal));
        }
     }"
     :class="{ 'fl-open': open, 'fl-closed': !open }">

    {{-- Stack of floating action icons --}}
    <div class="fl-stack" x-show="open" x-cloak x-transition.opacity>
        {{-- Support Chat --}}
        <a href="{{ $supportUrl }}"
           class="fl-btn fl-btn-support"
           title="{{ __('support_chat.support_chats') ?? 'Support' }}">
            <span class="fl-btn-inner">
                <img src="{{ asset('images/logo/Customer.png') }}" alt="support"
                     onerror="this.style.display='none'; this.parentNode.querySelector('.fl-btn-fallback').style.display='inline-flex';">
                <span class="fl-btn-fallback" style="display: none;">
                    <i class="fa fa-headset"></i>
                </span>
            </span>
            @if ($supportUnread > 0)
                <span class="fl-badge" wire:key="fl-sup-{{ $supportUnread }}">
                    {{ $supportUnread > 99 ? '99+' : $supportUnread }}
                </span>
            @endif
            <span class="fl-tooltip">{{ __('support_chat.open_chat') ?? 'Support Chat' }}</span>
        </a>

        {{-- General Chat --}}
        <a href="{{ $generalUrl }}"
           class="fl-btn fl-btn-general"
           title="{{ __('general_chat.menu_title') }}">
            <span class="fl-btn-inner">
                <img src="{{ asset('images/logo/chat%20icon.png') }}" alt="chat"
                     onerror="this.style.display='none'; this.parentNode.querySelector('.fl-btn-fallback').style.display='inline-flex';">
                <span class="fl-btn-fallback" style="display: none;">
                    <i class="fa fa-comments"></i>
                </span>
            </span>
            @if ($generalUnread > 0)
                <span class="fl-badge" wire:key="fl-gen-{{ $generalUnread }}">
                    {{ $generalUnread > 99 ? '99+' : $generalUnread }}
                </span>
            @endif
            <span class="fl-tooltip">{{ __('general_chat.menu_title') }}</span>
        </a>

        @if ($showWhatsapp)
            <a href="https://chat.whatsapp.com/D20g7KXF9Y557uRzPDa9OW"
               target="_blank"
               class="fl-btn fl-btn-whatsapp"
               title="WhatsApp">
                <span class="fl-btn-inner">
                    <i class="fa fa-whatsapp"></i>
                </span>
                <span class="fl-tooltip">WhatsApp</span>
            </a>
        @endif
    </div>

    {{-- Master toggle (always visible) --}}
    <button type="button" class="fl-toggle" @click="toggle()"
            :class="{ 'fl-toggle-open': open }"
            :title="open ? '{{ __('general_chat.hide_floating') ?? 'Hide' }}' : '{{ __('general_chat.show_floating') ?? 'Show' }}'">
        <i class="fa" :class="open ? 'fa-times' : 'fa-comments'"></i>

        {{-- Combined badge when collapsed --}}
        @php $combined = $supportUnread + $generalUnread; @endphp
        @if ($combined > 0)
            <span class="fl-badge fl-toggle-badge"
                  x-show="!open"
                  x-cloak
                  wire:key="fl-tog-{{ $combined }}">
                {{ $combined > 99 ? '99+' : $combined }}
            </span>
        @endif
    </button>

    @once
        @push('styles')
            <style>
                [x-cloak] { display: none !important; }

                .fl-launcher-root {
                    position: fixed;
                    bottom: 20px;
                    inset-inline-end: 20px;
                    z-index: 1050;
                    display: flex;
                    flex-direction: column-reverse;
                    align-items: flex-end;
                    gap: 12px;
                    pointer-events: none;
                }

                .fl-launcher-root > * { pointer-events: auto; }

                .fl-stack {
                    display: flex;
                    flex-direction: column-reverse;
                    gap: 12px;
                    align-items: center;
                }

                /* === Floating button === */
                .fl-btn {
                    position: relative;
                    width: 54px;
                    height: 54px;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: #fff;
                    box-shadow: 0 6px 18px rgba(0, 0, 0, .18);
                    color: #0f172a;
                    text-decoration: none !important;
                    transition: transform .18s ease, box-shadow .18s ease;
                    border: 0;
                    cursor: pointer;
                    animation: fl-slide-in .25s ease backwards;
                }
                .fl-btn:hover {
                    transform: translateY(-3px) scale(1.06);
                    box-shadow: 0 10px 24px rgba(0, 0, 0, .25);
                    color: #0f172a;
                    text-decoration: none;
                }
                .fl-btn-inner {
                    width: 100%;
                    height: 100%;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    overflow: hidden;
                }
                .fl-btn-inner img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }
                .fl-btn-inner i { font-size: 22px; }

                /* Staggered entry animation */
                .fl-stack > :nth-child(1) { animation-delay: 0ms; }
                .fl-stack > :nth-child(2) { animation-delay: 60ms; }
                .fl-stack > :nth-child(3) { animation-delay: 120ms; }

                @keyframes fl-slide-in {
                    from { transform: translateY(20px) scale(.6); opacity: 0; }
                    to   { transform: translateY(0) scale(1); opacity: 1; }
                }

                /* Per-icon theme colors (for the fallback icon + background glow) */
                .fl-btn-support { background: linear-gradient(135deg, #f59e0b, #ea580c); color: #fff; }
                .fl-btn-support .fl-btn-fallback,
                .fl-btn-support .fl-btn-fallback i { color: #fff; }

                .fl-btn-general { background: linear-gradient(135deg, #0ea5e9, #2563eb); color: #fff; }
                .fl-btn-general .fl-btn-fallback,
                .fl-btn-general .fl-btn-fallback i { color: #fff; }

                .fl-btn-whatsapp { background: linear-gradient(135deg, #25d366, #128c7e); color: #fff; }
                .fl-btn-whatsapp .fl-btn-inner i { color: #fff; font-size: 26px; }

                /* === Unread badge === */
                .fl-badge {
                    position: absolute;
                    top: -6px;
                    inset-inline-end: -6px;
                    background: #dc2626;
                    color: #fff;
                    border-radius: 999px;
                    min-width: 22px;
                    height: 22px;
                    padding: 0 7px;
                    font-size: 11px;
                    font-weight: 700;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    border: 2px solid #fff;
                    box-shadow: 0 0 0 2px rgba(220, 38, 38, .22);
                    animation: fl-pulse 1.6s infinite;
                    line-height: 1;
                }
                @keyframes fl-pulse {
                    0%   { box-shadow: 0 0 0 0 rgba(220, 38, 38, .55); }
                    70%  { box-shadow: 0 0 0 10px rgba(220, 38, 38, 0); }
                    100% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
                }

                /* === Tooltip next to each button === */
                .fl-tooltip {
                    position: absolute;
                    inset-inline-end: 62px;
                    top: 50%;
                    transform: translateY(-50%);
                    background: #0f172a;
                    color: #fff;
                    padding: 6px 12px;
                    border-radius: 8px;
                    font-size: 12px;
                    white-space: nowrap;
                    opacity: 0;
                    pointer-events: none;
                    transition: opacity .15s ease, transform .15s ease;
                }
                .fl-btn:hover .fl-tooltip {
                    opacity: 1;
                    transform: translateY(-50%) translateX(0);
                }
                html[dir="rtl"] .fl-tooltip { inset-inline-end: 62px; }

                /* === Master toggle === */
                .fl-toggle {
                    position: relative;
                    width: 58px;
                    height: 58px;
                    border-radius: 50%;
                    background: linear-gradient(135deg, #0f172a, #1e293b);
                    color: #fff;
                    border: 0;
                    cursor: pointer;
                    box-shadow: 0 8px 22px rgba(0, 0, 0, .28);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 22px;
                    transition: transform .2s ease, background .2s ease;
                }
                .fl-toggle:hover {
                    transform: rotate(-8deg) scale(1.05);
                }
                .fl-toggle-open {
                    background: linear-gradient(135deg, #dc2626, #b91c1c);
                }
                .fl-toggle-badge {
                    /* Appears on the toggle when the stack is collapsed */
                    animation: fl-pulse 1.2s infinite, fl-bounce-in .3s ease;
                }
                @keyframes fl-bounce-in {
                    from { transform: scale(0); }
                    to   { transform: scale(1); }
                }

                /* === Mobile tweaks === */
                @media (max-width: 576px) {
                    .fl-launcher-root {
                        bottom: 14px;
                        inset-inline-end: 14px;
                        gap: 10px;
                    }
                    .fl-btn { width: 48px; height: 48px; }
                    .fl-toggle { width: 52px; height: 52px; font-size: 20px; }
                    .fl-tooltip { display: none; }
                }
            </style>
        @endpush
    @endonce
</div>
