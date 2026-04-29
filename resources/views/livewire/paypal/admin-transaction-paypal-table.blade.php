    <div>
        <x-datatable :paginated-data="$paginatedData">

            <x-slot name="navBar">
                <div class="col-sm-12 col-md-6">
                    <x-datatable.table-search />
                </div>
            </x-slot>
            <x-slot name="thead">
                <x-table-thead :columns="__('datatable.admin_transactions_paypal')">
                </x-table-thead>
            </x-slot>

            <x-slot name="tbody">
                @if ($paginatedData && count($paginatedData) > 0)
                @foreach ($paginatedData as $index => $model)
                <tr>
                    @php
                        $statusBadge =  \App\ENUMS\AdminPaymentEnum::getStatusBadge($model->status);
                        $statusIcon = \App\ENUMS\AdminPaymentEnum::getStatusIcon($model->status);
                        $statusTrans = \App\ENUMS\AdminPaymentEnum::getStatusTrans($model->status);
                    @endphp
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
                                class=" badge {{ $statusBadge }} "
                                data-bs-toggle="dropdown">
                                    <span dir="auto">
                                        {{ $model->order_id }}
                                    </span>
                                </span>
                                {{-- @if($model->canDeleteTransaction())
                                <div class="dropdown-menu dropdown-menu-end fw-bold">
                                    <a class="dropdown-item py-2 fw-bold" href="#"
                                        wire:click="showDeletedBox('{{ $model->id }}')">
                                        <i class="fa fa-trash-o text-danger"></i>
                                        {{ __('site.user_index.option.delete') }}
                                    </a>
                                </div>
                                @endif --}}
                            </div>
                        </div>
                    </td>
                    <td class="no-padding">
                        <span class="badge  {{ $model->status == 'COMPLETED' ? 'badge-success' : 'badge-primary' }}">
                            {{ $model->amount . ' ' . __('new_trans.dollar_code') ?? '---' }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge {{ $statusBadge }} ">
                            {{ $statusTrans }}
                            <i class="{{  $statusIcon }} p-1"></i>
                        </span>
                    </td>

                    <td class="no-padding">
                        <span class="badge badge-dark">
                            {{ $model->created_at }}
                        </span>
                    </td>
                    {{-- <td class="no-padding">
                        <span class="text-{{__('site.admin_transactions.status_color.' . $model->status)}}">
                            {{__('site.admin_transactions.status_text.' . $model->status)}}
                            <i class="{{__('site.admin_transactions.status_icon.' . $model->status)}}"></i>
                        </span>
                    </td> --}}
                    {{-- <td class="no-padding">
                        <span class="">
                            @if(empty($model->reason))
                            ---
                            @else
                            {{__('site.admin_transactions.refuesd_reasons.' . $model->reason)}}
                            @endif
                        </span>
                    </td> --}}
                </tr>
                @endforeach
                @else
                <x-datatable.empty-records />
                @endif

            </x-slot>
        </x-datatable>
    </div>

