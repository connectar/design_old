<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-md-6">
            <span class="btn btn-sm btn-warning">
                {{ __('datatable.distributor_logs_title') }}
            </span>
        </div>
        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>
    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.distributors_logs')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 2px;">
                    {{ __('datatable.distributors_logs_key') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr class="fw-bold">
                    <td class="
                         py-0">
                        <div class="pull-left">
                            <span class="badge badge-dark">
                                @if (($page ?? 1) != 1)
                                    {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                @else
                                    {{ $loop->index + 1 }}
                                @endif
                            </span>
                            <span class="badge badge-dark">
                                {{ $model->admin_name }}
                            </span>
                        </div>
                    </td>
                    <td class="px-0 py-0">
                        <span
                            class="badge badge-{{ __("logs.distributor_logs_event_color.{$model->event_name}") }}">
                            {{ __("logs.distributor_logs_event.{$model->event_name}") }}
                        </span>
                    </td>
                    <td class="px-0">
                        <span class="badge badge-info">
                            {{ $model->invoice_id ?? '...' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-warning">
                            {{ $model->account_before }}
                        </span>
                    </td>
                    <td>
                        <span class="badge badge-green">
                            {{ $model->account_after }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if ($model->isEventDiscount())
                            <span class="badge badge-danger">
                                {{ $model->account_before - $model->account_after }}
                            </span>
                        @else
                            ---
                        @endif
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
