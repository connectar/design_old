@push('liveWire_styles')
    @livewireStyles
@endpush
@extends('backend.layouts.livewire.cafe')

@section('content')
    <form id="FormSubmit" action="{{ route('cafe_home.users.update', $user->id) }}" method="POST"
        novalidate>
        @method('PUT')
        @csrf
        <div class="box bt-1 border-success">
            <x-box-header back-text="{{ __('adding.user.users_title') }}"
                title="{{ __('adding.user.edit_title') }}"
                back-route="{{ route('cafe_home.users.index') }}">
                <x-slot name="username">
                    <span class="text-black">
                        {{ $user->fullname }}
                    </span>
                </x-slot>
                <span class="pull-right text-center">
                    {{-- singleton uptime query --}}
                    @php
                        $userUptime = $user->getUptimeInfo();
                    @endphp
                    @if (is_null($userUptime))
                        <span class="badge fw-bold px-4">
                            <i class="fa fa-circle text-danger"></i>
                            {{ __('adding.user.offline') }}
                        </span>
                    @else
                        <span class="badge fw-bold px-4" style="background-color: rgb(27, 170, 27)">
                            <i class="fa spi fa-snowflake-o fa-spin" style="color: greenyellow"></i>
                            {{ __('adding.user.online') }}
                        </span>
                        <span class="badge badge-lg d-block" style="color: yellow">
                            <i class="fa fa-clock-o text-white"></i>
                            {{ $userUptime }}
                        </span>
                    @endif
                </span>
            </x-box-header>

            <div class="box-body pt-0" x-data="addNewUser">
                <div class="col-12">
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
                                            <x-network-offers :selectedOffer="$user->offer_id" />
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
                                        <input class="form-control" type="text"
                                            name="userData[fullname]" id="fullname"
                                            value={{ $user->fullname ?? '' }}>
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
                                        <input class="form-control" type="text"
                                            name="userData[username]" id="username"
                                            value={{ $user->username ?? '' }}>
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
                                            id="city" value={{ $user->city ?? '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->

            <x-box-footer cancelRoute="{{ route('cafe_home.users.index') }}"
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
    <script src="{{ asset('assets/functions.js') }}"></script>
    <script src="{{ asset('assets/create_user.js') }}"></script>
@endpush
@push('livewire_scripts')
@endpush
