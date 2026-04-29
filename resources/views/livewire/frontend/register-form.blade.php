<div>
    <div class="container"
        style="background-color:white; padding: 4%; border-radius: 10px;max-width:1080px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);">

        {{-- Register form --}}
        @include('frontend.theme_two.includes.register.register_info')
        <form wire:submit="createNetworkAction" class="form" style="margin-top: 20px;">
            @csrf

            <div class="row mx-auto" style="margin-bottom:0px;">
                <div class="col lg-my-custom" style="margin-top:0px;">
                    <div class="input-container " style="margin-bottom:0px;">
                        <select class="custom-input col-12"
                            style="margin-right:8px;margin-left:8px;padding-top:8px;padding-bottom:8px;"
                            wire:model.prevent="network.plan_id" @if ($step > 1) disabled @endif>>
                            @foreach ($plans as $system_plan)
                                <option value="{{ $system_plan->id }}">
                                    {{ $system_plan->name }}
                                </option>
                            @endforeach
                        </select>
                        <label class="custom-label">@lang('adding.register.plan_name')</label>
                    </div>
                    @error('network.using')
                        <span class="custom-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- Form hidden input --}}
            @if ($step == 1)
                {{-- <input class="form-control" type="hidden" name="network[plan_id]" wire:model.prevent="network.plan_id"
                    id="plan_id"> --}}

                <div class="row mx-auto">
                    <div class="col lg-my-custom" style="margin-top:0px;">
                        <div class="input-container col-md-6 col-12"
                            style="position:relative; display:flex;Justify-content:center;margin-bottom:0px;">
                            <input class="custom-input" name="network[name]" wire:model.prevent="network.name"
                                placeholder="{{ trans('adding.register.network_name_placeholder') }}" id="network_name">
                            <label class="custom-label" for="network_name">
                                @lang('adding.register.network_name')
                            </label>
                        </div>
                        @error('network.name')
                            <span class="custom-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col lg-my-custom" style="margin-top:0px;">
                        <div class="input-container col-md-6 col-12" style="margin-bottom:0px;">
                            <select class="custom-input" style="padding:0px;padding-top:8px;padding-bottom:8px;"
                                name="network[using]" wire:model.prevent="network.using" disabled>
                                @foreach ($network_using as $key => $value)
                                    <option value="{{ $key }}"
                                        @if ($key == 'cafe' && $plan->type == 2) selected @endif>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="custom-label">@lang('adding.register.network_using')</label>
                        </div>
                        @error('network.using')
                            <span class="custom-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mx-auto">
                    <div class="col lg-my-custom" style="margin-top:0px;">
                        <div class="input-container" id="countryContainer" style="margin-bottom:0px;">
                            <select class="custom-input {{ $network['country_id'] == 1 ? 'col' : 'col-12' }}"
                                style="padding:0px;padding-top:8px;padding-bottom:8px;margin-bottom:0px;"
                                name="network[country_id]" wire:model.prevent="network.country_id" id="country_id">
                                @foreach ($countries as $country)
                                    <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                            <label class="custom-label">@lang('adding.register.country')</label>
                        </div>
                        @error('network.country_id')
                            <span class="custom-error">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($network['country_id'] == 1)
                        <div class="col lg-my-custom" style="margin-top:0px;">
                            <div class="input-container col-md-6" id="governorateContainer" style="margin-bottom:0px;">
                                <select class="custom-input"
                                    style="padding:0px;padding-top:8px;padding-bottom:8px; margin-bottom:0px;"
                                    name="network[governorate_id]" wire:model.prevent="network.governorate_id"
                                    id="governorate_id">
                                    @foreach ($governorates as $governorate)
                                        <option value="{{ $governorate['id'] }}">{{ $governorate['name'] }}</option>
                                    @endforeach
                                </select>
                                <label class="custom-label">@lang('adding.register.governorate')</label>
                            </div>
                            @error('network.governorate_id')
                                <span class="custom-error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>
            @elseif ($step == 2)
                <div class="row">
                    <div class="col" style="margin-bottom:20px;">
                        <div class="input-container " style="margin-bottom:0px;">
                            <input class="custom-input col-12" placeholder="@lang('adding.register.admin_name_placeholder')" name="admin[fullname]"
                                wire:model.prevent="admin.fullname" id="admin_name">
                            <label class="custom-label" for="admin_name">@lang('adding.register.admin_name')</label>
                        </div>
                        @error('admin.fullname')
                            <span class="custom-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col  lg-my-custom">
                        <div class="input-container col-md-6" style="margin-bottom:0px;">
                            <input class="custom-input" placeholder="@lang('adding.register.admin_phone_placeholder')" name="admin[phone]"
                                wire:model.prevent="admin.phone" id="admin_phone">
                            <label class="custom-label" for="admin_phone">@lang('adding.register.admin_phone')</label>
                        </div>
                        @error('admin.phone')
                            <span class="custom-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col lg-my-custom">
                        <div class="input-container col-md-6" style="margin-bottom:0px;">
                            <input class="custom-input" placeholder="@lang('adding.register.admin_phone_other_placeholder')" name="admin[other_phone]"
                                wire:model.prevent="admin.other_phone" id="admin_phone_other">
                            <label class="custom-label" for="admin_phone_other">@lang('adding.register.admin_phone_other')</label>
                        </div>
                        @error('admin.other_phone')
                            <span class="custom-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @elseif ($step == 3)
                <div class="row">
                    <div class="col" style="margin-bottom:20px;">
                        <div class="input-container " style="margin-bottom:0px;">
                            <input class="custom-input col-12" placeholder="@lang('adding.register.admin_username_placeholder')" name="admin[name]"
                                id="admin_username" wire:model.prevent="admin.name">
                            <label class="custom-label" for="admin_username">@lang('adding.register.admin_username')</label>
                        </div>
                        @error('admin.name')
                            <span class="custom-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col lg-my-custom">
                        <div class="input-container col-md-6" style="margin-bottom:0px;">
                            <input class="custom-input" placeholder="*********" name="admin[password]"
                                id="admin_password" wire:model.prevent="admin.password" type="password">
                            <label class="custom-label" for="admin_password">
                                @lang('adding.register.admin_password')
                            </label>
                        </div>
                        @error('admin.password')
                            <span class="custom-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col lg-my-custom">
                        <div class="input-container col-md-6" style="margin-bottom:0px;">
                            <input class="custom-input" placeholder="*********" name="password_confirmation"
                                wire:model.prevent="password_confirmation" id="admin_password2" type="password">
                            <label class="custom-label" for="admin_password2">@lang('adding.register.admin_password2')</label>
                        </div>
                        @error('password_confirmation')
                            <span class="custom-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif

            <div class="row" style="display: flex; justify-content: center;margin: 20px 0px;">
                <div>
                    @if ($step > 1)
                        <button type="button" wire:click="backStep()" class="btn btn-danger"
                            style="padding: 15px;margin-left:10px;margin-right:10px;font-family:changa;border-radius:5px;">
                            @lang('website.back')
                        </button>
                    @endif
                    @if ($step < 3)
                        <button type="button"
                            @if ($step == 1) wire:click="submitStepOne()" @elseif ($step == 2) wire:click="submitStepTwo()" @endif
                            class="btn btn-info"
                            style="font-family:changa;border-radius:5px;padding:15px;width:150px;">
                            @lang('website.next')
                        </button>
                    @else
                        <button type="submit" wire:submit="createNetworkAction" class="btn btn-success"
                            style="font-family:changa;border-radius:5px;padding:15px;width:150px;">
                            @lang('website.register')
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@push('styles')
    <style>
        .lg-my-custom {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        /* Row */
        .row {
            display: flex;
            flex-wrap: wrap;
            /* Ensure responsiveness */
            /* gap: 20px; */
            /* Spacing between columns */
        }

        /* Columns */
        .col {
            flex: 1;
            /* Grow equally */
            min-width: 0;
            /* Prevent overflow */
        }

        .col-12 {
            flex: 100%;
        }

        .col-6 {
            flex: 0 0 50%;
            /* Take up half the width */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .col {
                flex: 0 0 100%;
                /* Full width on small screens */
            }

            .lg-my-custom {
                margin-top: 15px !important;
                margin-bottom: 15px !important;
                padding: 0px !important;
            }
        }
    </style>
@endpush
