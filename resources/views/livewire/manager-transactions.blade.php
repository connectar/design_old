<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('managers.transactions.create')" :title="__('datatable.add_new_transaction')" />

        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
        <div class="row">
            <div class="py-2">
                <div class="dropdown" style="white-space: nowrap;">
                    <div class="clearfix pull-left">
                        <span class="dropdown-toggle px-2 badge badge-info py-2" data-bs-toggle="dropdown">
                            {{ __('site.user_index.option.menu_all') }}
                        </span>
                        <div class="dropdown-menu dropdown-menu-end fw-bold">
                            <a class="deleteAll dropdown-item py-2 fw-bold" href="#">
                                <i class="fa fa-trash-o text-danger"></i>
                                {{ __('site.user_index.option.delete') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="toggleStatusForTransactions dropdown-item py-2 fw-bold text-success"
                                href="#" data-status="1">
                                <i class="fa fa-check"></i>
                                {{ __('site.manager_transactions.options_selected.1') }}
                            </a>
                            <a class="toggleStatusForTransactions dropdown-item py-2 fw-bold text-danger" href="#"
                                data-status="0">
                                <i class="fa fa-lock"></i>
                                {{ __('site.manager_transactions.options_selected.0') }}
                            </a>
                        </div>
                    </div>
                </div>
                <span class="text-primary px-2">
                    الحالة
                </span>
                <select class="form-select d-inline bg-lightest text-white" style="max-width: 250px"
                    wire:model="filterByChecked">
                    @foreach (__('site.manager_transactions.checked_select') as $index => $value)
                        <option value="{{ $index }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-right: 23px;">
                <span class="text-primary px-2">
                    نوع التحويل
                </span>
                <select class="form-select d-inline bg-lightest text-white" style="max-width: 250px" wire:model="type">
                    @foreach (__('site.manager_transactions.types') as $index => $value)
                        <option value="{{ $index }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-right: 23px;" class="pt-2">
                <span class="text-primary px-2">
                    تم التحقق؟
                </span>
                <select class="form-select d-inline bg-lightest text-white" style="max-width: 250px"
                    wire:model="isVerfied">
                    @foreach (__('site.manager_transactions.is_verfied') as $index => $value)
                        <option value="{{ $index }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.manager_transactions')">
            <th>
                <div class="btn-group" role="group">
                    <span class="h-20 flex-shrink-0">
                        <input type="checkbox" id="checkAllItems" class="filled-in chk-col-success">
                        <label for="checkAllItems"></label>
                    </span>
                </div>
                <span class="badge">
                    <span class="ps-5">#</span>
                    <span style="">
                        {{ __('datatable.man_transaction_id') }}
                    </span>
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr>
                    <td class="py-2">
                        <div class="dropdown">
                            <div class="clearfix pull-left">
                                <span class="h-20 flex-shrink-0 pull-left">
                                    <input value="{{ $model->id }}" type="checkbox"
                                        id="md_checkbox_{{ $model->id }}"
                                        class="usersIds filled-in chk-col-success checkedId">
                                    <label for="md_checkbox_{{ $model->id }}"></label>
                                </span>
                                <span class="badge b-1 border-warning">
                                    @if (($page ?? 1) != 1)
                                        {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                    @else
                                        {{ $loop->index + 1 }}
                                    @endif
                                </span>

                                <span class="dropdown-toggle badge badge-warning" data-bs-toggle="dropdown">
                                    <span dir="auto">
                                        {{ $model->transaction_id }}
                                    </span>
                                </span>

                                <div class="dropdown-menu dropdown-menu-end fw-bold">
                                    <a class="dropdown-item py-2 fw-bold" href="#"
                                        wire:click="showDeletedBox('{{ $model->id }}')">
                                        <i class="fa fa-trash-o text-danger"></i>
                                        {{ __('site.user_index.option.delete') }}
                                    </a>
                                    <a class="dropdown-item py-2 fw-bold" href="#"
                                        wire:click="toggleChecked('{{ $model->id }}','{{ $model->is_checked }}')">
                                        <i class="fa fa-check text-primary"></i>
                                        استعلام
                                    </a>
                                </div>


                            </div>
                        </div>
                    </td>
                    <td class="p-2">
                        <span class="badge text-white">
                            {{ $model->admin_fullname }}
                        </span>
                    </td>
                    <td class="p-2">
                        @if ($model->is_checked == 1)
                            <span class="badge text-white badge-success">
                                تم القبول
                            </span>
                        @elseif($model->is_checked == 2)
                            <span class="badge text-primary">
                                بانتظار الاستعلام
                            </span>
                        @else
                            <span class="badge text-danger">
                                تم الرفض
                            </span>
                        @endif
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-danger">
                            {{ $model->price }}
                        </span>
                    </td>
                    <td class="no-padding">
                        @if ($model->network_id)
                            <span class="badge badge-primary">
                                {{ $model->type == 1 ? $model->billing_code : $model->network_id }}
                            </span>
                        @else
                            ---
                        @endif
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-warning">
                            <span dir="ltr">{{ $model->phone }}</span>
                            @if ((int) ($model->phone_accepted_distinct_billing_total ?? 0) > 1)
                                <span class="badge badge-info ms-1"
                                    title="{{ __('site.manager_transactions.phone_multi_billing_title', ['total' => (int) $model->phone_accepted_distinct_billing_total]) }}">
                                    {{ (int) $model->phone_accepted_distinct_billing_total }}
                                </span>
                            @endif
                        </span>
                    </td>

                    <td class="no-padding">
                        <span class="badge badge-dark">
                            {{ $model->created_at }}
                        </span>
                    </td>
                    <td class="no-padding">
                        @if ($model->network_id)
                            <i class="fa fa-check text-success"></i>
                        @else
                            <i class="fa fa-clock-o"></i>
                        @endif
                    </td>
                    <td class="p-2">
                        @if ($model->type == 1)
                            <span class="badge text-white badge-success">
                                شبكات
                            </span>
                        @else
                            <span class="badge text-white badge-danger">
                                كافيهات
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif

    </x-slot>
</x-datatable>
