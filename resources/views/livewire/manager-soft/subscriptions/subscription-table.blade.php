<div>
    <x-datatable :paginated-data=null>

        <x-slot name="navBar">
          <div class="box-header with-border py-3" style="width:100%;display:flex;justify-content:space-between;align-items:start;">
              <div>
                <h4 class="box-title">
                  {{ __('new_trans.subscription.datatable.subscription_title') }}
                </h4>
              </div>
              <div class="col-sm-12 col-md-8">
                <x-datatable.table-search />
              </div>

            <div style="position:fixed;z-index:999;"></div>
          </div>
        </x-slot>

        <x-slot name="thead">
            <x-table-thead :columns="__('new_trans.subscription.datatable.subscription_table_head')">

            </x-table-thead>
        </x-slot>

        <x-slot name="tbody">
                @forelse ($admins as $index => $model)
                    <tr>
                        <td class="">
                            <div class="dropdown ">
                                <div class="clearfix pull-left">
                                    <span class="badge badge-dark b-1 border-warning">
                                        @if (($pageNumber ?? 1) != 1)
                                            {{ $loop->index + 1 + $perPage * (($pageNumber ?? 1) - 1) }}
                                        @else
                                            {{ $loop->index + 1 }}
                                        @endif
                                    </span>
                                    <span class="">
                                      <span class="badge badge-info mx-1">
                                        {{ $model->fullname  ?? "not found" }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="badge {{$model->is_subscribed ? 'badge-success' : 'badge-danger'}}">
                                {{ $model->network->billing_code }}
                            </span>
                        </td>
                        <td>
                          <span class="badge {{$model->is_subscribed ? 'badge-success' : 'badge-danger'}}">
                            {{$model->phone}}
                          </span>
                        </td>
                        <td>
                          <span class="badge {{$model->is_subscribed ? 'badge-success' : 'badge-danger'}}">
                            {{ Carbon\Carbon::parse($model->network->lease_expired_at)->format('Y-m-d') ?? "s" }}
                          </span>
                        </td>


                        <td>
                            @if($model->is_subscribed ?? false)
                                <span class=" text-success ">
                                    <!-- {{ trans('new_trans.ticket.is_resolved.true') }} -->
                                    <i class="fa fa-2x fa-check"></i>
                                </span>
                                @else
                                <span class="text-danger ">
                                    <!-- {{ trans('new_trans.ticket.is_resolved.false') }} -->
                                    <i class="fa fa-2x fa-times"></i>
                                </span>
                            @endif
                        </td>
          </tr>
            @empty
                <x-datatable.empty-records />
            @endforelse




        </x-slot>
    </x-datatable>


@if($perPage < $admins_count)
  <div class="box pt-4">
      {{ $admins->links('vendor.pagination.livewire.crypto_paginate')  }}
  </div>
@endif

  @push('styles')
  <style>
  .custom-popover-container {
    position: relative;
    display: inline-block;
  }
  .custom-popover-content {
    display: none;
    position: absolute;
    top: -50px;
    left: -20;
    z-index: 1;
    color:#1f1f1f;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    width: auto;
  }

  .custom-popover-container:hover .custom-popover-content {
    display: block;
  }

  @media (max-width: 768px) {
  .custom-grid-tickets-table
  {
    grid-template-columns: 1fr !important ;
    grid-row-gap: 5px;
  }
  }
  </style>
  @endpush



  </div>
