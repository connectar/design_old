<div >
    <div class="d-flex mobile-display-block justify-content-around">
        <div class="col-xl-5 col-12 mobile-display-block">
            <div class="box box-body custom-card">
                <h6>
        <span class="text-uppercase">
          {{ __('new_trans.new_debts.total_debts') }}
            <span class="text-primary">
            @if($selected_admin_id)
                    [ {{$selected_admin_id->fullname}} ]
                @else
                    [ {{__('new_trans.new_debts.all_distributors')}} ]
                @endif
            </span>
        </span>
                </h6>
                <br>
                <p class="fs-26">
          <span class="text-danger">
            {{ $total_debts }}
          </span>
                    <span class="text-sm">{{getViewCurrency()}}</span>
                </p>

            </div>
        </div>

        <div class="col-xl-5 col-12 mx-4 mobile-display-block ">
            <div class="box box-body custom-card">
                <h6>
          <span class="text-uppercase">
            {{ __('new_trans.new_debts.total_debts_this_month') }}
            <span class="text-primary">
            @if($selected_admin_id)
                    [ {{$selected_admin_id->fullname}} ]
                @else
                    [ {{__('new_trans.new_debts.all_distributors')}} ]
                @endif
            </span>
          </span>
                </h6>
                <br>
                <p class="fs-26">
            <span class="text-danger">
              {{ $current_debt }}
            </span>
                    <span class="text-sm">{{getViewCurrency()}}</span>
                </p>
            </div>
        </div>
    </div>
    <div class="box ribbon-box">
        <div class="ribbon-two ribbon-two-primary ">
    <span>
      {{__('new_trans.ontest')}}
    </span>
        </div>
        <x-datatable :paginated-data=null>

            <x-slot name="navBar">

                <div class="box-header with-border py-3" style="width:100%;display:flex;justify-content:space-between;align-items:start;">
                    <div>
                        <h4 class="box-title d-flex">
                            <div class="box-controls ">
                                <div class="d-flex justify-content-end px-2 pb-0 fa-xl">
                                    <li>
                                        <a class="box-btn-fullscreen " href="#">
                                        </a>
                                    </li>
                                </div>
                            </div>
                            {{ __('new_trans.new_debts.title') }}
                        </h4>
                    </div>

                </div>

                <div class="box-header with-border py-3" style="width:100%;display:flex;justify-content:space-between;align-items:start;">
                    <div >
                        <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#bs-create-modal-lg" >
                            <i class="glyphicon glyphicon-pencil"></i>
                            {{__('new_trans.new_debts.create')}}
                        </button>
                    </div>
                    <div class="d-flex align-items-center justify-content-center" style="min-width:175px" >
                        <select class="form-select d-inline bg-lightest text-white" wire:model="admin_id">
                            <option selected value='' >{{ __('new_trans.new_debts.select_distributor') }}</option>
                            @foreach ($distributors as $distributor)
                                <option value="{{ $distributor->id }}">{{ $distributor->fullname }}</option>
                            @endforeach
                        </select>
                    </div>
                <!-- <div class="bootstrap-timepicker text-white">
           <div class="input-group text-white">
 					  <div class="input-group-addon text-white">
 						<i class="fa fa-calendar"></i>
 					  </div>
 					  <input type="text" class="form-control pull-left  text-white" id="reservation">
 					</div>
          @push('styles')
                    <style>
                    .calendar-table{
                    background-color: white;
                    padding: 5px;
                    width: 100%;
                    border-collapse: separate;
                    border-spacing:1px;
                  }
                </style>
@endpush
                @push('scripts')
                    <script src="{{asset('assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
      <script src="{{asset('assets/vendor_plugins/input-mask/jquery.inputmask.js')}}"></script>
      <script src="{{asset('assets/vendor_components/moment/min/moment.min.js')}}"></script>
      <script src="{{asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

      <script src="{{asset('js/pages/advanced-form-element.js')}}"></script>
      @endpush
                    </div> -->
                </div>
                <!-- Create Expense Modal -->
                <div class="modal fade {{ $errors->any() ? 'show':''}}" id="bs-create-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: {{ $errors->any() ? 'block':'none'}};">
                    <div class="modal-dialog modal-lg ">
                        <div class="modal-content ">
                            <form wire:submit='create'>
                                <div class="modal-header">
                                    <h4 class="modal-title text-white" id="myLargeModalLabel">
                                        {{__('new_trans.new_debts.create')}}
                                    </h4>
                                    <button type="button" data-bs-dismiss="modal" wire:click="resetErrors" aria-label="Close" class="btn btn-danger py-1 px-2 " style="height:50%;" >
                                        <i class="fa fa-times fa-x"></i>
                                    </button>
                                </div>
                                <div class="modal-body text-center p-2">

                                    <div class="modal-body px-4 mx-4 custom-padding-mobile " style="text-align:right;">
                                        <div class="form-group row">
                                            <label for="quta" class="form-label">
                                                {{ __('new_trans.new_debts.amount') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <input class="form-control" type="number" step="any" min="1"
                                                           wire:model="amount">
                                                </div>
                                                <span class="text-danger">
                               @error('amount')
                                                    {{ $message }}
                                                    @enderror
                           </span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="type" class="form-label">
                                                {{ trans('new_trans.new_debts.distributor') }}
                                            </label>
                                            <div>
                                                <div class="input-group p-0">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-flash text-danger"></i>
                                                    </div>
                                                    <select x-data="{ type: null, hasSelected: false }" class="form-select" id="type" wire:model="admin_id" x-model="type" @change="hasSelected = true">
                                                        <option value=""  selected x-bind:disabled="hasSelected">
                                                            {{ __('new_trans.new_debts.select_distributor') }}
                                                        </option>
                                                        @foreach ($distributors as  $distributor)
                                                            <option value="{{ $distributor->id }}">
                                                                {{ $distributor->fullname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('admin_id')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description" class="col-form-label">
                                                {{ trans('new_trans.new_debts.description') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-bookmark text-primary"></i>
                                                    </div>
                                                    <textarea class="form-control" style="height:125px;" id='description' placeholder="{{trans('new_trans.new_debts.description_placeholder')}}" type="text"
                                                              wire:model="description" >
                               </textarea>
                                                </div>
                                                @error('description')
                                                <span class="error text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger text-start" data-bs-dismiss="modal" wire:click="resetErrors">{{__('new_trans.close')}}</button>
                                    <button type="submit" wire:loading.attr="disabled" class="btn btn-success" data-dismiss="modal" wire:submit="create">
                                        {{__('new_trans.add')}}
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- Create Expense Modal -->


            </x-slot>

            <x-slot name="thead">
                <x-table-thead :columns="__('new_trans.new_debts.datatable.table_head')">

                </x-table-thead>
            </x-slot>

            <x-slot name="tbody">
                @forelse ($paginatedData as $index => $model)

                    <tr>
                        <td class="">
                            <div class="dropdown ">
                                <div class="clearfix ">
                                  <span class="badge badge-dark b-1 border-warning">
                                      @if (($pageNumber ?? 1) != 1)
                                          {{ $loop->index + 1 + $perPage * (($pageNumber ?? 1) - 1) }}
                                      @else
                                          {{ $loop->index + 1 }}
                                      @endif
                                  </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="custom-popover-container text-center">
                                <div class="custom-popover-content text-sm">
                                    {{ Str::limit($model->description, 110, '...') }}
                                </div>
                                <span class="dropdown-toggle badge badge-success badge-pill " data-bs-toggle="dropdown">
                                <span dir="auto" >
                                    {{ Str::limit($model->description, 50, '...') }}
                                </span>
                            </span>
                                <div class="dropdown-menu dropdown-menu-end fw-bold  text-center"  aria-labelledby="dropdown" >
                                    <a href="#" class="dropdown-item py-4 fw-bold" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg_{{$model->id}}">
                                        <i class="fa fa-eye text-info"></i>
                                        {{__('new_trans.new_debts.info')}}
                                    </a>
                                    <a  href="{{route($this->redirectUpdateRoute(), $model->id)}}"  class=" text-center dropdown-item py-4 fw-bold">
                                        <i class="fa fa-pencil text-primary"></i>
                                        {{ __('new_trans.new_debts.update')}}
                                    </a>
                                    <a href="#" :wire:key="'expense_delete_'.$model->id"  wire:click.prevent="showDeletedBox({{ $model->id }})" class="del-danger dropdown-item py-4 fw-bold text-md" >
                                        <i class="fa fa-trash fa-lg text-danger"></i>
                                        {{ __('new_trans.new_debts.delete') }}
                                    </a>
                                </div>
                            </div>
                        </td>
                        <div class="modal fade " id="bs-example-modal-lg_{{$model->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-white" id="myLargeModalLabel">{{__('new_trans.new_debts.info')}}</h4>
                                        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger py-1 px-2 " style="height:50%;" >
                                            <i class="fa fa-times fa-x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center p-2">
                                        <div style="display:grid;grid-template-columns:6fr 18fr;">

                                            <div class="text-xl text-white p-2 my-2 ">
                                                {{__('new_trans.new_debts.description')}}
                                            </div>
                                            <div class="p-2 ">
                                                {{ $model->description }}
                                            </div>

                                            <div class="text-xl text-white p-2 ">
                                                {{__('new_trans.new_debts.amount')}}
                                            </div>
                                            <div class="p-2 my-2">
                                  <span class="badge badge-danger ">
                                      {{ $model->amount }}
                                      <span class="text-sm">{{getViewCurrency()}}</span>
                                    </span>
                                            </div>

                                            <div class="text-xl text-white p-2 ">
                                                {{__('new_trans.created_at')}}
                                            </div>
                                            <div class="p-2 my-2">
                                                {{ $model->created_at }}
                                            </div>

                                            <div class="text-xl text-white p-2 ">
                                                {{__('new_trans.updated_at')}}
                                            </div>
                                            <div class="p-2 my-2">
                                                {{ $model->updated_at }}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-end">
                                        <button type="button" class="btn btn-danger text-start" data-bs-dismiss="modal">{{__('new_trans.close')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <td>
                        <span class="badge badge-danger ">
                          {{ $model->amount }}
                          <span class="text-sm">{{getViewCurrency()}}</span>
                          </span>
                        </td>
                        <td>
                            {{ \App\Models\Admin::find($model->admin_id) ? \App\Models\Admin::find($model->admin_id)->fullname : '-'}}
                        </td>
                        <td>
                            {{ $model->created_at }}
                        </td>

                    </tr>
                @empty
                    <x-datatable.empty-records />
                @endforelse




            </x-slot>
        </x-datatable>
    </div>


    @if($perPage < $data_count)

        <div class="box pt-4">
            {{ $paginatedData->links('vendor.pagination.livewire.crypto_paginate')  }}
        </div>
    @endif

    @push('styles')
        <style>
            @media (max-width: 768px) {
                .mobile-display-block{
                    display: block!important;
                    margin: 0px !important;
                }
            }
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
                .custom-padding-mobile
                {
                    padding:0px !important;
                }
            }

            /* Custom card class */
            .custom-card {
                transition: box-shadow 0.5s, transform 0.3s; /* Add a smooth transition for box-shadow and transform effects */
            }

            /* Add a subtle box-shadow on hover */
            .custom-card:hover {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
                transform: translateY(-5px); /* Move the card up slightly on hover */
            }
        </style>
    @endpush

</div>
