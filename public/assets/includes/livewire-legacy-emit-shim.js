/**
 * Livewire 4 — توافق مع السكربتات القديمة:
 * 1) يوفّر دالة emit على كائن Livewire (تحوّل إلى dispatch داخلياً) بعد livewire:init.
 * 2) الأحداث الصادرة من PHP عبر dispatch() لم تعد تصل إلى window.addEventListener(...) —
 *    نعيد بثها كـ CustomEvent بنفس الأسماء القديمة (camelCase) حتى تبقى jQuery/Swal تعمل.
 */
(function () {
    "use strict";

    var installed = false;

    function toKebab(name) {
        return String(name)
            .replace(/_/g, "-")
            .replace(/([a-z0-9])([A-Z])/g, "$1-$2")
            .toLowerCase();
    }

    function buildPayload(args) {
        if (args.length === 0) {
            return {};
        }
        if (args.length === 1) {
            var v = args[0];
            return {
                modelId: v,
                planId: v,
                id: v,
                modalId: v,
                networkIdToDelete: v,
                distributorId: v,
                value: v,
            };
        }
        if (args.length === 3) {
            var u = args[0];
            var ip = args[1];
            var ct = args[2];
            return {
                username: u,
                userIpAddress: u,
                ipAddress: ip,
                serverIp: ip,
                connection_type: ct,
                arg0: u,
                arg1: ip,
                arg2: ct,
            };
        }
        var a0 = args[0];
        var a1 = args[1];
        return {
            modelId: a0,
            adminPassword: a1,
            id: a0,
            modalId: a0,
            arg0: a0,
            arg1: a1,
            ids: a0,
            status: a1,
        };
    }

    function installEmitShim(L) {
        if (!L || typeof L.dispatch !== "function" || typeof L.emit === "function") {
            return;
        }
        L.emit = function (name) {
            var args = Array.prototype.slice.call(arguments, 1);
            var ev = toKebab(name);
            var payload = buildPayload(args);
            return L.dispatch(ev, payload);
        };
    }

    /**
     * يحوّل الحمولة من مستمعي الأحداث على كائن Livewire (كائن مسطّح) إلى event.detail للمستمعين القدامى.
     */
    function relayToWindow(legacyEventName, packet) {
        var detail =
            packet &&
            typeof packet === "object" &&
            Object.prototype.hasOwnProperty.call(packet, "detail")
                ? packet.detail
                : packet;
        window.dispatchEvent(new CustomEvent(legacyEventName, { detail: detail }));
    }

    /**
     * أسماء الأحداث التي يستمع لها المشروع عبر window.addEventListener (assets/includes/*.js).
     * لكل اسم نسجّل مستمعاً على كائن Livewire بالاسم كما هو وبصيغة kebab-case إن اختلفت.
     */
    var BRIDGE_EVENT_NAMES = [
        "updatedSlimScroll",
        "showDeletedBox",
        "modalClose",
        "sweetAlertShow",
        "modalShow",
        "toggleUserStatus",
        "toggleStatusForCollection",
        "activiatePikaday",
        "closeSwalBox",
        "nestableInit",
        "showSwalBox",
        "showExportModel",
        "renderCardContainer",
        "exportCardsAsPdf",
        "showRestoredBox",
        "showNasRebootBox",
        "nasReboot",
        "showNasAdminEditPasswordBox",
        "setNasAdminEditPasswordBoxOpened",
        "closeNasModal",
        "showAlertBox",
        "saveNewDevice",
        "checkConnection",
        "checkDnatConnection",
        "checkBroadbandDnatConnection",
        "toggleStatusForTransactions",
        "showDeletedAllBox",
        "refreshIframe",
        "copyScript",
        "checkInstalledStatus",
        "updatedPhoto",
        "doPaiedDebtInvoices",
        "cardsTabEvent",
        "selectPlanSwal",
    ];

    /** توجيهات خاصة: اسم الحدث في Livewire → اسم window المستعمل في المشروع */
    var BRIDGE_ALIASES = {
        "check-connect-status": "check_connection_step",
        checkConnectStatus: "check_connection_step",
    };

    function registerBridge(L, name, legacyWindowName) {
        if (typeof L.on !== "function") {
            return;
        }
        var forward = function (packet) {
            relayToWindow(legacyWindowName, packet);
        };
        try {
            L.on(name, forward);
        } catch (e) {
            /* ignore */
        }
    }

    function installWindowBridge(L) {
        if (!L || typeof L.on !== "function") {
            return;
        }
        var seen = Object.create(null);
        BRIDGE_EVENT_NAMES.forEach(function (name) {
            if (seen[name]) {
                return;
            }
            seen[name] = true;
            registerBridge(L, name, name);
            var kb = toKebab(name);
            if (kb !== name) {
                registerBridge(L, kb, name);
            }
        });
        Object.keys(BRIDGE_ALIASES).forEach(function (lwName) {
            registerBridge(L, lwName, BRIDGE_ALIASES[lwName]);
        });
    }

    /**
     * Livewire 4 no longer supports server calls to "$emit"/"$emitTo" from wire:click.
     * Intercept legacy action payloads on the client and convert them to dispatch calls.
     */
    function installLegacyActionInterceptors(L) {
        if (!L || typeof L.interceptAction !== "function") {
            return;
        }

        function extractMethod(action) {
            if (!action || typeof action !== "object") return "";
            return String(action.method || action.name || "").trim();
        }

        function extractParams(action) {
            if (!action || typeof action !== "object") return [];
            return Array.isArray(action.params) ? action.params : [];
        }

        function dispatchLegacyEvent(eventName, args) {
            if (!eventName || typeof eventName !== "string") return;
            var payload = buildPayload(args || []);
            if (typeof L.dispatch === "function") {
                L.dispatch(eventName, payload);
            }
        }

        L.interceptAction(function (ctx) {
            try {
                if (!ctx || !ctx.action) return;
                var method = extractMethod(ctx.action);
                var params = extractParams(ctx.action);

                if (method === "$emit") {
                    if (typeof ctx.cancel === "function") {
                        ctx.cancel();
                    }
                    var eventName = params[0];
                    dispatchLegacyEvent(eventName, params.slice(1));
                    return;
                }

                if (method === "$emitTo") {
                    if (typeof ctx.cancel === "function") {
                        ctx.cancel();
                    }
                    var target = params[0];
                    var toEventName = params[1];
                    var toPayload = buildPayload(params.slice(2));
                    if (
                        typeof L.dispatchTo === "function" &&
                        target &&
                        typeof toEventName === "string"
                    ) {
                        L.dispatchTo(String(target), toEventName, toPayload);
                    } else {
                        dispatchLegacyEvent(toEventName, params.slice(2));
                    }
                    return;
                }

                if (method === "$emitUp") {
                    if (typeof ctx.cancel === "function") {
                        ctx.cancel();
                    }
                    var upEventName = params[0];
                    dispatchLegacyEvent(upEventName, params.slice(1));
                }
            } catch (e) {
                // keep Livewire action pipeline alive
            }
        });
    }

    function installAll() {
        if (installed) {
            return;
        }
        var L = window.Livewire;
        if (!L) {
            return;
        }
        installed = true;
        installEmitShim(L);
        installWindowBridge(L);
        installLegacyActionInterceptors(L);
    }

    document.addEventListener("livewire:init", installAll);
    if (typeof window.Livewire !== "undefined") {
        installAll();
    }
})();
