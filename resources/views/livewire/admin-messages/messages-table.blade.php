<div>
  <x-datatable :paginated-data=null>

      <x-slot name="navBar">
          <div class="box-header with-border py-3" style="width:100%;display:flex;justify-content:space-between;align-items:start;">
  			<div>
  				<h4 class="box-title">
              {{ __('new_trans.admin_messages.datatable.title') }}
  				</h4>
  			</div>
	        <div class="col-sm-12 col-md-8 d-flex justify-content-end px-3">

	           <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg-send-message">
					<i class="fa fa-pencil-square-o px-1" aria-hidden="true"></i>
		           	{{__('new_trans.admin_messages.create')}}
	           </button>
	       	</div>
  		</div>
		<div wire:ignore.self wire:key="modal-send-message"  class="modal fade" id="bs-example-modal-lg-send-message" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;padding-right:0px!important;">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title text-white">{{__('new_trans.admin_messages.send')}}</h4>
		        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger py-1 px-2" style="height:50%;">
		          <i class="fa fa-times fa-x"></i>
		        </button>
		      </div>
		      <div class="modal-body p-2">
		        <form wire:submit="sendMessage()" >
		        <div class="container">
		          <div class="row">
									<div class="col-12">
												<div class="form-group row">
													<label for="message" class="col-form-label">
													    {{ trans('new_trans.admin_messages.message') }}
													</label>
													<div>
												    <div class="input-group">
												        <div class="input-group-addon">
												            <i class="fa fa-bookmark text-primary"></i>
												        </div>
												        <textarea class="form-control" style="height:125px;" id='message' placeholder="{{trans('new_trans.admin_messages.message_placeholder')}}" type="text" wire:model="message" ></textarea>
												    </div>
																@error('message')
																	<span class="error text-danger">{{ $message }}</span>
																@enderror
													</div>
											</div>
								</div>
								<div class="col-sm-12 py-3 px-4 custom-margin-mobile">
										<label for="message" class="col-form-label">
													    {{ trans('new_trans.admin_messages.sendto') }}
										</label>
	                  <div class="d-flex justify-content-around">
	                      <input name="invoiceStatus" wire:model="channel"
	                          type="radio" id="radio_32"
	                          class="with-gap radio-col-success" value="{{App\ENUMS\AdminMessageEnum::CHANNEL_ALL}}">
	                      <label for="radio_32">
											    {{ trans('new_trans.admin_messages.channels.all') }}
	                      </label>
	                      <input name="invoiceStatus" wire:model="channel"
	                          type="radio" id="radio_36"
	                          class="with-gap radio-col-success" value="{{App\ENUMS\AdminMessageEnum::CHANNEL_APP}}">
	                      <label for="radio_36">
											    {{ trans('new_trans.admin_messages.channels.app') }}
	                      </label>
                        <input name="invoiceStatus" wire:model="channel"
	                          type="radio" id="radio_35"
	                          class="with-gap radio-col-success" value="{{App\ENUMS\AdminMessageEnum::CHANNEL_TELEGRAM}}">
	                      <label for="radio_35">
											    {{ trans('new_trans.admin_messages.channels.telegram') }}
	                      </label>
	                  </div>
	              </div>
		            <div class="col-12 pt-2">
										<div class="form-group row">
											<label for="message" class="col-form-label py-2">
											    {{ trans('new_trans.admin_messages.select_nas') }}
											</label>
		                <div class="d-flex align-items-center justify-content-center" style="min-width:175px" >
					             <select class="form-select" wire:model="selected_nas_id">
					                 <option selected value='all_nas' >{{ __('new_trans.admin_messages.all_nas') }}</option>
					                 @foreach ($nas as $nas_)
					                     <option value="{{ $nas_->id }}">{{ $nas_->name }}</option>
					                 @endforeach
					             </select>
				         		</div>
										@error('selected_nas_id')
											<span class="error text-danger">{{ $message }}</span>
										@enderror
									</div>
		            </div>
								<div class="col-12">
                  <div class="form-group row">
                      <label class="col-form-label py-2">
                          الفيلتر
                      </label>
                      <div>
                          <select class="form-select" wire:model.live="filterUsed"
                              x-on:change="closeModal">
                              @foreach ($filters as $key => $value)
                                  <option value="{{ $key }}">{{ $value }}
                                  </option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                </div>

		          </div>
		        </div>
		      </div>
		      <div class="modal-footer d-flex justify-content-end">
		        <button type="submit" wire:loading.attr="disabled" wire:key="btn-partial-payment" class="btn btn-success text-start" >{{__('new_trans.send')}}</button>
		        <button type="button" data-action="closePaymentModal" class="btn btn-danger text-start" data-bs-dismiss="modal">{{__('new_trans.close')}}</button>
		      </div>
		    </form>
		    </div>
		  </div>
		</div>





      </x-slot>

      <x-slot name="thead">
          <x-table-thead :columns="__('new_trans.admin_messages.datatable.head')">

          </x-table-thead>
      </x-slot>

      <x-slot name="tbody">
              @forelse ($paginatedMessages as $index => $model)
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
			                         <div class="custom-popover-container">
				                          <div class="custom-popover-content">
				                                  {{ Str::limit($model->message,80, '...') }}
				                          </div>

				                          <span class="dropdown-toggle badge badge-success badge-pill " data-bs-toggle="dropdown">
				                              <span dir="auto" >
				                                  {{ Str::limit($model->message, 30, '...') }}
				                              </span>
				                          </span>
				                          <div class="dropdown-menu dropdown-menu-end fw-bold "  aria-labelledby="dropdown" >
				                              <a class="dropdown-item py-4 fw-bold" href="#" data-bs-toggle="modal"
				                               data-bs-target="#bs-info-modal-lg_{{$model->id}}">
				                                  <i class="fa fa-eye text-info"></i>
				                                {{__('new_trans.admin_messages.info_modal.info')}}
				                              </a>
				{{--                               <a class="dropdown-item py-4 fw-bold" href="{{ route('managers.tickets.update',$model->id) }}" >
				                                  <i class="fa fa-pencil text-primary"></i>
				                                  {{ __('new_trans.ticket.dropdown.ticket_update')}}
				                              </a> --}}
				                              <a wire:click="showDeletedBox({{ $model->id }})" wire:loading.attr="disabled"  class="dropdown-item text-center py-4 fw-bold">
				                                <i class="fa fa-trash text-danger"></i>
				                                {{__('new_trans.admin_messages.delete_modal.delete')}}
				                              </a>
				                          </div>

			                        </div>
                              </div>
                          </div>
                      </td>
                      <td>
                         <span class="badge badge-info mx-1">
                         	 	{{ $model->nas->name ?? __('new_trans.admin_messages.all_nas') }}
                          </span>
                      </td>
                      <td>
				                  @if($model->channel == App\ENUMS\AdminMessageEnum::CHANNEL_APP)
				                    <span class="badge badge-light mx-1" style="color:#1f1f1f!important;">
				                      {{ __('new_trans.admin_messages.channels.app') }}
				                    </span>
				                  @elseif($model->channel == App\ENUMS\AdminMessageEnum::CHANNEL_TELEGRAM)
				                    <span class="badge badge-light  mx-1" style="color:#1f1f1f!important;">
				                      {{ __('new_trans.admin_messages.channels.telegram') }}
				                    </span>
				                    @else
				                    <span class="badge badge-light mx-1" style="color:#1f1f1f!important;">
				                      {{ __('new_trans.admin_messages.channels.all') }}
				                    </span>
				                  @endif
                      </td>
					  					<td>
					  						{{ App\ENUMS\AdminMessageEnum::filterMessages($model->filter)}}
					  					</td>
					  					<td>
					  						{{ $model->created_at->diffForHumans() }}
					  					</td>

										<div>
											<!--/ message Info Modal -->
											  @include('backend.admins.admin_messages.includes.info_modal')
										</div>
                  </tr>
          @empty
              <x-datatable.empty-records />
          @endforelse




      </x-slot>
  </x-datatable>


  @if($perPage < $messages_count)

  <div class="box pt-4">
      {{ $paginatedMessages->links('vendor.pagination.livewire.crypto_paginate')  }}
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
.custom-margin-mobile
{
	margin-bottom:20px;
}
}
</style>
@endpush





</div>

