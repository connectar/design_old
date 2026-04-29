<div>

    <div class="d-flex mobile-display-block justify-content-around">


        <div class="col-xl-4 col-12 mobile-display-block">
          <div class="box box-body custom-card">
            <h6>
            <span class="text-uppercase fs-20">
              {{ __('new_trans.network_accounts.total_positive_accounts') }}
            </span>
            </h6>
            <br>
            <p class="fs-26">
              <span class="text-success">
                {{ $totalPositiveAccounts ?? '-' }}
              </span>
               <span class="text-sm">{{getViewCurrency()}}</span>
            </p>

            <div class="progress progress-xxs mt-0 mb-10">
            <div class="progress-bar bg-success" role="progressbar" style="width:80%; height: 4px;" aria-valuenow="" aria-valuemin="50" aria-valuemax="100"></div>
            </div>
            <div class="fs-12" ><i class="glyphicon glyphicon-info-sign text-primary me-1 "></i>
              <span class="px-2 ">
                {{ __('new_trans.network_accounts.total_positive_accounts_info') }}
            </span>
             </div>
          </div>
        </div>

        <div class="col-xl-3 col-12 mx-4 mobile-display-block ">
            <div class="box box-body custom-card">
            <h6>
            <span class="text-uppercase fs-20">
                {{ __('new_trans.network_accounts.total_accounts') }}
            </span>
            </h6>
            <br>
            <p class="fs-26">
                <span class="text-success">
                {{ $totalAccounts }}
                </span>
                <span class="text-sm">
                    {{getViewCurrency()}}
                </span>
            </p>

            <div class="progress progress-xxs mt-0 mb-10">
            <div class="progress-bar bg-success" role="progressbar" style="width:80%; height: 4px;" aria-valuenow="" aria-valuemin="50" aria-valuemax="100"></div>
            </div>
            <div class="fs-12" ><i class="glyphicon glyphicon-info-sign text-primary me-1 "></i>
                <span class="px-2 ">
                    {{ __('new_trans.network_accounts.total_accounts_info') }}
                </span>
            </div>
            </div>
        </div>

        <div class="col-xl-4 col-12 mobile-display-block">
            <div class="box box-body custom-card">
              <h6>
              <span class="text-uppercase fs-20">
                {{ __('new_trans.network_accounts.total_negative_accounts') }}
              </span>
              </h6>
              <br>
              <p class="fs-26">
                <span class="text-danger">
                  {{ $totalNegativeAccounts ?? '-' }}
                </span>
                 <span class="text-sm">{{getViewCurrency()}}</span>
              </p>

              <div class="progress progress-xxs mt-0 mb-10">
              <div class="progress-bar bg-danger" role="progressbar" style="width:5%; height: 4px;" aria-valuenow="" aria-valuemin="50" aria-valuemax="100"></div>
              </div>
              <div class="fs-12" ><i class="glyphicon glyphicon-info-sign text-primary me-1 "></i>
                <span class="px-2 ">
                    {{ __('new_trans.network_accounts.total_negative_accounts_info') }}
                </span>
               </div>
            </div>
          </div>
    </div>


<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">

    <div class="container py-3 px-4">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="col-md-6  ">
                    <span class="text-primary px-1">
                        <i class="fa fa-user text-primary px-1 py-2"></i>
                        {{ __('new_trans.network_accounts.filter_manager') }}
                    </span>
                    <select class="form-select d-inline bg-lightest text-white" wire:model="selectedManager">
                        <option selected value='' >
                            {{ __('new_trans.network_accounts.all_managers') }}
                        </option>
                        @forelse ($managers as $adminManager)
                            <option value="{{ $adminManager->id }}">
                                {{ $adminManager->fullname }}
                            </option>
                        @empty

                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 ">
                <div>
                    <label for="date-range" class="form-label p-2">{{ __('new_trans.started_at') }}</label><span class="text-primary">{{ __('new_trans.started_at_etc') }} </span> :</label>
                    <input type="text" id="date-range" wire:model.prevent.debounce.500ms="created_at_range" autocomplete="off" class="form-control" placeholder="{{ __('new_trans.choose_date') }}">
                </div>
            </div>
            <div class="col-md-4  col-sm-12">
                <x-datatable.table-search />
            </div>
        </div>
    </div>


    </x-slot>
    <x-slot name="thead">
        <th wire:click="orderBy('admin_fullname')">
            <span class="badge">
                <span class="ps-6">#</span>
                <span style="padding-right: 20px">
                    مدير النظام المحصل
                </span>
            </span>
            @if ($orderByColumn == 'admin_fullname')
            <span>
                <i class="fa {{ $sortIcon }} text-primary"></i>
            </span>
            @endif
        </th>
        @foreach (trans('datatable.manager_admin_accounts') as $column => $value)
        <th class="text-center" wire:click="orderBy('{{ $column }}')">
            <span class="badge">
                {{ $value }}
            </span>
            @if ($column == $orderByColumn)
            <span>
                <i class="fa {{ $sortIcon }} text-primary"></i>
            </span>
            @endif
        </th>
        @endforeach
    </x-slot>

<x-slot name="tbody">
    @forelse ($paginatedData as $index => $model)
        <tr class="fw-bold">
            <td class="w-auto">
                <span class="badge badge-dark">
                    @if (($page ?? 1) != 1)
                        {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                    @else
                        {{ $loop->index + 1 }}
                    @endif
                </span>
                <span class="px-2 badge badge-success">
                    {{ $model->admin_fullname ?? '-'}}
                </span>
            </td>

            <td class="no-padding">
                {{ $model->network_name ?? '-' }}
            </td>
            <td class="no-padding">
                <span class="badge badge-pill badge-dark">
                    {{ $model->billing_code ?? '-' }}
                </span>
            </td>
            <td class="no-padding">
                <span class="badge badge-pill badge-info">
                    {{ $model->price ?? '-' }}
                </span>
            </td>
            <td class="no-padding">
                @if ($model->is_paid)
                    <span class="badge badge-success">
                        تم الدفع
                    </span>
                @else
                    <span class="badge badge-danger">
                        لم يتم الدفع
                    </span>
                @endif
            </td>
            <td class="no-padding">
                {{ $model->is_cancelled ? 'تم الالغاء' : '-'}}
            </td>
            <td class="no-padding">
                {{ $model->created_at ?? '-'}}
            </td>
            <td class="no-padding">
                {{ $model->updated_at ?? '-'}}
            </td>

        </tr>
        @empty
        <x-datatable.empty-records />
    @endforelse
</x-slot>
</x-datatable>

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
