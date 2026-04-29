<div>

  <div class="alert alert-warning alert-dismissible">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <h4><i class="icon fa fa-info"></i>{{__('new_trans.alert_info_profits.info_alert')}}</h4>
    {{trans('new_trans.alert_info_profits.info_alert_text',['first_date'=> $first_date_carbon, 'last_date'=> $last_date_carbon])}}
  </div>
  <div class="box box-body p-3 ">
    <div class="d-block align-items-center justify-content-center" style="min-width:175px" >
      <select class="form-select d-inline bg-lightest text-white" wire:model="selected_nas_serial">
        <option selected value='' >{{ __('new_trans.select_network') }}</option>
        @foreach ($nas as $network)
        <option value="{{ $network->serial }}">{{ $network->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="d-flex mobile-display-block justify-content-around">
    <div class="col-xl-10 col-12 mx-4 mobile-display-block ">
      <div class="box  bg-hover-success box-body custom-card">
        <h6>
          <span class="text-uppercase fs-18 ">
            {{ __('new_trans.invoices.total_earnings_last_month') }}
            <span class="text-primary">
              @if($selected_nas ?? 0)
                [ {{$selected_nas->name}} ]
              @else
                [ {{__('new_trans.all_networks')}} ]
              @endif
            </span>
          </span>
        </h6>
        <br>
        <p class="fs-26">
          <span class="text-success">
            {{$total_earnings_last_month}}
          </span>
          <span class="text-sm">{{__('new_trans.expenses.egp')}}</span>
        </p>

        <div class="progress progress-xxs mt-0 mb-10">
          <div class="progress-bar bg-success" role="progressbar" style="width:80%; height: 4px;" aria-valuenow="" aria-valuemin="50" aria-valuemax="100"></div>
        </div>
        <div class="fs-12" >
          <i class="glyphicon glyphicon-info-sign text-primary me-1 "></i>
          <span class="px-2 ">
            {{__('new_trans.invoices.total_earnings_last_month_text')}}
          </span>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex mobile-display-block justify-content-around">
        <div class="col-xl-5 col-12 mx-4 mobile-display-block ">
          <div class="box box-body custom-card">
            <h6>
            <span class="text-uppercase">
              {{ __('new_trans.invoices.paid_invoices_last_month') }}
              <span class="text-primary">
                @if($selected_nas ?? 0)
                  [ {{$selected_nas->name}} ]
                @else
                  [ {{__('new_trans.all_networks')}} ]
                @endif
              </span>
            </span>
            </h6>
            <br>
            <p class="fs-26">
              <span class="text-success">
                {{ $total_users_paid_invoices_last_month ?? 0 }}
              </span>
               <span class="text-sm">{{__('new_trans.expenses.egp')}}</span>
            </p>

            <div class="progress progress-xxs mt-0 mb-10">
                  <div class="progress-bar bg-success" role="progressbar" style="width:0%; height: 4px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="fs-12" >
              <i class="glyphicon glyphicon-info-sign text-primary me-1 "></i>
              <span class="px-2 ">
               {{__('new_trans.invoices.paid_invoices_last_month_text')}}
             </span>
             </div>
          </div>
        </div>

        <div class="col-xl-5 col-12 mx-4 mobile-display-block ">
          <div class="box box-body custom-card">
            <h6>
            <span class="text-uppercase">
              {{ __('new_trans.expenses.total_expenses_this_month') }}
              <span class="text-primary">
                @if($selected_nas ?? 0)
                  [ {{$selected_nas->name}} ]
                @else
                  [ {{__('new_trans.all_networks')}} ]
                @endif
              </span>
            </span>
            </h6>
            <br>
            <p class="fs-26">
              <span class="text-danger">
                {{ $total_expenses_last_month }}
              </span>
               <span class="text-sm">{{__('new_trans.expenses.egp')}}</span>
            </p>

            <div class="progress progress-xxs mt-0 mb-10">
            <div class="progress-bar  bg-danger" role="progressbar" style="width:40%; height: 4px;" aria-valuenow="" aria-valuemin="50" aria-valuemax="100"></div>
            </div>
            <div class="fs-12" ><i class="ion-arrow-graph-up-right text-danger me-1"></i>
              <span dir="ltr" class="px-1 text-danger">
             </span>
               {{__('new_trans.expenses.percentage_change')}}
             </div>
          </div>
      </div>
  </div>

  <div class="d-flex mobile-display-block justify-content-around">
  <div class="col-xl-10 col-12 mx-4 mobile-display-block ">
    <div class="box box-body custom-card">
      <h6>
        <span class="text-uppercase">
          {{ __('new_trans.invoices.total_users_account') }}
          <span class="text-primary">
            @if($selected_nas ?? 0)
              [ {{$selected_nas->name}} ]
            @else
              [ {{__('new_trans.all_networks')}} ]
            @endif
          </span>
        </span>
      </h6>
      <br>
      <p class="fs-26">
        <span class="text-success">
          {{$total_users_account}}
        </span>
        <span class="text-sm">{{__('new_trans.expenses.egp')}}</span>
      </p>

      <div class="progress progress-xxs mt-0 mb-10">
            <div class="progress-bar bg-success" role="progressbar" style="width:80%; height: 4px;" aria-valuenow="" aria-valuemin="50" aria-valuemax="100"></div>
      </div>
      <div class="fs-12" >
        <i class="glyphicon glyphicon-info-sign text-primary me-1 "></i>
        <span class="px-2 ">
        {{__('new_trans.invoices.total_users_account_text')}}
      </span>
      </div>
    </div>
  </div>
</div>


</div>
@push('styles')
<style>
@media (max-width: 768px) {
  .mobile-display-block
  {
    display:block !important;
    line-height: 1.7;
    margin: 0px !important;

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
