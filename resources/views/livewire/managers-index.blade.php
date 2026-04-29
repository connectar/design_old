<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('managers.create')" :title="__('datatable.add_new_manager')" />
        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.managers_index')" :title="__('datatable.manager_key')" />
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr class="fw-bold bs-3 @if ($model->cards_count > 0) border-success @endif">
                    <td class="py-2">
                        @include('backend.managers.includes.optional_box')
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-pill">
                            {{ $model->name }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <label class="switch switch-success">
                            <input type="checkbox" wire:click="toggleActive('{{ $model->id }}')" @if ($model->active == 1) checked @endif>
                            <span class="switch-indicator"></span>
                        </label>
                    </td>

                    <td class="no-padding">
                        <span class="badge badge-dark badge-pill">
                            {{ $model->created_at }}
                        </span>
                    </td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif
    </x-slot>
</x-datatable>
