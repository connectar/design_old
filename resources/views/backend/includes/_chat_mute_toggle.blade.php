{{--
    Chat notification sound mute/unmute toggle.
    Sits next to the notifications bell in every back-office header.
    State is synced with the FloatingLauncher via localStorage
    (`fl_chat_muted`) and the `fl-mute-changed` window event.
--}}
<li class="btn-group nav-item d-inline-flex chat-mute-item"
    x-data="{
        muted: localStorage.getItem('fl_chat_muted') === '1',
        toggle() {
            this.muted = !this.muted;
            localStorage.setItem('fl_chat_muted', this.muted ? '1' : '0');
            window.dispatchEvent(new CustomEvent('fl-mute-changed', { detail: { muted: this.muted } }));
        },
        init() {
            window.addEventListener('fl-mute-changed', (e) => { this.muted = !!e.detail.muted; });
        }
    }">
    <a href="#"
       class="waves-effect waves-light btn-primary-light chat-mute-btn"
       :class="{ 'chat-mute-on': muted }"
       @click.prevent="toggle()"
       :title="muted
            ? '{{ __('general_chat.unmute_chat_sound') ?? 'Unmute chat sound' }}'
            : '{{ __('general_chat.mute_chat_sound') ?? 'Mute chat sound' }}'">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
             viewBox="0 0 24 24" fill="none" stroke="currentColor"
             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="chat-mute-icon">
            {{-- Base speaker (always visible) --}}
            <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
            {{-- Sound waves — hidden when muted --}}
            <path class="chat-mute-wave" x-show="!muted"
                  d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
            <path class="chat-mute-wave" x-show="!muted"
                  d="M19.07 4.93a10 10 0 0 1 0 14.14"></path>
            {{-- Cross mark when muted --}}
            <line class="chat-mute-cross" x-show="muted" x-cloak
                  x1="23" y1="9" x2="17" y2="15"></line>
            <line class="chat-mute-cross" x-show="muted" x-cloak
                  x1="17" y1="9" x2="23" y2="15"></line>
        </svg>
        <span class="chat-mute-dot" x-show="muted" x-cloak></span>
    </a>

    @once
        @push('styles')
            <style>
                /* Give the mute button its own slot so nothing overlaps it. */
                .chat-mute-item {
                    margin-inline-end: 6px;
                    margin-inline-start: 6px;
                }
                .chat-mute-btn {
                    position: relative;
                    display: inline-flex !important;
                    align-items: center;
                    justify-content: center;
                    width: 40px;
                    height: 40px;
                    padding: 0 !important;
                }
                .chat-mute-icon {
                    width: 22px;
                    height: 22px;
                    display: block;
                }
                /* Muted state → red icon */
                .chat-mute-btn.chat-mute-on .chat-mute-icon {
                    color: #dc2626;
                    stroke: #dc2626;
                }
                .chat-mute-dot {
                    position: absolute;
                    top: 4px;
                    inset-inline-end: 4px;
                    width: 9px; height: 9px;
                    border-radius: 50%;
                    background: #dc2626;
                    box-shadow: 0 0 0 2px rgba(255,255,255,.9);
                }
            </style>
        @endpush
    @endonce
</li>
