<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-md-6">
            <span class="btn btn-sm btn-warning">
                {{ __('datatable.users_logs_title') }}
            </span>
        </div>
        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>
    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.user_logs')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 2px;">
                    {{ __('datatable.user_logs_serial') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr class="fw-bold">
                    <td>
                        <div class="clearfix pull-left">
                            <span class="badge badge-dark">
                                @if (($page ?? 1) != 1)
                                    {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                @else
                                    {{ $loop->index + 1 }}
                                @endif
                            </span>
                            <span class="px-2 badge badge-success"
                                data-bs-toggle="dropdown">
                                {{ $model->id }}
                            </span>

                        </div>
                    </td>
                    <td class="
                        px-0 py-0">
                        @isset($model->admin_name)
                            <span class="badge badge-dark">
                                {{ $model->admin_name }}
                            </span>
                        @else
                            <span class="badge badge-danger">
                                {{ 'العميل' }}
                            </span>
                        @endisset

                    </td>
                    <td class="px-0 py-0">
                        <span
                            class="badge badge-{{ __("logs.user_logs_events_color.{$model->event_name}") }}">
                            {{ __("logs.user_logs_events.{$model->event_name}") }}
                        </span>
                    </td>
                    <td class="text-left">
                        {!! $model->render() !!}
                    </td>
                    <td class="px-0 py-0">
                        <span class="badge badge-warning">
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
