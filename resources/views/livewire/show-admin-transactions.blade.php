<div>
    @if ($viewName == 'get_all')
        <x-datatable :paginated-data="$paginatedData">

            <x-slot name="navBar">
                <div class="col-md-6">
                    <span class="btn btn-sm btn-success">
                        <i class="fa fa-money"></i>
                        {{ __('datatable.show_admin_transactions_title') }}
                    </span>
                </div>
                <div class="col-sm-12 col-md-6">
                    <x-datatable.table-search />
                </div>
                <div class="box-header py-2">
                    <span class="text-primary px-1">
                        <i class="fa fa-money text-primary px-1"></i>
                        {{ __('site.manager_transactions.status_title') }}
                    </span>
                    <select class="form-select d-inline bg-lightest text-white"
                        style="max-width: 250px" wire:model="status">
                        @foreach (__('site.admin_transactions.status_text') as $index => $value)
                            <option value="{{ $index }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </x-slot>
            <x-slot name="thead">
                <x-table-thead :columns="__('datatable.show_admin_transactions')">
                </x-table-thead>
            </x-slot>

            <x-slot name="tbody">
                @if ($paginatedData && count($paginatedData) > 0)
                    @foreach ($paginatedData as $index => $model)
                        <tr>
                            <td class="p-2">
                                <div class="dropdown">
                                    <div class="clearfix pull-left">
                                        <span class="badge badge-dark b-1 border-warning">
                                            @if (($page ?? 1) != 1)
                                                {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                            @else
                                                {{ $loop->index + 1 }}
                                            @endif
                                        </span>
                                        <span
                                            class="@if ($model->canDeleteTransaction()) dropdown-toggle @endif badge {{ __('site.manager_transactions.transaction_status_color.' . $model->status) }}"
                                            data-bs-toggle="dropdown">
                                            <span dir="auto">
                                                {{ $model->transaction_id }}
                                            </span>
                                        </span>
                                        @if ($model->canDeleteTransaction())
                                            <div class="dropdown-menu dropdown-menu-end fw-bold">
                                                <a class="dropdown-item py-2 fw-bold" href="#"
                                                    wire:click="showDeletedBox('{{ $model->id }}')">
                                                    <i class="fa fa-trash-o text-danger"></i>
                                                    {{ __('site.user_index.option.delete') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="p-2">
                                <span class="text-primary fw-bold">
                                    {{ $model->admin->manager_transaction_id ?? 'not_found' }}
                                </span>
                            </td>
                            <td class="p-2">
                                <span class="text-primary fw-bold">
                                    {{ $model->id ?? '' }}
                                </span>
                            </td>
                            <td class="p-2">
                                <span class="text-primary fw-bold">
                                    {{ optional($model->admin)->fullname }}
                                </span>
                            </td>
                            <td class="no-padding">
                                <span class="badge badge-success">
                                    {{ $model->phone ?? '--' }}
                                </span>
                            </td>
                            <td class="no-padding">
                                <span class="badge badge-success">
                                    {{ $model->price }}
                                </span>
                            </td>

                            <td class="no-padding">
                                <span class="badge badge-dark">
                                    {{ $model->created_at }}
                                </span>
                            </td>
                            <td class="no-padding">
                                <span
                                    class="text-{{ __('site.admin_transactions.status_color.' . $model->status) }}">
                                    {{ __('site.admin_transactions.status_text.' . $model->status) }}
                                    <i
                                        class="{{ __('site.admin_transactions.status_icon.' . $model->status) }}"></i>
                                </span>
                            </td>
                            <td class="no-padding">
                                <span class="">
                                    @if (empty($model->reason))
                                        ---
                                    @else
                                        {{ __('site.admin_transactions.refuesd_reasons.' . $model->reason) }}
                                    @endif
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <x-datatable.empty-records />
                @endif

            </x-slot>
        </x-datatable>
    @else
        @livewire('add-new-transaction')
    @endif
</div>
