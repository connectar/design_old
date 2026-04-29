<div class="box box-bordered border-danger m-0 no-padding">
    <div class="box-header with-border py-3">
        <h4 class="box-title">
            {{ __('site.user_panel.charge_action.title') }}
            <span class="badge text-primary px-2 fs-16">
                {{ $userName }}
            </span>
        </h4>
    </div>
    <div class="box-body no-padding">
        <div class="box border-success m-0">
            <!-- /.box-header -->
            <div class="box-body">
                @if ($step == 1)
                    <div class="p-2">
                        @error('userId')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="fullname" class="col-form-label">
                                    {{ __('site.user_panel.charge_action.card_input') }}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money text-primary"></i>
                                        </div>
                                        <input class="form-control" type="number"
                                            placeholder="{{ __('site.user_panel.charge_action.card_input_p') }}"
                                            wire:model="cardNumber">
                                    </div>
                                </div>
                            </div>
                            @error('cardNumber')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @else
                    <div class="px-4 mt-4">
                        <div class="alert text-center text-bold">
                            <span>
                                <i class="fa fa-close fs-40 text-danger"></i>
                            </span>
                            <h4 class="text-bold">
                                <span class="">
                                    رصيد الموزع لا يكفى لشحن هذا الكارت قم بالاتصال على رقم
                                </span>
                                <span class="text-primary fs-18">
                                    {{ $distributorPhone }}
                                </span>
                                <span>
                                    لحل تلك المشكلة
                                </span>

                            </h4>
                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer p-2">
        <div class="pull-right">
            <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked"
                class="btn btn-danger">
                {{ __('website.cancel') }}
            </a>
            @if ($step == 1)
                <button type="button" class="btn btn-success" wire:click="save">
                    @lang('website.save')
                </button>
            @endif
        </div>
    </div>
</div>

<!-- /.box -->
