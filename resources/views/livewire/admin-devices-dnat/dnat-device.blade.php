<x-datatable :paginated-data="$paginatedData">
    <x-slot name="navBar">
        {{-- <div class="col-12 text-primary p-2">
            <div class=" d-flex justify-content-end px-4 mx-4">
                <div >
                    <button class="btn btn-primary btn-xl mx-2 px-4 "  data-bs-toggle="modal" wire:loading.attr="disabled" data-bs-target="#bs-explain-modal-lg">
                        <i class="fa fa-info-circle px-1 fa-lg" aria-hidden="true"></i>
                        الشرح
                    </button>
                </div>
            </div>
        </div> --}}
        <div class="col-sm-12 col-md-6">
            <a class="btn btn-success btn-md ml-5 fw-bold" wire:click="$dispatch('addDevice')">
                <i class="fa spi fa-plus px-2"></i>
                {{ __('site.devices_index.title') }}
            </a>
        </div>

        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>
    <x-slot name="thead">
        <th wire:click="orderBy('name')">
            <span class="badge">
                <span class="ps-6">#</span>
                <span style="padding-right: 20px">
                    {{ __('site.devices_index.name') }}
                </span>
            </span>
            @if ($orderByColumn == 'name')
            <span>
                <i class="fa {{ $sortIcon }} text-primary"></i>
            </span>
            @endif
        </th>
        @foreach (trans('datatable.admin_devices_dnat_index') as $column => $value)
        <th class="text-center" wire:click="orderBy('{{ $column }}')">
            <span class="badge">
                {{ $value }}
            </span>
            @if ($column == $orderByColumn)
            <span>
                <i class="fa {{ $sortIcon }} text-primary"></i>
            </span>
            @endif
        </th>
        @endforeach
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
        @foreach ($paginatedData as $index => $model)
        <tr class="fw-bold">
            <td class="w-auto">
                @include(
                'backend.includes.dnat_device.devices_index_menu'
                )
            </td>
            <td class="no-padding">
                {{ __('site.devices_index.types.' . $model->type) }}
            </td>

            <td class="no-padding">
                <a href="">
                    <span class="{{ \App\ENUMS\DnatDeviceEnum::matchSchemaBadge($model->schema) }}  fs-15 fw-bold">
                        {{ \App\ENUMS\DnatDeviceEnum::matchSchema($model->schema) }}
                    </span>
                </a>
            </td>
            <td class="no-padding">
                <a href="">
                    <span class="badge text-primary bg-dark fs-15 fw-bold">
                        {{ $model->ip_address }}
                    </span>
                </a>
            </td>
            <td class="no-padding">
                @if ($model->status ?? false)
                    <span class="badge badge-success">
                        {{ __('new_trans.device_status.on') }}
                    </span>
                @else
                    <span class="badge badge-danger">
                        {{ __('new_trans.device_status.off') }}
                    </span>
                @endif
            </td>
            <td class="no-padding">
                {{ $model->nas->name }}
            </td>
        </tr>
        @endforeach
        @else
        <x-datatable.empty-records />
        @endif
    </x-slot>
</x-datatable>
    <!-- explain Modal -->
    {{-- <div class="modal fade {{ $errors->any() ? 'show' : '' }}" id="bs-explain-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: {{ $errors->any() ? 'block' : 'none' }};">
        <div class="modal-dialog modal-xl " >
            <div class="modal-content " >
                    <div class="modal-header" >
                        <h4 class="modal-title text-white" id="myLargeModalLabel">
                            شرح فتح الاجهزة
                        </h4>
                        <button type="button" data-bs-dismiss="modal" wire:click="resetErrors" aria-label="Close"
                            class="btn btn-danger py-1 px-2 " style="height:50%;">
                            <i class="fa fa-times fa-x"></i>
                        </button>
                    </div>
                    <div  class="modal-body text-center p-2  " style="background-color:#0f0f0f;" >


                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="submit" wire:loading.attr="disabled" class="btn btn-success" data-dismiss="modal"
                            wire:click.prevent="update">
                            حفظ التعديلات
                        </button>
                        <button type="button" class="btn btn-danger text-start" id="closeModalBtn" data-bs-dismiss="modal"
                            wire:click="resetErrors">{{ __('new_trans.close') }}</button>
                    </div>
            </div>
        </div>
    </div> --}}
