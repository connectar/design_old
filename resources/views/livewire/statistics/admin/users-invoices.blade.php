
<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-md-6">
            <span class="btn btn-sm btn-warning">
                {{ __('site.invoices.title') }}
            </span>
        </div>
        <div class="box-header py-2 ">
            <div class="d-inline-flex">
                <div class="mx-4">
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
                <div>
                    <span class="text-primary px-1">
                        <i class="fa fa-user text-primary px-1"></i>
                        {{ __('site.invoices.distributors') }}
                    </span>
                    <select class="form-select d-inline bg-lightest text-white" style="max-width: 250px"
                    wire:model="selected_distributor_id">
                    <option value="">الكل</option>
                    @foreach ($distributors as $distributor)
                    <option value="{{ $distributor->id }}">{{ $distributor->fullname }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-sm-12 col-md-auto">
                        @if ($printed_at_range)
                        <div>
                            <p class="px-3 text-sm">تاريخ طباعة <span class="text-primary">{{ $printed_at_range }}</span></p>
                        </div>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-auto">
                        @if ($started_at_range)
                        <div>
                            <p class="px-3 text-sm">تاريخ محاسبة <span class="text-primary">{{ $started_at_range }}</span></p>
                        </div>
                        @endif
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
                        <span class="badge badge-dark">
                            @if (($page ?? 1) != 1)
                                {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                            @else
                                {{ $loop->index + 1 }}
                            @endif
                        </span>
                        <span
                            class=" px-2 badge badge-{{ __("site.invoices_status_color.{$model->status}") }}">
                            {{ $model->id }}
                        </span>
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
                                <span>{{ __("new_trans.remaining") }}</span>
                                <span>
                                    {{ (int) $model->price - (int) $model->paied_price }}
                                </span>
                                <span class="text-sm">{{getViewCurrency()}}</span>
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
