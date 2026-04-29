<div class="box box-bordered border-danger m-0 no-padding">
    <div class="box-header with-border py-3">
        <h4 class="box-title">
            {{ __('site.distributer_index.charge_title') }}
            <span class="badge text-primary px-2 fs-16">
                {{ $networkName ?? '' }}
            </span>
        </h4>
    </div>
    <div class="box-body no-padding">
        <div class="box border-success m-0">
            @php
                $networkCurrency = $network->billing_currency ?? 'EGP';
            @endphp
            <!-- /.box-header -->
            <div class="box-body">
                @if ($step == 1)
                    <div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="box box-body pull-up bg-success bg-brick-dark text-center py-2">
                                    <div class="">
                                        <span class="fw-200 fs-30">
                                            {{ $network->account ?? 0 }}
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
                                            {{ $debt_invoices ?? 0 }}
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
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="fullname" class="col-form-label">
                                        {{ __('site.distributer_index.input_') . __('currencies.' . $networkCurrency) }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-money text-primary"></i>
                                            </div>
                                            <input class="form-control" type="text" wire:model.live.debounce.400ms="amount"
                                                placeholder="مثال : 200" dir="ltr">
                                        </div>
                                    </div>
                                </div>
                                @error('amount')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="fullname" class="col-form-label">
                                        {{ __('site.distributer_index.input2') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-money text-primary"></i>
                                            </div>
                                            <input class="form-control" type="text" wire:model.live.debounce.400ms="amount2"
                                                placeholder="مثال : 200" dir="ltr">
                                        </div>
                                    </div>
                                </div>
                                @error('amount2')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="mt-30">
                                    <div class="form-group row">
                                        <label class="switch switch-success">
                                            <span class="ps-3">
                                                {{ __('site.network_index.charged_money') }}
                                            </span>
                                            <input type="checkbox" wire:model="moneyIsCharged" />
                                            <span class="switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($step == 2)
                    <div class="px-4 mt-4">
                        <div class="alert text-center text-bold">
                            <span>
                                <i class="fa fa-check fs-40 text-success"></i>
                            </span>
                            <h4 class="text-bold">
                                <span class="text-success">
                                    {{ __('site.network_index.success') }}
                                </span>
                            </h4>
                            <span class="text-primary">
                                @if ($totalPaidInvoices >= 0 && $totalRemainInvoices > 0)
                                    {{ __('site.network_index.paid_alert', [
                                        'paid' => $totalPaidInvoices,
                                        'total' => $totalInvoices,
                                        'remain' => $totalRemainInvoices,
                                    ]) }}
                                @else
                                    {{ __('site.network_index.no_dept') }}
                                @endif
                            </span>
                            <div class="mt-4">
                                <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked"
                                    class="btn btn-sm btn-danger">
                                    {{ __('website.close') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @elseif ($step == 3)
                    <div class="px-4 mt-4">
                        <div class="alert text-center">
                            <h5 class="">
                                <span class="text-primary">
                                    {{ __('site.network_account_view.start_until_10_2') }}
                                </span>
                            </h5>
                            <div class="mt-4">
                                <a href="#" wire:click="$set('step',1)" class="btn btn-sm btn-dark text-white">
                                    {{ __('website.back') }}
                                </a>
                                <a href="#" wire:click="resetUserInvoice" class="btn btn-sm btn-success">
                                    {{ __('website.do') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @elseif ($step == 4)
                    <div class="px-4 mt-4">
                        <div class="alert text-center">
                            <span>
                                <i class="fa fa-check fs-40 text-success"></i>
                            </span>
                            <h5 class="">
                                <span class="text-primary">
                                    {{ __('site.network_account_view.success2') }}
                                </span>
                            </h5>
                            <div class="mt-4">
                                <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked"
                                    class="btn btn-danger">
                                    {{ __('website.cancel') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    @if ($step == 1)
        <div class="box-footer p-2">
            <div class="pull-right">

                <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked" class="btn btn-danger">
                    {{ __('website.cancel') }}
                </a>
                <button type="button" class="btn btn-success" wire:click="save" wire:loading.attr="disabled"
                    @if ($disableSaveButton) disabled @endif>
                    @lang('website.save')
                </button>

            </div>
        </div>
    @endif
</div>

<!-- /.box -->
