<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-6">
            <h4>

                <span class="badge badge-info fw-bold">
                    {{ __('datatable.admin_trashed_title') }}
                </span>
            </h4>
        </div>

    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.admins_trashed_index')">
            <th>
                <span class="ps-5">#</span>
                <span>{{ __('datatable.admins_fullname') }}</span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr>
                    <td class="">
                        @include('backend.admins.includes.trashed.optional_box')
                    </td>
                    <td>
                        <span class="badge  badge-danger badge-pill">
                            {{ $model->name }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-primary badge-pill">
                            {{ $model->phone }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-info badge-pill">
                            {{ $model->email }}
                        </span>
                    </td>
                    <td>
                        <span class="badge text-warning">
                            {{ $model->deleted_at }}
                        </span>
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif

    </x-slot>
</x-datatable>
