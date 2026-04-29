@php $unread = $this->unreadCount; @endphp
<span wire:poll.5s="pollUnread" class="sc-float-badge-wrap">
    @if ($unread > 0)
        <span class="sc-float-badge" wire:key="fb-{{ $unread }}">
            {{ $unread > 99 ? '99+' : $unread }}
        </span>
    @endif

    @once
        @push('styles')
            <style>
                .sc-float-badge-wrap { position: absolute; top: -6px; inset-inline-end: -6px; line-height: 1; pointer-events: none; }
                .sc-float-badge {
                    background: #dc3545;
                    color: #fff;
                    border-radius: 999px;
                    min-width: 22px;
                    height: 22px;
                    padding: 0 6px;
                    font-size: 11px;
                    font-weight: 700;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    border: 2px solid #fff;
                    box-shadow: 0 0 0 2px rgba(220,53,69,.25);
                    animation: sc-float-pulse 1.6s infinite;
                }
                @keyframes sc-float-pulse {
                    0% { box-shadow: 0 0 0 0 rgba(220,53,69,.55); }
                    70% { box-shadow: 0 0 0 10px rgba(220,53,69,0); }
                    100% { box-shadow: 0 0 0 0 rgba(220,53,69,0); }
                }
                /* Ensure the badge sits on top of the floating anchor */
                .whatsapp_float.support_float { position: fixed; }
                .whatsapp_float.support_float .sc-float-badge-wrap { position: absolute; }
            </style>
        @endpush
    @endonce
</span>
