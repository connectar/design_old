@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .flatpickr-day.inRange{
        background: #569ff7 !important;
        border-color: #569ff7 !important;
        color: #fff !important;
        box-shadow: none !important;
    }
</style>
@endpush
<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-md-6">
            <span class="btn btn-sm btn-warning">
                {{ __('site.invoices.title') }}
            </span>
        </div>
        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
        <div class="box-header py-2">
            <span class="text-primary px-1">
                <i class="fa fa-money text-primary px-1"></i>
                {{ __('site.invoices.status') }}
            </span>
            <select class="form-select d-inline bg-lightest text-white" style="max-width: 250px"
                wire:model="status">
                @foreach ($allStatuses as $index => $value)
                    <option value="{{ $index }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>

          <div class="container mt-4 px-4">
              <div class="row">
                  <div class=" col-md-5 mx-auto">
                      <div class="mb-3 mx-4">
                          <label for="date-range" class="form-label p-2">{{ __('new_trans.printed_at') . ' '. __("new_trans.printed_at_etc") }} :</label>
                          <input type="text" id="date-range" wire:model.prevent.debounce.500ms="printed_at_range" autocomplete="off" class="form-control" placeholder="{{ __("new_trans.choose_date") }}">
                      </div>
                  </div>
                  <div class="col-md-5 mx-auto">
                      <div class="mb-4 mx-4">
                          <label for="date-rangetwo" class="form-label p-2">{{ __('new_trans.started_at') . ' ' . __('new_trans.started_at_etc') }} :</label>
                          <input type="text" id="date-rangetwo" wire:model.prevent.debounce.500ms="started_at_range" autocomplete="off" class="form-control" placeholder="{{ __("new_trans.choose_date") }}">
                      </div>
                  </div>
              </div>
          </div>



        <div class="row mt-2">
            <div class="col-12">
                <span>
                    {{ __('site.invoices.by_type') }} :
                </span>
                <span>
                    <span class="mx-2">
                        <span class="badge badge-secondary p-2">
                        </span>
                        {{ __('site.invoices.by_admin') }}
                    </span>
                    <span class="mx-2">
                        <span class="badge badge-success p-2">
                        </span>
                        {{ __('site.invoices.by_distributor') }}
                    </span>
                    <span class="mx-2">
                        <span class="badge badge-danger p-2">
                        </span>
                        {{ __('site.invoices.by_user') }}
                    </span>
                </span>
            </div>
        </div>
    </x-slot>
    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.users_invoices')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 0px;">
                    {{ __('datatable.invoice_serial') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr class="fw-bold">
                    <td>
                        @include('backend.includes.users_invoices_index_menu')
                    </td>
                    <td class="px-1">
                        <span class="badge">
                            @if ($model->eventForCard())
                                {{ $model->card_num ?? '...' }}
                            @else
                                {{ $model->fullname ?? '...' }}
                            @endif
                        </span>
                    </td>
                    <td class="px-2 py-0">
                        <span class="badge badge-lightcoral">
                            {{ __("site.invoices_events.{$model->event_name}") }}
                        </span>
                    </td>
                    <td class="px-2 py-0">
                        <span class="badge badge-info">
                            @if ($model->status == App\Enums\InvoiceTypeEnum::STATUS_NOT_PAITD)
                                {{ $model->paied_price }}
                            @else
                                {{ $model->price }}
                            @endif
                        </span>
                    </td>
                    <td class="px-2 py-0">
                        <span class="badge text-primary fw-bold">
                            {{ now()->parse($model->printed_at)->format('Y-m-d') }}
                        </span>
                    </td>
                    <td class="px-2 py-0">
                        <span class="badge badge-warning">
                            {{ now()->parse($model->started_at)->format('Y-m-d') ?? __('site.invoices.action_not_performed') }}
                        </span>
                    </td>
                    <td class="px-2 py-0">
                        <span
                            class="badge badge-{{ __("site.invoices_action_color.{$model->action}") }}">
                            {{ __("site.invoices_action.{$model->action}") }}
                        </span>
                    </td>
                    <td class="px-2 py-0">
                        <span
                            class="badge badge-{{ __("site.invoices_status_color.{$model->status}") }}">
                            @if ($model->status == App\Enums\InvoiceTypeEnum::STATUS_NOT_PAITD)
                                <span>{{ __('new_trans.remaining') }}</span>
                                <span>
                                    {{ (int) $model->price - (int) $model->paied_price }}
                                </span>
                                <span>{{ getViewCurrency() }}</span>
                            @else
                                {{ __("site.invoices_status.{$model->status}") }}
                            @endif
                        </span>
                    </td>
                    <td class="px-2 py-0">
                        <span class="badge badge-{{ $model->renderActionBy()['color'] }}">
                            @if ($model->renderActionBy()['by'] == 'system')
                                {{ __('site.invoices.bu_system') }}
                            @elseif ($model->renderActionBy()['by'] == 'user')
                                {{ __('site.invoices.by_user') }}
                            @else
                                {{ $model->admin_name ?? ($model->content['admin_name'] ?? 'المدير') }}
                            @endif
                        </span>
                    </td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif
    </x-slot>
</x-datatable>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/ar.js"></script>

<script>
    flatpickr('#date-range', {
           dateFormat: 'Y-m-d', // Set your desired date format
           enableTime: false,   // Enable or disable time selection
           mode: 'range',       // Enable date range selection
           locale: 'ar',        // Set the locale to Arabic
           // Add more custom options as needed
       });
       flatpickr('#date-rangetwo', {
              dateFormat: 'Y-m-d', // Set your desired date format
              enableTime: false,   // Enable or disable time selection
              mode: 'range',       // Enable date range selection
              locale: 'ar',        // Set the locale to Arabic
              // Add more custom options as needed
          });
</script>


<script>
window.addEventListener('closePaymentModal', event => {

  // var closeButtons = document.querySelectorAll('.modal button[data-action="closePaymentModal"][data-bs-dismiss="modal"]');
  // closeButtons.forEach(function (closeButton) {
  //     closeButton.click();
  // });

    var modalBackdrops = document.querySelectorAll('.modal-backdrop');
    modalBackdrops.forEach(function (modalBackdrop) {
        modalBackdrop.remove();
    });

    // Get the body element
    var bodyElement = document.body;

    // Remove the 'modal-open' class from the body
    bodyElement.classList.remove('modal-open');


});

</script>
@endpush
