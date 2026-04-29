<x-datatable :paginated-data="$paginatedData">
    <x-slot name="navBar">
        <div class="col-12 text-primary p-2">
            <div class="row">
                <div class="col-md-6">
                    <span>
                        {{ trans('new_trans.new_feature_free_for_time') }}
                    </span>
                </div>
                <div class="col-md-6">
                    <span class="text-warning">
                        {{ trans('new_trans.explain_open_devices') }}
                    </span>
                    <a class="btn btn-sm btn-primary" href="https://www.youtube.com/watch?v=O5AfnQRhXLo"
                        target="_blank">{{ trans('new_trans.click_here') }}</a>
                </div>
            </div>
        </div>
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
        @foreach (trans('datatable.admin_devices_index') as $column => $value)
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
                'backend.includes.devices_index_menu'
                )
            </td>
            <td class="no-padding">
                {{ __('site.devices_index.types.' . $model->type) }}
            </td>

            <td class="no-padding">
                <a href="">
                    <span class="badge text-primary bg-dark fs-15 fw-bold">
                        {{ $model->ip_address }}
                    </span>
                </a>
            </td>

            <td class="no-padding">
                @if ($model->parent_name)
                <span>
                    {{ $model->parent_name }}
                </span>
                @else
                <span>
                    ---
                </span>
                @endif
            </td>
            <td class="no-padding">
                {{ $model->nas_name }}
            </td>
        </tr>
        @endforeach
        @else
        <x-datatable.empty-records />
        @endif
    </x-slot>
</x-datatable>
