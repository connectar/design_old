<div wire:poll.3s="pollMessages">
    @php
        /** @var \Illuminate\Support\Collection<int,\App\Models\GeneralChatMessage> $messages */
        $messages = $this->messages;
        $replying = $this->replyingTo;
    @endphp

    <div class="gcp-wrap"
         x-data="{
            scrollBottom() {
                const el = this.$refs.list;
                if (el) { el.scrollTop = el.scrollHeight; }
            },
            recording: false,
            mediaRecorder: null,
            chunks: [],
            recordSeconds: 0,
            recordTimer: null,
            cancelledRecord: false,
            showEmoji: false,
            showShortcuts: false,
            insertShortcut(text) {
                const cur = @this.get('newMessage') || '';
                const next = cur.trim() === '' ? text : (cur.replace(/\s+$/, '') + ' ' + text);
                @this.set('newMessage', next, false);
                this.showShortcuts = false;
                this.$nextTick(() => {
                    const ta = this.$refs.composer;
                    if (ta) { ta.focus(); ta.selectionStart = ta.selectionEnd = ta.value.length; }
                });
            },
            async toggleRecord() {
                if (this.recording) { this.stopAndSend(); } else { await this.startRecord(); }
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
                        const wasCancelled = this.cancelledRecord;
                        this.chunks = this.chunks || [];
                        if (wasCancelled) { this.chunks = []; return; }
                        const blob = new Blob(this.chunks, { type: mime });
                        const ext = mime.includes('webm') ? 'webm' : 'ogg';
                        const file = new File([blob], `voice-${Date.now()}.${ext}`, { type: mime });
                        window.__gcpLastVoiceUrl = URL.createObjectURL(blob);
                        @this.upload('voiceFile', file,
                            () => { @this.sendMessage(); },
                            () => {},
                            () => {}
                        );
                    };
                    this.mediaRecorder.start();
                    this.recording = true;
                    this.recordSeconds = 0;
                    this.recordTimer = setInterval(() => { this.recordSeconds++; }, 1000);
                } catch (e) {
                    alert('{{ __('general_chat.mic_error') }}');
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
            },
            addEmoji(e) {
                const ta = this.$refs.composer;
                const cur = @this.get('newMessage') || '';
                @this.set('newMessage', cur + e, false);
                this.showEmoji = false;
                this.$nextTick(() => ta && ta.focus());
            }
         }"
         x-init="$nextTick(() => scrollBottom());
                 Livewire.hook('morph.updated', () => scrollBottom());">

        <div class="gcp-card gcp-room-{{ $room }}">
            {{-- Header / Room tabs --}}
            <div class="gcp-header">
                <div class="d-flex align-items-center gap-3">
                    <div class="gcp-avatar">
                        <i class="fa {{ $room === \App\Models\GeneralChatMessage::ROOM_MANAGERS ? 'fa-user-secret' : 'fa-comments' }}"></i>
                    </div>
                    <div>
                        <div class="gcp-title">
                            {{ $room === \App\Models\GeneralChatMessage::ROOM_MANAGERS
                                ? __('general_chat.room_managers_title')
                                : __('general_chat.room_public_title') }}
                        </div>
                        <div class="gcp-sub">
                            <span class="gcp-dot"></span>
                            {{ $room === \App\Models\GeneralChatMessage::ROOM_MANAGERS
                                ? __('general_chat.room_managers_sub')
                                : __('general_chat.room_public_sub') }}
                        </div>
                    </div>
                </div>

                @if (count($availableRooms) > 1)
                    <div class="gcp-tabs">
                        @foreach ($availableRooms as $r)
                            <button type="button"
                                    class="gcp-tab {{ $room === $r ? 'gcp-tab-active' : '' }}"
                                    wire:click="switchRoom('{{ $r }}')">
                                <i class="fa {{ $r === \App\Models\GeneralChatMessage::ROOM_MANAGERS ? 'fa-user-secret' : 'fa-globe' }}"></i>
                                {{ $r === \App\Models\GeneralChatMessage::ROOM_MANAGERS
                                    ? __('general_chat.room_managers_short')
                                    : __('general_chat.room_public_short') }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            @if (! $canAccess)
                <div class="gcp-denied">
                    <i class="fa fa-lock gcp-empty-icon"></i>
                    <div class="mt-2 fw-bold">{{ __('general_chat.access_denied') }}</div>
                    <div class="small text-muted">{{ __('general_chat.not_active_subscription') }}</div>
                </div>
            @else
                {{-- Messages list --}}
                <div class="gcp-body" x-ref="list">
                    @if ($messages->isEmpty())
                        <div class="gcp-empty">
                            <i class="fa fa-comments gcp-empty-icon"></i>
                            <div class="mt-2 fw-bold">{{ __('general_chat.no_messages_yet') }}</div>
                            <div class="small text-muted">{{ __('general_chat.start_conversation_hint') }}</div>
                        </div>
                    @else
                        @php $prevDate = null; @endphp
                        @foreach ($messages as $msg)
                            @php
                                $fromMe = (int) $msg->sender_id === (int) $viewerId;
                                $isDeleted = $msg->deleted_at !== null;
                                $canDelete = ! $isDeleted && ($fromMe || $isManager);
                                $senderName = $msg->sender?->fullname
                                    ?: ($msg->sender?->name ?: ($msg->sender_name_snapshot ?: '#'.$msg->sender_id));
                                $senderRole = $msg->sender_type_snapshot ?? $msg->sender?->type;
                                $isManagerSender = in_array($senderRole, [
                                    \App\ENUMS\AdminTypeEnum::TYPE_SUPER_MANGER,
                                    \App\ENUMS\AdminTypeEnum::TYPE_MANGER,
                                    \App\ENUMS\AdminTypeEnum::TYPE_SYSTEM_DISTRIBUTOR,
                                ], true);
                                $dateLabel = $msg->created_at ? $msg->created_at->translatedFormat('D, j M') : '';
                            @endphp
                            @if ($dateLabel !== $prevDate)
                                <div class="gcp-divider"><span>{{ $dateLabel }}</span></div>
                                @php $prevDate = $dateLabel; @endphp
                            @endif

                            <div class="gcp-row {{ $fromMe ? 'gcp-row-me' : 'gcp-row-them' }}"
                                 wire:key="gmsg-{{ $msg->id }}">
                                @unless ($fromMe)
                                    @php
                                        $senderAvatarUrl = $msg->sender?->avatarUrl();
                                        $initial = mb_substr(trim($senderName), 0, 1);
                                        $avatarColor = 'hsl(' . (crc32((string) $msg->sender_id) % 360) . ', 55%, 45%)';
                                    @endphp
                                    <button type="button"
                                            class="gcp-msg-avatar {{ $isManagerSender ? 'gcp-avatar-mgr' : '' }}"
                                            style="{{ $senderAvatarUrl ? '' : ('background:' . $avatarColor . ';') }}"
                                            wire:click="openProfile({{ $msg->sender_id }})"
                                            title="{{ $senderName }}">
                                        @if ($senderAvatarUrl)
                                            <img src="{{ $senderAvatarUrl }}" alt="" class="gcp-msg-avatar-img">
                                        @elseif ($isManagerSender)
                                            <i class="fa fa-user-secret"></i>
                                        @else
                                            <span class="gcp-avatar-initial">{{ mb_strtoupper($initial) }}</span>
                                        @endif
                                    </button>
                                @endunless
                                <div class="gcp-bubble-wrap">
                                    <div class="gcp-bubble {{ $fromMe ? 'gcp-me' : 'gcp-them' }} {{ $isDeleted ? 'gcp-deleted' : '' }}">
                                        @unless ($fromMe)
                                            <button type="button" class="gcp-sender gcp-sender-btn"
                                                    wire:click="openProfile({{ $msg->sender_id }})">
                                                {{ $senderName }}
                                                @if ($isManagerSender)
                                                    <span class="gcp-role-badge">
                                                        <i class="fa fa-shield"></i>
                                                        {{ __('general_chat.role_support') }}
                                                    </span>
                                                @endif
                                            </button>
                                        @endunless

                                        @if ($isDeleted)
                                            <div class="gcp-text gcp-text-deleted">
                                                <i class="fa fa-ban"></i>
                                                {{ __('general_chat.message_deleted') }}
                                            </div>
                                        @else
                                            @if ($msg->replyTo)
                                                @php
                                                    $qr = $msg->replyTo;
                                                    $qrText = $qr->body
                                                        ?: ($qr->attachment_type === \App\Models\GeneralChatMessage::ATTACHMENT_IMAGE
                                                            ? '🖼️ '.__('general_chat.image_message')
                                                            : ($qr->attachment_type === \App\Models\GeneralChatMessage::ATTACHMENT_VOICE
                                                                ? '🎤 '.__('general_chat.voice_message')
                                                                : ''));
                                                    $qrWho = $qr->sender_name_snapshot ?: '#'.$qr->sender_id;
                                                @endphp
                                                <div class="gcp-quote">
                                                    <div class="gcp-quote-who">
                                                        <i class="fa fa-reply"></i>
                                                        {{ $qrWho }}
                                                    </div>
                                                    <div class="gcp-quote-text">{{ \Illuminate\Support\Str::limit($qrText, 140) }}</div>
                                                </div>
                                            @endif
                                            @if ($msg->attachment_type === \App\Models\GeneralChatMessage::ATTACHMENT_IMAGE && $msg->attachment_path)
                                                <a href="{{ route('general_chat.attachment', $msg) }}"
                                                   target="_blank" rel="noopener">
                                                    <img src="{{ route('general_chat.attachment', $msg) }}"
                                                         class="gcp-image" alt="" loading="lazy">
                                                </a>
                                            @elseif ($msg->attachment_type === \App\Models\GeneralChatMessage::ATTACHMENT_VOICE && $msg->attachment_path)
                                                <audio controls preload="metadata" class="gcp-audio"
                                                       src="{{ route('general_chat.attachment', $msg) }}"></audio>
                                            @endif
                                            @if ($msg->body)
                                                <div class="gcp-text">{{ $msg->body }}</div>
                                            @endif
                                        @endif

                                        <div class="gcp-meta">
                                            {{ $msg->created_at ? $msg->created_at->format('H:i') : '' }}
                                        </div>
                                    </div>
                                    @unless ($isDeleted)
                                        <div class="gcp-actions">
                                            @if ($canWrite)
                                                <button type="button" class="gcp-action-btn"
                                                        wire:click="startReply({{ $msg->id }})"
                                                        title="{{ __('general_chat.reply') }}">
                                                    <i class="fa fa-reply"></i>
                                                </button>
                                            @endif
                                            @if ($canDelete)
                                                <button type="button" class="gcp-action-btn gcp-action-danger"
                                                        wire:click="deleteMessage({{ $msg->id }})"
                                                        wire:confirm="{{ __('general_chat.confirm_delete') }}"
                                                        title="{{ __('general_chat.delete') }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    @endunless
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                @if (! $canWrite)
                    <div class="gcp-readonly-notice">
                        <i class="fa fa-info-circle"></i>
                        {{ __('general_chat.not_active_subscription') }}
                    </div>
                @else
                    {{-- Attachment preview --}}
                    @if ($uploadedImage || $voiceFile)
                        <div class="gcp-preview">
                            @if ($uploadedImage)
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $uploadedImage->temporaryUrl() }}" class="gcp-preview-thumb" alt="">
                                    <span class="small text-muted">{{ __('general_chat.image_ready') }}</span>
                                    <button type="button" class="btn btn-sm btn-link text-danger ms-auto"
                                            wire:click="$set('uploadedImage', null)">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            @elseif ($voiceFile)
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <i class="fa fa-microphone text-warning fa-lg"></i>
                                    <audio controls preload="metadata" class="gcp-audio"
                                           x-ref="voicePreview"
                                           x-init="if (window.__gcpLastVoiceUrl) { $el.src = window.__gcpLastVoiceUrl; }"></audio>
                                    <span class="small text-muted">{{ __('general_chat.voice_ready') }}</span>
                                    <button type="button" class="btn btn-sm btn-link text-danger ms-auto"
                                            wire:click="$set('voiceFile', null)">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Reply preview --}}
                    @if ($replying && ! $replying->deleted_at)
                        <div class="gcp-reply-preview">
                            <div class="gcp-reply-bar"></div>
                            <div class="flex-grow-1">
                                <div class="gcp-reply-who">
                                    <i class="fa fa-reply"></i>
                                    {{ $replying->sender_name_snapshot ?: ('#'.$replying->sender_id) }}
                                </div>
                                <div class="gcp-reply-text">
                                    {{ \Illuminate\Support\Str::limit(
                                        $replying->body
                                            ?: ($replying->attachment_type === \App\Models\GeneralChatMessage::ATTACHMENT_IMAGE
                                                ? '🖼️ '.__('general_chat.image_message')
                                                : ($replying->attachment_type === \App\Models\GeneralChatMessage::ATTACHMENT_VOICE
                                                    ? '🎤 '.__('general_chat.voice_message')
                                                    : '')),
                                        140) }}
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-link text-danger"
                                    wire:click="cancelReply"
                                    title="{{ __('general_chat.cancel_reply') }}">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    @endif

                    {{-- Validation errors --}}
                    @error('newMessage')
                        <div class="alert alert-danger m-2 mb-0 py-2 px-3" style="font-size: 13px;">{{ $message }}</div>
                    @enderror
                    @error('uploadedImage')
                        <div class="alert alert-danger m-2 mb-0 py-2 px-3" style="font-size: 13px;">{{ $message }}</div>
                    @enderror
                    @error('voiceFile')
                        <div class="alert alert-danger m-2 mb-0 py-2 px-3" style="font-size: 13px;">{{ $message }}</div>
                    @enderror

                    {{-- Recording bar --}}
                    <div class="gcp-record-bar" x-show="recording" x-cloak>
                        <button type="button" class="gcp-icon-btn text-danger"
                                @click="cancelRecording"
                                title="{{ __('general_chat.cancel') }}">
                            <i class="fa fa-trash"></i>
                        </button>
                        <div class="gcp-record-meter">
                            <span class="gcp-record-dot"></span>
                            <span class="gcp-record-wave">
                                @for ($i = 0; $i < 14; $i++)
                                    <span style="animation-delay: {{ $i * 0.08 }}s"></span>
                                @endfor
                            </span>
                            <span class="gcp-record-time" x-text="formatRecTime(recordSeconds)"></span>
                        </div>
                        <button type="button" class="gcp-send-btn" @click="stopAndSend"
                                title="{{ __('general_chat.send_voice') }}">
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </div>

                    <form class="gcp-composer" x-show="!recording" x-cloak wire:submit.prevent="sendMessage">
                        <div class="gcp-composer-actions">
                            <button type="button" class="gcp-icon-btn" @click="showEmoji = !showEmoji; showShortcuts = false"
                                    title="{{ __('general_chat.emoji') }}">
                                <i class="fa fa-smile-o"></i>
                            </button>
                            <label class="gcp-icon-btn m-0" title="{{ __('general_chat.attach_image') }}">
                                <i class="fa fa-image"></i>
                                <input type="file" accept="image/*" class="d-none" wire:model="uploadedImage">
                            </label>
                            <button type="button" class="gcp-icon-btn"
                                    @click="toggleRecord"
                                    title="{{ __('general_chat.record_voice') }}">
                                <i class="fa fa-microphone"></i>
                            </button>
                            <button type="button" class="gcp-icon-btn" @click="showShortcuts = !showShortcuts; showEmoji = false"
                                    title="{{ __('general_chat.shortcuts') }}">
                                <i class="fa fa-bolt"></i>
                            </button>
                        </div>

                        <div class="gcp-emoji-panel" x-show="showEmoji" x-cloak @click.outside="showEmoji = false">
                            @foreach (['😀','😁','😂','🤣','😊','😍','😘','😎','🤔','😢','😡','👍','👎','🙏','❤️','🔥','🎉','✅','❌','💯','🙌','👌','💪','🤝'] as $e)
                                <button type="button" class="gcp-emoji" @click="addEmoji('{{ $e }}')">{{ $e }}</button>
                            @endforeach
                        </div>

                        <div class="gcp-shortcuts-panel" x-show="showShortcuts" x-cloak @click.outside="showShortcuts = false">
                            <div class="gcp-shortcuts-title">
                                <i class="fa fa-bolt"></i> {{ __('general_chat.shortcuts') }}
                            </div>
                            @foreach ((array) __('general_chat.quick_replies') as $phrase)
                                <button type="button" class="gcp-shortcut-chip"
                                        @click="insertShortcut(@js($phrase))">
                                    {{ $phrase }}
                                </button>
                            @endforeach
                        </div>

                        <textarea wire:model="newMessage"
                                  x-ref="composer"
                                  class="gcp-input"
                                  rows="1"
                                  placeholder="{{ __('general_chat.type_message') }}"
                                  @keydown.enter.prevent="if (!$event.shiftKey) { $wire.sendMessage(); }"></textarea>

                        <button type="submit" class="gcp-send-btn"
                                wire:loading.attr="disabled"
                                wire:target="sendMessage,uploadedImage,voiceFile">
                            <span wire:loading.remove wire:target="sendMessage,uploadedImage,voiceFile">
                                <i class="fa fa-paper-plane"></i>
                            </span>
                            <span wire:loading wire:target="sendMessage,uploadedImage,voiceFile">
                                <i class="fa fa-spinner fa-spin"></i>
                            </span>
                        </button>
                    </form>
                @endif
            @endif
        </div>

        @if ($this->profileData)
            @php $pf = $this->profileData; @endphp
            <div class="gcp-profile-overlay" wire:click="closeProfile">
                <div class="gcp-profile-modal" wire:click.stop
                     wire:key="gcp-profile-{{ $pf['id'] }}">
                    <button type="button" class="gcp-profile-close" wire:click="closeProfile">
                        <i class="fa fa-times"></i>
                    </button>

                    <div class="gcp-profile-head">
                        @php
                            $pfInitial = mb_strtoupper(mb_substr(trim($pf['name']), 0, 1));
                            $pfColor = 'hsl(' . (crc32((string) $pf['id']) % 360) . ', 55%, 45%)';
                        @endphp
                        <div class="gcp-profile-avatar {{ $pf['is_manager'] ? 'gcp-profile-avatar-mgr' : '' }}"
                             style="{{ $pf['avatar_url'] ? '' : ('background:' . $pfColor . ';') }}">
                            @if ($pf['avatar_url'])
                                <img src="{{ $pf['avatar_url'] }}" alt="">
                            @elseif ($pf['is_manager'])
                                <i class="fa fa-user-secret"></i>
                            @else
                                <span>{{ $pfInitial }}</span>
                            @endif
                        </div>
                        <div class="gcp-profile-name">{{ $pf['name'] }}</div>
                        <div class="gcp-profile-role">
                            @if ($pf['is_manager'])
                                <i class="fa fa-shield"></i>
                            @else
                                <i class="fa fa-user"></i>
                            @endif
                            {{ $pf['role_label'] }}
                        </div>
                    </div>

                    <div class="gcp-profile-body">
                        @if ($pf['billing_code'])
                            <div class="gcp-profile-row">
                                <span class="gcp-profile-label">
                                    <i class="fa fa-hashtag"></i>
                                    {{ __('general_chat.billing_code') }}
                                </span>
                                <span class="gcp-profile-val">{{ $pf['billing_code'] }}</span>
                            </div>
                        @endif
                        @if ($pf['phone'])
                            <div class="gcp-profile-row">
                                <span class="gcp-profile-label">
                                    <i class="fa fa-phone"></i>
                                    {{ __('general_chat.phone') }}
                                </span>
                                <span class="gcp-profile-val" dir="ltr">{{ $pf['phone'] }}</span>
                            </div>
                        @endif
                        @if ($pf['username'])
                            <div class="gcp-profile-row">
                                <span class="gcp-profile-label">
                                    <i class="fa fa-at"></i>
                                    {{ __('general_chat.username') }}
                                </span>
                                <span class="gcp-profile-val">{{ $pf['username'] }}</span>
                            </div>
                        @endif

                        @if ($pf['block'] && $pf['block']['active'])
                            <div class="gcp-profile-block-alert">
                                <i class="fa fa-ban"></i>
                                @if ($pf['block']['permanent'])
                                    <strong>{{ __('general_chat.block_permanent_active') }}</strong>
                                @else
                                    <strong>{{ __('general_chat.block_active_until') }}</strong>
                                    <div>{{ $pf['block']['blocked_until'] }}</div>
                                @endif
                            </div>
                        @endif
                    </div>

                    @if ($isManager && ! $pf['is_manager'])
                        <div class="gcp-profile-actions">
                            @if ($pf['block'] && $pf['block']['active'])
                                <button type="button" class="gcp-blk-btn gcp-blk-unblock"
                                        wire:click="unblockUser({{ $pf['id'] }})"
                                        wire:confirm="{{ __('general_chat.confirm_unblock') }}">
                                    <i class="fa fa-unlock"></i>
                                    {{ __('general_chat.unblock') }}
                                </button>
                            @else
                                <div class="gcp-blk-title">
                                    <i class="fa fa-ban"></i>
                                    {{ __('general_chat.block_options') }}
                                </div>
                                <div class="gcp-blk-grid">
                                    <button type="button" class="gcp-blk-btn"
                                            wire:click="blockUser({{ $pf['id'] }}, 'day')"
                                            wire:confirm="{{ __('general_chat.confirm_block_day') }}">
                                        {{ __('general_chat.block_day') }}
                                    </button>
                                    <button type="button" class="gcp-blk-btn"
                                            wire:click="blockUser({{ $pf['id'] }}, 'week')"
                                            wire:confirm="{{ __('general_chat.confirm_block_week') }}">
                                        {{ __('general_chat.block_week') }}
                                    </button>
                                    <button type="button" class="gcp-blk-btn"
                                            wire:click="blockUser({{ $pf['id'] }}, 'month')"
                                            wire:confirm="{{ __('general_chat.confirm_block_month') }}">
                                        {{ __('general_chat.block_month') }}
                                    </button>
                                    <button type="button" class="gcp-blk-btn gcp-blk-permanent"
                                            wire:click="blockUser({{ $pf['id'] }}, 'permanent')"
                                            wire:confirm="{{ __('general_chat.confirm_block_permanent') }}">
                                        {{ __('general_chat.block_permanent') }}
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @if ($isBlocked ?? false)
            <div class="gcp-blocked-banner">
                <i class="fa fa-ban"></i>
                {{ __('general_chat.you_are_blocked_banner') }}
            </div>
        @endif
    </div>

    @once
        @push('styles')
            <style>
                /* === General Chat === */
                .gcp-wrap { padding: 8px 0; }
                .gcp-card {
                    max-width: 1024px;
                    margin: 0 auto;
                    background: #fff;
                    border-radius: 16px;
                    box-shadow: 0 10px 40px rgba(0,0,0,.08);
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    height: calc(100vh - 190px);
                    min-height: 520px;
                }
                .gcp-header {
                    padding: 14px 18px;
                    background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
                    color: #fff;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    flex-wrap: wrap;
                    gap: 10px;
                }
                .gcp-avatar {
                    width: 44px; height: 44px;
                    border-radius: 50%;
                    background: rgba(255,255,255,.14);
                    color: #ffd479;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 20px;
                }
                .gcp-title { font-weight: 700; font-size: 16px; color: #fff; }
                .gcp-sub {
                    font-size: 12px; color: rgba(255,255,255,.75);
                    display: inline-flex; align-items: center; gap: 6px;
                }
                .gcp-dot {
                    width: 8px; height: 8px; border-radius: 50%;
                    background: #10b981;
                    box-shadow: 0 0 0 3px rgba(16,185,129,.25);
                    display: inline-block;
                }
                .gcp-tabs { display: inline-flex; gap: 6px; }
                .gcp-tab {
                    background: rgba(255,255,255,.1);
                    color: #fff;
                    border: 1px solid rgba(255,255,255,.2);
                    padding: 6px 12px;
                    border-radius: 18px;
                    font-size: 12px;
                    cursor: pointer;
                    transition: background .15s, border-color .15s;
                }
                .gcp-tab:hover { background: rgba(255,255,255,.18); }
                .gcp-tab-active {
                    background: #f59e0b;
                    border-color: #f59e0b;
                    color: #0f172a;
                    font-weight: 700;
                }

                .gcp-body {
                    flex: 1;
                    overflow-y: auto;
                    padding: 18px;
                    background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
                    display: flex;
                    flex-direction: column;
                    gap: 8px;
                }
                .gcp-divider { text-align: center; margin: 10px 0; }
                .gcp-divider span {
                    background: #e2e8f0;
                    color: #64748b;
                    padding: 2px 12px;
                    border-radius: 12px;
                    font-size: 11px;
                }
                .gcp-empty, .gcp-denied {
                    margin: auto;
                    text-align: center;
                    color: #94a3b8;
                    padding: 50px 20px;
                }
                .gcp-empty-icon { font-size: 54px; color: #cbd5e1; }

                .gcp-row { display: flex; align-items: flex-end; gap: 8px; }
                .gcp-row-me { justify-content: flex-end; }
                .gcp-row-them { justify-content: flex-start; }
                .gcp-msg-avatar {
                    width: 30px; height: 30px; border-radius: 50%;
                    background: #64748b; color: #fff;
                    display: inline-flex; align-items: center; justify-content: center;
                    font-size: 13px; flex-shrink: 0;
                }
                .gcp-avatar-mgr { background: #1e3a8a; color: #ffd479; }

                .gcp-bubble-wrap {
                    display: flex;
                    align-items: center;
                    gap: 4px;
                    max-width: 78%;
                }
                .gcp-row-me .gcp-bubble-wrap { flex-direction: row-reverse; }

                .gcp-bubble {
                    max-width: 100%;
                    padding: 8px 12px 6px;
                    border-radius: 16px;
                    font-size: 14px;
                    line-height: 1.55;
                    word-wrap: break-word;
                    box-shadow: 0 2px 8px rgba(15,23,42,.05);
                    min-width: 80px;
                }
                .gcp-me {
                    background: linear-gradient(135deg, #f59e0b, #ea580c);
                    color: #fff;
                    border-bottom-right-radius: 4px;
                }
                .gcp-them {
                    background: #fff;
                    color: #0f172a;
                    border: 1px solid #e5e7eb;
                    border-bottom-left-radius: 4px;
                }
                html[dir="rtl"] .gcp-me {
                    border-bottom-right-radius: 16px;
                    border-bottom-left-radius: 4px;
                }
                html[dir="rtl"] .gcp-them {
                    border-bottom-left-radius: 16px;
                    border-bottom-right-radius: 4px;
                }
                .gcp-sender {
                    font-size: 11px;
                    font-weight: 700;
                    color: #f59e0b;
                    margin-bottom: 2px;
                    display: flex;
                    align-items: center;
                    gap: 6px;
                }
                .gcp-role-badge {
                    background: #1e3a8a;
                    color: #ffd479;
                    padding: 1px 6px;
                    border-radius: 6px;
                    font-size: 10px;
                    font-weight: 600;
                }
                .gcp-text { white-space: pre-wrap; }
                .gcp-text-deleted {
                    font-style: italic;
                    opacity: .7;
                    font-size: 13px;
                }
                .gcp-deleted {
                    background: #f1f5f9 !important;
                    color: #94a3b8 !important;
                    border: 1px dashed #cbd5e1 !important;
                }
                .gcp-meta {
                    font-size: 10px;
                    opacity: .75;
                    margin-top: 2px;
                    text-align: end;
                }

                .gcp-actions {
                    display: inline-flex;
                    gap: 2px;
                    opacity: 0;
                    transition: opacity .15s;
                }
                .gcp-row:hover .gcp-actions { opacity: 1; }
                .gcp-action-btn {
                    background: transparent;
                    border: none;
                    color: #94a3b8;
                    width: 26px; height: 26px;
                    border-radius: 50%;
                    font-size: 11px;
                    cursor: pointer;
                    transition: background .15s, color .15s;
                }
                .gcp-action-btn:hover { background: #e2e8f0; color: #1e293b; }
                .gcp-action-danger:hover { background: #fee2e2; color: #dc2626; }

                .gcp-quote {
                    border-inline-start: 3px solid rgba(255,255,255,.55);
                    background: rgba(255,255,255,.12);
                    padding: 6px 8px;
                    border-radius: 8px;
                    margin-bottom: 6px;
                    font-size: 12px;
                }
                .gcp-them .gcp-quote {
                    border-inline-start-color: #f59e0b;
                    background: #fff7e6;
                    color: #475569;
                }
                .gcp-quote-who { font-weight: 600; opacity: .85; font-size: 11px; }
                .gcp-quote-text {
                    white-space: pre-wrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                }

                .gcp-image {
                    max-width: 100%;
                    max-height: 260px;
                    border-radius: 10px;
                    display: block;
                    margin-bottom: 6px;
                }
                .gcp-audio { width: 260px; max-width: 100%; margin-bottom: 4px; }

                .gcp-preview {
                    padding: 10px 16px;
                    background: #fff7e6;
                    border-top: 1px solid #f3d58a;
                }
                .gcp-preview-thumb {
                    width: 44px; height: 44px;
                    object-fit: cover;
                    border-radius: 8px;
                }

                .gcp-reply-preview {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    padding: 8px 14px;
                    background: #fff7e6;
                    border-top: 1px solid #f3d58a;
                }
                .gcp-reply-bar {
                    width: 3px;
                    align-self: stretch;
                    background: #f59e0b;
                    border-radius: 3px;
                }
                .gcp-reply-who {
                    font-size: 11px;
                    font-weight: 700;
                    color: #d97706;
                }
                .gcp-reply-text {
                    font-size: 12px;
                    color: #475569;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                }

                .gcp-readonly-notice {
                    padding: 12px 16px;
                    background: #fef3c7;
                    border-top: 1px solid #fde68a;
                    color: #92400e;
                    font-size: 13px;
                    text-align: center;
                }

                .gcp-composer {
                    display: flex;
                    align-items: flex-end;
                    gap: 8px;
                    padding: 10px 14px;
                    background: #fff;
                    border-top: 1px solid #e5e7eb;
                    position: relative;
                }
                .gcp-composer-actions { display: inline-flex; gap: 4px; }
                .gcp-icon-btn {
                    background: transparent;
                    border: 1px solid transparent;
                    border-radius: 50%;
                    width: 40px; height: 40px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    color: #475569;
                    cursor: pointer;
                    font-size: 17px;
                    transition: background .15s;
                }
                .gcp-icon-btn:hover { background: #f1f5f9; color: #1e293b; }

                .gcp-record-bar {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    padding: 10px 14px;
                    background: #fff;
                    border-top: 1px solid #e5e7eb;
                }
                .gcp-record-meter {
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
                .gcp-record-dot {
                    width: 10px; height: 10px;
                    border-radius: 50%;
                    background: #ef4444;
                    animation: gcp-rec-blink 1s infinite;
                    flex-shrink: 0;
                }
                @keyframes gcp-rec-blink {
                    0%,100% { opacity: 1; }
                    50%     { opacity: .25; }
                }
                .gcp-record-wave {
                    flex: 1;
                    display: inline-flex;
                    align-items: center;
                    gap: 3px;
                    height: 24px;
                }
                .gcp-record-wave span {
                    display: inline-block;
                    width: 3px;
                    background: #ef4444;
                    border-radius: 2px;
                    animation: gcp-wave 1s ease-in-out infinite;
                }
                @keyframes gcp-wave {
                    0%,100% { height: 6px; opacity: .55; }
                    50%     { height: 22px; opacity: 1; }
                }
                .gcp-record-time {
                    font-variant-numeric: tabular-nums;
                    font-weight: 700;
                    color: #334155;
                    font-size: 14px;
                    min-width: 42px;
                    text-align: end;
                }

                .gcp-input {
                    flex: 1;
                    border: 1px solid #e5e7eb;
                    border-radius: 24px;
                    padding: 10px 16px;
                    resize: none;
                    max-height: 140px;
                    font-size: 14px;
                    outline: none;
                    background: #f8fafc;
                    transition: border-color .15s, background .15s;
                }
                .gcp-input:focus { border-color: #f59e0b; background: #fff; }
                .gcp-send-btn {
                    border: none;
                    border-radius: 50%;
                    width: 44px; height: 44px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    color: #fff;
                    background: linear-gradient(135deg, #f59e0b, #ea580c);
                    font-size: 16px;
                    cursor: pointer;
                    box-shadow: 0 6px 14px rgba(245,130,32,.3);
                    flex-shrink: 0;
                }
                .gcp-send-btn:disabled { opacity: .6; cursor: not-allowed; }

                .gcp-emoji-panel {
                    position: absolute;
                    bottom: 70px;
                    inset-inline-start: 14px;
                    background: #fff;
                    border: 1px solid #e5e7eb;
                    border-radius: 12px;
                    box-shadow: 0 10px 30px rgba(0,0,0,.12);
                    padding: 8px;
                    width: 280px;
                    display: grid;
                    grid-template-columns: repeat(8, 1fr);
                    gap: 2px;
                    z-index: 5;
                }
                .gcp-emoji {
                    background: transparent;
                    border: none;
                    font-size: 18px;
                    padding: 4px;
                    cursor: pointer;
                    border-radius: 6px;
                }
                .gcp-emoji:hover { background: #f1f5f9; }

                .gcp-shortcuts-panel {
                    position: absolute;
                    bottom: 70px;
                    inset-inline-start: 14px;
                    background: #fff;
                    border: 1px solid #e5e7eb;
                    border-radius: 12px;
                    box-shadow: 0 10px 30px rgba(0,0,0,.12);
                    padding: 10px;
                    max-width: min(420px, calc(100% - 28px));
                    display: flex;
                    flex-wrap: wrap;
                    gap: 6px;
                    z-index: 6;
                }
                .gcp-shortcuts-title {
                    width: 100%;
                    font-size: 12px;
                    font-weight: 700;
                    color: #475569;
                    margin-bottom: 2px;
                }
                .gcp-shortcut-chip {
                    background: #f8fafc;
                    border: 1px solid #e5e7eb;
                    color: #0f172a;
                    border-radius: 18px;
                    padding: 6px 12px;
                    font-size: 13px;
                    cursor: pointer;
                    transition: background .15s, border-color .15s;
                }
                .gcp-shortcut-chip:hover {
                    background: linear-gradient(135deg, #fff7e6, #ffe4b5);
                    border-color: #f59e0b;
                }

                @media (max-width: 576px) {
                    .gcp-card { height: calc(100vh - 150px); border-radius: 0; }
                    .gcp-bubble-wrap { max-width: 85%; }
                    .gcp-emoji-panel { width: 240px; grid-template-columns: repeat(6, 1fr); }
                    .gcp-shortcuts-panel { max-width: calc(100% - 16px); }
                }

                /* === Clickable avatar/name button reset === */
                button.gcp-msg-avatar {
                    border: 0; padding: 0; cursor: pointer; overflow: hidden;
                    transition: transform .15s ease, box-shadow .15s ease;
                }
                button.gcp-msg-avatar:hover {
                    transform: scale(1.08);
                    box-shadow: 0 2px 8px rgba(0,0,0,.2);
                }
                .gcp-msg-avatar-img {
                    width: 100%; height: 100%; object-fit: cover;
                }
                .gcp-avatar-initial {
                    font-weight: 700; font-size: 14px; line-height: 1;
                    text-transform: uppercase;
                }
                .gcp-sender-btn {
                    background: none; border: 0; padding: 0; cursor: pointer;
                    color: inherit; font: inherit;
                }
                .gcp-sender-btn:hover { text-decoration: underline; }

                /* === Visual separation: Managers-only room === */
                .gcp-room-managers .gcp-header {
                    background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 100%);
                }
                .gcp-room-managers .gcp-body {
                    background:
                        repeating-linear-gradient(45deg,
                            rgba(124, 58, 237, 0.035) 0px,
                            rgba(124, 58, 237, 0.035) 10px,
                            rgba(124, 58, 237, 0.08) 10px,
                            rgba(124, 58, 237, 0.08) 20px),
                        #f5f3ff;
                }
                .gcp-room-managers .gcp-me {
                    background: linear-gradient(135deg, #7c3aed, #4c1d95);
                    color: #fff;
                }
                .gcp-room-managers .gcp-them {
                    background: #fff;
                    border: 1px solid #d8b4fe;
                    color: #1e1b4b;
                }
                .gcp-room-managers .gcp-sender { color: #7c3aed; }
                .gcp-room-managers .gcp-composer {
                    background: linear-gradient(to top, #ede9fe, #fff);
                }
                .gcp-room-managers .gcp-tab-active {
                    background: #7c3aed;
                    color: #fff;
                }
                .gcp-room-managers::before {
                    content: '';
                    position: absolute;
                    inset: 0;
                    pointer-events: none;
                    border: 3px solid #7c3aed;
                    border-radius: 16px;
                    opacity: .35;
                    z-index: 5;
                }
                .gcp-card { position: relative; }

                /* === Blocked banner === */
                .gcp-blocked-banner {
                    margin: 10px 16px 0;
                    padding: 10px 14px;
                    background: #fef2f2;
                    border: 1px solid #fecaca;
                    color: #991b1b;
                    border-radius: 10px;
                    font-size: 13px;
                    display: flex; align-items: center; gap: 8px;
                }

                /* === Profile modal === */
                .gcp-profile-overlay {
                    position: fixed; inset: 0;
                    background: rgba(15, 23, 42, 0.55);
                    display: flex; align-items: center; justify-content: center;
                    z-index: 10000;
                    padding: 20px;
                    animation: gcp-fade-in .18s ease;
                }
                @keyframes gcp-fade-in { from { opacity: 0; } to { opacity: 1; } }
                .gcp-profile-modal {
                    background: #fff;
                    border-radius: 18px;
                    width: 100%; max-width: 380px;
                    box-shadow: 0 20px 60px rgba(0,0,0,.25);
                    position: relative;
                    animation: gcp-pop .2s ease;
                }
                @keyframes gcp-pop { from { transform: scale(.92); opacity: 0;} to { transform: scale(1); opacity: 1; } }
                .gcp-profile-close {
                    position: absolute; top: 10px;
                    inset-inline-end: 10px;
                    width: 32px; height: 32px;
                    background: rgba(0,0,0,.06); border: 0; border-radius: 50%;
                    cursor: pointer; color: #64748b;
                    display: flex; align-items: center; justify-content: center;
                    transition: background .15s ease;
                }
                .gcp-profile-close:hover { background: rgba(0,0,0,.12); color: #0f172a; }

                .gcp-profile-head {
                    padding: 30px 20px 20px;
                    text-align: center;
                    background: linear-gradient(135deg, #fef3c7, #fde68a);
                    border-radius: 18px 18px 0 0;
                }
                .gcp-profile-avatar {
                    width: 90px; height: 90px;
                    border-radius: 50%;
                    margin: 0 auto 12px;
                    background: #64748b; color: #fff;
                    display: flex; align-items: center; justify-content: center;
                    font-size: 36px; font-weight: 700;
                    border: 4px solid #fff;
                    box-shadow: 0 4px 14px rgba(0,0,0,.15);
                    overflow: hidden;
                }
                .gcp-profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
                .gcp-profile-avatar-mgr {
                    background: linear-gradient(135deg, #4c1d95, #7c3aed) !important;
                    color: #ffd479;
                }
                .gcp-profile-name {
                    font-size: 18px; font-weight: 700;
                    color: #0f172a;
                }
                .gcp-profile-role {
                    font-size: 12px; color: #78350f;
                    margin-top: 4px;
                }
                .gcp-profile-body { padding: 16px 20px; }
                .gcp-profile-row {
                    display: flex; justify-content: space-between;
                    align-items: center; padding: 8px 0;
                    border-bottom: 1px dashed #e5e7eb;
                    font-size: 13px;
                }
                .gcp-profile-row:last-of-type { border-bottom: 0; }
                .gcp-profile-label { color: #64748b; display: flex; align-items: center; gap: 6px; }
                .gcp-profile-val { color: #0f172a; font-weight: 600; }
                .gcp-profile-block-alert {
                    margin-top: 12px; padding: 10px 12px;
                    background: #fef2f2;
                    border: 1px solid #fecaca;
                    color: #991b1b;
                    border-radius: 10px;
                    font-size: 12px;
                    display: flex; align-items: center; gap: 8px;
                }
                .gcp-profile-block-alert div { margin-inline-start: auto; font-weight: 600; }
                .gcp-profile-actions {
                    padding: 14px 20px 20px;
                    border-top: 1px solid #f1f5f9;
                }
                .gcp-blk-title {
                    font-size: 12px; font-weight: 700;
                    color: #991b1b;
                    margin-bottom: 10px;
                    display: flex; align-items: center; gap: 6px;
                }
                .gcp-blk-grid {
                    display: grid; grid-template-columns: 1fr 1fr;
                    gap: 8px;
                }
                .gcp-blk-btn {
                    padding: 10px 12px;
                    background: #fff; border: 1px solid #fecaca;
                    color: #b91c1c; border-radius: 10px;
                    font-size: 13px; font-weight: 600;
                    cursor: pointer;
                    transition: all .15s ease;
                }
                .gcp-blk-btn:hover {
                    background: #fef2f2;
                    border-color: #ef4444;
                    color: #991b1b;
                }
                .gcp-blk-permanent {
                    background: #fef2f2;
                    border-color: #ef4444;
                    color: #991b1b;
                }
                .gcp-blk-permanent:hover {
                    background: #ef4444;
                    color: #fff;
                }
                .gcp-blk-unblock {
                    width: 100%;
                    background: #ecfdf5;
                    border-color: #a7f3d0;
                    color: #065f46;
                }
                .gcp-blk-unblock:hover {
                    background: #10b981;
                    color: #fff;
                    border-color: #10b981;
                }
            </style>
        @endpush
    @endonce
</div>
