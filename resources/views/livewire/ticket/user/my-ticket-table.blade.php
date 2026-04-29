<div>



<div>

<x-datatable :paginated-data=null>

    <x-slot name="navBar">
        <div class="box-header with-border py-3" style="width:100%;display:flex;justify-content:space-between;align-items:start;">
			<div>
				<h4 class="box-title">
					{{ trans('menu.tickets.mytickets') }}
				</h4>
			</div>
			<div >
				<a href="{{route($this->redirectToCreateTicketRoute())}}" class="btn btn-danger btn-sm " >
					<i class="fa fa-arrow-left"></i>
					{{__('menu.tickets.create')}}
				</a>
			</div>
		</div>
        <div class="col-6">
		<!--
		<div>
			<x-datatable.add-new :route="route('admins.tickets.create')" :title="__('new_trans.ticket.send_ticket')" />
			<x-datatable.add-new :route="route('admins.tickets.create')" :title="__('new_trans.ticket.send_ticket')" />
		</div> -->
        {{-- <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div> --}}
            {{-- <h4>

                <span class="badge badge-info fw-bold">
                    {{-- {{ __('new_trans.ticket.datatable.admin_ticket_table_title') }}
                </span>
            </h4> --}}
        </div>

    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('new_trans.ticket.datatable.admin_ticket_table_head')">

        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedTickets && count($paginatedTickets) > 0)
            @foreach ($paginatedTickets as $index => $model)
                <tr>
                    <td class="">
                        <div class="dropdown ">
                            <div class="clearfix pull-left">
                                <span class="badge badge-dark b-1 border-warning">
                                    @if (($page ?? 1) != 1)
                                        {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                    @else
                                        {{ $loop->index + 1 }}
                                    @endif
                                </span>
                                <span class="dropdown-toggle badge badge-success badge-pill " data-bs-toggle="dropdown">
                                    <span dir="auto" >
                                        {{ Str::limit($model->title, 20, '...') }}
                                    </span>
                                </span>

                                <div class="dropdown-menu dropdown-menu-end fw-bold "  aria-labelledby="dropdown" >
                                    <a class="dropdown-item py-4 fw-bold" href="{{route($this->redirectToShowTicketRoute(),$model->id)}}" >
                                        <i class="fa fa-eye text-secondary"></i>
                                        {{ __('new_trans.ticket.dropdown.ticket_show')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="">
                            {{ $model->ticket_number ?? "not found" }}
                        </span>
                    </td>
                    <td>
                        <span class="">
                            {{ Str::limit($model->description, 28, '...') }}
                        </span>
                    </td>
                    <td>
                      @if($model->type == App\ENUMS\TicketEnum::TYPE_TECH_SUPPORT)
                          <span class="badge badge-warning badge-pill ">
                              {{ __('new_trans.ticket.type.'. $model->type) }}
                          </span>
                      @elseif($model->type == App\ENUMS\TicketEnum::TYPE_INQUIRY)
                          <span class="badge badge-dark badge-pill">
                              {{ __('new_trans.ticket.type.'. $model->type) }}
                          </span>
                      @elseif($model->type == App\ENUMS\TicketEnum::TYPE_FEEDBACK)
                          <span class="badge badge-info badge-pill">
                              {{ __('new_trans.ticket.type.'. $model->type) }}
                          </span>
                      @elseif($model->type == App\ENUMS\TicketEnum::TYPE_SUGGESTION)
                          <span class="badge badge-primary badge-pill">
                              {{ __('new_trans.ticket.type.'. $model->type) }}
                          </span>
                      @else
                          <span class="badge badge-danger badge-pill">
                              {{ __('new_trans.ticket.type.'. $model->type) }}
                          </span>
                      @endif
                    </td>
                    <td>
                      @if($model->status == App\ENUMS\TicketEnum::STATUS_OPEN)
                          <span class="badge badge-warning  ">
                              {{ __('new_trans.ticket.status.'. $model->status) }}
                          </span>
                      @elseif($model->status == App\ENUMS\TicketEnum::STATUS_ARCHIVED)
                          <span class="badge badge-dark">
                              {{ __('new_trans.ticket.status.'. $model->status) }}
                          </span>
                      @elseif($model->status == App\ENUMS\TicketEnum::STATUS_IN_PROGRESS)
                          <span class="badge badge-info">
                              {{ __('new_trans.ticket.status.'. $model->status) }}
                          </span>
                      @elseif($model->status == App\ENUMS\TicketEnum::STATUS_PENDING)
                          <span class="badge badge-primary">
                              {{ __('new_trans.ticket.status.'. $model->status) }}
                          </span>
                      @else
                          <span class="badge badge-danger">
                              {{ __('new_trans.ticket.status.'. $model->status) }}
                          </span>
                      @endif
                    </td>
                    <td>
                        @if($model->is_resolved)
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
					<td>
						{{ $model->created_at->diffForHumans() }}
					</td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif




    </x-slot>
</x-datatable>


@if($perPage < $mytickets_count)

<div class="box pt-4">
    {{ $paginatedTickets->links('vendor.pagination.crypto_paginate')  }}
</div>
@endif




</div>

</div>
