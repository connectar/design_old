<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('cafe_home.nas.create')" :title="__('datatable.add_new_nas')" />
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.cafe_nas_index')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 20px">
                    {{ __('datatable.nas_name') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr>
                    <td class="py-2">
                        @include('backend.cafe_home.nas.incl00udes.optional_box')
                    </td>
                    <td class="p-0" width="25px">
                        <span class="badge badge-info badge-pill">
                            {{ $model->serial }}
                        </span>
                    </td>
                    <td class="p-0">
                        <span class="badge badge-warning badge-pill">
                            {{ __('adding.nas.types.' . $model->type) }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <a class="badge badge-primary badge-pill" target="_blank"
                            href="http://{{ $model->ip_address }}">
                            {{ $model->ip_address }}
                        </a>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-secondary badge-pill">
                            {{ $model->users_count }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge bg-dark text-primary" dir="auto">
                            {{ $model->mikro_version ?? '---' }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span
                            class="badge badge-pill @if ($model->is_connected == 1) badge-success @else badge-danger @endif">
                            {{ __('site.nas_is_connected_' . $model->is_connected) }}
                        </span>
                    </td>

                    <td class="no-padding">
                        <span
                            class="@if ($model->is_installed == 1) text-success
                        @else text-danger @endif">
                            {{ __('site.nas_is_installed_' . $model->is_installed) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif

    </x-slot>
</x-datatable>
