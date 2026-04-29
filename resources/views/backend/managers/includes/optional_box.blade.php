@php
    use App\ENUMS\AdminTypeEnum;
@endphp
<div class="dropdown">
    <div class="clearfix pull-left" x-data="{ showAddBalanceModal: false }">
        <span class="h-20 flex-shrink-0 pull-left">
            <input value="{{ $model->id }}" type="checkbox" id="md_checkbox_{{ $model->id }}"
                class="filled-in chk-col-success checkedId">
            <label for="md_checkbox_{{ $model->id }}"></label>
        </span>
        <span
            class="badge badge-dark b-1 @if ($model->cards_count > 0) border-success
        @else border-warning @endif">
            {{ $loop->index + 1 }}
        </span>
        <span
            class="dropdown-toggle badge @if ($model->cards_count > 0) badge-success
        @else badge-warning @endif badge-pill"
            data-bs-toggle="dropdown">
            <span dir="auto">
                {{ $model->fullname }}
            </span>
        </span>
        <span class="badge badge-dark b-1 border-warning mx-1">
            {{ AdminTypeEnum::matchLabelAdminTypes($model->type) }}
        </span>

        <div class="dropdown-menu dropdown-menu-end fw-bold">

            <a class="dropdown-item py-2 fw-bold fw-bold" href="{{ route('managers.edit', $model->id) }}">
                <i class="fa fa-pencil"></i>
                {{ __('site.user_index.option.edit') }}
            </a>
            @if ($model->type == AdminTypeEnum::TYPE_SYSTEM_DISTRIBUTOR)
                <a class="dropdown-item py-2 fw-bold fw-bold" href="#" x-on:click="showAddBalanceModal = true">
                    <i class="fa fa-plus"></i>
                    اضافة رصيد
            @endif
            <a class="dropdown-item py-2 fw-bold" href="#" wire:click="showDeletedBox('{{ $model->id }}')">
                <i class="fa fa-trash-o text-danger"></i>
                {{ __('site.user_index.option.delete') }}
            </a>
            <div class="dropdown-divider"></div>
        </div>
        @if ($model->type == AdminTypeEnum::TYPE_SYSTEM_DISTRIBUTOR)
            <livewire:manager.system-distributor.add-balance-to-system-distributor-modal show="showAddBalanceModal"
                :systemDistributor="$model" :key="now() . random_int(1, 999999)" />
        @endif
    </div>
</div>
