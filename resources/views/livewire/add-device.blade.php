<form wire:submit="nextStep">
    <div class="box box-bordered border-danger m-0 no-padding">
        <div class="box-header with-border py-3">
            <h4 class="box-title">
                {{ __('site.devices_index.title') }}
            </h4>
        </div>
        <div class="box-body">
            @if ($step == 1)
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="fullname" class="col-form-label">
                                {{ __('site.devices_index.name') }}
                            </label>
                            <div>
                                <input class="form-control" type="text"
                                    placeholder="{{ __('site.devices_index.placeholder.name') }}"
                                    wire:model="device_name">
                                @error('device_name')
                                    <span class="error text-danger">* {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="fullname" class="col-form-label">
                                {{ __('site.devices_index.ip_address') }}
                            </label>
                            <div>
                                <input class="form-control" type="text"
                                    placeholder="{{ __('site.devices_index.placeholder.ip_address') }}"
                                    wire:model="ip_address" dir="ltr">
                                @error('ip_address')
                                    <span class="error text-danger">* {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="type" class="form-label">
                                {{ __('site.devices_index.type') }}
                            </label>
                            <div>
                                <select class="form-select" wire:model="type">
                                    @foreach ($types as $key => $name)
                                        <option value="{{ $key }}">
                                            {{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="error text-danger">* {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="type" class="form-label">
                                {{ __('site.devices_index.parent_id') }}
                            </label>
                            <div>
                                <select class="form-select" wire:model="parent_id">
                                    @foreach ($allDevices as $index => $array)
                                        <option value="{{ $array['id'] }}">
                                            {{ $array['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <span class="error text-danger">* {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="nas_serial" class="form-label">
                                {{ __('site.devices_index.nas_serial') }}
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-server"></i>
                                    </div>
                                    <select class="form-select" wire:model="nas_serial">
                                        @foreach ($allNas as $nas)
                                            <option value="{{ $nas['serial'] }}">
                                                {{ $nas['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nas_serial')
                                        <span class="error text-danger">* {{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($step == 2)
                <div class="px-4 mt-1">
                    <div class="alert text-center text-bold">
                        <i class="fa spi fa-snowflake-o fa-spin text-success fs-20"></i>
                        <div class="text-primary">
                            {{ __('site.devices_index.add_device_alert') }}
                        </div>
                    </div>
                </div>
            @elseif($step == 3)
                <div class="px-4">
                    <div class="alert text-center text-bold">
                        <i class="fa fa-warning text-primary fs-20"></i>
                        <div class="mt-2 text-primary">
                            {{ __('site.devices_index.add_device_messages.' . $messageKey) }}
                        </div>
                        <div class="pt-2">
                            <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked"
                                class="btn btn-sm btn-danger">
                                {{ __('website.close') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
        @if ($step == 1)
            <div class="box-footer">
                <div class="pull-right">
                    <a href="#" data-bs-dismiss="modal" wire:click="buttonCancelClicked"
                        class="btn btn-danger">
                        {{ __('website.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success">
                        @lang('website.save')
                    </button>
                </div>
            </div>
        @endif
    </div>
</form>
<!-- /.box -->
