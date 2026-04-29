<div class="col-md-6">
    <div class="form-group row">
        <label for="quta" class="form-label text-primary">
            {{ __('adding.offer.quta_after_expired') }}
        </label>
        <div>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-cloud-download"></i>
                </div>
                <input class="form-control" type="number" min="0"
                    placeholder="{{ __('adding.offer.quta2_placeholder') }}" name="expire_quta"
                    x-model="offer.expire_quta_details.expire_quta">
                <div class="input-group-addon p-0">
                    <select class="form-select" name="expire_quta_unit"
                        x-model="offer.expire_quta_details.expire_quta_unit">
                        @foreach (config('offers.quta_unit') as $unit)
                            <option value="{{ $unit }}">
                                {{ __('adding.offer.quta_' . $unit) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <x-offer-speed class="col-md-8" name="expire_speed"
        speed-title="{{ __('adding.offer.speed_after_expired') }}"
        x-model="offer.expire_quta_details.expire_speed" />
</div>
