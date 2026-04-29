<div wire:poll.3s="pollMessages">
    @php
        /** @var \Illuminate\Support\Collection $chats */
        $chats = $this->chats;
        /** @var \App\Models\SupportChat|null $active */
        $active = $this->activeChat;
        /** @var \Illuminate\Support\Collection $activeMessages */
        $activeMessages = $this->activeMessages;
        $totalUnread = $this->totalUnread;
    @endphp

    @if (! $allowed)
        <div class="alert alert-warning m-3">{{ __('support_chat.access_denied') }}</div>
    @else
    <div class="scm-wrap"
         x-data="{
            showEmoji: false,
            showShortcuts: false,
            recording: false,
            mediaRecorder: null,
            chunks: [],
            recordSeconds: 0,
            recordTimer: null,
            cancelledRecord: false,
            insertShortcut(text) {
                const cur = @this.get('newReply') || '';
                const next = cur.trim() === '' ? text : (cur.replace(/\s+$/, '') + ' ' + text);
                @this.set('newReply', next, false);
                this.showShortcuts = false;
                this.$nextTick(() => {
                    const ta = this.$refs.reply;
                    if (ta) { ta.focus(); ta.selectionStart = ta.selectionEnd = ta.value.length; }
                });
            },
            scrollBottom() {
                const el = this.$refs.thread;
                if (el) { el.scrollTop = el.scrollHeight; }
            },
            addEmoji(e) {
                const ta = this.$refs.reply;
                const cur = @this.get('newReply') || '';
                @this.set('newReply', cur + e, false);
                this.showEmoji = false;
                this.$nextTick(() => ta && ta.focus());
            },
            async toggleRecord() {
                if (this.recording) {
                    this.stopAndSend();
                } else {
                    await this.startRecord();
                }
            },
            async startRecord() {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({
                        audio: {
                            channelCount: 1,
                            sampleRate: 16000,
                            echoCancellation: true,
                            noiseSuppression: true,
                            autoGainControl: true,
                        },
                    });
                    this.chunks = [];
                    this.cancelledRecord = false;
                    const candidates = [
                        'audio/webm;codecs=opus',
                        'audio/webm',
                        'audio/ogg;codecs=opus',
                        'audio/ogg',
                    ];
                    const mime = candidates.find(m => MediaRecorder.isTypeSupported(m)) || 'audio/webm';
                    this.mediaRecorder = new MediaRecorder(stream, {
                        mimeType: mime,
                        audioBitsPerSecond: 24000,
                    });
                    this.mediaRecorder.ondataavailable = (e) => this.chunks.push(e.data);
                    this.mediaRecorder.onstop = () => {
                        stream.getTracks().forEach(t => t.stop());
                        if (this.cancelledRecord) {
                            this.chunks = [];
                            return;
                        }
                        const blob = new Blob(this.chunks, { type: mime });
                        const ext = mime.includes('webm') ? 'webm' : 'ogg';
                        const file = new File([blob], `voice-${Date.now()}.${ext}`, { type: mime });
                        @this.upload('voiceFile', file,
                            () => { @this.sendReply(); },
                            () => {},
                            () => {}
                        );
                    };
                    this.mediaRecorder.start();
                    this.recording = true;
                    this.recordSeconds = 0;
                    this.recordTimer = setInterval(() => { this.recordSeconds++; }, 1000);
                } catch (e) {
                    alert('{{ __('support_chat.mic_error') }}');
                }
            },
            stopAndSend() {
                clearInterval(this.recordTimer);
                this.recordTimer = null;
                if (this.mediaRecorder && this.recording) {
                    this.cancelledRecord = false;
                    this.mediaRecorder.stop();
                    this.recording = false;
                }
            },
            cancelRecording() {
                clearInterval(this.recordTimer);
                this.recordTimer = null;
                this.cancelledRecord = true;
                if (this.mediaRecorder && this.recording) {
                    this.mediaRecorder.stop();
                    this.recording = false;
                }
            },
            formatRecTime(s) {
                const m = Math.floor(s / 60);
                const ss = String(s % 60).padStart(2, '0');
                return m + ':' + ss;
            }
         }"
         x-init="$nextTick(() => scrollBottom());
                 Livewire.hook('morph.updated', () => scrollBottom());">

        <div class="scm-card">
            {{-- Sidebar: chats list --}}
            <aside class="scm-side">
                <div class="scm-side-head">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="fw-bold text-white">
                            <i class="fa fa-comments"></i>
                            {{ __('support_chat.conversations') }}
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            @if ($totalUnread > 0)
                                <span class="badge bg-danger">{{ $totalUnread > 99 ? '99+' : $totalUnread }}</span>
                            @endif
                            <button type="button" class="scm-new-btn"
                                    wire:click="toggleNewChat"
                                    title="{{ __('support_chat.start_new_chat') }}">
                                <i class="fa {{ $showNewChat ? 'fa-times' : 'fa-plus' }}"></i>
                            </button>
                        </div>
                    </div>

                    {{-- New chat (lookup by billing code) --}}
                    @if ($showNewChat)
                        <div class="scm-new-chat-box">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa fa-barcode text-warning"></i>
                                <input type="text"
                                       class="form-control form-control-sm scm-new-chat-input"
                                       wire:model.live.debounce.400ms="newChatCode"
                                       placeholder="{{ __('support_chat.enter_billing_code') }}"
                                       autofocus>
                            </div>

                            @php $lookup = $this->newChatLookup; @endphp
                            @if ($lookup)
                                <div class="scm-new-chat-result">
                                    <div class="d-flex align-items-center justify-content-between gap-2">
                                        <div>
                                            <div class="fw-bold text-white">{{ $lookup['name'] }}</div>
                                            <div class="small text-muted-soft">
                                                <i class="fa fa-barcode"></i>
                                                {{ __('support_chat.billing_code') }}:
                                                <strong>{{ $lookup['billing_code'] }}</strong>
                                                @if (! empty($lookup['phone']))
                                                    &nbsp;·&nbsp; <i class="fa fa-phone"></i> {{ $lookup['phone'] }}
                                                @endif
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-warning"
                                                wire:click="startChatByCode"
                                                wire:loading.attr="disabled"
                                                wire:target="startChatByCode">
                                            <i class="fa fa-paper-plane"></i>
                                            {{ $lookup['existing_chat_id']
                                                ? __('support_chat.open_existing_chat')
                                                : __('support_chat.start_chat') }}
                                        </button>
                                    </div>
                                </div>
                            @elseif (trim($newChatCode) !== '')
                                <div class="scm-new-chat-result scm-new-chat-empty">
                                    <i class="fa fa-exclamation-circle text-danger"></i>
                                    {{ __('support_chat.no_customer_found') }}
                                </div>
                            @endif

                            @error('newChatCode')
                                <div class="scm-new-chat-result text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="position-relative">
                        <input type="text"
                               class="form-control form-control-sm scm-search"
                               wire:model.live.debounce.400ms="search"
                               placeholder="{{ __('support_chat.search_customers') }}">
                        <i class="fa fa-search scm-search-icon"></i>
                    </div>
                    <div class="scm-filters mt-2">
                        @php
                            $filters = [
                                'all' => __('support_chat.all'),
                                'unread' => __('support_chat.unread'),
                                'open' => __('support_chat.open'),
                                'closed' => __('support_chat.closed'),
                            ];
                        @endphp
                        @foreach ($filters as $key => $label)
                            <button type="button"
                                    class="scm-chip @if ($filter === $key) scm-chip-active @endif"
                                    wire:click="setFilter('{{ $key }}')">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="scm-list">
                    @forelse ($chats as $c)
                        @php
                            $status = $c->subscriptionStatus();
                            $statusColor = [
                                'active' => 'success',
                                'expired' => 'danger',
                                'trial' => 'warning',
                            ][$status] ?? 'secondary';
                            $statusText = __('support_chat.sub_'.$status);
                            $billing = $c->billingCode();
                            $isActive = $activeChatId === $c->id;
                        @endphp
                        <button type="button"
                                class="scm-item @if ($isActive) scm-item-active @endif"
                                wire:click="openChat({{ $c->id }})"
                                wire:key="chat-{{ $c->id }}">
                            <div class="scm-item-avatar">
                                {{ mb_strtoupper(mb_substr($c->admin->fullname ?? $c->admin->name ?? '?', 0, 1)) }}
                            </div>
                            <div class="scm-item-body">
                                <div class="scm-item-row">
                                    <span class="scm-item-name">
                                        {{ $c->admin->fullname ?? $c->admin->name ?? '—' }}
                                    </span>
                                    @if ($c->last_message_at)
                                        <span class="scm-item-time">
                                            {{ $c->last_message_at->diffForHumans(null, true) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="scm-item-row">
                                    @if ($billing)
                                        <span class="scm-code">#{{ $billing }}</span>
                                    @endif
                                    <span class="badge bg-{{ $statusColor }}-soft text-{{ $statusColor }} scm-status">
                                        {{ $statusText }}
                                    </span>
                                </div>
                                <div class="scm-item-preview">
                                    @if ($c->last_message_by === \App\Models\SupportChat::SENDER_MANAGER)
                                        <i class="fa fa-reply text-muted me-1"></i>
                                    @endif
                                    {{ $c->last_message_preview ?: __('support_chat.no_messages_yet') }}
                                </div>
                            </div>
                            @if ($c->unread_for_support > 0)
                                <span class="scm-unread">
                                    {{ $c->unread_for_support > 99 ? '99+' : $c->unread_for_support }}
                                </span>
                            @endif
                        </button>
                    @empty
                        <div class="scm-empty">
                            <i class="fa fa-inbox fa-3x text-muted mb-2"></i>
                            <div class="fw-bold">{{ __('support_chat.no_conversations') }}</div>
                        </div>
                    @endforelse
                </div>
            </aside>

            {{-- Conversation panel --}}
            <section class="scm-main">
                @if (! $active)
                    <div class="scm-placeholder">
                        <i class="fa fa-comments fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">{{ __('support_chat.select_chat') }}</h5>
                        <p class="text-muted small">{{ __('support_chat.select_chat_hint') }}</p>
                    </div>
                @else
                    @php
                        $status = $active->subscriptionStatus();
                        $statusColor = [
                            'active' => 'success',
                            'expired' => 'danger',
                            'trial' => 'warning',
                        ][$status] ?? 'secondary';
                        $billing = $active->billingCode();
                    @endphp

                    {{-- Conversation header --}}
                    <div class="scm-main-head">
                        <div class="d-flex align-items-center gap-3">
                            <div class="scm-main-avatar">
                                {{ mb_strtoupper(mb_substr($active->admin->fullname ?? '?', 0, 1)) }}
                            </div>
                            <div>
                                <div class="scm-main-name">{{ $active->admin->fullname ?? '—' }}</div>
                                <div class="scm-main-meta">
                                    @if ($billing)
                                        <span class="scm-code">#{{ $billing }}</span>
                                    @endif
                                    <span class="badge bg-{{ $statusColor }}-soft text-{{ $statusColor }}">
                                        {{ __('support_chat.sub_'.$status) }}
                                    </span>
                                    @if (optional($active->network)->plan)
                                        <span class="text-muted small">
                                            <i class="fa fa-tag"></i> {{ $active->network->plan->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            @if ($active->status === \App\Models\SupportChat::STATUS_OPEN)
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                        wire:click="closeConversation">
                                    <i class="fa fa-archive"></i>
                                    {{ __('support_chat.close_chat') }}
                                </button>
                            @else
                                <button type="button" class="btn btn-sm btn-outline-success"
                                        wire:click="reopenConversation">
                                    <i class="fa fa-refresh"></i>
                                    {{ __('support_chat.reopen_chat') }}
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Info bar with seen / replied --}}
                    <div class="scm-infobar">
                        @if ($active->seenByManager)
                            <span>
                                <i class="fa fa-eye"></i>
                                {{ __('support_chat.seen_by') }}
                                <strong>{{ $active->seenByManager->fullname ?? $active->seenByManager->name }}</strong>
                                @if ($active->seen_at)
                                    · {{ $active->seen_at->diffForHumans() }}
                                @endif
                            </span>
                        @endif
                        @if ($active->repliedByManager)
                            <span>
                                <i class="fa fa-reply"></i>
                                {{ __('support_chat.replied_by') }}
                                <strong>{{ $active->repliedByManager->fullname ?? $active->repliedByManager->name }}</strong>
                                @if ($active->replied_at)
                                    · {{ $active->replied_at->diffForHumans() }}
                                @endif
                            </span>
                        @endif
                    </div>

                    {{-- Thread --}}
                    <div class="scm-thread" x-ref="thread">
                        @php $prevDate = null; @endphp
                        @foreach ($activeMessages as $msg)
                            @php
                                $fromSupport = $msg->sender_type === \App\Models\SupportChat::SENDER_MANAGER;
                                $dateLabel = $msg->created_at ? $msg->created_at->translatedFormat('D, j M') : '';
                            @endphp
                            @if ($dateLabel !== $prevDate)
                                <div class="scm-divider"><span>{{ $dateLabel }}</span></div>
                                @php $prevDate = $dateLabel; @endphp
                            @endif

                            <div class="scm-row {{ $fromSupport ? 'scm-row-me' : 'scm-row-them' }}"
                                 wire:key="m-{{ $msg->id }}">
                                <div class="scm-bubble-wrap">
                                    <div class="scm-bubble {{ $fromSupport ? 'scm-me' : 'scm-them' }}">
                                        @if ($msg->replyTo)
                                            @php
                                                $qr = $msg->replyTo;
                                                $qrText = $qr->body
                                                    ?: ($qr->attachment_type === \App\Models\SupportChatMessage::ATTACHMENT_IMAGE
                                                        ? '🖼️ '.__('support_chat.image_message')
                                                        : ($qr->attachment_type === \App\Models\SupportChatMessage::ATTACHMENT_VOICE
                                                            ? '🎤 '.__('support_chat.voice_message')
                                                            : ''));
                                            @endphp
                                            <div class="scm-quote">
                                                <div class="scm-quote-who">
                                                    <i class="fa fa-reply"></i>
                                                    {{ $qr->sender_type === \App\Models\SupportChat::SENDER_MANAGER
                                                        ? __('support_chat.replying_to_me')
                                                        : __('support_chat.replying_to_them') }}
                                                </div>
                                                <div class="scm-quote-text">{{ \Illuminate\Support\Str::limit($qrText, 140) }}</div>
                                            </div>
                                        @endif
                                        @if ($msg->attachment_type === \App\Models\SupportChatMessage::ATTACHMENT_IMAGE && $msg->attachment_path)
                                            <a href="{{ route('support_chat.attachment', $msg) }}"
                                               target="_blank" rel="noopener">
                                                <img src="{{ route('support_chat.attachment', $msg) }}"
                                                     class="scm-image" alt="" loading="lazy">
                                            </a>
                                        @elseif ($msg->attachment_type === \App\Models\SupportChatMessage::ATTACHMENT_VOICE && $msg->attachment_path)
                                            <audio controls preload="metadata" class="scm-audio"
                                                   src="{{ route('support_chat.attachment', $msg) }}"></audio>
                                        @endif
                                        @if ($msg->body)
                                            <div class="scm-text">{{ $msg->body }}</div>
                                        @endif
                                        <div class="scm-meta">
                                            {{ $msg->created_at ? $msg->created_at->format('H:i') : '' }}
                                            @if ($fromSupport)
                                                @if ($msg->read_at)
                                                    <i class="fa fa-check-double text-info"></i>
                                                @else
                                                    <i class="fa fa-check"></i>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <button type="button" class="scm-reply-btn"
                                            wire:click="startReply({{ $msg->id }})"
                                            title="{{ __('support_chat.reply') }}">
                                        <i class="fa fa-reply"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Preview --}}
                    @if ($uploadedImage || $voiceFile)
                        <div class="scm-preview">
                            @if ($uploadedImage)
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $uploadedImage->temporaryUrl() }}" class="scm-preview-thumb" alt="">
                                    <span class="small text-muted">{{ __('support_chat.image_ready') }}</span>
                                    <button type="button" class="btn btn-sm btn-link text-danger ms-auto"
                                            wire:click="$set('uploadedImage', null)">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            @elseif ($voiceFile)
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <i class="fa fa-microphone text-warning fa-lg"></i>
                                    <audio controls preload="metadata" class="scm-audio"
                                           x-init="if (window.__scmLastVoiceUrl) { $el.src = window.__scmLastVoiceUrl; }"></audio>
                                    <span class="small text-muted">{{ __('support_chat.voice_ready') }}</span>
                                    <button type="button" class="btn btn-sm btn-link text-danger ms-auto"
                                            wire:click="$set('voiceFile', null)">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Reply preview --}}
                    @php $replying = $this->replyingTo; @endphp
                    @if ($replying)
                        <div class="scm-reply-preview">
                            <div class="scm-reply-bar"></div>
                            <div class="flex-grow-1">
                                <div class="scm-reply-who">
                                    <i class="fa fa-reply"></i>
                                    {{ $replying->sender_type === \App\Models\SupportChat::SENDER_MANAGER
                                        ? __('support_chat.replying_to_me')
                                        : __('support_chat.replying_to_them') }}
                                </div>
                                <div class="scm-reply-text">
                                    {{ \Illuminate\Support\Str::limit(
                                        $replying->body
                                            ?: ($replying->attachment_type === \App\Models\SupportChatMessage::ATTACHMENT_IMAGE
                                                ? '🖼️ '.__('support_chat.image_message')
                                                : ($replying->attachment_type === \App\Models\SupportChatMessage::ATTACHMENT_VOICE
                                                    ? '🎤 '.__('support_chat.voice_message')
                                                    : '')),
                                        140) }}
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-link text-danger"
                                    wire:click="cancelReply"
                                    title="{{ __('support_chat.cancel_reply') }}">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    @endif

                    {{-- Composer --}}
                    @error('newReply')
                        <div class="alert alert-danger m-2 mb-0 py-2 px-3" style="font-size: 13px;">{{ $message }}</div>
                    @enderror
                    @error('uploadedImage')
                        <div class="alert alert-danger m-2 mb-0 py-2 px-3" style="font-size: 13px;">{{ $message }}</div>
                    @enderror

                    {{-- Recording bar (shown while recording) --}}
                    <div class="scm-record-bar" x-show="recording" x-cloak>
                        <button type="button" class="scm-icon-btn text-danger"
                                @click="cancelRecording"
                                title="{{ __('support_chat.cancel') }}">
                            <i class="fa fa-trash"></i>
                        </button>
                        <div class="scm-record-meter">
                            <span class="scm-record-dot"></span>
                            <span class="scm-record-wave">
                                @for ($i = 0; $i < 14; $i++)
                                    <span style="animation-delay: {{ $i * 0.08 }}s"></span>
                                @endfor
                            </span>
                            <span class="scm-record-time" x-text="formatRecTime(recordSeconds)"></span>
                        </div>
                        <button type="button" class="scm-send-btn" @click="stopAndSend"
                                title="{{ __('support_chat.send_voice') }}">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </div>

                    <form class="scm-composer" x-show="!recording" x-cloak wire:submit.prevent="sendReply">
                        <button type="button" class="scm-icon-btn"
                                @click="showEmoji = !showEmoji; showShortcuts = false"
                                title="{{ __('support_chat.emoji') }}">
                            <i class="fa fa-smile-o"></i>
                        </button>
                        <label class="scm-icon-btn m-0" title="{{ __('support_chat.attach_image') }}">
                            <i class="fa fa-image"></i>
                            <input type="file" accept="image/*" class="d-none" wire:model="uploadedImage">
                        </label>
                        <button type="button" class="scm-icon-btn"
                                @click="toggleRecord"
                                title="{{ __('support_chat.record_voice') }}">
                            <i class="fa fa-microphone"></i>
                        </button>
                        <button type="button" class="scm-icon-btn"
                                @click="showShortcuts = !showShortcuts; showEmoji = false"
                                title="{{ __('support_chat.shortcuts') }}">
                            <i class="fa fa-bolt"></i>
                        </button>

                        <div class="scm-shortcuts-panel" x-show="showShortcuts" x-cloak
                             @click.outside="showShortcuts = false">
                            <div class="scm-shortcuts-title">
                                <i class="fa fa-bolt"></i> {{ __('support_chat.shortcuts') }}
                            </div>
                            @foreach ((array) __('support_chat.quick_replies') as $phrase)
                                <button type="button" class="scm-shortcut-chip"
                                        @click="insertShortcut(@js($phrase))">
                                    {{ $phrase }}
                                </button>
                            @endforeach
                        </div>

                        <div class="scm-emoji-panel" x-show="showEmoji" x-cloak
                             @click.outside="showEmoji = false">
                            @foreach (['😀','😁','😂','🤣','😊','😍','😘','😎','🤔','😢','😡','👍','👎','🙏','❤️','🔥','🎉','✅','❌','💯','🙌','👌','💪','🤝'] as $e)
                                <button type="button" class="scm-emoji" @click="addEmoji('{{ $e }}')">{{ $e }}</button>
                            @endforeach
                        </div>

                        <textarea wire:model="newReply"
                                  x-ref="reply"
                                  class="scm-input"
                                  rows="1"
                                  placeholder="{{ __('support_chat.type_reply') }}"
                                  @keydown.enter.prevent="if (!$event.shiftKey) { $wire.sendReply(); }"></textarea>

                        <button type="submit" class="scm-send-btn"
                                wire:loading.attr="disabled"
                                wire:target="sendReply,uploadedImage,voiceFile">
                            <span wire:loading.remove wire:target="sendReply,uploadedImage,voiceFile">
                                <i class="fa fa-paper-plane"></i>
                            </span>
                            <span wire:loading wire:target="sendReply,uploadedImage,voiceFile">
                                <i class="fa fa-spinner fa-spin"></i>
                            </span>
                        </button>
                    </form>
                @endif
            </section>
        </div>
    </div>
    @endif

    @once
        @push('styles')
            <style>
                /* === Support Chat (Manager full-page) === */
                .scm-wrap { padding: 8px 0; }
                .scm-card {
                    max-width: 1280px;
                    margin: 0 auto;
                    background: #fff;
                    border-radius: 16px;
                    box-shadow: 0 10px 40px rgba(0,0,0,.08);
                    overflow: hidden;
                    display: flex;
                    height: calc(100vh - 190px);
                    min-height: 560px;
                }

                .scm-side {
                    width: 340px;
                    min-width: 340px;
                    border-inline-end: 1px solid #e5e7eb;
                    display: flex;
                    flex-direction: column;
                    background: #f8fafc;
                }
                .scm-side-head {
                    padding: 14px;
                    background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
                    color: #fff;
                }
                .scm-search { padding-inline-end: 28px; }
                .scm-search-icon {
                    position: absolute;
                    top: 50%;
                    inset-inline-end: 10px;
                    transform: translateY(-50%);
                    color: #94a3b8;
                    font-size: 12px;
                    pointer-events: none;
                }
                .scm-new-btn {
                    background: #f59e0b;
                    color: #fff;
                    border: none;
                    width: 30px; height: 30px;
                    border-radius: 50%;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    font-size: 13px;
                    transition: transform .15s, background .15s;
                }
                .scm-new-btn:hover { background: #ea580c; transform: scale(1.08); }
                .scm-new-chat-box {
                    background: rgba(255,255,255,.06);
                    border: 1px solid rgba(255,255,255,.12);
                    border-radius: 10px;
                    padding: 10px;
                    margin-bottom: 10px;
                }
                .scm-new-chat-input {
                    background: rgba(255,255,255,.08) !important;
                    color: #fff !important;
                    border: 1px solid rgba(255,255,255,.2) !important;
                    font-variant-numeric: tabular-nums;
                    letter-spacing: 1px;
                }
                .scm-new-chat-input::placeholder { color: rgba(255,255,255,.55) !important; }
                .scm-new-chat-input:focus {
                    background: rgba(255,255,255,.12) !important;
                    border-color: #f59e0b !important;
                    box-shadow: 0 0 0 3px rgba(245,158,11,.2) !important;
                }
                .scm-new-chat-result {
                    margin-top: 10px;
                    background: rgba(0,0,0,.2);
                    border-radius: 8px;
                    padding: 10px;
                }
                .scm-new-chat-empty {
                    color: #fca5a5;
                    font-size: 13px;
                }
                .text-muted-soft { color: rgba(255,255,255,.65); font-size: 12px; }

                .scm-filters { display: flex; flex-wrap: wrap; gap: 4px; }
                .scm-chip {
                    background: rgba(255,255,255,.1);
                    color: #fff;
                    border: 1px solid rgba(255,255,255,.2);
                    padding: 3px 10px;
                    border-radius: 999px;
                    font-size: 11px;
                    cursor: pointer;
                    transition: all .15s;
                }
                .scm-chip:hover { background: rgba(255,255,255,.2); }
                .scm-chip-active {
                    background: #f59e0b;
                    color: #0f172a;
                    border-color: #f59e0b;
                    font-weight: 600;
                }

                .scm-list { flex: 1; overflow-y: auto; }
                .scm-item {
                    width: 100%;
                    display: flex;
                    align-items: flex-start;
                    gap: 10px;
                    padding: 12px 14px;
                    background: transparent;
                    border: none;
                    border-bottom: 1px solid #e5e7eb;
                    text-align: start;
                    cursor: pointer;
                    transition: background .15s;
                    position: relative;
                }
                .scm-item:hover { background: #fff; }
                .scm-item-active {
                    background: #fff !important;
                    border-inline-start: 3px solid #f59e0b;
                }
                .scm-item-avatar {
                    width: 38px; height: 38px;
                    border-radius: 50%;
                    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
                    color: #fff;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: 700;
                    flex-shrink: 0;
                }
                .scm-item-body { flex: 1; min-width: 0; }
                .scm-item-row {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 6px;
                    margin-bottom: 2px;
                }
                .scm-item-name {
                    font-weight: 600;
                    font-size: 13px;
                    color: #0f172a;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                    flex: 1;
                }
                .scm-item-time { font-size: 10px; color: #64748b; flex-shrink: 0; }
                .scm-code { font-size: 10px; color: #64748b; font-family: monospace; }
                .scm-status { font-size: 10px !important; padding: 2px 8px !important; }
                .scm-item-preview {
                    font-size: 12px;
                    color: #475569;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                }
                .scm-unread {
                    position: absolute;
                    top: 12px;
                    inset-inline-end: 12px;
                    background: #ef4444;
                    color: #fff;
                    min-width: 20px;
                    height: 20px;
                    padding: 0 6px;
                    border-radius: 999px;
                    font-size: 10px;
                    font-weight: 700;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                }
                .scm-empty { text-align: center; padding: 40px 20px; color: #94a3b8; }

                .scm-main { flex: 1; display: flex; flex-direction: column; min-width: 0; }
                .scm-placeholder {
                    margin: auto;
                    text-align: center;
                    padding: 40px;
                }
                .scm-main-head {
                    padding: 14px 18px;
                    border-bottom: 1px solid #e5e7eb;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 12px;
                    flex-wrap: wrap;
                    background: #fff;
                }
                .scm-main-avatar {
                    width: 42px; height: 42px;
                    border-radius: 50%;
                    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
                    color: #fff;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    font-weight: 700;
                    font-size: 16px;
                }
                .scm-main-name { font-weight: 700; color: #0f172a; }
                .scm-main-meta {
                    display: flex;
                    gap: 8px;
                    align-items: center;
                    flex-wrap: wrap;
                    font-size: 11px;
                }

                .scm-infobar {
                    padding: 6px 18px;
                    background: #f1f5f9;
                    border-bottom: 1px solid #e5e7eb;
                    font-size: 11px;
                    color: #475569;
                    display: flex;
                    gap: 16px;
                    flex-wrap: wrap;
                }
                .scm-infobar:empty { display: none; }

                .scm-thread {
                    flex: 1;
                    overflow-y: auto;
                    padding: 18px;
                    background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
                    display: flex;
                    flex-direction: column;
                    gap: 8px;
                }
                .scm-divider { text-align: center; margin: 8px 0; }
                .scm-divider span {
                    background: #e2e8f0;
                    color: #64748b;
                    padding: 2px 12px;
                    border-radius: 12px;
                    font-size: 11px;
                }
                .scm-row { display: flex; }
                .scm-row-me { justify-content: flex-end; }
                .scm-row-them { justify-content: flex-start; }
                .scm-bubble {
                    max-width: 68%;
                    padding: 10px 14px;
                    border-radius: 16px;
                    font-size: 14px;
                    line-height: 1.55;
                    word-wrap: break-word;
                    box-shadow: 0 2px 8px rgba(15,23,42,.05);
                }
                .scm-me {
                    background: linear-gradient(135deg, #10b981, #059669);
                    color: #fff;
                    border-bottom-right-radius: 4px;
                }
                .scm-them {
                    background: #fff;
                    color: #0f172a;
                    border: 1px solid #e5e7eb;
                    border-bottom-left-radius: 4px;
                }
                html[dir="rtl"] .scm-me {
                    border-bottom-right-radius: 16px;
                    border-bottom-left-radius: 4px;
                }
                html[dir="rtl"] .scm-them {
                    border-bottom-left-radius: 16px;
                    border-bottom-right-radius: 4px;
                }
                .scm-text { white-space: pre-wrap; }
                .scm-meta {
                    font-size: 10px;
                    opacity: .75;
                    margin-top: 4px;
                    text-align: end;
                    display: flex;
                    justify-content: flex-end;
                    gap: 4px;
                    align-items: center;
                }
                .scm-bubble-wrap {
                    display: flex;
                    align-items: center;
                    gap: 4px;
                    max-width: 78%;
                }
                .scm-row-me .scm-bubble-wrap { flex-direction: row-reverse; }
                .scm-bubble-wrap .scm-bubble { max-width: 100%; }
                .scm-reply-btn {
                    background: transparent;
                    border: none;
                    color: #94a3b8;
                    width: 28px; height: 28px;
                    border-radius: 50%;
                    opacity: 0;
                    transition: opacity .15s, background .15s, color .15s;
                    font-size: 12px;
                }
                .scm-row:hover .scm-reply-btn { opacity: 1; }
                .scm-reply-btn:hover { background: #e2e8f0; color: #1e293b; }
                .scm-quote {
                    border-inline-start: 3px solid rgba(255,255,255,.55);
                    background: rgba(255,255,255,.12);
                    padding: 6px 8px;
                    border-radius: 8px;
                    margin-bottom: 6px;
                    font-size: 12px;
                }
                .scm-them .scm-quote {
                    border-inline-start-color: #f59e0b;
                    background: #fff7e6;
                    color: #475569;
                }
                .scm-quote-who { font-weight: 600; opacity: .85; font-size: 11px; }
                .scm-quote-text {
                    white-space: pre-wrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                }
                .scm-reply-preview {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    padding: 8px 14px;
                    background: #fff7e6;
                    border-top: 1px solid #f3d58a;
                }
                .scm-reply-bar {
                    width: 3px;
                    align-self: stretch;
                    background: #f59e0b;
                    border-radius: 3px;
                }
                .scm-reply-who {
                    font-size: 11px;
                    font-weight: 700;
                    color: #d97706;
                }
                .scm-reply-text {
                    font-size: 12px;
                    color: #475569;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                }
                .scm-image {
                    max-width: 100%;
                    max-height: 260px;
                    border-radius: 10px;
                    display: block;
                    margin-bottom: 6px;
                }
                .scm-audio { width: 260px; max-width: 100%; margin-bottom: 4px; }

                .scm-preview {
                    padding: 10px 16px;
                    background: #fff7e6;
                    border-top: 1px solid #f3d58a;
                }
                .scm-preview-thumb {
                    width: 44px; height: 44px;
                    object-fit: cover;
                    border-radius: 8px;
                }

                .scm-composer {
                    display: flex;
                    align-items: flex-end;
                    gap: 8px;
                    padding: 12px 16px;
                    background: #fff;
                    border-top: 1px solid #e5e7eb;
                    position: relative;
                }
                .scm-emoji-panel {
                    position: absolute;
                    bottom: 64px;
                    inset-inline-start: 16px;
                    background: #fff;
                    border: 1px solid #e5e7eb;
                    border-radius: 12px;
                    box-shadow: 0 12px 30px rgba(15,23,42,.12);
                    padding: 8px;
                    display: grid;
                    grid-template-columns: repeat(8, 1fr);
                    gap: 4px;
                    max-width: 300px;
                    z-index: 20;
                }
                .scm-emoji {
                    background: transparent;
                    border: none;
                    font-size: 20px;
                    line-height: 1;
                    padding: 4px;
                    border-radius: 6px;
                    cursor: pointer;
                }
                .scm-emoji:hover { background: #f1f5f9; }

                .scm-shortcuts-panel {
                    position: absolute;
                    bottom: 70px;
                    inset-inline-start: 16px;
                    background: #fff;
                    border: 1px solid #e5e7eb;
                    border-radius: 12px;
                    box-shadow: 0 12px 30px rgba(15,23,42,.12);
                    padding: 10px;
                    max-width: min(460px, calc(100% - 32px));
                    display: flex;
                    flex-wrap: wrap;
                    gap: 6px;
                    z-index: 25;
                }
                .scm-shortcuts-title {
                    width: 100%;
                    font-size: 12px;
                    font-weight: 700;
                    color: #475569;
                    margin-bottom: 2px;
                }
                .scm-shortcut-chip {
                    background: #f0fdf4;
                    border: 1px solid #bbf7d0;
                    color: #065f46;
                    border-radius: 18px;
                    padding: 6px 12px;
                    font-size: 13px;
                    cursor: pointer;
                    transition: background .15s, border-color .15s;
                }
                .scm-shortcut-chip:hover {
                    background: #dcfce7;
                    border-color: #10b981;
                }
                [x-cloak] { display: none !important; }
                .scm-icon-btn {
                    background: transparent;
                    border: 1px solid transparent;
                    border-radius: 50%;
                    width: 40px;
                    height: 40px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    color: #475569;
                    cursor: pointer;
                    font-size: 17px;
                }
                .scm-icon-btn:hover { background: #f1f5f9; color: #1e293b; }
                .scm-icon-btn-rec {
                    background: #ef4444 !important;
                    color: #fff !important;
                    animation: scm-pulse-rec 1s infinite;
                }
                @keyframes scm-pulse-rec {
                    0%,100% { box-shadow: 0 0 0 0 rgba(239,68,68,.55); }
                    50%     { box-shadow: 0 0 0 8px rgba(239,68,68,0); }
                }

                /* --- WhatsApp-style recording bar (manager) --- */
                .scm-record-bar {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    padding: 12px 16px;
                    background: #fff;
                    border-top: 1px solid #e5e7eb;
                }
                .scm-record-meter {
                    flex: 1;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    background: #f8fafc;
                    border: 1px solid #e5e7eb;
                    border-radius: 28px;
                    padding: 8px 18px;
                    height: 44px;
                }
                .scm-record-dot {
                    width: 10px; height: 10px;
                    border-radius: 50%;
                    background: #ef4444;
                    animation: scm-rec-blink 1s infinite;
                    flex-shrink: 0;
                }
                @keyframes scm-rec-blink {
                    0%,100% { opacity: 1; }
                    50%     { opacity: .25; }
                }
                .scm-record-wave {
                    flex: 1;
                    display: inline-flex;
                    align-items: center;
                    gap: 3px;
                    height: 24px;
                }
                .scm-record-wave span {
                    display: inline-block;
                    width: 3px;
                    background: #ef4444;
                    border-radius: 2px;
                    animation: scm-wave 1s ease-in-out infinite;
                }
                @keyframes scm-wave {
                    0%,100% { height: 6px; opacity: .55; }
                    50%     { height: 22px; opacity: 1; }
                }
                .scm-record-time {
                    font-variant-numeric: tabular-nums;
                    font-weight: 700;
                    color: #334155;
                    font-size: 14px;
                    min-width: 42px;
                    text-align: end;
                }
                .scm-input {
                    flex: 1;
                    border: 1px solid #e5e7eb;
                    border-radius: 24px;
                    padding: 10px 16px;
                    resize: none;
                    max-height: 140px;
                    font-size: 14px;
                    outline: none;
                    background: #f8fafc;
                }
                .scm-input:focus { border-color: #10b981; background: #fff; }
                .scm-send-btn {
                    border: none;
                    border-radius: 50%;
                    width: 44px;
                    height: 44px;
                    color: #fff;
                    background: linear-gradient(135deg, #10b981, #059669);
                    font-size: 16px;
                    cursor: pointer;
                    box-shadow: 0 6px 14px rgba(16,185,129,.3);
                    flex-shrink: 0;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                }
                .scm-send-btn:disabled { opacity: .6; cursor: not-allowed; }

                .bg-success-soft { background: rgba(16,185,129,.12); }
                .bg-danger-soft { background: rgba(239,68,68,.12); }
                .bg-warning-soft { background: rgba(245,158,11,.12); }
                .bg-secondary-soft { background: rgba(100,116,139,.12); }
                .text-success { color: #059669 !important; }
                .text-danger { color: #dc2626 !important; }
                .text-warning { color: #b45309 !important; }
                .text-secondary { color: #64748b !important; }

                @media (max-width: 900px) {
                    .scm-card { flex-direction: column; height: auto; }
                    .scm-side { width: 100%; min-width: 0; max-height: 300px; }
                    .scm-main { min-height: 500px; }
                }
            </style>
        @endpush
    @endonce
</div>
