<div class="row">
    <div class="col-md-4">
        <div class="form-group row">
            <label for="added_macs" class="form-label">@lang('adding.user.user_macs_group')
            </label>
            <label class="switch switch-success">
                <input name="userData[import_macs]" type="checkbox" wire:model="importMacs"
                    wire:click="toggleImport" />
                <span class="switch-indicator"></span>
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label for="added_macs" class="form-label">@lang('adding.user.user_macs_title')
            </label>
            <label class="switch switch-success">
                <input name="userData[define_macs]" type="checkbox" wire:model="userMacsStatus"
                    wire:click="toggleDefine" />
                <span class="switch-indicator"></span>
            </label>
        </div>
    </div>
    @if ($userMacsStatus)
        @foreach ($userMacsData as $index => $mac)
            <div class="col-md-6">
                <div class='form-group row @error("userMacsData.{$index}.mac") error @enderror'>
                    <label for="city" class="form-label">
                        {{ __('adding.user.user_mac_address', ['number' => $index + 1]) }}
                    </label>
                    <div>
                        <div class="input-group p-0">
                            <div class="input-group-addon">
                                <i class="fa fa-barcode"></i>
                            </div>
                            <input class="form-control" type="text"
                                name="defined_macs[{{ $index }}][mac]"
                                wire:model="userMacsData.{{ $index }}.mac"
                                placeholder="{{ __('adding.user.mac_placeholder') }}">

                            <div class="input-group-addon bt-0">
                                <i class="fa fa-laptop"></i>
                            </div>
                            <input class="form-control" type="text"
                                name="defined_macs[{{ $index }}][name]"
                                wire:model="userMacsData.{{ $index }}.name"
                                placeholder="{{ __('adding.user.device_name_placeholder') }}">
                            <div class="input-group-addon p-0">
                                @if ($loop->last && $totalMacs > count($userMacsData))
                                    <a href="#" class="btn btn-danger btn-sm pb-2"
                                        wire:click="deleteExistingMac({{ $index }})">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    <a href="#" class="btn btn-success btn-sm pb-2"
                                        wire:click="addNewMac">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                @else
                                    <a href="#" class="btn btn-danger btn-sm pb-2"
                                        wire:click="deleteExistingMac({{ $index }})">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @error("userMacsData.{$index}.mac")
                        <div class="help-block">
                            <ul role="alert">
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @enderror
                </div>
            </div>
        @endforeach
    @endif
</div>
