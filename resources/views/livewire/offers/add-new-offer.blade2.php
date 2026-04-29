<div class="row">
    <form wire:submit="save" novalidate>
        <div class="box bt-3 border-success">
            <x-datatable.loading />
            <div class="box-header with-border p-2 px-4">
                <h4 class="box-title">
                    <span class="badge badge-warning badge-pill fw-bold">
                        <i class="fa spi fa-plus px-2"></i>
                        @lang('adding.offer.create_title')
                    </span>
                </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="row">
                        {{-- show offer input --}}
                        <div class="col-md-2">
                            <div class="form-group row">
                                <label for="show_profile" class="form-label">
                                    {{ __('adding.offer.show_profile') }}
                                </label>
                                <label class="switch switch-success">
                                    <input type="checkbox" wire:model.defer="show" checked />
                                    <span class="switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                        {{-- offer name input --}}
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="name" class="form-label">
                                    {{ __('adding.offer.name') }}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tags text-primary"></i>
                                        </div>
                                        <input class="form-control" type="text"
                                            placeholder="{{ __('adding.offer.name_placeholder') }}" id="name"
                                            wire:model.defer="name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- offer price input --}}
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="price" class="form-label">
                                    {{ __('adding.offer.price') }}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money text-success"></i>
                                        </div>
                                        <input class="form-control" type="number"
                                            placeholder="{{ __('adding.offer.price_placeholder') }}" id="price"
                                            wire:model.defer="price">
                                        <div class="input-group-addon">
                                            جنيه
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <x-offer-speed class="col-md-8" name="speed" speed-title="{{ __('adding.offer.speed') }}" />
                        {{-- duration --}}
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="duration" class="form-label">
                                    {{ __('adding.offer.duration') }}
                                </label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o text-primary"></i>
                                    </div>
                                    <input class="form-control" type="number" min="1" value="1"
                                        placeholder="{{ __('adding.offer.duration_placeholder') }}"
                                        wire:model.defer="duration" id="duration">
                                    <div class="input-group-addon p-0">
                                        <select class="form-select" wire.model.defer="duration_unit">
                                            <option value="MONTH">
                                                {{ __('adding.offer.duration_label_month') }}
                                            </option>
                                            <option value="DAY">
                                                {{ __('adding.offer.duration_label_day') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="quta" class="form-label">
                                    {{ __('adding.offer.quta') }}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-cloud-download text-warning"></i>
                                        </div>
                                        <input class="form-control" type="number" min="0"
                                            placeholder="{{ __('adding.offer.quta_placeholder') }}"
                                            wire.model.defer="quta">
                                        <div class="input-group-addon p-0">
                                            <select class="form-select" wire.model.defer="quta_unit">
                                                @foreach (config('offers.quta_type') as $unit)
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

                        <div class="col-md-4" wire:ignore>
                            <div class="form-group row">
                                <label for="after_expired_quta"
                                    class="form-label">@lang('adding.offer.after_expired_quta')</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tachometer text-success"></i>
                                        </div>
                                        <select class="selectpickerJs form-select show-tick p-0" id="expiredQutaAction">
                                            @foreach ($expiredQutaActions as $key => $type)
                                            <option class="mb-10" value="{{ $type }}">
                                                {{ $key }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" wire:ignore>
                            <div class="form-group row">
                                <label for="filter" class="form-label">
                                    @lang('adding.offer.filter')
                                </label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-shield text-danger"></i>
                                    </div>
                                    <select class="selectpickerJs form-select p-0" multiple data-actions-box="true"
                                        id="filters">
                                        @foreach (config('offers.filters') as $index => $filter)
                                        <option data-content='{{ __("adding.offer.{$filter}_content") }}'
                                            value="{{ $filter }}">
                                            {{ __("adding.offer.{$filter}") }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($showExpiredMonthlyQutaAction)
                    <x-offer-expired qutaName="expiredMonthlyQuta" speedName="expiredMonthlySpeed"
                        speed-title="{{ __('adding.offer.speed_after_expired') }}"
                        quta-title="{{ __('adding.offer.quta_after_expired') }}" />
                    @endif
                    <!-- /.col -->
                    {{-- enable_daily_quta --}}
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group row">
                                <label for="enable_daily_quta"
                                    class=" form-label">@lang('adding.offer.enable_daily_quta')
                                </label>
                                <label class="switch switch-danger">
                                    <input type="checkbox" wire:model="enableDailyQuta" />
                                    <span class="switch-indicator"></span>
                                </label>
                            </div>
                        </div>
                        {{-- daily quta --}}
                        @if ($enableDailyQuta)
                        <div class="col-md-6">
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
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="after_expired_daily_quta"
                                    class="form-label">@lang('adding.offer.after_expired_daily_quta')</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-tachometer text-success"></i>
                                    </div>
                                    <select class="selectpickerJs form-select show-tick p-0"
                                        name="offerData[expire_daily_quta]">
                                        <option value="END_USER">
                                            {{ __('adding.offer.daily_quta_end_user') }}
                                        </option>
                                        <x-network-offers />
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{-- enable_daily_quta --}}
                    {{-- enable_peak_time --}}
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group row">
                                <label for="enable_peak_time" class="form-label">
                                    {{ __('adding.offer.enable_peak_time') }}
                                </label>
                                <div class="col-sm-9">
                                    <label class="switch switch-danger">
                                        <input type="checkbox" wire:model="enablePeakTime" />
                                        <span class="switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @if ($enablePeakTime)
                        <x-offer-speed class="col-md-6 text-primary fw-bold" name="peakTimeSpeed"
                            speed-title="{{ __('adding.offer.speed') }}" />
                        {{-- peak time duration --}}
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="after_expired_quta" class="form-label text-success fw-bold">
                                            @lang('adding.offer.time_from')
                                        </label>
                                        <div>
                                            <div class="input-group bootstrap-timepicker">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o text-success"></i>
                                                </div>
                                                <input class="form-control timepicker" type="text"
                                                    name="peak_time_start">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="after_expired_quta" class="form-label text-danger fw-bold">
                                            @lang('adding.offer.time_to')
                                        </label>
                                        <div>
                                            <div class="input-group bootstrap-timepicker">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o text-danger"></i>
                                                </div>
                                                <input class="form-control timepicker" type="text"
                                                    name="peak_time_end">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- peak time duration --}}
                        </div>
                        @endif
                    </div>
                    {{-- enable_peak_time --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="after_expired_quta"
                                    class="form-label">@lang('adding.offer.after_expired_time')</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tachometer text-success"></i>
                                        </div>
                                        <select class="selectpickerJs form-select show-tick p-0"
                                            name="offerData[expire_time]">
                                            <option value="END_USER">@lang('adding.offer.closed')</option>
                                            <option value="RENEW_USER">
                                                @lang('adding.offer.after_expired_time_renew')
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer pb-0">
                        <a href="{{ route('admins.nas.index') }}"
                            class="btn btn-dark btn-rounded">@lang('website.cancel')</a>
                        <button type="submit" class="btn btn-success btn-rounded">@lang('website.save')</button>
                    </div>
                </div>
    </form>
</div>