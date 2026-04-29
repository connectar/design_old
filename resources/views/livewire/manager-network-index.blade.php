<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('managers.networks.create')" :title="__('datatable.add_new_network')" />
        @auth('admin')
            @php
                $__wipeAdmin = auth('admin')->user();
                $__canWipe = $__wipeAdmin && in_array($__wipeAdmin->type, [
                    \App\ENUMS\AdminTypeEnum::TYPE_MANGER,
                    \App\ENUMS\AdminTypeEnum::TYPE_SUPER_MANGER,
                ], true);
            @endphp
            @if ($__canWipe)
                <button type="button" class="btn btn-danger fw-bold ms-2" data-bs-toggle="modal"
                    data-bs-target="#wipeAllNetworksModal" title="{{ __('customer_migration.wipe_card_intro') }}">
                    <i class="fa fa-trash"></i>
                    {{ __('customer_migration.wipe_btn_open') }}
                </button>
            @endif
        @endauth
        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>

    <x-slot name="thead">
        <th>
            <span class="badge" wire:click="orderBy('fullname')">
                <span class="ps-5">#</span>
                <span style="padding-right: 20px">
                    {{ __('datatable.manager_network_key') }}
                </span>
            </span>
            @if ($orderByColumn == 'fullname')
                <span>
                    <i class="fa {{ $sortIcon }} text-primary"></i>
                </span>
            @endif
        </th>
        @foreach (trans('datatable.manager_network_index') as $column => $value)
            <th>
                <span class="badge" wire:click="orderBy('{{ $column }}')">
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
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr>
                    <td class="py-2" x-data="{ showChangeBillingCurrencyModal: false }"
                        x-on:close-change-billing-currency-modal.window="showChangeBillingCurrencyModal = false; $wire.set('showChangeBillingCurrencyModalId', '');">
                        <div class="dropdown">
                            <div class="clearfix pull-left">
                                <span class="badge badge-dark b-1 border-warning">
                                    @if (($page ?? 1) != 1)
                                        {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                    @else
                                        {{ $loop->index + 1 }}
                                    @endif
                                </span>
                                <span class="dropdown-toggle badge badge-warning" data-bs-toggle="dropdown">
                                    <span dir="auto">
                                        {{ $model->fullname }}
                                    </span>
                                </span>
                                <div class="dropdown-menu dropdown-menu-end fw-bold">
                                    <a class="dropdown-item py-2 fw-bold fw-bold text-primary"
                                        wire:click="loginAsAdmin('{{ $model->admin_id }}')">
                                        <i class="fa fa-hand-lizard-o"></i>
                                        {{ __('site.manager_nas.login') }}
                                    </a>

                                    <a class="dropdown-item py-2 fw-bold" href="#"
                                        wire:click="$dispatch('charge','{{ $model->id }}')">
                                        <i class="fa fa-money text-success"></i>
                                        {{ __('site.network_index.charge') }}
                                    </a>
                                    <a class="dropdown-item py-2 fw-bold fw-bold"
                                        href="{{ route('managers.networks.edit', $model->id) }}">
                                        <i class="fa fa-pencil"></i>
                                        {{ __('site.user_index.option.edit') }}
                                    </a>
                                    <a class="dropdown-item py-2 fw-bold fw-bold" href="#" x-data="{
                                        customDelete(networkId) {
                                            let message = '<span class=\'text-primary\'>Ù‡Ù„ Ø§Ù†Øª Ù…ØªØ§ÙƒØ¯ Ù…Ù† Ø§Ù†Ùƒ ØªØ±ÙŠØ¯ Ø­Ø°Ù Ø§Ù„ÙƒØ±ÙˆØª Ù†Ù‡Ø§Ø¦ÙŠØ§ Ù…Ù† Ù‡Ø°Ù‡ Ø§Ù„Ø´Ø¨ÙƒØ© Ù„Ø§ÙŠÙ…ÙƒÙ† Ø§Ù„ØªØ±Ø§Ø¬Ø¹</span>';
                                            swalAlert(message).then((result) => {
                                                if (result.isConfirmed) {
                                                    console.log(networkId);
                                                    $wire.call('forceDeleteNetworkHotspotCards', networkId);
                                                }
                                            });
                                        }
                                    }"
                                        @click="customDelete('{{ $model->id }}')">
                                        <i class="fa fa-trash text-danger"></i>
                                        {{ __('new_trans.delete_hotspotcards') }}
                                    </a>
                                    @if (config('networks.allow_deleting'))
                                        <a class="dropdown-item py-2 fw-bold fw-bold" href="#"
                                            wire:click.prevent="showDeletedBox({{ $model->id }})">
                                            <i class="fa fa-trash text-danger"></i>
                                            {{ __('new_trans.delete') }}
                                        </a>
                                    @endif
                                    @if (config('networks.allow_change_billing_currency'))
                                        <div>
                                            <a class="dropdown-item py-2 fw-bold fw-bold" href="#"
                                                x-on:click="$wire.set('showChangeBillingCurrencyModalId', '{{ $model->id }}');showChangeBillingCurrencyModal = true;">
                                                <i class="fa fa-exchange text-dark"></i>
                                                {{ __('new_trans.change_billing_currency') }}
                                            </a>
                                        </div>
                                    @endif
                                    @if (config('networks.allow_refund'))
                                        <a class="dropdown-item py-2 fw-bold fw-bold" href="#"
                                            wire:click="openRefundModal({{ $model->id }})">
                                            <i class="fa fa-reply text-danger"></i>
                                            {{ __('new_trans.refund') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($showChangeBillingCurrencyModalId == $model->id)
                            <livewire:manager.networks.change-billing-currency-modal
                                show="showChangeBillingCurrencyModal"
                                wire:key="{{ now() . '-change-billing-currency-modal-' . rand(1, 9999) }}"
                                :modelId="$model->admin_id" />
                        @endif
                    </td>
                    @if ($refundModalOpen && $refundModalOpen !== false && !empty($refundModalId) && $refundModalId === $model->id)
                        {{-- <div wire:ignore.self wire:key="modal-refund-{{ $model->admin_id }}"  class="modal fade" id="modal-refund-{{ $model->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;padding-right:0px!important;"> --}}
                        <div class="modal show" id="modal-refund-{{ $model->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true"
                            style="display:block;padding-right:0px!important;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-white">{{ __('new_trans.refund_network.title') }}
                                        </h4>
                                        <button type="button" wire:click='closeRefundModal' aria-label="Close"
                                            class="btn btn-danger py-1 px-2" style="height:50%;">
                                            <i class="fa fa-times fa-x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body p-2">
                                        <form wire:submit="refundNetworkAdmin({{ $model->admin_id }})">
                                            <div class="container my-3">
                                                <div class="p-2 ">
                                                    <h5 class="text-primary">
                                                        {{ trans('new_trans.refund_network.network_admin_name', ['fullname' => $model->fullname ?? 'ØºÙŠØ± Ù…Ø¹Ø±ÙˆÙ']) }}
                                                    </h5>
                                                </div>
                                                <div class="row">
                                                    @if ($disable_network != 'refund_last_invoice')
                                                        <div class="col-12 mx-auto">
                                                            <div class="form-group row">
                                                                <label for="message" class="col-form-label  ">
                                                                    {{ trans('new_trans.refund_network.refund_amount') }}
                                                                </label>
                                                                <div>
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-money"></i>
                                                                        </div>
                                                                        <input class="form-control" type="number"
                                                                            step="any" min="1"
                                                                            wire:model="refund_amount">
                                                                    </div>
                                                                </div>
                                                                @error('refund_amount')
                                                                    <div class="error text-danger mt-2">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-12 ">
                                                        <div class="form-group row">
                                                            <h5 class="col-form-label text-light">
                                                                {{ trans('new_trans.refund_network.disable_network') }}
                                                            </h5>
                                                            <div class="col-sm-12 py-3 px-4">
                                                                <div class="d-flex justify-content-around">
                                                                    <div>
                                                                        <input name="disable_network"
                                                                            wire:model="disable_network" type="radio"
                                                                            id="radio_32"
                                                                            class="with-gap radio-col-success "
                                                                            value="disable_and_refund">
                                                                        <label for="radio_32">
                                                                            {{ trans('new_trans.refund_network.disable') }}
                                                                        </label>
                                                                    </div>
                                                                    <div>
                                                                        <input name="disable_network"
                                                                            wire:model="disable_network"
                                                                            type="radio" id="radio_36"
                                                                            class="with-gap radio-col-danger"
                                                                            value="only_add_the_debt">
                                                                        <label for="radio_36">
                                                                            {{ trans('new_trans.refund_network.only_add_the_debt') }}
                                                                        </label>
                                                                    </div>
                                                                    <div>
                                                                        <input name="disable_network"
                                                                            wire:model="disable_network"
                                                                            type="radio" id="radio_101"
                                                                            class="with-gap radio-col-primary"
                                                                            value="refund_last_invoice">
                                                                        <label for="radio_101">
                                                                            {{ trans('new_trans.refund_network.refund_last_invoice') }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                @error('disable_network')
                                                                    <div class="error text-danger mt-2">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="p-2 text-sm px-3">
                                                            {{ trans('new_trans.refund_network.description') }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-end">
                                                <button wire:click.submit="refundNetworkAdmin({{ $model->admin_id }})"
                                                    wire:loading.attr="disabled"
                                                    class="btn btn-success text-start">{{ __('new_trans.refund') }}</button>
                                                <button type="button" data-action="closePaymentModal"
                                                    class="btn btn-danger text-start"
                                                    wire:click='closeRefundModal'>{{ __('new_trans.close') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    @endif
                    {{-- <td class="p-0" width="25px">
                        <span class="badge text-primary">
                            {{ $model->name }}
                        </span>
                    </td>
                    <td class="p-0" width="25px">
                        <span class="badge">
                            {{ $model->phone }}
                        </span>
                    </td> --}}
                    <td class="p-0" width="25px">
                        <span class="badge badge-info">
                            {{ $model->plan_name }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-success">
                            {{ $model->users_count + $model->cards_count }}
                        </span>
                    </td>

                    <td class="no-padding">
                        <span class="badge badge-success">
                            {{ $model->nas_count }}
                        </span>
                    </td>
                    {{-- <td class="no-padding">
                        @if ($model->online_count > 0)
                            <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                        @else
                            <i class="fa fa-circle text-danger"></i>
                        @endif
                        <span class="badge badge-secondary">
                            {{ $model->online_count }}
                        </span>
                    </td> --}}

                    <td class="no-padding">
                        <span class=" text-success">
                            {{ $model->account ?? 0 }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class=" text-primary">
                            {{ now()->parse($model->lease_expired_at)->format('Y-m-d') }}
                        </span>
                    </td>
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
        @endif

    </x-slot>
</x-datatable>
