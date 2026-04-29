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
                    <select class="selectpicker form-select show-tick p-0" name="userData[nas_serial]"
                        x-model="user.nas_serial">
                        <x-network-nas />
                    </select>
                </div>
            </div>
        </div>
    </div>
    {{-- offer name --}}
    @if (authIsAdmin())
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
                            <x-network-offers selected-offer="{{ $user->offer_id }}" />
                        </select>
                    </div>
                </div>
            </div>
        </div>
    @else
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
                        <input class="form-control" type="text" value="{{ $user->offer->name }}">
                    </div>
                </div>
            </div>
        </div>
    @endif
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
                        name="userData[connection_type]" x-model="user.connection_type">
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
                        id="fullname" x-model="user.fullname">
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
                        id="username" x-model="user.username">
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
                        id="password" x-model="user.password">
                </div>
            </div>
        </div>
    </div>
    {{-- password --}}
</div> <!-- end of row-->
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="payment_type" class="form-label">@lang('adding.user.payment_type')</label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                    </div>
                    <input class="form-control" type="text"
                        value="{{ __('networks.user.payment_types.' . $user->payment_type) }}"
                        disabled>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="shared_users" class="form-label" x-show="user.connection_type != 'MAC'">
                {{ __('adding.user.shared') }}
            </label>
            <label for="devices" class="form-label" x-show="user.connection_type == 'MAC'">
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
                    <input class="form-control" type="text" name="userData[city]"
                        id="city" x-model="user.city">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="send_sms" class="form-label">
                {{ __('adding.user.send_sms') }}
            </label>
            <div class="input-group">
                <div class="input-group-addon py-0">
                    <label class="switch switch-success">
                        <input name="userData[send_sms]" type="checkbox" x-model="phoneIsEnabled"
                            x-on:change="togglePhone()" />
                        <span class="switch-indicator"></span>
                    </label>
                </div>
                <input class="form-control" type="text" name="userData[phone]" id="phone"
                    placeholder=""  x-model="phone">
                <input type="hidden" name="userData[region]" id="region">
                <!-- x-bind:disabled="phoneIsEnabled == false" -->

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
                            x-on:change="chooseDistributer()" x-model="distributer"
                            name="distributor[]" multiple>
                            <option value="0">
                                {{ __('adding.user.map_without_device') }}
                            </option>
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
                    <select class="selectpicker form-select show-tick p-0" name="userData[map_id]"
                        x-model="user.map_id">
                        <x-maps />
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label class="form-label">
                الإشعارات
            </label>
            <div class="row notify_input_sec">
                <div class="col-6">
                    <div>
                        <label>
                            <input type="hidden" name="userData[is_send_wp]" value="0">
                            <input type="checkbox" x-model="user.is_send_wp" class="default_checkbox" @if($user['is_send_wp']) checked="checked" @endif name="userData[is_send_wp]" value="1">
                            الواتساب
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <label>
                            <input type="hidden" name="userData[is_send_sms]" value="0">
                            <input type="checkbox" x-model="user.is_send_sms" class="default_checkbox" @if($user['is_send_sms']) checked="checked" @endif name="userData[is_send_sms]" value="1">
                            SMS
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            <textarea class="form-control" rows="3" id="notes" name="notes">{{ optional($user->notes)->content }}</textarea>
        </div>
    </div>
</div>
