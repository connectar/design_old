<div class="dropdown">
    <div class="clearfix pull-left" >
        <span class="h-20 flex-shrink-0 pull-left">
            <input
                type="checkbox"
                id="md_checkbox_{{ $model->id }}"
                value="{{ $model->id }}"
                class="filled-in chk-col-success checkedId"
                onchange="updateSelectedModels(this)">
            <label for="md_checkbox_{{ $model->id }}"></label>
        </span>


        <span class="badge badge-dark b-1 border-warning">
            @if ($page != 1)
            {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
            {{ $loop->index + 1 }}
            @endif
        </span>
        <span class="dropdown-toggle badge @if ($model->cards_count > 0) badge-success
        @else badge-warning @endif badge-pill" data-bs-toggle="dropdown">
            <span dir="auto">
                {{ $model->username }}
            </span>
        </span>

        <div class="dropdown-menu dropdown-menu-end fw-bold">

            @can('cards_delete')
                @if (authIsSuperAdmin())
                    <a class="dropdown-item py-2 fw-bold" href="#" wire:click="showDeletedBox('{{ $model->id }}')">
                        <i class="fa fa-trash-o text-danger"></i>
                        {{ __('site.user_index.option.delete') }}
                    </a>
                @endif
            @endcan
            @if ($this->cardIsAbleToReset($model))
                <a class="dropdown-item py-2 fw-bold" href="#"
                    wire:click="showWarningBox('{{ $model->id }}')">
                    <i class="fa fa-undo text-primary"></i>
                    {{ __('site.user_index.option.reset_mac') }}
                </a>
            @endif
            <div class="dropdown-divider"></div>
            @if (authIsAdmin())
            <a class="dropdown-item py-2 fw-bold" href="#" wire:click="$dispatch('editExpiredDate','{{ $model->id }}')">
                <i class="fa spi fa-calendar"></i>
                {{ __('site.user_index.option.change_expired_date') }}
            </a>
            @endif
            @can ('user_qutaLog')
            <a class="dropdown-item py-2 fw-bold" href="#" wire:click="$dispatch('showQutaUsage','{{ $model->id }}')">
                <i class="fa fa-cloud-download"></i>
                {{ __('site.user_index.option.show_quta_usage') }}
            </a>
            @endcan
        </div>
    </div>
</div>


@push('scripts')
<script>
    window.addEventListener("showWarningBox", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch("confirmWarningOperation", event.detail.modelId);
            }
        });
    });

    window.addEventListener("showWarningResetMacForCollectionBox", (event) => {
        Swal.fire(event.detail.alert).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch("confirmWarningOperationForCollection");
            }
        });
    });
</script>
<script>
    let selectedModels = @json($selectedModels);

    function updateSelectedModels(checkbox) {
        const modelId = checkbox.value;
        if (checkbox.checked) {
            if (!selectedModels.includes(modelId)) {
                selectedModels.push(modelId);
            }
        } else {
            selectedModels = selectedModels.filter(id => id !== modelId);
        }
        @this.call('updateSelectedModels', selectedModels);
    }
</script>
@endpush
