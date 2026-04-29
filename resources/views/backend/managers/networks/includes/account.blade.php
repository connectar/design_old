<div class="justify-content-between">
    @php
        $__planLimit = (int) ($network->plan_users ?? 0);
        $__activeUsage = (int) ($network->users_count ?? 0) + (int) ($network->cards_count ?? 0);
        $__overLimitBy = $__activeUsage - $__planLimit;
    @endphp
    @if ($__planLimit > 0 && $__overLimitBy > 0)
        <div class="box border-danger bt-3 mb-3">
            <div class="box-body bg-danger-light">
                <div class="d-flex align-items-center flex-wrap gap-3">
                    <span class="fa fa-exclamation-triangle fs-40 text-danger"></span>
                    <div class="flex-grow-1">
                        <h4 class="text-danger fw-bold mb-1">
                            لقد تجاوزت العدد المسموح به فى الخطة الحالية
                        </h4>
                        <div class="text-dark">
                            عدد المشتركين الفعلى
                            <span class="fw-bold text-danger">{{ $__activeUsage }}</span>
                            من أصل
                            <span class="fw-bold">{{ $__planLimit }}</span>
                            (زيادة
                            <span class="fw-bold text-danger">{{ $__overLimitBy }}</span>
                            مشترك).
                            لا بد من الاشتراك فى خطة أكبر لإعادة فتح اللوحة.
                        </div>
                    </div>
                    @if (authIsAdmin())
                        <a href="{{ route('admins.account.change_plan') }}" class="btn btn-danger">
                            <i class="fa fa-arrow-circle-up"></i>
                            الترقية إلى خطة أعلى
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <div class="box box-body pull-up bg-success">
                <div class="flexbox">
                    <span class="fa fa-qrcode fs-40"></span>
                    <span class="fw-200 fs-40">
                        {{ $network->billing_code ?? 0 }}
                    </span>
                </div>
                <div class="text-end">
                    {{ __('new_trans.billing_code') }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-body pull-up bg-info">
                <div class="flexbox">
                    <span class="fa fa-dollar fs-40"></span>
                    <span class="fw-200 fs-40">
                        {{ number_format($networkAccount ?? 0, 2) }}
                        <span class="fw-200 fs-22">
                            {{ __('currencies.' . $network->billing_currency) }}
                        </span>
                    </span>
                </div>
                <div class="text-end">
                    {{ __('new_trans.current_balance') }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-body pull-up bg-danger bg-deathstar-white">
                <div class="flexbox">
                    <span class="fa fa-close fs-40"></span>
                    <span class="fw-200 fs-40">
                        {{ number_format($debtInvoices ?? 0, 2) }}
                        <span class="fw-200 fs-22">
                            {{ __('currencies.' . $network->billing_currency) }}
                        </span>
                    </span>
                </div>
                <div class="text-end">
                    {{ __('new_trans.debts') }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="box box-body pull-up bg-dark">
                <table class="table table-hover table-bordered my-4">
                    {{-- <tr>
                        <td class="py-2 text-wrap text-primary">
                            {{ __('site.network_account_view.auto_renew_title') }}
                        </td>
                        <td class="py-2">
                            <label class="switch switch-success">
                                <input type="checkbox"
                                    wire:click="toggleAutoRenew('{{ $network->billing_code }}','{{ $network->auto_renew }}')"
                                    @if ($network->auto_renew == 1) checked @endif>
                                <span class="switch-indicator"></span>
                            </label>
                        </td>
                    </tr> --}}
                    <tr>
                        <td class="py-2 text-wrap">
                            {{ __('site.network_account_view.invoice_info.started_at') }}
                        </td>
                        <td class="py-1">
                            <span class="fs-17">
                                {{ $networkInvoice->getStartedAt() ?? '' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2">
                            {{ __('site.network_account_view.invoice_info.expired') }}
                        </td>
                        <td class="py-1">
                            <span class="text-danger fs-17">
                                {{ $networkInvoice->getExpiredAt() ?? '' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2">
                            {{ __('site.network_account_view.duration') }}
                        </td>
                        <td class="py-1">
                            <span class="text-warning fs-17">
                                @if ($networkInvoice->full_term)
                                    {{ __('site.network_account_view.month') }}
                                @else
                                    {{ $networkInvoice->days . ' ' . __('site.duration_label.DAY') }}
                                @endif
                            </span>
                        </td>
                    </tr>
                    @foreach ($networkInvoice->content ?? [] as $key => $price)
                        <tr>
                            <td class="py-2 ">
                                {{ __('site.network_account_view.invoice_info.content.' . $key) }}
                            </td>
                            <td class="py-1">
                                <span
                                    class="{{ __('site.network_account_view.invoice_info.content_class_color.' . $key) }} fs-18">
                                    {{ $price }}
                                    <span class="fs-14">
                                        @if ($key != \App\ENUMS\NetworkInvoiceTypeEnum::TOTAL_SERVERS)
                                            {{ __('currencies.' . $networkInvoice->currency_code) }}
                                        @else
                                            {{ __('site.server') }}
                                        @endif
                                    </span>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-danger ">
                        <div>
                            <td class="py-3 text-white fs-18">
                                {{ __('site.network_account_view.invoice_info.price') }}
                            </td>
                            <td class="py-1">
                                <span class="text-white fs-24">
                                    {{ $networkInvoice->price }}
                                    <span class="fw-200 fs-19">
                                        {{ __('currencies.' . $networkInvoice->currency_code) }}
                                    </span>
                                </span>
                            </td>
                        </div>
                    </tr>

                </table>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="box box-body pull-up bg-dark">
                <table class="table table-hover table-bordered ">
                    <tr>
                        <td class="py-3">
                            {{ __('site.network_account_view.plan_name') }}
                        </td>
                        <td class="py-1">
                            <span class="text-primary fs-17">
                                {{ $network->plan_name }}
                            </span>
                            <a class="btn btn-sm btn-info mx-2" href="{{ route('admins.account.change_plan') }}">
                                {{ __('site.admin_change_plan.title') }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3">
                            {{ __('site.network_account_view.plan_price') }}
                        </td>
                        <td class="py-1">
                            <span class="text-success fs-18">
                                @if (isAuthAdminBillingCurrencyIsDollar())
                                    {{ $network->plan_price_dollar }} {{ __('currencies.USD') }}
                                @else
                                    {{ $network->plan_price }} {{ __('currencies.' . $network->billing_currency) }}
                                @endif
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3">
                            {{ __('site.network_account_view.nas_count') }}
                        </td>
                        <td class="py-1">
                            <span class="fs-18">
                                {{ $network->nas_count }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3">
                            {{ __('site.network_account_view.max_users') }}
                        </td>
                        <td class="py-1">
                            <span class="text-danger fs-18">
                                {{ $network->plan_users }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 text-wrap">
                            {{ __('site.network_account_view.active_users') }}
                        </td>
                        <td class="py-1">
                            <span class="text-success fs-20">
                                {{ $network->users_count + $network->cards_count }}
                            </span>
                            (
                            <span class="text-primary">
                                <span>{{ $network->users_count }}</span></span>
                            {{ __('site.settings.admin_keys.users') }} +
                            <span class="text-danger">
                                <span>{{ $network->cards_count }}</span></span>
                            {{ __('site.settings.admin_keys.cards') }}
                            )
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 text-wrap">
                            {{ __('site.network_account_view.can_add_users') }}
                        </td>
                        <td class="py-1">
                            <span class="fs-18">
                                {{ $network->plan_users - ($network->users_count + $network->cards_count) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-3 text-wrap">
                            {{ __('site.network_account_view.expired_at') }}
                        </td>
                        <td class="py-1">
                            <span class="text-danger fs-18">
                                {{ $network->getExpiredAt() }}
                            </span>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
