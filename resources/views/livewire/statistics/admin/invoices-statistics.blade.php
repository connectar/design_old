

<div >
  <div class="box box-body p-3 ">
    <div class="container mt-4 px-4">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <span class="text-primary px-1">
                    <i class="fa fa-user text-primary px-1"></i>
                    {{ __('new_trans.select_network') }}
                </span>
                <select class="form-select d-inline bg-lightest text-white" wire:model="selected_nas_serial">
                <option selected value='' >{{ __('new_trans.admin_messages.all_nas') }}</option>
                @foreach ($nas as $network)
                <option value="{{ $network->serial }}">{{ $network->name }}</option>
                @endforeach
                </select>
            </div>

            <div class="col-md-5 mx-auto">
                <span class="text-primary px-1">
                    <i class="fa fa-user text-primary px-1"></i>
                    {{ __('site.invoices.users_type') }}
                </span>
                <select class="form-select d-inline bg-lightest text-white" wire:model="selected_users_type">
                <option selected value='' >{{ __('site.invoices.all_users_type') }}</option>
                <option value="{{ \App\ENUMS\UserTypeEnum::FILTER_USER_ONLINE }}">{{ __('site.invoices.type_users') }}</option>
                <option value="{{ \App\ENUMS\UserTypeEnum::FILTER_CARD_ONLINE }}">{{ __('site.invoices.type_cards') }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="container mt-4 px-4">
        <div class="row">
            <div class=" col-md-5 mx-auto">
                <div class="mb-3 mx-4">
                    <label for="date-range" class="form-label p-2">{{ __('new_trans.printed_at') }}</label><span class="text-primary">{{ __('new_trans.printed_at_etc') }} </span> :</label>
                    <input type="text" id="date-range" wire:model.prevent.debounce.500ms="printed_at_range" autocomplete="off" class="form-control" placeholder="{{ __('new_trans.choose_date') }}">
                </div>
            </div>
            <div class="col-md-5 mx-auto">
                <div class="mb-4 mx-4">
                    <label for="date-rangetwo" class="form-label p-2">{{ __('new_trans.started_at') }}</label><span class="text-primary">{{ __('new_trans.started_at_etc') }} </span>:</label>
                    <input type="text" id="date-rangetwo" wire:model.prevent.debounce.500ms="started_at_range" autocomplete="off" class="form-control" placeholder="{{ __('new_trans.choose_date') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <a href="#users_invoices" class="btn btn-danger btn-sm m-3" wire:loading.attr="disabled" wire:click="showUsersInvoices()">{{ $showUsersInvoices ? __("new_trans.hide") : __("new_trans.show") }} {{ __("new_trans.subscribers_invoices") }}</a>
        @if($distributors !== null && $distributors->isNotEmpty())
            <button  class="btn btn-danger btn-sm m-3" wire:loading.attr="disabled" wire:click="showDistributorsInvoices()">{{ $showDistributorsInvoices ? __("new_trans.hide") : __("new_trans.show") }} {{ __("new_trans.distributors_invoices") }}</button>
        @endif
    </div>
  </div>
  <div class="d-flex mobile-display-block justify-content-around">


    <div class="col-xl-4 col-12 mobile-display-block">
      <div class="box box-body custom-card">
        <h6>
        <span class="text-uppercase">
          {{ __('new_trans.invoices.all_invoices') }}
        <span class="text-primary">
            [ {{ $selected_nas ?  $selected_nas->name : __('new_trans.all_networks')}} ]
        </span>
        -
        <span class="text-primary">
            [ {{ $selected_users_type ?  __('site.invoices.type_'. $selected_users_type) :  __('site.invoices.all_users_type')}} ]
        </span>
        </span>
        </h6>
        <br>
        <p class="fs-26">
          <span class="text-success">
            {{$total_users_invoices}}
          </span>
          <span class="text-sm">{{getViewCurrency()}}</span>
        </p>
        {{-- <div class="d-flex justify-content-around p-2">
            @if ($printed_at_range)
            <span style="font-size:11px;" >تاريخ طباعة <span class="text-primary">{{ $printed_at_range }}</span></span>
            @endif
            @if ($started_at_range)
                <span style="font-size:11px;" >تاريخ محاسبة <span class="text-primary">{{ $started_at_range }}</span></span>
            @endif
        </div> --}}
        <div class="progress progress-xxs mt-0 mb-10">
            @if ($total_users_invoices > 0)
            <div class="progress-bar bg-success" role="progressbar" style="width:{{ $total_users_paid_invoices * 100 / $total_users_invoices }}%; height: 4px;" aria-valuenow="{{ $total_users_paid_invoices }}" aria-valuemin="0" aria-valuemax="{{ $total_users_invoices }}"></div>
            @else
            <!-- Handle the case where $total_users_invoices is zero or less -->
            <div class="progress-bar bg-success" role="progressbar" style="width:0%; height: 4px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div>
            @endif
        </div>
        <div class="fs-12" ><i class="glyphicon glyphicon-info-sign text-primary me-1 "></i>
            <span class="px-2 ">
                {{__('new_trans.invoices.all_invoices_text')}}
            </span>
         </div>
      </div>
    </div>

    <div class="col-xl-3 col-12 mx-4 mobile-display-block ">
      <div class="box box-body custom-card">
        <h6>
        <span class="text-uppercase">
          {{ __('new_trans.invoices.paid_invoices') }}
          <span class="text-primary">
            [ {{ $selected_nas ?  $selected_nas->name : __('new_trans.all_networks')}} ]
          </span>
          -
          <span class="text-primary">
              [ {{ $selected_users_type ?  __('site.invoices.type_'. $selected_users_type) :  __('site.invoices.all_users_type')}} ]
          </span>
        </span>
        </h6>
        <br>
        <p class="fs-26">
          <span class="text-success">
            {{ $total_users_paid_invoices ?? 0 }}
          </span>
           <span class="text-sm">{{getViewCurrency()}}</span>
        </p>

        <div class="progress progress-xxs mt-0 mb-10">
          @if ($total_users_invoices > 0)
              <div class="progress-bar bg-success" role="progressbar" style="width:{{ $total_users_paid_invoices * 100 / $total_users_invoices }}%; height: 4px;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
          @else
              <div class="progress-bar bg-success" role="progressbar" style="width:0%; height: 4px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
          @endif
        </div>
        <div class="fs-12" >
          <i class="glyphicon glyphicon-info-sign text-primary me-1 "></i>
          <span class="px-2 ">
           {{__('new_trans.invoices.paid_invoices_text')}}
         </span>
         </div>
      </div>
    </div>


    <div class="col-xl-4 col-12 mx-4 mobile-display-block ">
      <div class="box box-body custom-card">
        <h6>
          <span class="text-uppercase">
            {{ __('new_trans.invoices.unpaid_invoices') }}
            <span class="text-primary">
                [ {{ $selected_nas ?  $selected_nas->name : __('new_trans.all_networks')}} ]
            </span>
            -
            <span class="text-primary">
                [ {{ $selected_users_type ?  __('site.invoices.type_'. $selected_users_type) :  __('site.invoices.all_users_type')}} ]
            </span>
          </span>
        </h6>
        <br>
        <p class="fs-26">
          <span class="text-danger">
            {{$total_users_unpaid_invoices}}
          </span>
          <span class="text-sm">{{getViewCurrency()}}</span>
        </p>

        <div class="progress progress-xxs mt-0 mb-10">
          @if ($total_users_invoices > 0)
              <div class="progress-bar bg-danger" role="progressbar" style="width:{{ $total_users_unpaid_invoices * 100 / $total_users_invoices }}%; height: 4px;" aria-valuenow="" aria-valuemin="50" aria-valuemax="100"></div>
          @else
              <div class="progress-bar bg-danger" role="progressbar" style="width:0%; height: 4px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
          @endif
        </div>
        <div class="fs-12" >
          <i class="glyphicon glyphicon-info-sign text-primary me-1 "></i>
          <span class="px-2 ">
          {{__('new_trans.invoices.unpaid_invoices_text')}}
        </span>
        </div>
      </div>
    </div>
</div>
<div class="d-flex mobile-display-block justify-content-around">

    <div class="col-xl-4 col-12  mobile-display-block ">
        <div class="box box-body custom-card">
            <h6>
            <span class="text-uppercase">
            {{ __('new_trans.expenses.total_expenses') }}
            <span class="text-primary">
                [ {{ $selected_nas ?  $selected_nas->name : __('new_trans.all_networks')}} ]
            </span>
            </span>
            </h6>
            <br>
            <p class="fs-26">
            <span class="text-danger">
                {{ $total_expenses }}
            </span>
            <span class="text-sm">{{getViewCurrency()}}</span>
        </p>

            <div class="progress progress-xxs mt-0 mb-10">
            <div class="progress-bar bg-danger" role="progressbar" style="width:50%; height: 4px;" aria-valuenow="" aria-valuemin="50" aria-valuemax="100"></div>
            </div>
            <div class="fs-12" ><i class="ion-arrow-graph-up-right text-danger me-1"></i>
            <span dir="ltr" class="px-1 text-danger">

            </span>
                {{__('new_trans.expenses.total_expenses_info')}}
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-12 mx-4 mobile-display-block ">
        <div class="box  bg-hover-success box-body custom-card">
          <h6>
            <span class="text-uppercase">
              {{ __('new_trans.invoices.total_earnings') }}
              <span class="text-primary">
                [ {{ $selected_nas ?  $selected_nas->name : __('new_trans.all_networks')}} ]
              </span>
            </span>
          </h6>
          <br>
          <p class="fs-26">
            <span class="text-success">
              {{$total_earnings}}
            </span>
            <span class="text-sm">{{getViewCurrency()}}</span>
        </p>

          <div class="progress progress-xxs mt-0 mb-10">
            <div class="progress-bar bg-success" role="progressbar" style="width:80%; height: 4px;" aria-valuenow="" aria-valuemin="50" aria-valuemax="100"></div>
          </div>
          <div class="fs-12" >
            <i class="glyphicon glyphicon-info-sign text-primary me-1 "></i>
            <span class="px-2 ">
              {{__('new_trans.invoices.total_earnings_text')}}
            </span>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-12 mx-4 mobile-display-block ">
        <div class="box box-body custom-card">
            <h6>
            <span class="text-uppercase">
                {{ __('new_trans.invoices.total_users_account') }}
                <span class="text-primary">
                    [ {{ $selected_nas ?  $selected_nas->name : __('new_trans.all_networks')}} ]
                </span>
            </span>
            </h6>
            <br>
            <p class="fs-26">
            <span class="text-success">
                {{$total_users_account}}
            </span>
            <span class="text-sm">{{getViewCurrency()}}</span>
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

@if($distributors !== null && $distributors->isNotEmpty() && $showDistributorsInvoices)
<div class="row">
    <div class="col-xl-4 col-12">
        <div class="box custom-card">
            <div class="box-header with-border text-center">
              <h6 class="box-title" style="line-height:1.7;">
                    {{ __('new_trans.invoices.distributors_users_invoices') }}
                    <span class="badge badge-primary mt-3 mx-2 ">
                     {{$total_distributors_invoices}}
                     <span class="text-sm">{{getViewCurrency()}}</span>
                   </span>
                </h6>
            </div>
            <div class="box-body p-0">
                <div class="media-list media-list-hover media-list-divided inner-user-div">
                    @forelse (empty($distributors) || $distributors == null ? [] : $distributors->sortByDesc('total_users_paid_invoices') as $distributor)
                        <div class="media media-single">
                            <div class="media-body px-0 d-flex">
                              <i class="{{$loop->iteration == 1 ? 'ti-crown' : 'ti-cup'}} fs-16 px-2 text-primary"></i>
                                <h6>
                                    {{ $distributor->fullname }}
                                </h6>
                            </div>
                            <div class="media-right">
                                <span class="badge badge-primary badge-lg" dir="auto">
                                    {{ $distributor->total_users_invoices }}
                                    <span class="text-sm">{{getViewCurrency()}}</span>

                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-4">
                            <x-datatable.empty-records />
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-12">
        <div class="box custom-card">
            <div class="box-header with-border text-center">
              <h6 class="box-title" style="line-height:1.7;">
                    {{ __('new_trans.invoices.distributors_users_paid_invoices') }}
                </h6>
                <span class="badge badge-success mt-3 mx-2">
                 {{$total_distributors_paid_invoices}}
                 <span class="text-sm">{{getViewCurrency()}}</span>

               </span>
            </div>
            <div class="box-body p-0">
                <div class="media-list media-list-hover media-list-divided inner-user-div">
                    @forelse (empty($distributors) || $distributors == null ? [] : $distributors->sortByDesc('total_users_paid_invoices') as $distributor)
                        <div class="media media-single">
                            <div class="media-body px-0 d-flex">
                              <i class="{{$loop->iteration == 1 ? 'ti-crown' : 'ti-cup'}} fs-16 px-2 text-success"></i>
                                <h6>
                                    {{ $distributor->fullname }}
                                </h6>
                            </div>
                            <div class="media-right">
                                <span class="badge badge-success badge-lg" dir="auto">
                                    {{ $distributor->total_users_paid_invoices }}
                                    <span class="text-sm">{{getViewCurrency()}}</span>
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-4">
                            <x-datatable.empty-records />
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-4 col-12">
        <div class="box custom-card">
            <div class="box-header with-border text-center">
                <h6 class="box-title " style="line-height:1.7;">
                    {{ __('new_trans.invoices.distributors_users_unpaid_invoices') }}
                    <span class="badge badge-danger mt-3 mx-2">
                     {{$total_distributors_unpaid_invoices}}
                     <span class="text-sm">{{getViewCurrency()}}</span>
                   </span>
                </h6>
            </div>
            <div class="box-body p-0">
                <div class="media-list media-list-hover media-list-divided inner-user-div">
                    @forelse (empty($distributors) || $distributors == null ? [] : $distributors->sortByDesc('total_users_paid_invoices') as $distributor)
                        <div class="media media-single">
                            <div class="media-body px-0 d-flex">
                              <i class="{{$loop->iteration == 1 ? 'ti-crown' : 'ti-cup'}} fs-16 px-2 text-danger"></i>
                                <h6>
                                    {{ $distributor->fullname }}
                                </h6>
                            </div>
                            <div class="media-right">
                                <span class="badge badge-danger badge-lg" dir="auto">
                                    {{ $distributor->total_users_unpaid_invoices }}
                                    <span class="text-sm">{{getViewCurrency()}}</span>
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-4">
                            <x-datatable.empty-records />
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div id="users_invoices">
    @if ($showUsersInvoices)
        @livewire('statistics.admin.users-invoices',[
            'started_at_range' => $started_at_range,
            'printed_at_range' => $printed_at_range,
            'distributors' => $distributors ?? [],
            'nas_serial_selected' => $selected_nas ? $selected_nas->serial : null,
            'selected_users_type' => $selected_users_type,
        ], key('users_invoices_' . $started_at_range . '_' . $printed_at_range. '_' . ($selected_nas->serial ?? 'none') . '_' . ($selected_users_type ?? 'none')))
    @endif
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
