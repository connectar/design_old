<div>


  <x-datatable :paginated-data=null>

      <x-slot name="navBar">
          <div class="box-header with-border py-3" style="width:100%;display:flex;justify-content:space-between;align-items:start;">
  			<div>
  				<h4 class="box-title">
              {{ __('new_trans.ticket.datatable.support_ticket_table_title') }}
  				</h4>
  			</div>
        <div class="col-sm-12 col-md-8">
           <x-datatable.table-search />
       </div>
       <div style="position:fixed;z-index:999;">
     </div>

      <!--
  			<div >
  				<a href="{{-- route($this->redirectToCreateTicketRoute()) --}}" class="btn btn-danger btn-sm " >
  					<i class="fa fa-arrow-left"></i>
  					{{__('menu.tickets.create')}}
  				</a>
  			</div> -->
  		</div>
          <div class=" d-grid custom-grid-tickets-table" style="grid-template-columns:16fr 15fr 16fr 15fr;">
            <div class=" box-header py-2 d-flex" style="align-items:center;">
                <span class="text-primary px-1">
                    <!-- <i class="fa fa-ticket text-white px-1"></i> -->
                    {{ __('new_trans.ticket.ticket_status') }}
                </span>
                <select class="form-select d-inline bg-lightest text-white" style="max-width: 150px"
                    wire:model="ticket_status">
                    <option selected value='99' >{{ __('new_trans.ticket.select_ticket_status') }}</option>
                    @foreach (App\ENUMS\TicketEnum::getLabelTicketStatus() as $index => $value)
                        <option value="{{ $index }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class=" box-header py-2 d-flex" style="align-items:center;">
                <span class="text-primary px-2">
                    <!-- <i class="fa fa-ticket text-white px-1"></i> -->
                    {{ __('new_trans.ticket.ticket_priority') }}
                </span>
                <select class="form-select d-inline bg-lightest text-white" style="max-width: 150px"
                    wire:model="ticket_priority">
                    <option selected value='99' >{{ __('new_trans.ticket.select_ticket_priority') }}</option>

                    @foreach (App\ENUMS\TicketEnum::getLabelTicketPriorities() as $index => $value)
                        <option value="{{ $index }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class=" box-header py-2 d-flex" style="align-items:center;">
                <span class="text-primary px-2">
                    <!-- <i class="fa fa-ticket text-white px-1"></i> -->
                    {{ __('new_trans.ticket.ticket_type') }}
                </span>
                <select class="form-select d-inline  bg-lightest text-white" style="max-width: 150px"
                    wire:model="ticket_type">
                    <option selected value='99' >{{ __('new_trans.ticket.select_ticket_type') }}</option>

                    @foreach (App\ENUMS\TicketEnum::getLabelTicketTypes() as $index => $value)
                        <option value="{{ $index }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class=" box-header py-2 d-flex" style="align-items:center;">
                <span class="text-primary px-2">
                    <!-- <i class="fa fa-ticket text-white px-1"></i> -->
                    {{ __('new_trans.ticket.is_resolved.what') }}
                </span>
                <select class="form-select d-inline bg-lightest text-white" style="max-width: 150px"
                    wire:model="ticket_is_resolved">
                    <option selected value='99' >{{ __('new_trans.ticket.select_ticket_is_resolved') }}</option>

                    @foreach (App\ENUMS\TicketEnum::getLabelTicketIsResolved() as $index => $value)
                        <option value="{{ $index }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

          </div>

      </x-slot>

      <x-slot name="thead">
          <x-table-thead :columns="__('new_trans.ticket.datatable.support_ticket_table_head')">

          </x-table-thead>
      </x-slot>

      <x-slot name="tbody">
              @forelse ($paginatedTickets as $index => $model)
                @php
                  $billing_code = $model->owner->getBillingcodeAttribute() ?? "not found";
                @endphp
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
                                      {{ $model->owner->fullname  ?? "not found" }}
                                      </span>
                                      <!-- CommentedOut  -->
                              {{-- <div class="my-2">
                                      <livewire:ticket.support.user-info-modal :billing_code="$billing_code" :ticket="$model" wire:key="unique-modal-key-{{ $model->id }}" />
                                    </div> --}}
                                    <!-- CommentedOut  -->
                                  </span>
                              </div>
                          </div>
                      </td>
                      <td>
                        <div class="custom-popover-container">
                          <div class="custom-popover-content">
                            {{ $model->title }}
                          </div>
                          <span class="dropdown-toggle badge badge-success badge-pill " data-bs-toggle="dropdown">
                              <span dir="auto" >
                                  {{ Str::limit($model->title, 20, '...') }}
                              </span>
                          </span>
                          <div class="dropdown-menu dropdown-menu-end fw-bold "  aria-labelledby="dropdown" >
                              <a class="dropdown-item py-4 fw-bold" href="{{ route('managers.tickets.show',$model->id) }}" >
                                  <i class="fa fa-eye text-info"></i>
                                  {{ __('new_trans.ticket.dropdown.ticket_show')}}
                              </a>
                              <a class="dropdown-item py-4 fw-bold" href="{{ route('managers.tickets.update',$model->id) }}" >
                                  <i class="fa fa-pencil text-primary"></i>
                                  {{ __('new_trans.ticket.dropdown.ticket_update')}}
                              </a>
                              <!-- Users Info Modal -->
                              <a wire:click="openUserInfoModal({{ $model->id }})" wire:loading.attr="disabled"  class="dropdown-item text-center py-4 fw-bold">
                                <i class="fa fa-user text-success"></i>
                                {{__('new_trans.ticket.user_info_modal.index')}}
                              </a>
                              @if($model->is_resolved)
                              <a class="dropdown-item py-2 fw-bold" wire:click="confirmDelete({{ $model->id }})">
                                  <i class="fa fa-trash-o text-danger"></i>
                                  {{__('notification.message_type.delete')}}
                              </a>
                                  @endif
                          </div>
                          <div>
                          <!--/ Users Info Modal -->
                          @if($showModal && $modal_id == $model->id)
                              @include('backend.ticket.support.manager.includes.userinfomodal')
                          @endif
                        </div>

                        </div>
                      </td>
                      <td>
                          <span class="">
                              {{ $billing_code }}
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
                        @if($model->priority == App\ENUMS\TicketEnum::PRIORITY_LOW)
                            <span class="badge badge-warning  ">
                                {{ __('new_trans.ticket.priority.'. $model->priority) }}
                            </span>
                        @elseif($model->priority == App\ENUMS\TicketEnum::PRIORITY_MEDIUM)
                            <span class="badge badge-success">
                                {{ __('new_trans.ticket.priority.'. $model->priority) }}
                            </span>
                        @elseif($model->priority == App\ENUMS\TicketEnum::PRIORITY_HIGH)
                            <span class="badge badge-info">
                                {{ __('new_trans.ticket.priority.'. $model->priority) }}
                            </span>
                        @elseif($model->priority == App\ENUMS\TicketEnum::PRIORITY_URGENT)
                            <span class="badge badge-primary">
                                {{ __('new_trans.ticket.priority.'. $model->priority) }}
                            </span>
                        @else
                            <span class="badge badge-danger">
                                {{ __('new_trans.ticket.priority.'. $model->priority) }}
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
          @empty
              <x-datatable.empty-records />
          @endforelse




      </x-slot>
  </x-datatable>
    <div class="modal" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('notification.message_type.delete')}}</h4>
                </div>
                <div class="modal-body">
                    {{__('notification.message_type.are_you_sure_delete')}}
                </div>
                <div class="modal-footer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('notification.message_type.cancel')}}</button>
                        <button type="button" wire:click="delete" class="btn btn-danger">{{__('notification.message_type.delete')}}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

  @if($perPage < $tickets_count)

  <div class="box pt-4">
      {{ $paginatedTickets->links('vendor.pagination.livewire.crypto_paginate')  }}
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

@push('scripts')
    <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script>
        Livewire.on('openDeleteModal', () => {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        });
        Livewire.on('refreshTable', () => {
            location.reload(); // Reloads the entire page
        });
    </script>
@endpush
