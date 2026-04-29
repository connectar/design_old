<form wire:submit="submitForm">
    <div class="box border-success m-0">
        <div class="box-header with-border py-1">
            <h4 class="box-title">
                {{ __('site.user_add_macs.title') }}
                <span class="badge text-primary px-2 fs-16">
                    {{ $user->fullname ?? '' }}
                </span>
            </h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @error('totalMacs')
                <div class="help-block text-danger alert-block">
                    <ul role="alert">
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            @enderror
            @if ($step == 'show_all')
                <div class="row mb-3">
                    <div class="col-12">
                        <a href="#" class="btn btn-success btn-sm pb-2" wire:click="addNewMac">
                            <i class="fa fa-plus"></i>
                            {{ __('site.user_index.ShowAndEditMacs.add_new') }}
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-laptop"></i>
                                        عدد الاجهزة
                                    </div>
                                    <select class="form-select" wire:model="MaxMacsCount">
                                        @foreach (range(1, 10) as $number)
                                            <option value="{{ $number }}">
                                                {{ $number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="switch switch-success">
                                <input type="checkbox" wire:model="importMacs"
                                    wire:click="toggleImport" />
                                <span class="switch-indicator"></span>
                                <span>
                                    سحب الماك اوتوماتيك
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                @if ($userMacsData)
                    <div class="row">
                        @if ($usingMac)
                            <span class="text-primary">
                                {{ __('site.user_index.ShowAndEditMacs.using_mac') }}
                            </span>
                        @endif

                        <table class="table table-striped table-bordered">
                            <thead class="text-center">
                                <th class="text-center">الماك ادريس</th>
                                <th class="text-center">اسم الجهاز</th>
                                <th class="text-center">#</th>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($userMacsData as $mac => $name)
                                    <tr class="py-1">
                                        <td dir="ltr">
                                            {{ $mac }}
                                        </td>
                                        <td>
                                            {{ $name ?? '__' }}
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-danger btn-sm pb-2"
                                                wire:click="deleteExistingMac('{{ $mac }}')">
                                                <i class="fa fa-trash-o"></i>
                                                {{ __('site.user_index.ShowAndEditMacs.delete') }}
                                            </a>
                                            <a href="#" class="btn btn-warning btn-sm pb-2"
                                                wire:click="editMac('{{ $mac }}','{{ $name }}')">
                                                <i class="fa fa-pencil"></i>
                                                {{ __('site.user_index.ShowAndEditMacs.edit') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-1">
                        <span class="text-danger px-1 fs-18">
                            {{ __('site.user_add_macs.no_macs') }}
                        </span>
                        {{-- <a href="#" class="btn btn-success btn-sm pb-2" wire:click="addNewMac">
                            {{ __('site.user_add_macs.add_mac') }}
                            <i class="fa fa-plus"></i>
                        </a> --}}
                    </div>
                @endif
            @elseif($step =='add_new')
                <div class="col-12 px-1">
                    <div class="form-group row @error('addingMac') error @enderror">
                        <label for="city" class="form-label">
                            {{ __('site.user_index.ShowAndEditMacs.mac_title') }}
                        </label>
                        <div>
                            <div class="input-group p-0">
                                <div class="input-group-addon">
                                    <i class="fa fa-barcode"></i>
                                </div>
                                <input class="form-control" type="text" dir="ltr"
                                    wire:model="addingMac"
                                    placeholder="{{ __('adding.user.mac_placeholder') }}">

                                <div class="input-group-addon bt-0">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input class="form-control" type="text"
                                    wire:model="addingName"
                                    placeholder="{{ __('adding.user.device_name_placeholder') }}">

                            </div>
                        </div>
                        @error('addingMac')
                            <div class="help-block">
                                <ul role="alert">
                                    <li>{{ $message }}</li>
                                </ul>
                            </div>
                        @enderror
                    </div>
                    <div>
                        <a href="#" class="btn btn-success btn-sm pb-2 mx-1 pull-right"
                            wire:click="saveNewMac">
                            {{ __('website.save') }}
                        </a>
                        <a href="#" class="btn btn-info btn-sm pb-2 pull-right"
                            wire:click="$set('step','show_all')">
                            <i class="fa spi fa-arrow-right"></i>
                            رجوع لكل الماكات
                        </a>
                    </div>
                </div>
            @elseif($step =='edit_mac')
                <div class="col-12 px-2">
                    <div class="form-group row @error('editingMac') error @enderror">
                        <label for="city" class="form-label">
                            {{ __('site.user_index.ShowAndEditMacs.mac_title') }}
                        </label>
                        <div>
                            <div class="input-group p-0">
                                <div class="input-group-addon">
                                    <i class="fa fa-barcode"></i>
                                </div>
                                <input class="form-control" type="text" dir="ltr"
                                    wire:model="editingMac"
                                    placeholder="{{ __('adding.user.mac_placeholder') }}">

                                <div class="input-group-addon bt-0">
                                    <i class="fa fa-laptop"></i>
                                </div>
                                <input class="form-control" type="text" wire:model="editingName"
                                    placeholder="{{ __('adding.user.device_name_placeholder') }}">

                            </div>
                        </div>
                        @error('editingMac')
                            <div class="help-block">
                                <ul role="alert">
                                    <li>{{ $message }}</li>
                                </ul>
                            </div>
                        @enderror
                    </div>
                    <div>
                        <a href="#" class="btn btn-success btn-sm pb-2 pull-right mx-1"
                            wire:click="saveEditedMac">
                            {{ __('website.save') }}
                        </a>
                        <a href="#" class="btn btn-info btn-sm pb-2 pull-right"
                            wire:click="$set('step','show_all')">
                            <i class="fa spi fa-arrow-right"></i>
                            رجوع لكل الماكات
                        </a>

                    </div>
                </div>
            @elseif($step=='error')
                <div class="px-4 mt-4">
                    <div class="alert text-center text-bold">
                        <h4 class="text-bold text-primary h4">
                            <i class="icon fa fa-warning"></i>
                            <span class="text-danger">
                                {{ __('site.user_index.ShowAndEditMacs.errors.' . $errorKey) }}
                            </span>
                        </h4>
                        <a href="#" class="btn btn-info btn-sm pb-2"
                            wire:click="$set('step','show_all')">
                            <i class="fa spi fa-arrow-right"></i>
                            رجوع لكل الماكات
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">
                <a href="#" data-bs-dismiss="modal" class="btn btn-danger"
                    wire:click="buttonCancelClicked">
                    {{ __('website.cancel') }}
                </a>
            </div>
        </div>
    </div>
</form>
