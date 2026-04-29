<div class="manager-nas-page">
    {{-- Stats row: total / connected / disconnected / network-active --}}
    <div class="row g-2 mb-2 manager-nas-stats">
        <div class="col-6 col-md-3">
            <button type="button"
                class="w-100 info-box bg-info text-white border-0 {{ $filterStatus === 'all' ? 'is-active' : '' }}"
                wire:click="$set('filterStatus','all')" wire:loading.attr="disabled">
                <span class="info-box-icon push-bottom rounded">
                    <i class="fa fa-server"></i>
                </span>
                <div class="info-box-content text-start">
                    <span class="info-box-text fw-bold">كل السيرفرات</span>
                    <span class="info-box-number">{{ number_format($counts['total']) }}</span>
                </div>
            </button>
        </div>
        <div class="col-6 col-md-3">
            <button type="button"
                class="w-100 info-box bg-success text-white border-0 {{ $filterStatus === 'connected' ? 'is-active' : '' }}"
                wire:click="$set('filterStatus','connected')" wire:loading.attr="disabled">
                <span class="info-box-icon push-bottom rounded">
                    <i class="fa fa-snowflake-o fa-spin"></i>
                </span>
                <div class="info-box-content text-start">
                    <span class="info-box-text fw-bold">المتصلة فقط</span>
                    <span class="info-box-number">{{ number_format($counts['connected']) }}</span>
                </div>
            </button>
        </div>
        <div class="col-6 col-md-3">
            <button type="button"
                class="w-100 info-box bg-danger text-white border-0 {{ $filterStatus === 'disconnected' ? 'is-active' : '' }}"
                wire:click="$set('filterStatus','disconnected')" wire:loading.attr="disabled">
                <span class="info-box-icon push-bottom rounded">
                    <i class="fa fa-circle"></i>
                </span>
                <div class="info-box-content text-start">
                    <span class="info-box-text fw-bold">الأوفلاين فقط</span>
                    <span class="info-box-number">{{ number_format($counts['disconnected']) }}</span>
                </div>
            </button>
        </div>
        <div class="col-6 col-md-3">
            <button type="button"
                class="w-100 info-box bg-warning text-white border-0 {{ $filterStatus === 'network_active' ? 'is-active' : '' }}"
                wire:click="$set('filterStatus','network_active')" wire:loading.attr="disabled">
                <span class="info-box-icon push-bottom rounded">
                    <i class="fa fa-bolt"></i>
                </span>
                <div class="info-box-content text-start">
                    <span class="info-box-text fw-bold">اشتراك الشبكة نشط</span>
                    <span class="info-box-number">{{ number_format($counts['network_active']) }}</span>
                </div>
            </button>
        </div>
    </div>

    <x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-md-4">
            <span class="btn btn-sm btn-warning">
                {{ __('datatable.servers_title') }}
            </span>
        </div>
        <div class="col-sm-12 col-md-4">
            <select class="form-select d-inline bg-lightest text-white" wire:model.live="filterStatus">
                <option value="all">كل السيرفرات</option>
                <option value="connected">المتصلة فقط</option>
                <option value="disconnected">الأوفلاين فقط</option>
                <option value="network_active">اشتراك الشبكة نشط</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-4">
            <x-datatable.table-search />
        </div>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.manager_nas_index')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 20px">
                    {{ __('datatable.manager_nas_name') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        <div>
            @if ($paginatedData && count($paginatedData) > 0)
                @foreach ($paginatedData as $index => $model)
                    <tr>
                        <td class="py-2">
                            <div class="dropdown">
                                <div class="clearfix pull-left">
                                    <span class="badge badge-dark b-1 border-warning">
                                        @if (($page ?? 1) != 1)
                                            {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                        @else
                                            {{ $loop->index + 1 }}
                                        @endif
                                    </span>
                                    <span class="dropdown-toggle badge badge-warning" data-bs-toggle="dropdown">
                                        <span dir="auto">
                                            {{ $model->nas_name }}
                                        </span>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-end fw-bold">
                                        <a class="dropdown-item py-2 fw-bold fw-bold text-primary"
                                            wire:click="loginAsAdmin('{{ $model->admin_id }}')">
                                            <i class="fa fa-hand-lizard-o"></i>
                                            {{ __('site.manager_nas.login') }}
                                        </a>
                                        <a class="dropdown-item py-2 fw-bold text-warning"
                                            wire:click="openTransferModal('{{ $model->serial }}')">
                                            <i class="fa fa-exchange"></i>
                                            نقل السيرفر
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td class="p-0" width="25px">
                            <span class="badge text-primary">
                                {{ $model->fullname }}
                            </span>
                        </td>
                        <td class="p-0" width="25px">
                            <span class="badge badge-info">
                                {{ $model->serial }}
                            </span>
                        </td>
                        <td class="p-0" width="25px">
                            @if ($model->billing_code)
                                <span class="badge badge-primary" dir="ltr"
                                    title="كود التحصيل"
                                    style="cursor:pointer"
                                    onclick="copyNasIp('{{ $model->billing_code }}')">
                                    {{ $model->billing_code }}
                                </span>
                            @else
                                <span class="badge badge-secondary">---</span>
                            @endif
                        </td>
                        <td class="no-padding">
                            <a class="badge" target="_blank" href="{{ 'http://' . $model->ip_address }}">
                                {{ $model->ip_address }}
                            </a>
                            <button type="button" class="btn btn-success fw-bold  btn-sm"
                                wire:click="openDevice('{{ $model->serial }}')">
                                دخول
                            </button>
                            <button class="btn btn-sm btn-danger"
                                onclick="copyNasIp('{{ $model->ip_address }}')">نسخ</button>
                        </td>
                        <td class="no-padding">
                            <div x-data="{ showPassword: false }">
                                <span x-show="showPassword" class="badge badge-danger px-2" style="display: none;">
                                    {{ $model->is_pass_changed ? $model->api_password : \App\Models\Nas::getApiPassword() }}
                                </span>
                                <button @click="showPassword = !showPassword" class="badge btn-danger">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </td>
                        <td class="no-padding">
                            <button type="button" class="btn btn-info fw-bold btn-rounded btn-sm"
                                wire:click="copyScript('{{ $model->serial }}')">
                                نسخ كود التركيب
                            </button>
                        </td>
                        <td class="no-padding" x-data="componentNasOptionalBox()">
                            <button type="button" class="btn btn-dark fw-bold btn-rounded btn-sm"
                                @click="confirmReinstallOnline(@js($model->serial))">
                                اعادة تركيب اولانلاين
                            </button>
                        </td>
                        <td class="no-padding">
                            <span class="badge bg-dark text-primary" dir="auto">
                                {{ $model->mikro_version ?? '---' }}
                            </span>
                        </td>
                        <td class="no-padding">
                            <span class="badge badge-success">
                                {{-- {{ $model->users_count }} --}}
                                {{ $model->users_count + $model->cards_count }}
                            </span>
                        </td>
                        <td class="no-padding">
                            @if ($model->online_count > 0)
                                <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                            @else
                                <i class="fa fa-circle text-danger"></i>
                            @endif
                            <span class="badge badge-secondary">
                                {{ $model->online_count }}

                            </span>
                        </td>
                        <td class="no-padding">
                            <span
                                class="badge badge-pill @if ($model->is_connected == 1) badge-success @else badge-danger @endif">
                                {{ __('site.nas_is_connected_' . $model->is_connected) }}
                            </span>
                        </td>

                        {{-- <td class="no-padding">
                        <span
                            class="@if ($model->is_installed == 1) text-success
                        @else text-danger @endif">
                            {{ __('site.nas_is_installed_' . $model->is_installed) }}
                        </span>
                    </td> --}}
                    </tr>
                @endforeach
            @else
                <x-datatable.empty-records />
            @endif
        </div>
    </x-slot>
    </x-datatable>

    {{-- Floating horizontal scrollbar (sticks to the bottom of the viewport
         while the servers table is visible — saves scrolling to the end of
         a tall page just to reach the native scrollbar). --}}
    <div class="floating-hscroll" id="managerNasFloatingScroll" aria-hidden="true">
        <div class="floating-hscroll__inner"></div>
    </div>

    {{-- ===================== Transfer Server Modal ===================== --}}
    <div wire:ignore.self class="modal fade" id="transferServerModal" tabindex="-1"
        aria-labelledby="transferServerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark py-2">
                    <h6 class="modal-title fw-bold mb-0" id="transferServerModalLabel">
                        <i class="fa fa-exchange"></i>
                        نقل السيرفر
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        wire:click="closeTransferModal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-2">
                    @if ($transferSerial)
                        {{-- Source server snapshot --}}
                        <div class="card mb-2 border shadow-none">
                            <div class="card-body p-2">
                                <h6 class="fw-bold text-primary mb-2 small">
                                    <i class="fa fa-server"></i>
                                    السيرفر الحالي
                                </h6>
                                <div class="row g-1 small">
                                    <div class="col-4">
                                        <span class="text-muted d-block">الاسم</span>
                                        <strong>{{ $transferServerName }}</strong>
                                    </div>
                                    <div class="col-4">
                                        <span class="text-muted d-block">السيريال</span>
                                        <span class="badge badge-info">{{ $transferSerial }}</span>
                                    </div>
                                    <div class="col-4">
                                        <span class="text-muted d-block">الشبكة</span>
                                        <strong>{{ $transferSourceNetworkName ?? '---' }}</strong>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <div class="small">
                                            <i class="fa fa-users text-primary"></i>
                                            عدد العملاء:
                                            <strong class="text-danger">
                                                {{ number_format($transferUsersOnServer) }}
                                            </strong>
                                            يوزر (سيتم نقلهم مع السيرفر)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Destination billing code --}}
                        <div class="mb-2">
                            <label class="form-label fw-bold small mb-1">
                                كود التحصيل للشبكة الهدف
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control text-center ltr"
                                placeholder="أدخل كود التحصيل"
                                wire:model.live.debounce.400ms="transferBillingCode"
                                autocomplete="off" dir="ltr">
                            <small class="text-muted">
                                كود فريد لكل شبكة — راجعه من صفحة الشبكات.
                            </small>
                        </div>

                        {{-- Destination preview --}}
                        @if ($transferDestinationPreview)
                            @php
                                $dest = $transferDestinationPreview;
                                $totalAfter = $dest['current_used'] + $transferUsersOnServer;
                                $fits = $totalAfter <= $dest['plan_users_limit'];
                            @endphp
                            <div class="card border shadow-none mb-2">
                                <div
                                    class="card-body p-2 {{ $fits ? 'bg-light-success' : 'bg-light-danger' }}">
                                    <h6 class="fw-bold mb-2 small {{ $fits ? 'text-success' : 'text-danger' }}">
                                        <i class="fa {{ $fits ? 'fa-check-circle' : 'fa-exclamation-triangle' }}"></i>
                                        {{ $dest['name'] ?? '---' }}
                                    </h6>
                                    <div class="row g-1 small">
                                        <div class="col-3">
                                            <span class="text-muted d-block">الحد</span>
                                            <strong>{{ number_format($dest['plan_users_limit']) }}</strong>
                                        </div>
                                        <div class="col-3">
                                            <span class="text-muted d-block">يوزرات</span>
                                            <strong>{{ number_format($dest['current_users']) }}</strong>
                                        </div>
                                        <div class="col-3">
                                            <span class="text-muted d-block">كروت</span>
                                            <strong>{{ number_format($dest['current_active_cards']) }}</strong>
                                        </div>
                                        <div class="col-3">
                                            <span class="text-muted d-block">المتاح</span>
                                            <strong class="{{ $dest['free_slots'] >= $transferUsersOnServer ? 'text-success' : 'text-danger' }}">
                                                {{ number_format($dest['free_slots']) }}
                                            </strong>
                                        </div>
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex justify-content-between align-items-center small">
                                        <span>
                                            بعد النقل:
                                            <strong>{{ number_format($totalAfter) }}</strong>
                                            /
                                            {{ number_format($dest['plan_users_limit']) }}
                                        </span>
                                        @if ($fits)
                                            <span class="badge badge-success">
                                                <i class="fa fa-check"></i>
                                                كافية
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fa fa-times"></i>
                                                غير كافية
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($transferError)
                            <div class="alert alert-danger py-1 px-2 mb-0 small">
                                <i class="fa fa-exclamation-circle"></i>
                                {{ $transferError }}
                            </div>
                        @endif
                    @endif
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                        wire:click="closeTransferModal">
                        إلغاء
                    </button>
                    <button type="button" class="btn btn-sm btn-warning fw-bold"
                        wire:click="confirmTransfer"
                        wire:loading.attr="disabled" wire:target="confirmTransfer"
                        @if (
                            !$transferDestinationPreview ||
                                $transferError ||
                                ($transferDestinationPreview['current_used'] + $transferUsersOnServer) >
                                    $transferDestinationPreview['plan_users_limit']) disabled @endif>
                        <span wire:loading.remove wire:target="confirmTransfer">
                            <i class="fa fa-exchange"></i>
                            تأكيد النقل
                        </span>
                        <span wire:loading wire:target="confirmTransfer">
                            <i class="fa fa-spinner fa-spin"></i>
                            جاري النقل...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener("copyScript", (event) => {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = event.detail.script;
            document.body.appendChild(tempInput);
            tempInput.select();
            try {
                var successful = document.execCommand("copy", false, null);
                if (successful) {
                    Swal.fire(event.detail.alert.success);
                }
            } catch (err) {
                Swal.fire(event.detail.alert.error);
                alert("Oops, unable to copy to clipboard");
            }
        });

        function componentNasOptionalBox() {
            return {
                confirmReinstallOnline(serial) {
                    let title = "هل أنت متأكد من اعادة تركيب السيستم اونلاين؟";
                    let text = "سيتم اعادة تركيب السيستم مع الحفاظ على البيانات الحالية";
                    confirmWarningAlert(title, text, 'تأكيد').then((result) => {
                        if (result.isConfirmed) {
                            @this.call('reinstallOnline', serial);
                        }
                    });
                },
            };
        }

        var transferServerModalInstance = null;
        function getTransferServerModal() {
            var el = document.getElementById('transferServerModal');
            if (!el) return null;
            if (transferServerModalInstance) return transferServerModalInstance;

            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                transferServerModalInstance = new bootstrap.Modal(el);
                return transferServerModalInstance;
            }
            if (typeof window.jQuery !== 'undefined') {
                return {
                    show: function () { window.jQuery(el).modal('show'); },
                    hide: function () { window.jQuery(el).modal('hide'); },
                };
            }
            return null;
        }
        Livewire.on('show-transfer-modal', () => {
            var modal = getTransferServerModal();
            if (modal) modal.show();
        });
        Livewire.on('hide-transfer-modal', () => {
            var modal = getTransferServerModal();
            if (modal) modal.hide();
        });

        /* Floating horizontal scrollbar — proxies the servers table's
           horizontal scroll so it can be used from anywhere on a tall page. */
        (function () {
            function initManagerNasFloatingScroll() {
                var page = document.querySelector('.manager-nas-page');
                var bar = document.getElementById('managerNasFloatingScroll');
                if (!page || !bar) return;
                var tableWrapper = page.querySelector('.table-responsive');
                if (!tableWrapper) return;
                var inner = bar.querySelector('.floating-hscroll__inner');
                if (!inner) return;

                var syncingFromBar = false;
                var syncingFromTable = false;

                function refresh() {
                    var table = tableWrapper.querySelector('table');
                    var scrollWidth = table ? table.scrollWidth : tableWrapper.scrollWidth;
                    inner.style.width = scrollWidth + 'px';

                    var overflows = tableWrapper.scrollWidth > tableWrapper.clientWidth + 1;
                    if (!overflows) { bar.style.display = 'none'; return; }

                    var rect = tableWrapper.getBoundingClientRect();
                    var viewH = window.innerHeight || document.documentElement.clientHeight;
                    var tableInView = rect.top < viewH - 40 && rect.bottom > 80;
                    var nativeScrollbarVisible = rect.bottom <= viewH - 4;

                    bar.style.display = (tableInView && !nativeScrollbarVisible) ? 'block' : 'none';

                    if (bar.style.display === 'block' && !syncingFromTable) {
                        bar.scrollLeft = tableWrapper.scrollLeft;
                    }
                }

                bar.addEventListener('scroll', function () {
                    if (syncingFromTable) return;
                    syncingFromBar = true;
                    tableWrapper.scrollLeft = bar.scrollLeft;
                    requestAnimationFrame(function () { syncingFromBar = false; });
                });
                tableWrapper.addEventListener('scroll', function () {
                    if (syncingFromBar) return;
                    syncingFromTable = true;
                    bar.scrollLeft = tableWrapper.scrollLeft;
                    requestAnimationFrame(function () { syncingFromTable = false; });
                });

                var scheduled = false;
                function schedule() {
                    if (scheduled) return;
                    scheduled = true;
                    requestAnimationFrame(function () { scheduled = false; refresh(); });
                }
                window.addEventListener('scroll', schedule, { passive: true });
                window.addEventListener('resize', schedule);
                new MutationObserver(schedule).observe(tableWrapper, {
                    childList: true, subtree: true, attributes: true,
                });

                refresh();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initManagerNasFloatingScroll);
            } else {
                initManagerNasFloatingScroll();
            }
            document.addEventListener('livewire:navigated', initManagerNasFloatingScroll);
        })();
    </script>
@endpush
@push('styles')
    <style>
        /* Stats row (clickable filter buttons) for managers/servers */
        .manager-nas-stats .info-box {
            cursor: pointer;
            opacity: .55;
            filter: saturate(.7);
            transition: opacity .15s ease, filter .15s ease, transform .15s ease, box-shadow .15s ease;
        }
        .manager-nas-stats .info-box:hover {
            opacity: .85;
            filter: saturate(1);
        }
        .manager-nas-stats .info-box.is-active {
            opacity: 1;
            filter: saturate(1);
            transform: translateY(-1px);
            box-shadow: 0 .35rem .75rem rgba(0, 0, 0, .18);
        }
        .manager-nas-stats .info-box-text,
        .manager-nas-stats .info-box-number {
            color: #fff;
        }
        /* Transfer modal — destination capacity preview backgrounds */
        .bg-light-success {
            background-color: rgba(25, 135, 84, .08) !important;
        }
        .bg-light-danger {
            background-color: rgba(220, 53, 69, .08) !important;
        }
        #transferServerModal .form-control.ltr {
            letter-spacing: 1px;
            font-family: monospace;
        }
        /* Floating horizontal scrollbar — stays docked to the viewport bottom
           so the user can pan the wide servers table without scrolling the
           whole page to reach its native scrollbar. */
        .floating-hscroll {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            height: 16px;
            overflow-x: auto;
            overflow-y: hidden;
            background: rgba(0, 0, 0, .35);
            z-index: 1040;
            display: none;
        }
        .floating-hscroll__inner {
            height: 1px;
        }
        .floating-hscroll::-webkit-scrollbar {
            height: 14px;
        }
        .floating-hscroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .55);
            border-radius: 7px;
        }
        .floating-hscroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, .8);
        }
    </style>
@endpush
