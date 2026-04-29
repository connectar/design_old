<div>
    <x-modals.modal show="{{ $show }}" maxWidth="5xl" withBorders="border:1px solid #F64E60">
        <x-slot name="title">
            <h4 class="fs-20 text-primary fw-bold mb-4">
                {{ __('new_trans.change_billing_currency') }} [{{ $networkAdmin->fullname }}]
            </h4>
        </x-slot>
        <x-slot name="content">
            @php
                $networkCurrency = $this->billing_currency ?? $networkAdmin->network->billing_currency;
            @endphp
            <div class="row" style="text-align: right;">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                        <label for="country_id" class="form-label">
                            {{ __('adding.register.country') }}
                        </label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-map-o"></i>
                            </div>
                            <select class="form-select show-tick p-2" wire:model="country_code">
                                @foreach ($countries as $country)
                                    <option value="{{ $country['code'] }}">
                                        {{ $country['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('country_code')
                            <span class="error text-danger" style="color:#f64e60!important">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="network_name" class="form-label">
                            {{ __('new_trans.billing_currency') }}
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-money px-2"></i>
                                </div>
                                <input class="form-control-disabled form-control mx-0 bg-dark" type="text"
                                    id="network_name" readonly disabled
                                    value="{{ getCurrencyNameByCurrencyCode($this->billing_currency) }}">
                            </div>
                            @error('billing_currency')
                                <span class="error text-danger" style="color:#f64e60!important">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                @if (!in_array($this->billing_currency, ['EGP', 'USD']))
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group row">
                            <label for="country_id" class="form-label">
                                {{ __('new_trans.system_distributor_for_the_network') }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-o"></i>
                                    </div>
                                    <select class="form-select show-tick p-2" wire:model="system_distributor_id">
                                        <option>
                                            {{ __('new_trans.select_system_distributor') }}
                                        </option>
                                        @foreach ($systemDistributors->where('sysdist_country', '=', $this->country_code) as $systemDistributor)
                                            <option value="{{ $systemDistributor->id }}">
                                                {{ $systemDistributor->fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('system_distributor_id')
                                    <span class="error text-danger"
                                        style="color:#f64e60!important">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-12">
                    <div class="form-group row">
                        <label for="fullname" class="col-form-label">
                            {{ __('site.distributer_index.change_currnecy_input_') . __('currencies.' . $networkCurrency) }}
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-money text-success mx-0"></i>
                                </div>
                                <input class="form-control" type="text" wire:model="amount" placeholder="مثال : 200"
                                    dir="ltr">
                            </div>
                        </div>
                    </div>
                    @error('amount')
                        <span class="error text-danger" style="color:#f64e60!important">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <label for="debt" class="col-form-label">
                            {{ __('site.distributer_index.change_currnecy_debt_input_') . __('currencies.' . $networkCurrency) }}
                        </label>
                        <div>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-money text-danger mx-0"></i>
                                </div>
                                <input class="form-control" type="text" wire:model="amount_debt"
                                    placeholder="مثال : 200" dir="ltr">
                            </div>
                        </div>
                    </div>
                    @error('amount_debt')
                        <span class="error text-danger" style="color:#f64e60!important">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="row bg-dark p-4 mx-0 rounded-lg mt-3">
                    <div class="pb-4 pt-2">
                        العملة الحالية للشبكة هي
                        {{ getCurrencyNameByCurrencyCode($networkAdmin->network->billing_currency) }}
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="box box-body pull-up bg-success bg-brick-dark text-center py-2">
                            <div class="">
                                <span class="fw-200 fs-30">
                                    {{ $networkAdmin->network->account ?? 0 }}
                                </span>
                                <span class="fw-200 fs-16">
                                    {{ __('currencies.' . $networkAdmin->network->billing_currency) }}
                                </span>
                            </div>
                            <div class="text-center">
                                رصيد الشبكة
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="box box-body pull-up bg-danger bg-deathstar-white py-2">
                            <div class="text-center">
                                <span class="fw-200 fs-30">
                                    {{ $debt_invoices ?? 0 }}
                                    <span class="fw-200 fs-16">
                                        {{ __('currencies.' . $networkAdmin->network->billing_currency) }}
                                    </span>
                                </span>
                            </div>
                            <div class="text-center">
                                الديون
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row bg-info p-4 mx-0 rounded-lg mt-3">
                    <div class="pb-4 pt-2">
                        بعد تغير العملة سيتم اعادة تحويل الديون للعملة الجديد
                        {{ getCurrencyNameByCurrencyCode($networkCurrency) }} واضافة المبلغ المضاف بدلا
                        من
                        الرصيد الحالي
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="box box-body pull-up bg-success bg-brick-dark text-center py-2">
                            <div class="">
                                <span class="fw-200 fs-30">
                                    {{ $amount ?? 0 }}
                                </span>
                                <span class="fw-200 fs-16">
                                    {{ __('currencies.' . $networkCurrency) }}
                                </span>
                            </div>
                            <div class="text-center">
                                رصيد الشبكة
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="box box-body pull-up bg-danger bg-deathstar-white py-2">
                            <div class="text-center">
                                <span class="fw-200 fs-30">
                                    {{ $amount_debt ?? 0 }}
                                    <span class="fw-200 fs-16">
                                        {{ __('currencies.' . $networkCurrency) }}
                                    </span>
                                </span>
                            </div>
                            <div class="text-center">
                                الديون
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-success mx-2" wire:click="changeBillingCurrencyAction">
                تأكيد
            </button>
            <button type="button" class="btn btn-danger" x-on:click="{{ $show }} = false">
                إلغاء
            </button>
        </x-slot>
    </x-modals.modal>
</div>
