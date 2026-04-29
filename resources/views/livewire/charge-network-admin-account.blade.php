<div>
    {{-- <form method="post" action="{{ route('processTransaction') }}">
        @csrf
        <span class="d-block">
            <button type="submit" class="btn btn-danger my-2" >
                Pay Subscription
                <li class="fa fa-paypal  text-dark p-2 "></li>
            </button>
        </span>
    </form> --}}
    <button type="submit" class="btn btn-danger mt-1 mb-3"  data-bs-toggle="modal" data-bs-target="#bs-modal-lg-process-transaction">
        <li class="fa fa-paypal  text-dark p-2 "></li>
        {{ __('site.network_account_view.pay_subscription') }}
   </button>


    <div wire:ignore.self wire:key="modal-send-message"  class="modal fade" id="bs-modal-lg-process-transaction" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;padding-right:0px!important;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-white">{{__('new_trans.admin_payments.process_transaction')}}</h4>
              <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-danger py-1 px-2" style="height:50%;">
                <i class="fa fa-times fa-x"></i>
              </button>
            </div>
            <div class="modal-body p-2">
        {{-- <form wire:submit="processTransaction()" method="post" action="{{ route('processTransaction') }}" > --}}
            <form  method="post" action="{{ route('paypal.processTransaction') }}" >
                @csrf
                <div class="container">

                <div class="col-12">
                    <div class="form-group row">
                        <h5 class="col-form-label py-2 ">
                            {{ __('new_trans.admin_payments.select_action') }}
                        </h5>
                        <div>
                            <select class="form-select" wire:model="action" name="action">
                                @foreach ($admin_payment_actions as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                @if ($action == \App\ENUMS\AdminPaymentEnum::PAYMENT_ACTION_CHARGE_ACCOUNT)
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <h5 for="fullname" class="col-form-label p-3" >
                                    {{ __('new_trans.admin_payments.charge_amount') }}
                                </h5>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money text-primary"></i>
                                        </div>
                                        <input class="form-control" type="number"
                                        placeholder="{{ __('new_trans.admin_payments.charge_amount_placeholder') }}"
                                        wire:model="amount" name="amount">
                                    </div>
                                </div>
                            </div>
                            @error('amount')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @elseif ($action == \App\ENUMS\AdminPaymentEnum::PAYMENT_ACTION_CHARGE_SUBSCRIPTION)
                    <div class="row">
                        <div class="col-12">
                            @forelse ($debtInvoices as $debtInvoice)
                                <div class="card mb-3">
                                    <div class="card-header bg-primary ">
                                        <h5 class="mb-0 text-primary">Invoice #{{ $debtInvoice->id }}</h5>
                                    </div>
                                    <div class="card-body  text-light">
                                        <div class="row px-4 " style="font-size:18px;">
                                            @if (in_array($debtInvoice->event_name, [\App\ENUMS\NetworkTypeEnum::EVENT_ADD_NEW_NETWORK, \App\ENUMS\NetworkTypeEnum::EVENT_BUY_NEW_CAFE]))
                                                <div class="col-md-6">
                                                    <p class="mb-3">
                                                        <strong>{{ __('new_trans.admin_payments.plan_price') }} : </strong>
                                                        <span class="text-danger" style="font-size: 16px;">
                                                            {{ $debtInvoice->content['plan'] }}
                                                            {{ __('new_trans.dollar_code') }}
                                                        </span>
                                                    </p>
                                                    <p class="mb-3">
                                                        <strong>{{ __('new_trans.admin_payments.subscription_fee') }} : </strong>
                                                        <span class="text-danger" style="font-size: 16px;">
                                                            {{ $debtInvoice->content['subscription_fee'] }}
                                                            {{ __('new_trans.dollar_code') }}
                                                        </span>
                                                    </p>
                                                </div>
                                            @elseif($debtInvoice->event_name === \App\ENUMS\NetworkTypeEnum::EVENT_RENEW)
                                                <div class="col-md-6">
                                                    <p class="mb-3">
                                                        <strong>{{ __('new_trans.admin_payments.plan_price') }} : </strong>
                                                        <span class="text-danger" style="font-size: 16px;">
                                                            {{ $debtInvoice->content['plan'] }}
                                                            {{ __('new_trans.dollar_code') }}
                                                        </span>
                                                    </p>
                                                    <p class="mb-3">
                                                        <strong>{{ __('new_trans.admin_payments.total_servers_fee') }} : </strong>
                                                        <span class="text-danger" style="font-size: 16px;">
                                                            {{  $debtInvoice->content['total_buy_nas'] }}
                                                            {{ __('new_trans.dollar_code') }}
                                                        </span>
                                                    </p>
                                                </div>
                                            @endif
                                                <div class="col-md-6 text-md-right ">
                                                    <p class="mb-3">
                                                        <strong>{{ __('new_trans.admin_payments.total_amount') }} : </strong>
                                                        <span class="text-danger" style="font-size: 16px;">
                                                            {{ $debtInvoice->price }}
                                                                {{ __('new_trans.dollar_code') }}
                                                            </span>
                                                        </p>
                                                    <p class="mb-3">
                                                        <strong>{{ __('new_trans.date') }} : </strong>
                                                        <span class="text-primary" style="font-size: 16px;">
                                                            {{ $debtInvoice->created_at->format('M d, Y') }}
                                                        </span>
                                                    </p>
                                                </div>
                                        </div>
                                        <hr>
                                        <p class="mb-0 text-danger px-3" style="font-size: 14px;">
                                            {{ __('new_trans.admin_payments.info') }}

                                        </p>

                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-primary" role="alert">
                                    {{ __('new_trans.admin_payments.no_debt') }}

                                </div>
                            @endforelse
                        </div>
                    </div>

                    @endif


              </div>
            </div>
            <div class="modal-footer d-flex justify-content-end">
              <button type="submit" wire:loading.attr="disabled" wire:key="btn-partial-payment" class="btn btn-success text-start" >{{__('new_trans.charge')}}</button>
              <button type="button" data-action="closePaymentModal" class="btn btn-danger text-start" data-bs-dismiss="modal">{{__('new_trans.close')}}</button>
            </div>
          </form>
          </div>
        </div>
      </div>

</div>
