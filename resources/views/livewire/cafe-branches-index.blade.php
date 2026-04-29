<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('cafe.branches.create')" :title="__('datatable.add_new_cafe')" />
        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>

    <x-slot name="thead">
        <th>
            <span class="badge" wire:click="orderBy('fullname')">
                <span class="ps-5">#</span>
                <span style="padding-right: 20px">
                    {{ __('datatable.manager_network_key') }}
                </span>
            </span>
            @if ($orderByColumn == 'fullname')
                <span>
                    <i class="fa {{ $sortIcon }} text-primary"></i>
                </span>
            @endif
        </th>
        @foreach (trans('datatable.cafe_branches_index') as $column => $value)
            <th class="text-center">
                <span class="badge" wire:click="orderBy('{{ $column }}')">
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
                <tr>
                    <td class="py-2">
                        <div class="dropdown">
                            <div class="clearfix pull-left">
                                <span class="badge badge-dark b-1 border-warning">
                                    @if (($page ?? 1) != 1)
                                        {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                    @else
                                        {{ $loop->index + 1 }}
                                    @endif
                                </span>
                                <span class="dropdown-toggle badge badge-warning"
                                    data-bs-toggle="dropdown">
                                    <span dir="auto">
                                        {{ $model->fullname }}
                                    </span>
                                </span>
                                <div class="dropdown-menu dropdown-menu-end fw-bold">
                                    <a class="dropdown-item py-2 fw-bold fw-bold text-primary"
                                        wire:click="loginAsAdmin('{{ $model->admin_id }}')">
                                        <i class="fa fa-hand-lizard-o"></i>
                                        {{ __('site.manager_nas.login') }}
                                    </a>
                                    <a class="dropdown-item py-2 fw-bold fw-bold"
                                        href="{{ route('cafe.branches.edit', ['branch' => $model->id]) }}">
                                        <i class="fa fa-pencil"></i>
                                        {{ __('site.user_index.option.edit') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                    </td>
                    {{-- <td class="p-0" width="25px">
                        <span class="badge">
                            {{ $model->phone }}
                        </span>
                    </td> --}}
                    <td class="p-0" width="25px">
                        <span class="badge badge-info">
                            {{ $model->plan_name }}
                        </span>
                    </td>
                    <td class="p-0" width="25px">
                        <span class="badge text-primary">
                            {{ $model->name }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-success">
                            {{ $model->plan_cards }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-success">
                            {{ $model->network_cards ?? 'لا يوجد' }}
                        </span>
                    </td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif

    </x-slot>
</x-datatable>
