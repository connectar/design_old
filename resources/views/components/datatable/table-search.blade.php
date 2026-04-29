<div id="complex_header_filter" class="dataTables_filter">
    <label>
        {{ __('datatable.serach') }}
        <input type="search" class="form-control form-control-sm bg-lightest" wire:model.live.debounce.500ms="search"
            placeholder="{{ __('datatable.serach') }}" aria-controls="complex_header" dir="auto">
    </label>
</div>
