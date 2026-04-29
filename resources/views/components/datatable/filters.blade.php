<div class="row pt-2">
    <div class="col-md-8">
        <div class="form-group">
            <!-- Responsive flex container -->
            <div class=" d-flex flex-column flex-md-row align-items-stretch gap-2">
                <div class="input-group">
                    <!-- Label + icon -->
                    <div class="input-group-addon">
                        <i class="fa fa-server"></i>
                        <span class="px-2">{{ __('datatable.choose_nas') }}</span>
                    </div>
                    <!-- NAS dropdown -->
                    <select class="form-select" wire:model.live="selectedNas">
                        @foreach ($nas as $index => $nas)
                            <option value="{{ $nas['serial'] }}">{{ $nas['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter dropdown -->
                <select class="form-select" wire:model.live="filterUsed">
                    @foreach ($filters as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>

                <!-- Slot content if exists -->
                {{ $slot ?? '' }}

                <!-- Refresh button -->
                <button wire:click="$refresh" class="btn btn-sm btn-outline btn-primary">
                    <i class="fa fa-refresh"></i>
                </button>
            </div>
        </div>
    </div>
</div>
