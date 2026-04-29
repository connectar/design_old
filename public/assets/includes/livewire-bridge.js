/**
 * livewire-bridge.js — جسر سلوك Livewire في الواجهة (مخصص المشروع، ليس جزءاً من حزمة Livewire الرسمية).
 * سابقاً: livewire4.js — يوفّر init/update/rerender/on مع Livewire 4 وإصلاحات مودال/aria.
 * Bootstrap 5: يُكمّل فقط السمات القديمة data-toggle/data-target → data-bs-* (بدون إضافة data-toggle من data-bs).
 */
(function () {
    "use strict";

    if (window.Livewire4) {
        return;
    }

    var ready = false;
    var queue = { init: [], update: [], rerender: [] };
    var observerStarted = false;
    var modalAccessibilityBound = false;
    var bootstrapAttrBridgeBound = false;
    var ariaHiddenGuardBound = false;

    function run(list) {
        for (var i = 0; i < list.length; i++) {
            try {
                list[i]();
            } catch (e) {
                console.error("[LivewireBridge]", e);
            }
        }
    }

    function add(type, fn) {
        if (typeof fn !== "function") return;
        if (queue[type].indexOf(fn) === -1) {
            queue[type].push(fn);
        }
        if (ready && type === "init") {
            try {
                fn();
            } catch (e) {
                console.error("[LivewireBridge]", e);
            }
        }
    }

    function startObserver() {
        if (observerStarted || typeof MutationObserver === "undefined") return;
        observerStarted = true;
        var observer = new MutationObserver(function (mutations) {
            for (var i = 0; i < mutations.length; i++) {
                if (mutations[i].addedNodes && mutations[i].addedNodes.length) {
                    run(queue.update);
                    break;
                }
            }
        });
        observer.observe(document.body, { childList: true, subtree: true });
    }

    function registerHooks() {
        if (!window.Livewire || typeof window.Livewire.hook !== "function") return;
        try {
            window.Livewire.hook("morph.updated", function () {
                run(queue.rerender);
                closeStuckLoadingSwal();
            });
        } catch (e) {
            console.warn("[LivewireBridge] morph.updated hook unavailable", e);
        }
    }

    function closeStuckLoadingSwal() {
        if (typeof window.Swal === "undefined") return;
        if (!window.Swal.isVisible || !window.Swal.isVisible()) {
            window.__swalLoadingOpen = false;
            return;
        }

        var popup = window.Swal.getPopup ? window.Swal.getPopup() : null;
        var isLoadingPopup = false;
        if (popup) {
            isLoadingPopup =
                popup.getAttribute("data-swal-loading") === "1" ||
                popup.querySelector(".spinner-border") !== null;
        }

        if (window.__swalLoadingOpen || isLoadingPopup) {
            window.Swal.close();
            window.__swalLoadingOpen = false;
        }
    }

    function bindModalAccessibilityFixes() {
        if (modalAccessibilityBound) return;
        modalAccessibilityBound = true;

        document.addEventListener("show.bs.modal", function (event) {
            var modal = event.target;
            if (modal && modal.classList && modal.classList.contains("modal")) {
                var active = document.activeElement;
                if (active && !modal.contains(active) && typeof modal.focus === "function") {
                    modal.focus();
                }
                modal.setAttribute("aria-hidden", "false");
                modal.removeAttribute("inert");
            }
        });

        document.addEventListener("hide.bs.modal", function (event) {
            var modal = event.target;
            var active = document.activeElement;
            if (modal && active && modal.contains(active) && typeof active.blur === "function") {
                active.blur();
            }
        });

        document.addEventListener("hidden.bs.modal", function (event) {
            var modal = event.target;
            if (modal && modal.classList && modal.classList.contains("modal")) {
                modal.setAttribute("aria-hidden", "true");
            }
        });
    }

    function bindAriaHiddenFocusGuard() {
        if (ariaHiddenGuardBound || typeof MutationObserver === "undefined") return;
        ariaHiddenGuardBound = true;

        function repairIfFocusedInsideHiddenContainer(node) {
            if (!node || typeof node.getAttribute !== "function") return;
            if (node.getAttribute("aria-hidden") !== "true") return;

            var active = document.activeElement;
            if (!active) return;
            if (!node.contains(active)) return;

            if (typeof active.blur === "function") {
                active.blur();
            }
            node.removeAttribute("aria-hidden");
        }

        var observer = new MutationObserver(function (mutations) {
            for (var i = 0; i < mutations.length; i++) {
                var mutation = mutations[i];
                if (mutation.type === "attributes" && mutation.attributeName === "aria-hidden") {
                    repairIfFocusedInsideHiddenContainer(mutation.target);
                }
            }
        });

        observer.observe(document.body, {
            subtree: true,
            attributes: true,
            attributeFilter: ["aria-hidden"],
        });
    }

    /** ترقية سمات Bootstrap 4 → 5 فقط (لا نعيد إضافة data-toggle من data-bs-toggle). */
    function mirrorBootstrapAttrs(root) {
        if (!root || !root.querySelectorAll) return;
        var nodes = root.querySelectorAll("[data-toggle],[data-target],[data-dismiss],[data-bs-toggle],[data-bs-target],[data-bs-dismiss]");
        for (var i = 0; i < nodes.length; i++) {
            var el = nodes[i];
            var toggle = el.getAttribute("data-toggle");
            var target = el.getAttribute("data-target");
            var dismiss = el.getAttribute("data-dismiss");
            var bsToggle = el.getAttribute("data-bs-toggle");
            var bsTarget = el.getAttribute("data-bs-target");
            var bsDismiss = el.getAttribute("data-bs-dismiss");

            if (toggle && !bsToggle) el.setAttribute("data-bs-toggle", toggle);
            if (target && !bsTarget) el.setAttribute("data-bs-target", target);
            if (dismiss && !bsDismiss) el.setAttribute("data-bs-dismiss", dismiss);
        }
    }

    function bindBootstrapAttrBridge() {
        if (bootstrapAttrBridgeBound) return;
        bootstrapAttrBridgeBound = true;

        mirrorBootstrapAttrs(document);

        if (typeof MutationObserver === "undefined") return;
        var observer = new MutationObserver(function (mutations) {
            for (var i = 0; i < mutations.length; i++) {
                var mutation = mutations[i];
                for (var j = 0; j < mutation.addedNodes.length; j++) {
                    var node = mutation.addedNodes[j];
                    if (node && node.nodeType === 1) {
                        mirrorBootstrapAttrs(node);
                    }
                }
            }
        });
        observer.observe(document.body, { childList: true, subtree: true });
    }

    function initOnce() {
        if (ready) return;
        ready = true;
        run(queue.init);
        startObserver();
        registerHooks();
        bindModalAccessibilityFixes();
        bindAriaHiddenFocusGuard();
        bindBootstrapAttrBridge();
        closeStuckLoadingSwal();
    }

    document.addEventListener("livewire:init", initOnce);
    if (window.Livewire) {
        initOnce();
    }

    window.Livewire4 = {
        init: function (fn) {
            add("init", fn);
        },
        onInit: function (fn) {
            add("init", fn);
        },
        update: function (fn) {
            add("update", fn);
        },
        onUpdate: function (fn) {
            add("update", fn);
        },
        rerender: function (fn) {
            add("rerender", fn);
        },
        onRerender: function (fn) {
            add("rerender", fn);
        },
        on: function (eventName, fn) {
            var register = function () {
                if (!window.Livewire || typeof window.Livewire.on !== "function") return;
                window.Livewire.on(eventName, fn);
            };

            if (window.Livewire) {
                register();
            } else {
                document.addEventListener("livewire:init", register, { once: true });
            }
        },
    };
})();
