@push('liveWire_styles')
    @livewireStyles
@endpush
@extends('backend.layouts.admin')

@section('content')
    <form id="FormSubmit" action="{{ route('admins.users.update', $user->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')
        <div class="box bt-3 border-success">
            <div class="box-header with-border p-2 px-4">
                <h4 class="box-title">
                    {{ __('adding.user.edit_title') }}
                    <small class="badge badge-warning badge-pill py-1">
                        {{ $user->fullname }}
                    </small>
                </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
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
                            <label for="quta" class="form-label">@lang('adding.user.user_quta')</label>
                            <div>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-cloud-download"></i>
                                    </div>
                                    <input class="form-control" type="number" min="0"
                                        name="quta" id="quta" value="0">
                                    <div class="input-group-addon p-0">
                                        <select class="form-select" name="quta_type">
                                            <option value="GIGA">
                                                @lang('adding.offer.quta_GIGA')
                                            </option>
                                            <option value="MEGA">
                                                @lang('adding.offer.quta_MEGA')
                                            </option>
                                        </select>
                                    </div>
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
                    <div class="col-md-4 col-sm-12">
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
                                        <x-maps :selected="$user->map_id" />
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hotspot-content" style="display: none">
                    @livewire('user-macs')
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ route('admins.users.index') }}"
                    class="btn btn-dark btn-rounded">@lang('website.cancel')</a>
                <button type="submit" class="btn btn-success btn-rounded">@lang('website.save')</button>
            </div>
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
