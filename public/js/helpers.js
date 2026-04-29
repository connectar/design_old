/**
 * Global helpers + bullet-proof fix for the Chrome accessibility warning:
 *   "Blocked aria-hidden on an element because its descendant retained focus"
 *
 * Why the previous MutationObserver fix was not enough:
 *   setAttribute('aria-hidden', 'true') is synchronous. Chrome logs the
 *   warning immediately if a focused descendant exists. MutationObserver
 *   callbacks run afterwards, so the warning is already printed.
 *
 * What we do here (synchronously, via prototype patch):
 *   1. Intercept Element.prototype.setAttribute for 'aria-hidden'.
 *   2. Intercept the 'aria-hidden' IDL property setter too.
 *   3. Before the attribute is actually set to 'true', if the element
 *      contains document.activeElement, blur it first.
 *   4. Then set the attribute as usual.
 *
 *  We also keep the existing Bootstrap-modal focus lifecycle helpers so
 *  focus is restored to the trigger after a modal closes.
 */
(function (w, d) {
    if (typeof w === 'undefined' || typeof d === 'undefined') return;

    w.dachHelpersLoaded = true;

    // ---------- 1. Synchronous aria-hidden guard ----------
    if (!w.__ariaHiddenFocusGuardInstalled) {
        w.__ariaHiddenFocusGuardInstalled = true;

        var Elem = w.Element && w.Element.prototype;
        if (Elem) {
            var origSetAttribute = Elem.setAttribute;

            function blurIfFocusedInside(el) {
                try {
                    var active = d.activeElement;
                    if (!active || active === d.body) return;
                    if (el === active || (el.contains && el.contains(active))) {
                        if (typeof active.blur === 'function') active.blur();
                    }
                } catch (_) {}
            }

            Elem.setAttribute = function (name, value) {
                if (name === 'aria-hidden' && (value === 'true' || value === true)) {
                    blurIfFocusedInside(this);
                }
                return origSetAttribute.call(this, name, value);
            };

            // Also cover the IDL reflection: element.ariaHidden = 'true'
            try {
                var desc = Object.getOwnPropertyDescriptor(Elem, 'ariaHidden');
                if (desc && desc.set) {
                    var origSetter = desc.set;
                    Object.defineProperty(Elem, 'ariaHidden', {
                        configurable: true,
                        enumerable: desc.enumerable,
                        get: desc.get,
                        set: function (value) {
                            if (value === 'true' || value === true) blurIfFocusedInside(this);
                            return origSetter.call(this, value);
                        }
                    });
                }
            } catch (_) {}
        }
    }

    // ---------- 2. Bootstrap modal focus lifecycle ----------
    if (!w.__modalA11yPatched) {
        w.__modalA11yPatched = true;

        d.addEventListener('show.bs.modal', function (e) {
            var active = d.activeElement;
            if (active && active !== d.body && !e.target.contains(active)) {
                e.target.__a11yLastTrigger = active;
                try { active.blur(); } catch (_) {}
            }
        }, true);

        d.addEventListener('shown.bs.modal', function (e) {
            var modal = e.target;
            var focusTarget =
                modal.querySelector('[autofocus]') ||
                modal.querySelector('.modal-body [tabindex]:not([tabindex="-1"]), .modal-body input, .modal-body select, .modal-body textarea, .modal-body button') ||
                modal;

            if (focusTarget && typeof focusTarget.focus === 'function') {
                try { focusTarget.focus({ preventScroll: true }); } catch (_) { focusTarget.focus(); }
            }
        }, true);

        d.addEventListener('hide.bs.modal', function (e) {
            var modal = e.target;
            var active = d.activeElement;
            if (active && modal.contains(active)) {
                try { active.blur(); } catch (_) {}
            }
        }, true);

        d.addEventListener('hidden.bs.modal', function (e) {
            var trigger = e.target.__a11yLastTrigger;
            if (trigger && d.body.contains(trigger) && typeof trigger.focus === 'function') {
                try { trigger.focus({ preventScroll: true }); } catch (_) { trigger.focus(); }
            }
            e.target.__a11yLastTrigger = null;
        }, true);
    }
})(typeof window !== 'undefined' ? window : null, typeof document !== 'undefined' ? document : null);
