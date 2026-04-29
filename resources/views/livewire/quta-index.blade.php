<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('admins.quta.create')"
            :title="__('datatable.add_new_quta')" />
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.admin_quta')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 5px;">
                    {{ __('datatable.quta_name') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
    @if($paginatedData && count($paginatedData) > 0)
        @foreach ($paginatedData as $index => $model)
            <tr class="fw-bold bs-3">
                <td class="py-2">
                    @include('backend.admins.quta.includes.optional_box')
                </td>
                <td class="no-padding">
                    <span class="badge badge-primary badge-pill">
                        {{ $model->price }}
                    </span>
                </td>
                <td class="no-padding">
                    <span class="badge badge-warning badge-pill">
                        {{ $model->users_count }}
                    </span>
                </td>
                <td class="no-padding">
                    <span class="text-lighter">
                        {{ __('networks.quta.statuses.' . $model->status )}}
                    </span>
                </td>

            </tr>
        @endforeach
    @else
        <x-datatable.empty-records />
    @endif
    </x-slot>
</x-datatable>

