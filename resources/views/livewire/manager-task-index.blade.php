<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">

        <div class="col-sm-12 col-md-6">
            <button class="btn btn-success btn-md ml-5 fw-bold" wire:click="$dispatch('addTask')">
                <i class="fa spi fa-plus px-2"></i>
                {{trans('new_trans.add_task.title')}}
            </button>
        </div>


        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>

    <x-slot name="thead">
        <th>
            <span class="badge" wire:click="orderBy('fullname')">
                <span class="ps-5">#</span>
                <span style="padding-right: 20px">
                    {{ trans('new_trans.add_task.note') }}
                </span>
            </span>
            @if ($orderByColumn == 'fullname')
                <span>
                    <i class="fa {{ $sortIcon }} text-primary"></i>
                </span>
            @endif
        </th>
        @foreach (trans('datatable.manager_tasks_index') as $column => $value)
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
                                        {{ $model->subject }}
                                    </span>
                                </span>
                                <div class="dropdown-menu dropdown-menu-end fw-bold">
                                    <a class="dropdown-item py-2 fw-bold" href="#"
                                        wire:click="showDeletedBox('{{ $model->id }}')">
                                        <i class="fa fa-trash-o text-danger"></i>
                                        {{ __('site.user_index.option.delete') }}
                                    </a>

                                    <a class="dropdown-item py-2 fw-bold" href="#"
                                        wire:click="$dispatch('editTask','{{ $model->id }}')">
                                        <i class="fa fa-pencil"></i>
                                        تعديل
                                    </a>
                                </div>
                            </div>
                        </div>

                    </td>

                    <td class="p-1">
                        <div class="text-wrap text-center" style="min-width: 250px;padding: 10px; white-space: pre-wrap;">
                            {{ $model->content }}
                        </div>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-success">
                            {{ __('site.tasks.admins.' . $model->admin) }}
                        </span>
                    </td>

                    <td class="no-padding">
                        <span
                            class="badge {{ __('site.tasks.priority_color.' . $model->priority) }}">
                            {{ __('site.tasks.priority.' . $model->priority) }}
                        </span>
                    </td>
                    <td>
                        {{ $model->created_at }}
                    </td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif

    </x-slot>
</x-datatable>
