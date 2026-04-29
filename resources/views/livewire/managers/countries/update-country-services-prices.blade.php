<div class="box">
    <div class="box-body">
        <h3 class="px-4 pb-4 mb-4">
            تعديل اسعار خدمات الدولة
            <span class="text-primary">
                ({{ $country->getName() }})
            </span>
            {{-- <span class="text-primary">
                ({{ $country->getCurrency() }})
            </span>
            <span class="text-primary">
                ({{ $country->getCurrencyCode() }})
            </span> --}}
        </h3>
        <div class="row px-4">
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
                            wire:model="subscription_fee" id="subscription_fee"
                            value="{{ $prices['subscription_fee'] ?? 0 }}">
                        </div>
                        @error('subscription_fee')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
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
                            wire:model="subscription_fee_dollar" id="subscription_fee"
                            value="{{ $prices['subscription_fee_dollar'] ?? 0 }}">
                        </div>
                        @error('subscription_fee_dollar')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
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
                            wire:model="buy_nas" id="buy_nas"
                            value="{{ $prices['buy_nas'] ?? 0 }}">
                        </div>
                        @error('buy_nas')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
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
                            wire:model="buy_nas_dollar" id="buy_nas"
                            value="{{ $prices['buy_nas_dollar'] ?? 0 }}">
                        </div>
                        @error('buy_nas_dollar')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
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
                            wire:model="reinstall_network_fee" id="reinstall_network_fee"
                            value="{{ $prices['reinstall_network_fee'] ?? 0 }}">
                        </div>
                        @error('reinstall_network_fee')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="{{ route('managers.countries.index') }}" class="btn btn-danger  my-4 mx-2">
                {{ __('site.cancel') }}
            </a>
            <button class="btn btn-success my-4" wire:click="updateCountryServicesPricesAction()">
                {{ __('site.edit') }}
            </button>
        </div>
    </div>
</div>
