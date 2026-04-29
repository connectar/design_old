<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="phone" class="form-label">
                {{ __('adding.setting.admin_phones.phone') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                    </div>
                    <input class="form-control" type="text" name="admin_phones[phone]" id="phone"
                        value="{{ $settings['admin_phones']['phone'] ?? '' }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="other_phone" class="form-label">
                {{ __('adding.setting.admin_phones.other_phone') }}
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                    </div>
                    <input class="form-control" type="text" name="admin_phones[other_phone]"
                        id="other_phone"
                        value="{{ $settings['admin_phones']['other_phone'] ?? '' }}">
                </div>
            </div>
        </div>
    </div>
</div>
