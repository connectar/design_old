<div class="row">
    <div class="col-md-2">
        <div class="dataTables_length pt-2" id="complex_header_length">
            <label>
                {{ __('datatable.show') }}
                <select aria-controls="complex_header" class="form-select form-control-sm" wire:model.live="perPage">
                    @foreach ($menuItems as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </label>
        </div>
    </div>
    <div class="col-md-10">
        {{ $paginatedData->links('vendor.pagination.livewire.crypto_paginate')  }}
    </div>
</div>
