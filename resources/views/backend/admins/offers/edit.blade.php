@extends('backend.layouts.admin')

@section('content')
    <form id="FormSubmit" action="{{ route('admins.offers.update', $offer->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="box">
            <x-box-header back-text="{{ __('adding.offer.offers_title') }}" title="{{ __('adding.offer.edit_title') }}"
                back-route="{{ route('admins.offers.index') }}" />
            <div class="box-body">
                <div class="row" x-data="editOffer">
                    <div class="row">
                        {{-- show offer input --}}
                        <div class="col-md-2">
                            <div class="form-group row">
                                <label for="show_profile" class="form-label">
                                    {{ __('adding.offer.show_profile') }}
                                </label>
                                <label class="switch switch-success">
                                    <input type="checkbox" name="show" x-bind:checked="offer.show == 1" />
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
                                            name="name" x-model="offer.name">
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
                                        <input class="form-control" type="number" min="0"
                                            placeholder="{{ __('adding.offer.price_placeholder') }}" id="price"
                                            name="price" x-model="offer.price">
                                        <div class="input-group-addon">
                                            {{ getViewCurrency() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <x-offer-speed class="col-md-8" name="speed" speed-title="{{ __('adding.offer.speed') }}"
                                x-model="offer.speed" />
                        </div>
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
                                        placeholder="{{ __('adding.offer.duration_placeholder') }}" name="duration"
                                        id="duration" x-model="offer.duration">
                                    <div class="input-group-addon p-0">
                                        <select class="form-select" name="duration_unit" x-model="offer.duration_unit">
                                            <option value="MONTH">
                                                {{ __('adding.offer.duration_label_month') }}
                                            </option>
                                            <option value="DAY">
                                                {{ __('adding.offer.duration_label_day') }}
                                            </option>
                                            <option value="HOUR">
                                                {{ __('adding.offer.duration_label_hour') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- quta --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="quta" class="form-label">
                                    {{ __('adding.offer.quta_type_label') }}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-cloud-download text-warning"></i>
                                        </div>
                                        <select class="form-select" name="quta_type" x-model="offer.quta_type">
                                            @foreach (config('offers.quta_type') as $unit)
                                                <option value="{{ $unit }}">
                                                    {{ __('adding.offer.quta_type_' . $unit) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="quta" class="form-label">
                                    {{ __('adding.offer.quta_unit_label') }}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-cloud-download text-warning"></i>
                                        </div>
                                        <input class="form-control" type="number" min="0"
                                            placeholder="{{ __('adding.offer.quta_placeholder') }}" name="quta"
                                            x-model="offer.quta">
                                        <div class="input-group-addon p-0">
                                            <select class="form-select" name="quta_unit" x-model="offer.quta_unit">
                                                @foreach (config('offers.quta_unit') as $unit)
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

                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="after_expired_quta" class="form-label">
                                    @lang('adding.offer.after_expired_quta')
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tachometer text-success"></i>
                                        </div>
                                        <select class="selectpickerJs form-select show-tick p-0"
                                            x-model="expire_quta_action" name="expire_quta_action">
                                            @foreach (config('offers.expire_quta') as $index)
                                                <option class="mb-10" value="{{ $index }}">
                                                    {{ __('adding.offer.expire_quta_action_' . $index) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" x-show="expire_quta_action == 'SET_QUTA'">
                        @include('backend.admins.offers.includes.expired_quta_action')
                    </div>
                    <div class="row">
                        @include('backend.admins.offers.includes.peak_time')
                    </div>
                    <div class="row">
                        @include('backend.admins.offers.includes.filters_end')
                    </div>
                    @include('backend.admins.offers.includes.disconnect_quota_after_time_expire')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="disable_user_after_renew" class="form-label">
                                    @lang('adding.offer.disable_user_after_renew')
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tachometer text-success"></i>
                                        </div>
                                        <select class="selectpickerJs form-select show-tick p-0"
                                            x-model="offer.disable_user_after_renew" name="disable_user_after_renew">
                                            @foreach (config('offers.disable_user_after_renew_days') as $day)
                                                <option class="mb-10" value="{{ $day }}">
                                                    @if ($day == null)
                                                        @lang('adding.offer.dont_disconnect_the_service')
                                                    @else
                                                        {{ $day }}
                                                        @lang('adding.offer.day')
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="disable_user_after_renew" class="form-label">
                                    طرد المستخدمين من الاتصال لتطبيق التعديلات بشكل مباشر
                                    {{-- @lang('adding.offer.disable_user_after_renew') --}}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-pencil text-success"></i>
                                        </div>
                                        <select class="selectpickerJs form-select show-tick p-0"
                                            name="remove_from_active">
                                            @foreach (config('offers.remove_from_active') as $key => $option)
                                                <option class="mb-10" value="{{ $key }}">
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (auth('admin')->user()->network->login_by_network ?? false)
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="disable_user_after_renew" class="form-label">
                                        @lang('adding.offer.login_from_any_nas_on_the_network')
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon"
                                                x-show="offer.is_login_by_network_allowed == '0' || offer.is_login_by_network_allowed == null">
                                                <i class="fa fa-lock text-danger"></i>
                                            </div>
                                            <div class="input-group-addon"
                                                x-show="offer.is_login_by_network_allowed== '1'">
                                                <i class="fa fa-unlock text-success"></i>
                                            </div>
                                            <select class="selectpickerJs form-select show-tick p-0"
                                                x-model="offer.is_login_by_network_allowed"
                                                name="is_login_by_network_allowed">
                                                <option value="0">
                                                    {{ __('adding.offer.dont_disconnect_the_service') }}
                                                </option>
                                                <option value="1">
                                                    {{ __('adding.offer.enabled') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <x-box-footer cancelRoute="{{ route('admins.offers.index') }}" submitText="{{ __('website.save') }}" />
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}"></script>
    <script src="{{ asset('assets/main.js') }}"></script>
    <script src="{{ asset('assets/includes/selectPicker.js') }}"></script>
    <script src="{{ asset('assets/create_offer.js') }}"></script>
    <script>
        function editOffer() {
            var offer = @json($offer);
            if (offer.expire_quta_details == undefined) {
                offer.expire_quta_details = {
                    expire_speed: '64k/64k',
                    expire_quta: '',
                    expire_quta_unit: null,
                };
            };
            if (offer.peak_time_details == undefined) {
                offer.peak_time_details = {
                    speed: '',
                    start: '',
                    end: '',
                }
            };
            if (offer.disconnect_quota_mb_after_time_expire === undefined || offer.disconnect_quota_mb_after_time_expire === null) {
                offer.disconnect_quota_mb_after_time_expire = {{ (int) config('offers.broadband_expire_quta', 250) }};
            }
            return {
                offer: offer,
                tempDq: {{ (int) config('offers.broadband_expire_quta', 250) }},
                expire_quta_action: offer.expire_quta_action,
                peak_time: offer.peak_time,
                changeSpeed(input, value) {
                    $('[name="' + input + '"]').val(value);
                }
            }
        }
    </script>
@endpush
