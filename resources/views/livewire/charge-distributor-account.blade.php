<div class="box box-bordered border-danger m-0 no-padding">
    <div class="box-header with-border py-3">
        <h4 class="box-title">
            {{ __('site.distributer_index.charge_title') }}
            <span class="badge text-primary px-2 fs-16">
                {{ optional($distributor)->fullname }}
            </span>
        </h4>
    </div>
    <div class="box-body no-padding">
        <div class="box border-success m-0">
            <!-- /.box-header -->
            <div class="box-body">
                @if ($step == 1)
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="box box-body pull-up bg-success bg-brick-dark text-center">
                                <div class="">
                                    <span class="fw-200 fs-30">
                                        {{ $distributor->account ?? 0 }}
                                    </span>
                                </div>
                                <div class="text-center">
                                    رصيد الموزع
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="box box-body pull-up bg-danger bg-deathstar-white">
                                <div class="text-center">
                                    <span class="fw-200 fs-30">
                                        {{ $debt_invoices ?? 0 }}
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
                                    {{ __('site.distributer_index.input') }}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money text-primary"></i>
                                        </div>
                                        <input class="form-control" type="number"
                                            wire:model="amount" placeholder="مثال : 200">
                                    </div>
                                </div>
                            </div>
                            @error('amount')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
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
                                    {{ __('site.distributer_index.success') }}
                                </span>
                            </h4>
                            <span class="text-primary">
                                @if ($totalPaidInvoices > 0)
                                    {{ __('site.distributer_index.paid_alert', [
                                        'paid' => $totalPaidInvoices,
                                        'total' => $totalInvoices,
                                        'remain' => $totalRemainInvoices,
                                    ]) }}
                                @else
                                    {{ __('site.distributer_index.no_dept') }}
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


                @endif
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    @if ($step == 1)
        <div class="box-footer p-2">
            <div class="pull-right">

                <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked"
                    class="btn btn-danger">
                    {{ __('website.cancel') }}
                </a>
                <button type="button" class="btn btn-success" wire:click="save">
                    @lang('website.save')
                </button>
            </div>
        </div>
    @endif
</div>

<!-- /.box -->
