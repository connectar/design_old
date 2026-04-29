<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="subscription_fee" class="form-label">
                {{ __('adding.setting.prices.subscription_fee') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                    </div>
                    <input class="form-control" type="number" min="1" max="59"
                        name="prices[subscription_fee]" id="subscription_fee"
                        value="{{ $settings['prices']['subscription_fee'] ?? 0 }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="subscription_fee" class="form-label">
                {{ __('adding.setting.prices.subscription_fee_dollar') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                    </div>
                    <input class="form-control" type="number" min="1" max="59"
                        name="prices[subscription_fee_dollar]" id="subscription_fee"
                        value="{{ $settings['prices']['subscription_fee_dollar'] ?? 0 }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="buy_nas" class="form-label">
                {{ __('adding.setting.prices.buy_nas') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                    </div>
                    <input class="form-control" type="number" min="1" max="59"
                        name="prices[buy_nas]" id="buy_nas"
                        value="{{ $settings['prices']['buy_nas'] ?? 0 }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="buy_nas" class="form-label">
                {{ __('adding.setting.prices.buy_nas_dollar') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                    </div>
                    <input class="form-control" type="number" min="1" max="59"
                        name="prices[buy_nas_dollar]" id="buy_nas"
                        value="{{ $settings['prices']['buy_nas_dollar'] ?? 0 }}">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="buy_nas" class="form-label">
                {{ __('adding.setting.prices.reinstall_network_fee') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                    </div>
                    <input class="form-control" type="number" min="1" max="59"
                        name="prices[reinstall_network_fee]" id="reinstall_network_fee"
                        value="{{ $settings['prices']['reinstall_network_fee'] ?? 0 }}">
                </div>
            </div>
        </div>
    </div>
</div>
