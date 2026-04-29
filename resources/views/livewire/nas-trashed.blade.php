<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-6">
            <h4>

                <span class="badge badge-info fw-bold">
                    {{ __('datatable.nas_trashed_title') }}
                </span>
            </h4>
        </div>

    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.admin_nas_trashed_index')" >
            <th>
                <span class="ps-5">#</span>
               <span>{{ __('datatable.admin_nas_trashed_index_key') }}</span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr>
                    <td class="">
                        @include('backend.admins.nas.includes.trashed.optional_box')
                    </td>
                    <td class="p-0">
                        <span class="badge badge-info badge-pill">
                            {{ $model->serial }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-primary badge-pill">
                            {{ $model->ip_address }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-secondary badge-pill">
                            {{ $model->users_count }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-pill @if ($model->is_connected == 1) badge-success @else badge-danger @endif">
                            {{ __('site.nas_is_connected_' . $model->is_connected) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif

    </x-slot>
</x-datatable>
