<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('admins.create')"
            :title="__('datatable.add_new_admin')" />
        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.admins_index')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 30px;">
                    {{ __('datatable.admins_fullname') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)

                <tr class="fw-bold bs-3">
                    <td class="py-2">
                        @include('backend.includes.admins_index_menu')
                    </td>

                    <td class="no-padding">
                        <span class="badge b-2  badge-dark badge-pill">
                            {{ $model->name }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge b-2 badge-dark badge-pill">
                            {{ $model->phone }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge b-2 badge-dark badge-pill">
                            {{ $model->email }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <label class="switch switch-success">
                            <input type="checkbox" @if ($model->active == 1) checked @endif
                                wire:click="changeStatus('{{ $model->id }}')">
                            <span class="switch-indicator"></span>
                        </label>
                    </td>
                    <td class="no-padding">
                        {{ $model->created_at }}
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records colspan="7" />
        @endif
    </x-slot>
</x-datatable>
