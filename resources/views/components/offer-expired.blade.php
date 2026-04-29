<div class="form-group row">
    <label for="quta" class="form-label fw-bold">
        {{ $qutaTitle }}
    </label>
    <div>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-cloud-download"></i>
            </div>
            <input class="form-control" type="number" min="0"
            placeholder="{{ __('adding.offer.quta_placeholder') }}"
                wire.model.defer="{{ $qutaName }}">
            <div class="input-group-addon p-0">
                <select class="form-select" wire.model.defer="quta_unit">
                    @foreach (config('offers.quta_type') as $unit)
                        <option value="{{ $unit }}">
                            {{ __('adding.offer.quta_' . $unit) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
