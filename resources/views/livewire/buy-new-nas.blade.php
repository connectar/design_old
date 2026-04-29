<div class="box box-bordered">
    <div class="box-header with-border py-3">
        <h4 class="box-title">
            {{ __('site.buy_new_nas.title') }}
        </h4>
    </div>
    <div class="box-body">
        <div class="box border-success">
            <!-- /.box-header -->
            <div class="box-body">
                @if ($step == 1)
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="box box-body pull-up bg-dark text-center">
                            <div class="">
                                <span class="fw-200 fs-20 text-primary">
                                    {{ $nasPrice ?? 0 }}
                                </span>
                            </div>
                            <div class="text-center">
                                {{ __('site.buy_new_nas.nas_price') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="box box-body pull-up bg-dark">
                            <div class="text-center">
                                <span class="fw-200 fs-20 text-danger">
                                    {{ $totalPrice ?? 0 }}
                                </span>
                            </div>
                            <div class="text-center">
                                {{ __('site.buy_new_nas.total_price') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="fullname" class="col-form-label">
                                {{ __('site.buy_new_nas.nas_name') }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-barcode text-primary"></i>
                                    </div>
                                    <input class="form-control" type="text" wire:model.live.debounce.500ms="nasName"
                                        placeholder="شبكة محسن محمد">
                                </div>
                            </div>
                        </div>
                        @error('nasName')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @elseif($step == 2)
                <div class="px-4 mt-4">
                    <div class="alert text-center text-bold">
                        <span>
                            <i class="fa fa-close fs-40 text-primary"></i>
                        </span>
                        <h4 class="text-bold">
                            <span class="text-primary">
                                {{ $errorMessage ?? '' }}
                            </span>
                        </h4>
                        <span class="text-primary">

                        </span>
                        <div class="mt-4">
                            <a href="{{ route('admins.nas.index') }}" data-bs-dismiss="modal"
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
            <a href="{{route('admins.nas.index')}}" class="btn btn-danger">
                {{ __('website.cancel') }}
            </a>
            <button type="button" class="btn btn-success" wire:click="save" wire:loading.attr="disabled"
                @if($disableSaveButton) disabled @endif>
                @lang('website.save')
            </button>

        </div>
    </div>
    @endif
</div>

<!-- /.box -->
