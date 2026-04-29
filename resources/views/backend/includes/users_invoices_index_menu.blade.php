<div class="dropdown" style="white-space: nowrap;">
    <div class="clearfix pull-left">
        <span class="badge badge-dark">
            @if ($page != 1)
                {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
                {{ $loop->index + 1 }}
            @endif
        </span>

        @can(['invoices_delete', 'invoices_print', 'invoices_paied'])
            <span
                class="dropdown-toggle px-2 badge badge-{{ __("site.invoices_status_color.{$model->status}") }}"
                data-bs-toggle="dropdown">
                {{ $model->id }}
            </span>
            <div class="dropdown-menu dropdown-menu-end fw-bold">

                @can('invoices_delete')
                    @if (authIsAdmin())
                        <a class="dropdown-item py-2 fw-bold" href="#"
                            wire:click="showDeletedBox('{{ $model->id }}')">
                            <i class="fa fa-trash-o text-danger"></i>
                            {{ __('site.user_index.option.delete') }}
                        </a>
                    @endif
                @endcan
                @if ($model->showCancelledButton())
                    @can('invoices_paied')
                        @if ($model->showPaiedButton())
                            <a class="dropdown-item py-2 fw-bold" href="#"
                                wire:click="showPaiedBox('{{ $model->id }}')">
                                <i class="fa fa-money text-success"></i>
                                {{ __('site.invoices.options.paied') }}
                            </a>


                            <a href="#" class="dropdown-item py-2 fw-bold" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg_{{$model->id}}">
                              <i class="fa fa-credit-card text-primary" aria-hidden="true"></i>
                                {{__('site.invoices.options.partial_payment')}}
                            </a>



                        @endif
                    @endcan

                    @can('invoices_print')
                        <a class="dropdown-item py-2 fw-bold" href="#"
                            wire:click="print('{{ $model->id }}')">
                            <i class="fa fa-print"></i>
                            {{ __('site.invoices.options.print') }}
                        </a>
                    @endcan
                @endif
            </div>

        @endcan


    </div>

</div>

@if ($model->showCancelledButton())
@can('invoices_paied')
@if ($model->showPaiedButton())
<div wire:ignore.self wire:key="modal-partial-payment-{{$model->id}}"  class="modal fade" id="bs-example-modal-lg_{{$model->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;padding-right:0px!important;">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-white">{{__('site.invoices.options.partial_payment')}}</h4>
        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger py-1 px-2" style="height:50%;">
          <i class="fa fa-times fa-x"></i>
        </button>
      </div>
      <div class="modal-body p-2">
        <form wire:submit="createPartialPayment({{$model->id}})" >
        <div class="container">
          <div class="row">
            <div class="col-12 my-2">
              <div class="form-group row m-3 my-2">
                <label class="col-sm-4 col-form-label" style="width:auto!important;">
                  اسم العميل
                </label>
                <div class="col-sm-8" style="width:auto!important;">
                  <span class="badge badge-success fs-16" >
                      @if ($model->eventForCard())
                          {{ $model->card_num ?? '...' }}
                      @else
                          {{ $model->fullname ?? '...' }}
                      @endif
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 my-2">
              <div class="form-group row m-3 my-2">
                <label  class="col-sm-4 col-form-label" style="width:auto!important;">
                  {{ __("new_trans.needed_amount") }}
                </label>
                <div class="col-sm-8" style="width:auto!important;">
                  <span class="badge badge-danger fs-18" >
                    {{ formatViewCurrency(((int) $model->price - (int) $model->paied_price)) }}

                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 my-2">
              <div class="d-flex m-3 my-2">
                <label  class="col-sm-4 p-2 col-form-label" style="width:auto!important;">
                    {{ __("new_trans.paid_amount") }}
                </label>
                <div class="col-sm-8" style="width:auto!important;">
                  <input class="form-control" type="number" placeholder="اكتب ما دفعه العميل لك" wire:model="partial_paid_price">

                  @error('partial_paid_price')
                  <div class="error text-danger mt-2">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-end">
        <button type="submit" wire:loading.attr="disabled" wire:key="btn-partial-payment-{{$model->id}}"  wire:submit="createPartialPayment({{$model->id}})" class="btn btn-success text-start" >{{__('new_trans.add')}}</button>
        <button type="button" data-action="closePaymentModal" class="btn btn-danger text-start" data-bs-dismiss="modal">{{__('new_trans.close')}}</button>
      </div>
    </form>
    </div>
  </div>
</div>

@endif
@endcan
@endif
