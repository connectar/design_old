<div class="justify-content-between">
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
                    كود التحصيل
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-body pull-up bg-info">
                <div class="flexbox">
                    <span class="fa fa-dollar fs-40"></span>
                    <span class="fw-200 fs-40">
                        {{ $networkAccount ?? 0 }}
                    </span>
                </div>
                <div class="text-end">
                    الرصيد الحالى
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-body pull-up bg-danger bg-deathstar-white">
                <div class="flexbox">
                    <span class="fa fa-close fs-40"></span>
                    <span class="fw-200 fs-40">
                        {{ $debtInvoices ?? 0 }}
                    </span>
                </div>
                <div class="text-end">
                    الديون
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="box box-body pull-up bg-dark">
                <table class="table no-border">
                    <tr>
                        <td class="py-1 text-wrap text-primary">
                            {{ __('site.network_account_view.auto_renew_title') }}
                        </td>
                        <td class="py-1">
                            <label class="switch switch-success">
                                <input type="checkbox"
                                    wire:click="toggleAutoRenew('{{ $network->billing_code }}','{{ $network->auto_renew }}')"
                                    @if ($network->auto_renew == 1) checked @endif>
                                <span class="switch-indicator"></span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 text-wrap">
                            {{ __('site.network_account_view.invoice_info.started_at') }}
                        </td>
                        <td class="py-1">
                            <span class="fs-17">
                                {{ $networkInvoice->getStartedAt() ?? '' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1">
                            {{ __('site.network_account_view.invoice_info.expired') }}
                        </td>
                        <td class="py-1">
                            <span class="text-danger fs-17">
                                {{ $networkInvoice->getExpiredAt() ?? '' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1">
                            {{ __('site.network_account_view.duration') }}
                        </td>
                        <td class="py-1">
                            <span class="text-warning fs-17">
                                @if ($networkInvoice->full_term)
                                    {{ __('site.network_account_view.month') }}
                                @else
                                    {{ $networkInvoice->days . ' يوم' }}
                                @endif
                            </span>
                        </td>
                    </tr>
                    @foreach ($networkInvoice->content as $key => $price)
                        <tr>
                            <td class="py-1">
                                {{ __('site.network_account_view.invoice_info.content.' . $key) }}
                            </td>
                            <td class="py-1">
                                <span
                                    class="{{ __('site.network_account_view.invoice_info.content_class_color.' . $key) }} fs-18">
                                    {{ $price }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="py-1 text-danger">
                            {{ __('site.network_account_view.invoice_info.price') }}
                        </td>
                        <td class="py-1">
                            <span class="text-danger fs-24">
                                {{ $networkInvoice->price }}
                            </span>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="box box-body pull-up bg-dark">
                <table class="table no-border">
                    <tr>
                        <td class="py-1">
                            {{ __('site.network_account_view.plan_name') }}
                        </td>
                        <td class="py-1">
                            <span class="text-primary fs-17">
                                {{ $network->plan_name }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1">
                            {{ __('site.network_account_view.plan_price') }}
                        </td>
                        <td class="py-1">
                            <span class="text-success fs-18">
                                {{ $network->plan_price . ' جنيه' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1">
                            {{ __('site.network_account_view.nas_count') }}
                        </td>
                        <td class="py-1">
                            <span class="fs-18">
                                {{ $network->nas_count }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1">
                            {{ __('site.network_account_view.max_users') }}
                        </td>
                        <td class="py-1">
                            <span class="text-danger fs-18">
                                {{ $network->plan_users }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 text-wrap">
                            {{ __('site.network_account_view.active_users') }}
                        </td>
                        <td class="py-1">
                            <span class="text-success fs-20">
                                {{ $network->users_count + $network->cards_count }}
                            </span>
                            (
                            <span class="text-primary">مشتركين
                                <span>{{ $network->users_count }}</span></span> +
                            <span class="text-danger">كروت
                                <span>{{ $network->cards_count }}</span></span>
                            )
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 text-wrap">
                            {{ __('site.network_account_view.can_add_users') }}
                        </td>
                        <td class="py-1">
                            <span class="fs-18">
                                {{ $network->plan_users - ($network->users_count + $network->cards_count) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 text-wrap">
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
</div>
