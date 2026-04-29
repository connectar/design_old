<div class="col-md-4">
    <div class="form-group row">
        <label for="filter" class="form-label">
            @lang('adding.offer.filter')
        </label>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-shield text-danger"></i>
            </div>
            <select class="selectpickerJs form-select p-0" multiple data-actions-box="true"
                name="filters[]">
                @foreach (config('offers.filters') as $index => $filter)
                    <option data-content='{{ __("adding.offer.{$filter}_content") }}'
                        value="{{ $filter }}" @isset($offer->filters[$filter]) selected
                        @endisset>
                        {{ __("adding.offer.{$filter}") }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group row">
        <label for="after_expired_quta" class="form-label">
            {{ __('adding.offer.after_expired_time') }}
        </label>
        <div>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-tachometer text-success"></i>
                </div>
                <select class="selectpickerJs form-select show-tick p-0" name="expire_time"
                    value="{{ $offer->expire_time ?? '' }}">
                    <option value="END_USER">
                        {{ __('adding.offer.closed') }}
                    </option>
                    <option value="RENEW_USER" @if (isset($offer) && $offer->expire_time == 'RENEW_USER') selected @endif>
                        {{ __('adding.offer.after_expired_time_renew') }}
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group row">
        <label for="ip_pool" class="form-label">
            {{ __('adding.offer.ip_pool') }}
        </label>
        <div>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-money text-success"></i>
                </div>
                <input class="form-control" type="text"
                    placeholder="{{ __('adding.offer.ip_pool_placeholder') }}" id="ip_pool"
                    name="ip_pool" value="{{ $offer->ip_pool ?? '' }}" dir="ltr">
            </div>
        </div>
    </div>
</div>
