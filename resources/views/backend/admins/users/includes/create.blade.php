<div class="row">
    {{-- nas serial --}}
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="nas_serial" class="form-label">
                {{ __('adding.user.nas_name') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-server text-success"></i>
                    </div>
                    <select class="selectpicker form-select show-tick p-0"
                        name="userData[nas_serial]">
                        <x-network-nas />
                    </select>
                </div>
            </div>
        </div>
    </div>
    {{-- offer name --}}
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="offer_id" class="form-label">
                {{ __('adding.user.offer_id') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-tags text-primary"></i>
                    </div>
                    <select class="selectpicker form-select show-tick p-0"
                        name="userData[offer_id]">
                        <x-network-offers />
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="connection_type" class="form-label">
                {{ __('adding.user.connection_type') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-wifi"></i>
                    </div>
                    <select class="selectpicker form-select show-tick p-0"
                        name="userData[connection_type]" x-model="connection_type">
                        @foreach ($connectionTypes as $value => $name)
                            <option value="{{ $value }}">
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div><!-- end of row-->
<div class="row">
    <div class="col-md-4">
        <div class="form-group row">
            <label for="fullname" class="form-label">
                {{ __('adding.user.fullname') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-id-badge"></i>
                    </div>
                    <input class="form-control" type="text" name="userData[fullname]"
                        id="fullname">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label for="username" class="form-label">
                {{ __('adding.user.username') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </div>
                    <input class="form-control" type="text" name="userData[username]"
                        id="username">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label for="password" class="form-label">
                {{ __('adding.user.password') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-key"></i>
                    </div>
                    <input class="form-control" type="text" name="userData[password]"
                        id="password">
                </div>
            </div>
        </div>
    </div>
    {{-- password --}}

    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="payment_type"
                class="form-label">@lang('adding.user.payment_type')</label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                    </div>
                    <x-user-payment-types />
                </div>
            </div>
        </div>
    </div>
    @can('user_previousQuta')
        <div class="col-md-4 col-sm-6">
            <div class="form-group row">
                <label for="quta" class="form-label">
                    {{ __('adding.user.user_quta') }}
                </label>
                <div>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-cloud-download"></i>
                        </div>
                        <input class="form-control" type="number" min="0" name="quta" id="quta"
                            value="0">
                        <div class="input-group-addon p-0">
                            <select class="form-select" name="quta_unit">
                                <option value="GIGA">
                                    {{ __('adding.offer.quta_GIGA') }}
                                </option>
                                <option value="MEGA">
                                    {{ __('adding.offer.quta_MEGA') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="shared_users" class="form-label" x-show="connection_type != 'MAC'">
                {{ __('adding.user.shared') }}
            </label>
            <label for="devices" class="form-label" x-show="connection_type == 'MAC'">
                {{ __('adding.user.devices') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <select class="selectpicker form-select show-tick p-0"
                        name="userData[shared_users]" x-model="shared_users"
                        x-on:change="setMacsCount()">
                        @foreach (range(1, 10) as $number)
                            <option value="{{ $number }}">
                                {{ $number }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="city" class="form-label">
                {{ __('adding.user.city') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <input class="form-control" type="text" name="userData[city]" id="city">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="send_sms" class="form-label">
                {{ __('adding.user.send_sms') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon py-0">
                        <label class="switch switch-success">
                            <input name="userData[send_sms]" type="checkbox"
                                x-model="phoneIsEnabled" x-on:change="togglePhone()" />
                            <span class="switch-indicator"></span>
                        </label>
                    </div>
                    <input class="form-control" type="text" name="userData[phone]" id="phone"
                        placeholder=""
                         x-model="phone">
                    <input type="hidden" name="userData[region]" id="region">
                    <!--
                    x-bind:disabled="phoneIsEnabled == false"
                    -->
                </div>
            </div>
        </div>
    </div>
    @if (authIsAdmin())
        <div class="col-md-4 col-sm-12">
            <div class="form-group row">
                <label for="distributer" class="form-label">
                    {{ __('adding.user.distributer') }}
                </label>
                <div>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </div>
                        <select class="selectpicker form-select show-tick p-0 select_distributor"
                            x-model="distributer" x-on:change="chooseDistributer()"
                            name="distributor[]" multiple>
                            <option value="0">{{ __('adding.user.map_without_device') }}</option>
                            @foreach ($distributors as $distributor)
                                <option value="{{ $distributor['id'] }}">
                                    {{ $distributor['fullname'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-4 col-sm-12">
        <div class="form-group row">
            <label for="send_sms" class="form-label">
                @lang('adding.user.map')
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <select class="selectpicker form-select show-tick p-0" name="userData[map_id]">
                        <x-maps />
                    </select>
                </div>
            </div>
        </div>
    </div>
    @if (authIsAdmin())
        <div class="col-md-4 col-sm-12">
            <div class="form-group row" style="margin-top: 20px">
                <label for="" class="form-label"></label>
                <div>
                    <div class="input-group">
                        <div>
                            <span class="badge badge-success" style="padding:9px">
                                <i class="fa fa-server"></i>
                                {{ __('adding.user_option.change_offer_payment_title') }}
                            </span>
                            <input name="invoice[payment_status]" type="radio" id="radio_32"
                                class="with-gap radio-col-success" value="1" checked>
                            <label for="radio_32">
                                {{ __('adding.user_option.change_offer_payment.1') }}
                            </label>
                            <input name="invoice[payment_status]" type="radio" id="radio_36"
                                class="with-gap radio-col-danger" value="0">
                            <label for="radio_36">
                                {{ __('adding.user_option.change_offer_payment.0') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<div class="row">
    <div class="form-group col-md-12">
        <label for="note">
            {{ __('adding.user.notes') }}
        </label>
        <div class="input-group">
            <span class="input-group-addon vertical-align">
                <i class="fa fa-bookmark">
                </i>
            </span>
            <textarea class="form-control" rows="3" id="notes" name="notes"></textarea>
        </div>
    </div>
</div>
