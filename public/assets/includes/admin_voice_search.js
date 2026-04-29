/**
 * Voice input for search fields in the admin dashboard (Web Speech API).
 * Progressive enhancement: no-op when unsupported.
 */
(function () {
    'use strict';

    function getI18n() {
        var g = window.ADMIN_VOICE_SEARCH_I18N || {};
        return {
            micAria: g.mic_aria || 'Voice search',
            listening: g.listening || 'Listening, speak now',
            stopped: g.stopped || 'Voice input stopped',
            unsupported: g.unsupported || 'Voice input is not supported in this browser',
            error: g.error || 'Microphone could not be used',
            denied: g.denied || g.error || 'Microphone permission was denied',
            noSpeech: g.no_speech || g.stopped || 'No speech was detected',
        };
    }

    /** لغة Web Speech Recognition — ar-EG غالباً أوضح من ar-SA في Chrome/Edge */
    function recognitionLocale() {
        var appLoc = (typeof window.ADMIN_APP_LOCALE === 'string' && window.ADMIN_APP_LOCALE) || '';
        var lang = (appLoc || document.documentElement.lang || 'en').trim().toLowerCase();
        if (lang.indexOf('ar') === 0) return 'ar-EG';
        if (lang.indexOf('en') === 0) return 'en-US';
        return lang || 'en-US';
    }

    function announceRecognitionError(ev) {
        var code = (ev && ev.error) || '';
        var i18n = getI18n();
        if (code === 'not-allowed' || code === 'service-not-allowed') {
            announce(i18n.denied);
            return;
        }
        if (code === 'no-speech' || code === 'aborted') {
            announce(i18n.noSpeech);
            return;
        }
        if (code === 'audio-capture') {
            announce(i18n.noSpeech);
            return;
        }
        announce(i18n.error);
    }

    function getRecognitionCtor() {
        return window.SpeechRecognition || window.webkitSpeechRecognition || null;
    }

    function isUsableSearchInput(el) {
        if (!el || el.tagName !== 'INPUT' || el.type !== 'search') return false;
        if (el.disabled || el.readOnly) return false;
        if (el.getAttribute('data-voice-search-skip') === '1') return false;
        if (el.closest('.login-box, .register-box')) return false;
        var style = window.getComputedStyle(el);
        if (style.display === 'none' || style.visibility === 'hidden') return false;
        var rect = el.getBoundingClientRect();
        if (rect.width < 1 && rect.height < 1) return false;
        return true;
    }

    function announce(msg) {
        var el = document.getElementById('admin-voice-search-status');
        if (el) el.textContent = msg;
    }

    function ensureStatusRegion() {
        var id = 'admin-voice-search-status';
        if (document.getElementById(id)) return;
        var d = document.createElement('div');
        d.id = id;
        d.className = 'sr-only';
        d.setAttribute('role', 'status');
        d.setAttribute('aria-live', 'polite');
        d.setAttribute('aria-atomic', 'true');
        document.body.appendChild(d);
    }

    /** Livewire wire:model + Alpine x-model يعتمدان على حدث input حقيقي */
    function dispatchInputForWireModel(input) {
        if (!input) return;
        try {
            input.dispatchEvent(
                new InputEvent('input', {
                    bubbles: true,
                    cancelable: true,
                    inputType: 'insertReplacementText',
                })
            );
        } catch (e) {
            input.dispatchEvent(new Event('input', { bubbles: true }));
        }
        input.dispatchEvent(new Event('change', { bubbles: true }));
    }

    function setLivewireInputValue(input, text) {
        input.focus();
        input.value = text;
        dispatchInputForWireModel(input);
    }

    var activeRecognition = null;
    var activeButton = null;

    function stopListening() {
        if (activeRecognition) {
            try {
                activeRecognition.stop();
            } catch (e) {}
            activeRecognition = null;
        }
        if (activeButton) {
            activeButton.setAttribute('aria-pressed', 'false');
            activeButton.classList.remove('active');
            activeButton = null;
        }
    }

    function toggleMic(input, button, RecognitionCtor) {
        var i18n = getI18n();
        if (activeButton === button && activeRecognition) {
            stopListening();
            announce(i18n.stopped);
            return;
        }
        stopListening();

        var rec = new RecognitionCtor();
        rec.lang = recognitionLocale();
        rec.interimResults = false;
        rec.continuous = false;
        rec.maxAlternatives = 1;
        activeRecognition = rec;
        activeButton = button;
        button.setAttribute('aria-pressed', 'true');
        button.classList.add('active');
        announce(i18n.listening);

        rec.onresult = function (ev) {
            var t = '';
            if (ev.results && ev.results.length) {
                t = (ev.results[0][0] && ev.results[0][0].transcript) || '';
            }
            t = (t || '').trim();
            if (t) setLivewireInputValue(input, t);
            stopListening();
            announce(t ? t : i18n.stopped);
        };

        rec.onerror = function (ev) {
            stopListening();
            announceRecognitionError(ev);
        };

        rec.onend = function () {
            if (activeRecognition === rec) {
                activeRecognition = null;
                if (activeButton === button) {
                    button.setAttribute('aria-pressed', 'false');
                    button.classList.remove('active');
                    activeButton = null;
                }
            }
        };

        try {
            rec.start();
        } catch (e) {
            stopListening();
            announce(i18n.error);
        }
    }

    function enhanceInput(input) {
        if (input.getAttribute('data-voice-search-enhanced') === '1') return;
        var RecognitionCtor = getRecognitionCtor();
        if (!RecognitionCtor) return;

        input.setAttribute('data-voice-search-enhanced', '1');

        var i18n = getI18n();
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className =
            'btn btn-sm admin-voice-search-mic mx-1 align-middle';
        btn.setAttribute('aria-label', i18n.micAria);
        btn.setAttribute('title', i18n.micAria);
        btn.setAttribute('aria-pressed', 'false');
        btn.innerHTML = '<i class="fa fa-microphone" aria-hidden="true"></i>';

        var ig = input.closest('.input-group');
        if (ig) {
            var prepend = document.createElement('div');
            prepend.className = 'input-group-prepend';
            prepend.appendChild(btn);
            ig.insertBefore(prepend, input);
        } else {
            input.insertAdjacentElement('afterend', btn);
        }

        btn.addEventListener('click', function () {
            toggleMic(input, btn, RecognitionCtor);
        });
    }

    function scan(root) {
        var RecognitionCtor = getRecognitionCtor();
        if (!RecognitionCtor) return;

        var scope = root && root.querySelectorAll ? root : document;
        var list = scope.querySelectorAll('input[type="search"]');
        for (var i = 0; i < list.length; i++) {
            if (isUsableSearchInput(list[i])) enhanceInput(list[i]);
        }
    }

    function init() {
        ensureStatusRegion();
        bindGlobalSearchMicButtons(document);
        if (!getRecognitionCtor()) return;
        scan(document);
    }

    function bindGlobalSearchMicButtons(root) {
        var scope = root && root.querySelectorAll ? root : document;

        function bind(btn, isModal) {
            if (!btn || btn.getAttribute('data-voice-global-mic-bound') === '1') return;
            btn.setAttribute('data-voice-global-mic-bound', '1');
            btn.addEventListener(
                'click',
                function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (isModal) {
                        if (typeof window.adminGlobalSearchStartModalMic === 'function') {
                            window.adminGlobalSearchStartModalMic(btn);
                        }
                    } else if (typeof window.adminGlobalSearchStartHeaderMic === 'function') {
                        window.adminGlobalSearchStartHeaderMic(btn);
                    }
                },
                true
            );
        }

        var modalMics = scope.querySelectorAll('.js-admin-global-search-modal-mic');
        for (var m = 0; m < modalMics.length; m++) {
            bind(modalMics[m], true);
        }
        var headerMics = scope.querySelectorAll('.js-admin-global-search-mic');
        for (var h = 0; h < headerMics.length; h++) {
            if (headerMics[h].classList.contains('js-admin-global-search-modal-mic')) continue;
            bind(headerMics[h], false);
        }
    }

    /** إعادة ربط أزرار الميكروفون بعد أي تحديث DOM من Livewire */
    function refreshVoiceSearchBindings() {
        bindGlobalSearchMicButtons(document);
        scan(document);
    }

    /**
     * إن وُضع السكربت بعد livewire:scripts فقد يكون livewire:load قد اطلق قبل تسجيل المستمع — نعالج ذلك.
     */
    function wireLivewireLifecycle() {
        refreshVoiceSearchBindings();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    if (typeof window.Livewire4 !== 'undefined') {
        Livewire4.init(wireLivewireLifecycle);
        Livewire4.update(refreshVoiceSearchBindings);
        Livewire4.rerender(refreshVoiceSearchBindings);
    } else if (typeof window.Livewire !== 'undefined') {
        wireLivewireLifecycle();
    } else {
        document.addEventListener('livewire:init', wireLivewireLifecycle);
    }

    /** Global search (header + modal): explicit window.* — avoids body delegation blocked by other handlers */
    var headerBarRec = null;

    function stopHeaderBarRec() {
        if (headerBarRec) {
            try {
                headerBarRec.stop();
            } catch (e) {}
            headerBarRec = null;
        }
    }

    function applyHeaderSearchText(input, text) {
        var t = (text || '').trim();
        if (!input) return;
        input.value = t;
        dispatchInputForWireModel(input);
        /** مزامنة Alpine x-model على الهيدر (قد لا يتحدث من input اصطناعي في بعض الحالات) */
        try {
            window.dispatchEvent(new CustomEvent('global-search-query-updated', { detail: { query: t } }));
        } catch (e) {}
        window.dispatchEvent(new CustomEvent('open-admin-global-search'));
        function emitLivewire() {
            if (typeof Livewire === 'undefined') return;
            var p = { query: t };
            if (typeof Livewire.dispatchTo === 'function') {
                Livewire.dispatchTo('admin.global-search-modal', 'global-search-set-query', p);
            } else if (typeof Livewire.dispatch === 'function') {
                Livewire.dispatch('global-search-set-query', p);
            }
        }
        if (typeof requestAnimationFrame === 'function') {
            requestAnimationFrame(function () {
                setTimeout(emitLivewire, 80);
            });
        } else {
            setTimeout(emitLivewire, 120);
        }
    }

    function resetGlobalSearchMicButton(mic) {
        if (!mic) return;
        mic.setAttribute('aria-pressed', 'false');
        mic.classList.remove('active');
    }

    function extractTranscript(ev) {
        var t = '';
        if (ev.results && ev.results.length) {
            t = (ev.results[0][0] && ev.results[0][0].transcript) || '';
        }
        return (t || '').trim();
    }

    /**
     * @param {HTMLElement} micButton
     * @param {function(string): void} onText — receives trimmed transcript (may be empty)
     */
    function startGlobalSearchSpeech(micButton, onText) {
        ensureStatusRegion();
        var i18n = getI18n();
        var RecognitionCtor = getRecognitionCtor();
        if (!RecognitionCtor) {
            announce(i18n.unsupported);
            return;
        }
        stopListening();
        stopHeaderBarRec();

        micButton.setAttribute('aria-pressed', 'true');
        micButton.classList.add('active');
        announce(i18n.listening);

        var rec = new RecognitionCtor();
        rec.lang = recognitionLocale();
        rec.interimResults = false;
        rec.continuous = false;
        rec.maxAlternatives = 1;
        headerBarRec = rec;

        rec.onresult = function (ev) {
            var t = extractTranscript(ev);
            try {
                onText(t);
            } catch (err) {}
            announce(t ? t : i18n.stopped);
            resetGlobalSearchMicButton(micButton);
            stopHeaderBarRec();
        };

        rec.onerror = function (ev) {
            announceRecognitionError(ev);
            resetGlobalSearchMicButton(micButton);
            stopHeaderBarRec();
        };

        rec.onend = function () {
            if (headerBarRec === rec) {
                headerBarRec = null;
            }
            resetGlobalSearchMicButton(micButton);
        };

        try {
            rec.start();
        } catch (err) {
            announce(i18n.error);
            resetGlobalSearchMicButton(micButton);
            stopHeaderBarRec();
        }
    }

    window.adminGlobalSearchStartHeaderMic = function (micButton) {
        if (!micButton) return;
        var input = document.getElementById('admin-global-header-search');
        if (!input) {
            ensureStatusRegion();
            announce(getI18n().error);
            return;
        }
        startGlobalSearchSpeech(micButton, function (t) {
            applyHeaderSearchText(input, t);
        });
    };

    window.adminGlobalSearchStartModalMic = function (micButton) {
        if (!micButton) return;
        var root = micButton.closest('.admin-global-search-lw');
        var input = root ? root.querySelector('input.admin-global-search-modal-input') : null;
        if (!input) return;
        startGlobalSearchSpeech(micButton, function (t) {
            setLivewireInputValue(input, t);
            if (typeof Livewire === 'undefined') return;
            var p = { query: t };
            if (typeof Livewire.dispatchTo === 'function') {
                Livewire.dispatchTo('admin.global-search-modal', 'global-search-set-query', p);
            } else if (typeof Livewire.dispatch === 'function') {
                Livewire.dispatch('global-search-set-query', p);
            }
        });
    };

})();
