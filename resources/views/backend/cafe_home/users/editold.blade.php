@extends('backend.layouts.admin')

@push('livewire_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pickaday.css') }}">
@endpush
@section('content')
    <div class="box">
        <x-box-header back-text="{{ __('adding.user.users_title') }}"
            title="{{ __('adding.user.edit_title') }}" back-route="{{ route('admins.users.index') }}">
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
        <div class="box-body py-0" x-data="editUser">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($tabs as $key => $value)
                    <li
                        class="nav-item fw-bolder @if ($loop->index > 0) hidden-sm-down @endif">
                        <a class="nav-link @if ($key == $tab) active @endif"
                            id="{{ $key }}-tab" data-bs-toggle="tab"
                            href="#{{ $key }}" role="tab"
                            aria-controls="{{ $key }}" aria-expanded="true">
                            <span>
                                <i class="{{ __('site.user_edit.tabs_icons.' . $key) }}"></i>
                                {{ $value }}
                            </span>
                        </a>
                    </li>
                @endforeach
                <li class="nav-item dropdown hidden-sm-up">
                    <a class="nav-link dropdown-toggle @if ($tab != 'edit_index') active @endif"
                        data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <span>
                            <i class="fa fa-gears"></i>
                            {{ __('site.user_edit.dropdown_key') }}
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        @foreach ($tabs as $key => $value)
                            @if ($key != 'edit_index')
                                <a class="dropdown-item" id="{{ $key }}-tab"
                                    href="#{{ $key }}" role="tab" data-bs-toggle="tab"
                                    aria-controls="{{ $key }}">
                                    {{ $value }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </li>
            </ul>
            <div class="tab-content p-0">
                @foreach ($tabs as $key => $value)
                    <div role="tabpanel"
                        class="tab-pane fade @if ($key == $tab) show active @endif"
                        id="{{ $key }}" aria-labelledby="home-tab">

                        @include('backend.admins.users.includes.' . $key)

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/ar.js"></script>
    <script src="{{ asset('assets/pickaday.js') }}"></script>
    <script src="{{ asset('assets/main.js') }}"></script>
    <script src="{{ asset('assets/functions.js') }}"></script>
    <script src="{{ asset('assets/includes/set_pickaday.js') }}"></script>
    <script>
        function editUser() {
            let user = @json($user);
            localStorage.clear();
            return {
                user: user,
                distributer: user.distributors,
                phone: user.phone,
                phoneIsEnabled: user.send_sms,
                shared_users: user.shared_users,
                tabSelected: edit_index,
                togglePhone() {
                    this.phone = togglePhoneInput(this.phoneIsEnabled, this.phone);
                },
                chooseDistributer() {
                    chooseDistributer(this.distributer);
                },
                editExpiredDate() {
                    swalLoading();
                    Livewire.dispatch('doEdit');
                },
                editQuta() {
                    swalLoading();
                    Livewire.dispatch('editQuta');
                }
            }
        }

        initPickaday();

        window.addEventListener("showSwalMessage", (event) => {
            Swal.fire(event.detail.swal);
        });
    </script>
@endpush
