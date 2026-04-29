<div class="px-4 my-2">
    <form wire:submit="changeViewCurrencyCode()">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="form-group row">
                    <label for="phone" class="form-label">
                        {{ __('adding.setting.change_view_currency') }}
                    </label>
                    <div>
                        <div>
                            <div class="input-group p-0">
                                <div class="input-group-addon">
                                    <i class="fa fa-flash text-danger"></i>
                                </div>
                                <select class="form-select" id="locale" wire:model.prevent="selectedCurrencyCode">
                                    <option value="{{ $viewCurrency }}">
                                        {{ __("currencies.{$viewCurrency}" ) }}
                                    </option>
                                    @foreach (__('currencies') as $currency_code => $currency)
                                        @if ($viewCurrency != $currency_code)
                                            <option value="{{ $currency_code }}">
                                                {{ $currency }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('selectedCurrencyCode')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" wire:loading.attr='disabled' class="btn btn-success btn-rounded my-1 ">
            {{ __('website.save') }}
        </button>
    </form>
</div>
