@push('liveWire_styles')
    @livewireStyles
@endpush
@extends('backend.layouts.admin')

@section('content')
    <form id="FormSubmit" action="{{ route('admins.users.update', $user->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')
        <div class="box bt-1 border-success">
            <x-box-header back-text="{{ __('adding.user.users_title') }}"
                title="{{ __('adding.user.edit_title') }}" back-route="{{ route('admins.users.index') }}">
                <x-slot name="username">
                    <span class="text-black">
                        {{ $user->fullname }}
                    </span>
                </x-slot>
                <span class="pull-right">
                    <span class="badge fw-bold px-4" style="background-color: rgb(27, 170, 27)">
                        <i class="fa spi fa-snowflake-o fa-spin" style="color: greenyellow"></i>
                        متصل
                    </span>
                </span>
            </x-box-header>
            <!-- /.box-header -->
            <div class="box-body pt-0">
                <div class="row">
                    <div class="col p-0 m-0">
                        <span class="badge badge-lg pull-right" style="color: yellow">
                            <i class="fa fa-clock-o text-white"></i>
                            ساعة 33 دقيقة 20 ثانية
                        </span>
                    </div>
                </div>
                <div class="row">
                    {{-- nas serial --}}
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group row">
                            <label for="nas_serial" class="form-label">@lang('adding.user.nas_name')</label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-server"></i>
                                    </div>
                                    <select class="selectpicker form-select show-tick p-0"
                                        name="userData[nas_serial]">
                                        <x-network-nas :selected="$user->nas_serial" />
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- offer name --}}
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group row">
                            <label for="offer_id" class="form-label">@lang('adding.user.offer_id')</label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-tags"></i>
                                    </div>
                                    <select class="selectpicker form-select show-tick p-0"
                                        name="userData[offer_id]">
                                        <x-network-offers :selectedOffer="$user->offer_id" />
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group row">
                            <label for="connection_type" class="form-label">@lang('adding.user.connection_type')</label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-wifi"></i>
                                    </div>
                                    <x-user-connection-type :selected="$user->connection_type" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end of row-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="fullname" class="form-label">@lang('adding.user.fullname')</label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-id-badge"></i>
                                    </div>
                                    <input class="form-control" type="text" name="userData[fullname]"
                                        id="fullname" value="{{ $user->name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="username" class="form-label">@lang('adding.user.username')</label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input class="form-control" type="text" name="userData[username]"
                                        id="username" value="{{ $user->username }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- username --}}
                    {{-- password --}}
                    <div class="col-md-4 usingmac-content">
                        <div class="form-group row">
                            <label for="password" class="form-label">@lang('adding.user.password')</label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </div>
                                    <input class="form-control" type="text" name="userData[password]"
                                        id="password" value="{{ $user->password }}">
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
                                    <x-user-payment-types />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group row">
                            <label for="paid_price" class="form-label">@lang('adding.user.paid_price')</label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <input class="form-control" type="number" min="0"
                                        value="0" name="paid_price" id="paid_price"
                                        value="{{ $user->price }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group row">
                            <label for="send_sms" class="form-label">@lang('adding.user.map')
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        {{ __('adding.user.map_name') }}
                                    </div>
                                    <select class="selectpicker form-select show-tick p-0"
                                        name="userData[map_id]">
                                        <x-maps />
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group row">
                            <label for="city" class="form-label">@lang('adding.user.city')</label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <input class="form-control" type="text" name="userData[city]"
                                        id="city" value="{{ $user->city }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group row">
                            <label for="send_sms" class="form-label">@lang('adding.user.send_sms')
                            </label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon py-0">
                                        <label class="switch switch-danger">
                                            <input name="userData[send_sms]" type="checkbox" />
                                            <span class="switch-indicator"></span>
                                        </label>
                                    </div>
                                    <input class="form-control" type="text" name="userData[phone]"
                                        id="phone"
                                        placeholder="{{ __('adding.user.phone_placeholder') }}"
                                        value="{{ $user->phone ?? '' }}">
                                    <div class="input-group-addon border-round-0">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group row shared_users-content">
                            <label for="shared_users" class="form-label">@lang('adding.user.shared')</label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                    <input class="form-control" type="number" min="1"
                                        max="50" value="1" name="userData[shared_users]"
                                        id="shared_users" value="{{ $user->shared_users ?? 1 }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row devices-content" style="display: none">
                            <label for="devices" class="form-label">@lang('adding.user.devices')</label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-laptop"></i>
                                    </div>
                                    <input class="form-control" type="number" min="1"
                                        max="50" value="1" name="userData[devices]"
                                        id="devices" value="{{ $user->devices ?? 1 }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>
            </div>
            <!-- /.box-body -->
            <x-box-footer cancelRoute="{{ route('admins.users.index') }}"
                submitText="{{ __('website.save') }}" />
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}">
    </script>
    <script src="{{ asset('assets/main.js') }}"></script>
    <script src="{{ asset('assets/create_user.js') }}"></script>
@endpush
@push('livewire_scripts')
@endpush
