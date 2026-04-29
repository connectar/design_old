<div class="row">
    <div class="col-md-4">
        <div class="form-group row">
            <label for="domain" class="form-label">
                @lang('adding.setting.manager.domain')
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <input class="form-control" type="text" name="domain" id="domain"
                        placeholder="connect4ar.com"
                        value="{{ $settings['general']['domain'] ?? 'connect4ar.com' }}">
                </div>
                <small class="text-muted d-block mt-1">
                    @lang('adding.setting.manager.domain_hint')
                </small>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label for="ip_host" class="form-label">
                @lang('adding.setting.manager.ip_host')
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-id-badge"></i>
                    </div>
                    <input class="form-control" type="text" name="ip_host" id="ip_host"
                        value="{{ $settings['general']['ip_host'] }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label for="vpn_ip" class="form-label">
                @lang('adding.setting.manager.vpn_ip')
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </div>
                    <input class="form-control" type="text" name="vpn_ip" id="vpn_ip"
                        value="{{ $settings['general']['vpn_ip'] ?? '' }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label for="radius_ip" class="form-label">
                @lang('adding.setting.manager.radius_ip')
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-id-badge"></i>
                    </div>
                    <input class="form-control" type="text" name="radius[ip]" id="radius_ip"
                        value="{{ $settings['general']['radius']['ip'] }}">
                </div>
            </div>
        </div>
    </div>
</div> <!-- end of row-->
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="radius_idle" class="form-label">
                @lang('adding.setting.manager.radius_idle')
            </label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-cloud-download"></i>
                    </div>
                    <input class="form-control" type="number" min="1" max="59" name="radius[idle]"
                        id="radius_idle" value="{{ $settings['general']['radius']['idle'] }}">
                    <div class="input-group-addon">
                        <span>{{ __('adding.setting.manager.time_in_seconds') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="servers_update_time"
                class="form-label">@lang('adding.setting.manager.servers_update_time')</label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-cloud-download"></i>
                    </div>
                    <input class="form-control" type="number" min="1" max="59"
                        name="servers_update_time" id="servers_update_time"
                        value="{{ $settings['general']['servers_update_time'] }}">
                    <div class="input-group-addon">
                        <span>{{ __('adding.setting.manager.time_in_minutes') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="backup_every_hours"
                class="form-label">@lang('adding.setting.manager.backup_every_hours')</label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-database"></i>
                    </div>
                    <input class="form-control" type="number" min="1" max="24"
                        name="backup_every_hours" id="backup_every_hours"
                        value="{{ $settings['general']['backup_every_hours'] ?? 2 }}">
                    <div class="input-group-addon">
                        <span>{{ __('adding.setting.manager.time_in_hours') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="radius_interim_update"
                class="form-label">@lang('adding.setting.manager.radius_interim_update')</label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-cloud-download"></i>
                    </div>
                    <input class="form-control" type="number" min="1" max="59"
                        name="radius[interim_update]" id="radius_interim_update"
                        value="{{ $settings['general']['radius']['interim_update'] }}">
                    <div class="input-group-addon">
                        <span>{{ __('adding.setting.manager.time_in_minutes') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="radius_port_incoming"
                class="form-label">@lang('adding.setting.manager.radius_port_incoming')</label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-cloud-download"></i>
                    </div>
                    <input class="form-control" type="number" name="radius[port]"
                        id="radius_port_incoming"
                        value="{{ $settings['general']['radius']['port'] }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="form-group row">
            <label for="block_users"
                class="form-label">@lang('adding.setting.manager.block_users')</label>
            <div>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-cloud-download"></i>
                    </div>
                    <select class="form-select" name="block_users" id="block_users">
                        <option value="0">لا</option>
                        <option value="1" @if (isset($settings['general']['block_users']) && $settings['general']['block_users'] == 1) selected @endif>نعم
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
