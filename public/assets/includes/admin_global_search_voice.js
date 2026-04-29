/**
 * بعد ظهور نتائج البحث العام: نغمة قصيرة + قراءة النص (speechSynthesis).
 */
(function () {
    'use strict';

    var lastAnnounced = '';
    var announceTimer = null;

    function detailText(e) {
        var d = e.detail;
        if (d == null) return '';
        if (typeof d.text === 'string') return d.text;
        if (typeof d === 'object' && d.text != null) return String(d.text);
        return '';
    }

    function appLocaleWantsArabic() {
        var loc = (typeof window.ADMIN_APP_LOCALE === 'string' && window.ADMIN_APP_LOCALE) || '';
        loc = loc.trim().toLowerCase();
        return loc.indexOf('ar') === 0;
    }

    function pageWantsArabic() {
        var lang = (document.documentElement.lang || '').trim().toLowerCase();
        return lang.indexOf('ar') === 0;
    }

    /** إن وُجدت حروف عربية في النص نُجبر القارئ على العربية حتى لو كان lang على <html> مختلفاً */
    function hasArabicLetters(s) {
        return /[\u0600-\u06FF\u0750-\u077F\u08A0-\u08FF\uFB50-\uFDFF\uFE70-\uFEFF]/.test(String(s || ''));
    }

    function defaultUtteranceLang(ar) {
        return ar ? 'ar-SA' : 'en-US';
    }

    function voiceLooksArabic(v) {
        if (!v) return false;
        var l = (v.lang || '').toLowerCase();
        if (l.indexOf('ar') === 0) return true;
        var n = ((v.name || '') + ' ' + (v.voiceURI || '')).toLowerCase();
        if (n.indexOf('arabic') >= 0) return true;
        if (n.indexOf('saudi') >= 0 || n.indexOf('egypt') >= 0 || n.indexOf('hoda') >= 0) return true;
        return false;
    }

    function scoreVoiceForLocale(v, wantAr) {
        if (!v) return -10000;
        if (wantAr) {
            if (!voiceLooksArabic(v)) return -10000;
        } else {
            var l = (v.lang || '').toLowerCase();
            if (l.indexOf('en') !== 0) return -10000;
        }
        var l2 = (v.lang || '').toLowerCase();
        var n = ((v.name || '') + ' ' + (v.voiceURI || '')).toLowerCase();
        var s = 0;
        if (l2.indexOf('ar-eg') === 0 || l2.indexOf('ar_eg') === 0) s += 8;
        if (l2.indexOf('ar-sa') === 0 || l2.indexOf('ar_sa') === 0) s += 6;
        if (n.indexOf('google') >= 0) s += 40;
        if (n.indexOf('neural') >= 0 || n.indexOf('natural') >= 0) s += 35;
        if (n.indexOf('microsoft') >= 0) s += 25;
        if (n.indexOf('premium') >= 0) s += 12;
        if (v.localService) s += 6;
        return s;
    }

    function pickBestVoice(wantAr) {
        var list = window.speechSynthesis.getVoices();
        if (!list || !list.length) return null;
        var best = null;
        var bestScore = -10001;
        for (var i = 0; i < list.length; i++) {
            var sc = scoreVoiceForLocale(list[i], wantAr);
            if (sc > bestScore) {
                bestScore = sc;
                best = list[i];
            }
        }
        return bestScore > -9000 ? best : null;
    }

    /** نغمة خفيفة قريبة من إشعار النجاح (ثلاث نغمات صاعدة). */
    function playFoundChime() {
        try {
            var Ctx = window.AudioContext || window.webkitAudioContext;
            if (!Ctx) return;
            var ctx = new Ctx();
            if (ctx.state === 'suspended') {
                ctx.resume();
            }
            var t0 = ctx.currentTime;
            var freqs = [523.25, 659.25, 783.99];
            freqs.forEach(function (freq, i) {
                var t = t0 + i * 0.07;
                var osc = ctx.createOscillator();
                var gain = ctx.createGain();
                osc.type = 'sine';
                osc.frequency.value = freq;
                osc.connect(gain);
                gain.connect(ctx.destination);
                gain.gain.setValueAtTime(0.0001, t);
                gain.gain.exponentialRampToValueAtTime(0.07, t + 0.02);
                gain.gain.exponentialRampToValueAtTime(0.0001, t + 0.14);
                osc.start(t);
                osc.stop(t + 0.15);
            });
            setTimeout(function () {
                try {
                    ctx.close();
                } catch (err) {}
            }, 600);
        } catch (e) {}
    }

    var lastTtsObjectUrl = null;

    function revokeLastTtsUrl() {
        if (!lastTtsObjectUrl) return;
        try {
            URL.revokeObjectURL(lastTtsObjectUrl);
        } catch (e) {}
        lastTtsObjectUrl = null;
    }

    /** OpenAI عبر الخادم (Laravel) — جودة أعلى؛ عند الفشل نرجع لـ speechSynthesis */
    function speakViaOpenAi(text, onFallback) {
        var cfg = window.ADMIN_GLOBAL_SEARCH_TTS || {};
        if (!cfg.enabled || !cfg.url) {
            onFallback();
            return;
        }
        fetch(cfg.url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'audio/mpeg',
                'X-CSRF-TOKEN': cfg.csrf || '',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({ text: text }),
        })
            .then(function (r) {
                if (!r.ok) throw new Error('tts_' + r.status);
                var ct = (r.headers.get('content-type') || '').toLowerCase();
                if (ct.indexOf('audio') === -1 && ct.indexOf('octet-stream') === -1) {
                    throw new Error('tts_not_audio');
                }
                return r.blob();
            })
            .then(function (blob) {
                revokeLastTtsUrl();
                var u = URL.createObjectURL(blob);
                lastTtsObjectUrl = u;
                var a = new Audio(u);
                a.setAttribute('playsinline', 'true');
                a.onended = function () {
                    revokeLastTtsUrl();
                };
                a.onerror = function () {
                    revokeLastTtsUrl();
                    onFallback();
                };
                var p = a.play();
                if (p && typeof p.catch === 'function') {
                    p.catch(function () {
                        revokeLastTtsUrl();
                        onFallback();
                    });
                }
            })
            .catch(function () {
                onFallback();
            });
    }

    function speakBrowser(text) {
        if (!text || !window.speechSynthesis) return;
        try {
            window.speechSynthesis.cancel();
            var wantAr =
                hasArabicLetters(text) || appLocaleWantsArabic() || pageWantsArabic();
            var baseLang = defaultUtteranceLang(wantAr);

            function runSpeak() {
                var u = new SpeechSynthesisUtterance(text);
                u.lang = wantAr ? 'ar-EG' : baseLang;
                u.rate = wantAr ? 0.96 : 0.92;
                u.pitch = 1;
                var voice = pickBestVoice(wantAr);
                if (voice) {
                    u.voice = voice;
                    if (voice.lang) u.lang = voice.lang;
                } else if (wantAr) {
                    u.lang = 'ar-SA';
                }
                window.speechSynthesis.speak(u);
            }

            var voices = window.speechSynthesis.getVoices();
            if (voices && voices.length) {
                runSpeak();
                return;
            }
            var ran = false;
            function tryRun() {
                if (ran) return;
                var v2 = window.speechSynthesis.getVoices();
                if (v2 && v2.length) {
                    ran = true;
                    window.speechSynthesis.removeEventListener('voiceschanged', onVc);
                    runSpeak();
                }
            }
            function onVc() {
                tryRun();
            }
            window.speechSynthesis.addEventListener('voiceschanged', onVc);
            window.speechSynthesis.getVoices();
            setTimeout(function () {
                window.speechSynthesis.removeEventListener('voiceschanged', onVc);
                if (!ran) {
                    ran = true;
                    runSpeak();
                }
            }, 900);
        } catch (e) {}
    }

    function speak(text) {
        if (!text) return;
        revokeLastTtsUrl();
        if (window.speechSynthesis) {
            try {
                window.speechSynthesis.cancel();
            } catch (e) {}
        }
        var cfg = window.ADMIN_GLOBAL_SEARCH_TTS || {};
        var canBrowser = !!window.speechSynthesis;

        function fallback() {
            if (canBrowser) speakBrowser(text);
        }

        if (cfg.enabled && cfg.url) {
            speakViaOpenAi(text, fallback);
        } else {
            fallback();
        }
    }

    window.addEventListener('global-search-query-updated', function (e) {
        var d = e.detail || {};
        var q = typeof d.query === 'string' ? d.query : '';
        if (String(q).trim().length < 2) {
            lastAnnounced = '';
        }
    });

    window.addEventListener('global-search-voice-announce', function (e) {
        var text = detailText(e);
        if (!text) return;
        if (text === lastAnnounced) return;
        lastAnnounced = text;
        if (announceTimer) clearTimeout(announceTimer);
        announceTimer = setTimeout(function () {
            announceTimer = null;
            playFoundChime();
            setTimeout(function () {
                speak(text);
            }, 280);
        }, 350);
    });
})();
