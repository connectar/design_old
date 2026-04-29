<div>
    <x-modals.modal show="{{ $show }}" maxWidth="4xl" withBorders="border:1px solid #F64E60">
        <x-slot name="title">
            <h4 class="fs-20 text-primary fw-bold mb-4">
                اضافة رصيد للموزع الدولي للنظام ({{ $systemDistributor->fullname }})
            </h4>
        </x-slot>
        <x-slot name="content">
            @php
                $networkCurrency = getCurrencyCodeByCountryCode($systemDistributor->sysdist_country);
            @endphp
            <div class="my-4 d-block" style="text-align: right;">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="box box-body pull-up bg-success bg-brick-dark text-center py-2">
                            <div class="">
                                <span class="fw-200 fs-30">
                                    {{ $systemDistributor->account ?? 0 }}
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
                                    <input class="form-control" type="text" wire:model="amount"
                                        placeholder="مثال : 200" dir="ltr">
                                </div>
                            </div>
                        </div>
                        @error('amount')
                            <span class="error text-danger p-2" style="color:#f64e60!important">{{ $message }}</span>
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
                                    <input class="form-control" type="text" wire:model="amount_confirmation"
                                        placeholder="مثال : 200" dir="ltr">
                                </div>
                            </div>
                        </div>
                        @error('amount_confirmation')
                            <span class="error text-danger p-2" style="color:#f64e60!important">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-success mx-2" wire:click="addBalanceToSystemDistributorAction">
                تأكيد
            </button>
            <button type="button" class="btn btn-danger" x-on:click="{{ $show }} = false">
                إلغاء
            </button>
        </x-slot>
    </x-modals.modal>
</div>
