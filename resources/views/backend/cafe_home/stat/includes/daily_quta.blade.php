{{-- daily quta --}}
<div class="row">
    <div class="col-md-2">
        <div class="form-group row">
            <label for="enable_daily_quta" class=" form-label">@lang('adding.offer.enable_daily_quta')
            </label>
            <label class="switch switch-danger">
                <input type="checkbox" name="daily_quta" x-model="daily_quta"
                    x-on:click="expire_monthly_quta = 'END_USER'" />
                <span class="switch-indicator"></span>
            </label>
        </div>
    </div>

    <div class="col-md-6" x-show="daily_quta">
        <div class="form-group row">
            <label for="daily_quta" class="form-label">@lang('adding.offer.daily_quta')</label>
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-download"></i>
                </div>
                <select class="form-select w-90">
                    <option>@lang('adding.offer.daily_quta_all')</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4" x-show="daily_quta">
        <div class="form-group row">
            <label for="after_expired_daily_quta"
                class="form-label">@lang('adding.offer.after_expired_daily_quta')</label>

            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-tachometer text-success"></i>
                </div>
                <select class="selectpickerJs form-select show-tick p-0" name="offerData[expire_daily_quta]"
                    x-model="expire_daily_quta">
                    <option value="END_USER">
                        {{ __('adding.offer.daily_quta_end_user') }}
                    </option>
                    <option value="SET_QUTA">
                        {{ __('adding.offer.expire_quta_action_SET_QUTA') }}
                    </option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row" x-show="expire_daily_quta == 'SET_QUTA'">
    <div class="col-md-6">
        <x-offer-expired qutaName="expiredMonthlyQuta" quta-title="{{ __('adding.offer.quta_after_expired') }}" />
    </div>
    <div class="col-md-6">
        <x-offer-speed class="col-md-6 fw-bold" name="8989" speed-title="89898" />
    </div>
</div>
{{-- daily quta --}}
