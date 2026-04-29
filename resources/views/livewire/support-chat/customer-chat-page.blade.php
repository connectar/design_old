<div wire:poll.3s="pollMessages">
    @php
        /** @var \App\Models\SupportChat|null $chat */
        $chat = $this->chat;
        $messages = $this->messages;
        $admin = auth('admin')->user();
    @endphp

    <div class="scc-wrap"
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
                    // Prefer Opus for best voice-at-low-bitrate compression.
                    const candidates = [
                        'audio/webm;codecs=opus',
                        'audio/webm',
                        'audio/ogg;codecs=opus',
                        'audio/ogg',
                    ];
                    const mime = candidates.find(m => MediaRecorder.isTypeSupported(m)) || 'audio/webm';
                    this.mediaRecorder = new MediaRecorder(stream, {
                        mimeType: mime,
                        audioBitsPerSecond: 24000, // ~24 kbps: clear voice, tiny files
                    });
                    this.mediaRecorder.ondataavailable = (e) => this.chunks.push(e.data);
                    this.mediaRecorder.onstop = () => {
                        stream.getTracks().forEach(t => t.stop());
                        const wasCancelled = this.cancelledRecord;
                        this.chunks = this.chunks || [];
                        if (wasCancelled) {
                            this.chunks = [];
                            return;
                        }
                        const blob = new Blob(this.chunks, { type: mime });
                        const ext = mime.includes('webm') ? 'webm' : 'ogg';
                        const file = new File([blob], `voice-${Date.now()}.${ext}`, { type: mime });
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

        <div class="scc-card">
            {{-- Header --}}
            <div class="scc-header">
                <div class="d-flex align-items-center gap-3">
                    <div class="scc-avatar">
                        <i class="fa fa-headset"></i>
                    </div>
                    <div>
                        <div class="scc-title">{{ __('support_chat.support_team') }}</div>
                        <div class="scc-sub">
                            <span class="scc-dot"></span>
                            {{ __('support_chat.online_usually_replies') }}
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success-soft text-success d-none d-md-inline">
                        <i class="fa fa-shield"></i> {{ __('support_chat.secure_chat') }}
                    </span>
                </div>
            </div>

            {{-- Messages list --}}
            <div class="scc-body" x-ref="list">
                @if ($messages->isEmpty())
                    <div class="scc-empty">
                        <i class="fa fa-comments scc-empty-icon"></i>
                        <div class="mt-2 fw-bold">{{ __('support_chat.no_messages_yet') }}</div>
                        <div class="small text-muted">{{ __('support_chat.start_conversation_hint') }}</div>
                    </div>
                @else
                    @php $prevDate = null; @endphp
                    @foreach ($messages as $msg)
                        @php
                            $fromMe = $msg->sender_type === \App\Models\SupportChat::SENDER_ADMIN;
                            $dateLabel = $msg->created_at ? $msg->created_at->translatedFormat('D, j M') : '';
                        @endphp
                        @if ($dateLabel !== $prevDate)
                            <div class="scc-divider"><span>{{ $dateLabel }}</span></div>
                            @php $prevDate = $dateLabel; @endphp
                        @endif

                        <div class="scc-row {{ $fromMe ? 'scc-row-me' : 'scc-row-them' }}"
                             wire:key="msg-{{ $msg->id }}">
                            @unless ($fromMe)
                                <div class="scc-msg-avatar"><i class="fa fa-headset"></i></div>
                            @endunless
                            <div class="scc-bubble-wrap">
                                <div class="scc-bubble {{ $fromMe ? 'scc-me' : 'scc-them' }}">
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
                                        <div class="scc-quote">
                                            <div class="scc-quote-who">
                                                <i class="fa fa-reply"></i>
                                                {{ $qr->sender_type === \App\Models\SupportChat::SENDER_ADMIN
                                                    ? __('support_chat.replying_to_me')
                                                    : __('support_chat.replying_to_them') }}
                                            </div>
                                            <div class="scc-quote-text">{{ \Illuminate\Support\Str::limit($qrText, 140) }}</div>
                                        </div>
                                    @endif
                                    @if ($msg->attachment_type === \App\Models\SupportChatMessage::ATTACHMENT_IMAGE && $msg->attachment_path)
                                        <a href="{{ route('support_chat.attachment', $msg) }}"
                                           target="_blank" rel="noopener">
                                            <img src="{{ route('support_chat.attachment', $msg) }}"
                                                 class="scc-image" alt="" loading="lazy">
                                        </a>
                                    @elseif ($msg->attachment_type === \App\Models\SupportChatMessage::ATTACHMENT_VOICE && $msg->attachment_path)
                                        <audio controls preload="metadata" class="scc-audio"
                                               src="{{ route('support_chat.attachment', $msg) }}"></audio>
                                    @endif
                                    @if ($msg->body)
                                        <div class="scc-text">{{ $msg->body }}</div>
                                    @endif
                                    <div class="scc-meta">
                                        {{ $msg->created_at ? $msg->created_at->format('H:i') : '' }}
                                        @if ($fromMe)
                                            @if ($msg->read_at)
                                                <i class="fa fa-check-double text-info"></i>
                                            @else
                                                <i class="fa fa-check"></i>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <button type="button" class="scc-reply-btn"
                                        wire:click="startReply({{ $msg->id }})"
                                        title="{{ __('support_chat.reply') }}">
                                    <i class="fa fa-reply"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- Attachment preview --}}
            @if ($uploadedImage || $voiceFile)
                <div class="scc-preview">
                    @if ($uploadedImage)
                        <div class="d-flex align-items-center gap-2">
                            <img src="{{ $uploadedImage->temporaryUrl() }}" class="scc-preview-thumb" alt="">
                            <span class="small text-muted">{{ __('support_chat.image_ready') }}</span>
                            <button type="button" class="btn btn-sm btn-link text-danger ms-auto"
                                    wire:click="$set('uploadedImage', null)">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    @elseif ($voiceFile)
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <i class="fa fa-microphone text-warning fa-lg"></i>
                            <audio controls preload="metadata" class="scc-audio"
                                   x-ref="voicePreview"
                                   x-init="if (window.__sccLastVoiceUrl) { $el.src = window.__sccLastVoiceUrl; }"></audio>
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
                <div class="scc-reply-preview">
                    <div class="scc-reply-bar"></div>
                    <div class="flex-grow-1">
                        <div class="scc-reply-who">
                            <i class="fa fa-reply"></i>
                            {{ $replying->sender_type === \App\Models\SupportChat::SENDER_ADMIN
                                ? __('support_chat.replying_to_me')
                                : __('support_chat.replying_to_them') }}
                        </div>
                        <div class="scc-reply-text">
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
            @error('newMessage')
                <div class="alert alert-danger m-2 mb-0 py-2 px-3" style="font-size: 13px;">{{ $message }}</div>
            @enderror
            @error('uploadedImage')
                <div class="alert alert-danger m-2 mb-0 py-2 px-3" style="font-size: 13px;">{{ $message }}</div>
            @enderror
            @error('voiceFile')
                <div class="alert alert-danger m-2 mb-0 py-2 px-3" style="font-size: 13px;">{{ $message }}</div>
            @enderror

            {{-- Recording bar (shown while recording) --}}
            <div class="scc-record-bar" x-show="recording" x-cloak>
                <button type="button" class="scc-icon-btn text-danger"
                        @click="cancelRecording"
                        title="{{ __('support_chat.cancel') }}">
                    <i class="fa fa-trash"></i>
                </button>
                <div class="scc-record-meter">
                    <span class="scc-record-dot"></span>
                    <span class="scc-record-wave">
                        @for ($i = 0; $i < 14; $i++)
                            <span style="animation-delay: {{ $i * 0.08 }}s"></span>
                        @endfor
                    </span>
                    <span class="scc-record-time" x-text="formatRecTime(recordSeconds)"></span>
                </div>
                <button type="button" class="scc-send-btn" @click="stopAndSend"
                        title="{{ __('support_chat.send_voice') }}">
                    <i class="fa fa-paper-plane"></i>
                </button>
            </div>

            <form class="scc-composer" x-show="!recording" x-cloak wire:submit.prevent="sendMessage">
                <div class="scc-composer-actions">
                    <button type="button" class="scc-icon-btn" @click="showEmoji = !showEmoji; showShortcuts = false"
                            title="{{ __('support_chat.emoji') }}">
                        <i class="fa fa-smile-o"></i>
                    </button>
                    <label class="scc-icon-btn m-0" title="{{ __('support_chat.attach_image') }}">
                        <i class="fa fa-image"></i>
                        <input type="file" accept="image/*" class="d-none" wire:model="uploadedImage">
                    </label>
                    <button type="button" class="scc-icon-btn"
                            @click="toggleRecord"
                            title="{{ __('support_chat.record_voice') }}">
                        <i class="fa fa-microphone"></i>
                    </button>
                    <button type="button" class="scc-icon-btn" @click="showShortcuts = !showShortcuts; showEmoji = false"
                            title="{{ __('support_chat.shortcuts') }}">
                        <i class="fa fa-bolt"></i>
                    </button>
                </div>

                <div class="scc-emoji-panel" x-show="showEmoji" x-cloak @click.outside="showEmoji = false">
                    @foreach (['😀','😁','😂','🤣','😊','😍','😘','😎','🤔','😢','😡','👍','👎','🙏','❤️','🔥','🎉','✅','❌','💯','🙌','👌','💪','🤝'] as $e)
                        <button type="button" class="scc-emoji" @click="addEmoji('{{ $e }}')">{{ $e }}</button>
                    @endforeach
                </div>

                <div class="scc-shortcuts-panel" x-show="showShortcuts" x-cloak @click.outside="showShortcuts = false">
                    <div class="scc-shortcuts-title">
                        <i class="fa fa-bolt"></i> {{ __('support_chat.shortcuts') }}
                    </div>
                    @foreach ((array) __('support_chat.quick_replies') as $phrase)
                        <button type="button" class="scc-shortcut-chip"
                                @click="insertShortcut(@js($phrase))">
                            {{ $phrase }}
                        </button>
                    @endforeach
                </div>

                <textarea wire:model="newMessage"
                          x-ref="composer"
                          class="scc-input"
                          rows="1"
                          placeholder="{{ __('support_chat.type_message') }}"
                          @keydown.enter.prevent="if (!$event.shiftKey) { $wire.sendMessage(); }"></textarea>

                <button type="submit" class="scc-send-btn"
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
        </div>
    </div>

    @once
        @push('styles')
            <style>
                /* === Support Chat (Customer full-page) === */
                .scc-wrap { padding: 8px 0; }
                .scc-card {
                    max-width: 960px;
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
                .scc-header {
                    padding: 14px 18px;
                    background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
                    color: #fff;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    flex-wrap: wrap;
                    gap: 8px;
                }
                .scc-avatar {
                    width: 44px; height: 44px;
                    border-radius: 50%;
                    background: rgba(255,255,255,.15);
                    color: #ffd479;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 20px;
                }
                .scc-title { font-weight: 700; font-size: 16px; color: #fff; }
                .scc-sub {
                    font-size: 12px; color: rgba(255,255,255,.75);
                    display: inline-flex; align-items: center; gap: 6px;
                }
                .scc-dot {
                    width: 8px; height: 8px; border-radius: 50%;
                    background: #10b981;
                    box-shadow: 0 0 0 3px rgba(16,185,129,.25);
                    display: inline-block;
                }
                .bg-success-soft { background: rgba(16,185,129,.12); }
                .text-success { color: #059669 !important; }

                .scc-body {
                    flex: 1;
                    overflow-y: auto;
                    padding: 18px;
                    background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
                    display: flex;
                    flex-direction: column;
                    gap: 8px;
                }
                .scc-divider {
                    text-align: center;
                    margin: 10px 0;
                    position: relative;
                }
                .scc-divider span {
                    background: #e2e8f0;
                    color: #64748b;
                    padding: 2px 12px;
                    border-radius: 12px;
                    font-size: 11px;
                }
                .scc-empty {
                    margin: auto;
                    text-align: center;
                    color: #94a3b8;
                    padding: 40px 20px;
                }
                .scc-empty-icon { font-size: 54px; color: #cbd5e1; }

                .scc-row { display: flex; align-items: flex-end; gap: 8px; }
                .scc-row-me { justify-content: flex-end; }
                .scc-row-them { justify-content: flex-start; }
                .scc-msg-avatar {
                    width: 28px; height: 28px; border-radius: 50%;
                    background: #1e3a8a; color: #ffd479;
                    display: inline-flex; align-items: center; justify-content: center;
                    font-size: 12px;
                    flex-shrink: 0;
                }
                .scc-bubble {
                    max-width: 72%;
                    padding: 10px 14px;
                    border-radius: 16px;
                    font-size: 14px;
                    line-height: 1.55;
                    word-wrap: break-word;
                    box-shadow: 0 2px 8px rgba(15,23,42,.05);
                }
                .scc-me {
                    background: linear-gradient(135deg, #f59e0b, #ea580c);
                    color: #fff;
                    border-bottom-right-radius: 4px;
                }
                .scc-them {
                    background: #fff;
                    color: #0f172a;
                    border: 1px solid #e5e7eb;
                    border-bottom-left-radius: 4px;
                }
                html[dir="rtl"] .scc-me {
                    border-bottom-right-radius: 16px;
                    border-bottom-left-radius: 4px;
                }
                html[dir="rtl"] .scc-them {
                    border-bottom-left-radius: 16px;
                    border-bottom-right-radius: 4px;
                }
                .scc-text { white-space: pre-wrap; }
                .scc-meta {
                    font-size: 10px;
                    opacity: .75;
                    margin-top: 4px;
                    text-align: end;
                    display: flex;
                    justify-content: flex-end;
                    gap: 4px;
                    align-items: center;
                }
                .scc-bubble-wrap {
                    display: flex;
                    align-items: center;
                    gap: 4px;
                    max-width: 78%;
                }
                .scc-row-me .scc-bubble-wrap { flex-direction: row-reverse; }
                .scc-bubble-wrap .scc-bubble { max-width: 100%; }
                .scc-reply-btn {
                    background: transparent;
                    border: none;
                    color: #94a3b8;
                    width: 28px; height: 28px;
                    border-radius: 50%;
                    opacity: 0;
                    transition: opacity .15s, background .15s, color .15s;
                    font-size: 12px;
                }
                .scc-row:hover .scc-reply-btn { opacity: 1; }
                .scc-reply-btn:hover { background: #e2e8f0; color: #1e293b; }
                .scc-quote {
                    border-inline-start: 3px solid rgba(255,255,255,.55);
                    background: rgba(255,255,255,.12);
                    padding: 6px 8px;
                    border-radius: 8px;
                    margin-bottom: 6px;
                    font-size: 12px;
                }
                .scc-them .scc-quote {
                    border-inline-start-color: #f59e0b;
                    background: #fff7e6;
                    color: #475569;
                }
                .scc-quote-who { font-weight: 600; opacity: .85; font-size: 11px; }
                .scc-quote-text {
                    white-space: pre-wrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                }
                .scc-reply-preview {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    padding: 8px 14px;
                    background: #fff7e6;
                    border-top: 1px solid #f3d58a;
                }
                .scc-reply-bar {
                    width: 3px;
                    align-self: stretch;
                    background: #f59e0b;
                    border-radius: 3px;
                }
                .scc-reply-who {
                    font-size: 11px;
                    font-weight: 700;
                    color: #d97706;
                }
                .scc-reply-text {
                    font-size: 12px;
                    color: #475569;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                }
                .scc-image {
                    max-width: 100%;
                    max-height: 260px;
                    border-radius: 10px;
                    display: block;
                    margin-bottom: 6px;
                }
                .scc-audio { width: 260px; max-width: 100%; margin-bottom: 4px; }

                .scc-preview {
                    padding: 10px 16px;
                    background: #fff7e6;
                    border-top: 1px solid #f3d58a;
                }
                .scc-preview-thumb {
                    width: 44px; height: 44px;
                    object-fit: cover;
                    border-radius: 8px;
                }

                .scc-composer {
                    display: flex;
                    align-items: flex-end;
                    gap: 8px;
                    padding: 10px 14px;
                    background: #fff;
                    border-top: 1px solid #e5e7eb;
                    position: relative;
                }
                .scc-composer-actions {
                    display: inline-flex;
                    gap: 4px;
                }
                .scc-icon-btn {
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
                    transition: background .15s;
                }
                .scc-icon-btn:hover { background: #f1f5f9; color: #1e293b; }
                .scc-icon-btn-rec {
                    background: #ef4444 !important;
                    color: #fff !important;
                    animation: scc-pulse-rec 1s infinite;
                }
                @keyframes scc-pulse-rec {
                    0%,100% { box-shadow: 0 0 0 0 rgba(239,68,68,.55); }
                    50% { box-shadow: 0 0 0 8px rgba(239,68,68,0); }
                }

                /* --- WhatsApp-style recording bar --- */
                .scc-record-bar {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    padding: 10px 14px;
                    background: #fff;
                    border-top: 1px solid #e5e7eb;
                }
                .scc-record-meter {
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
                .scc-record-dot {
                    width: 10px; height: 10px;
                    border-radius: 50%;
                    background: #ef4444;
                    animation: scc-rec-blink 1s infinite;
                    flex-shrink: 0;
                }
                @keyframes scc-rec-blink {
                    0%,100% { opacity: 1; }
                    50%     { opacity: .25; }
                }
                .scc-record-wave {
                    flex: 1;
                    display: inline-flex;
                    align-items: center;
                    gap: 3px;
                    height: 24px;
                }
                .scc-record-wave span {
                    display: inline-block;
                    width: 3px;
                    background: #ef4444;
                    border-radius: 2px;
                    animation: scc-wave 1s ease-in-out infinite;
                }
                @keyframes scc-wave {
                    0%,100% { height: 6px; opacity: .55; }
                    50%     { height: 22px; opacity: 1; }
                }
                .scc-record-time {
                    font-variant-numeric: tabular-nums;
                    font-weight: 700;
                    color: #334155;
                    font-size: 14px;
                    min-width: 42px;
                    text-align: end;
                }
                .scc-input {
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
                .scc-input:focus { border-color: #f59e0b; background: #fff; }
                .scc-send-btn {
                    border: none;
                    border-radius: 50%;
                    width: 44px;
                    height: 44px;
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
                .scc-send-btn:disabled { opacity: .6; cursor: not-allowed; }

                .scc-emoji-panel {
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
                .scc-emoji {
                    background: transparent;
                    border: none;
                    font-size: 18px;
                    padding: 4px;
                    cursor: pointer;
                    border-radius: 6px;
                }
                .scc-emoji:hover { background: #f1f5f9; }

                .scc-shortcuts-panel {
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
                .scc-shortcuts-title {
                    width: 100%;
                    font-size: 12px;
                    font-weight: 700;
                    color: #475569;
                    margin-bottom: 2px;
                }
                .scc-shortcut-chip {
                    background: #f8fafc;
                    border: 1px solid #e5e7eb;
                    color: #0f172a;
                    border-radius: 18px;
                    padding: 6px 12px;
                    font-size: 13px;
                    cursor: pointer;
                    transition: background .15s, border-color .15s;
                }
                .scc-shortcut-chip:hover {
                    background: linear-gradient(135deg, #fff7e6, #ffe4b5);
                    border-color: #f59e0b;
                }

                @media (max-width: 576px) {
                    .scc-card { height: calc(100vh - 150px); border-radius: 0; }
                    .scc-bubble { max-width: 85%; }
                    .scc-emoji-panel { width: 240px; grid-template-columns: repeat(6, 1fr); }
                    .scc-shortcuts-panel { max-width: calc(100% - 16px); }
                }
            </style>
        @endpush
    @endonce
</div>
