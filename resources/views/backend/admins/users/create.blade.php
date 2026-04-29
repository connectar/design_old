@push('liveWire_styles')
    @livewireStyles
@endpush

@extends('backend.layouts.admin')

@section('content')
    <form id="FormSubmit" action="{{ route('admins.users.store') }}" method="POST" novalidate>
        @method('POST')
        @csrf
        <div class="box bt-1 border-success">
            <x-box-header back-text="{{ __('adding.user.users_title') }}"
                title="{{ __('adding.user.create_title') }}"
                back-route="{{ route('admins.users.index') }}" />

            <div class="box-body pt-0" x-data="addNewUser">
                <div class="col-12">
                    <ul class="nav nav-pills justify-content-start mb-20">
                        <li>
                            <a href="#create_user" class="create_user_button nav-link active"
                                data-bs-toggle="tab" aria-expanded="false">
                                <i class="fa fa-user"></i>
                                {{ __('adding.user.user_info') }}
                            </a>
                        </li>
                        @can('user_addMacs')
                            <li>
                                <a href="#create_user_macs" class="create_user_mac_button nav-link"
                                    data-bs-toggle="tab" aria-expanded="false">
                                    <i class="fa fa-barcode"></i>
                                    {{ __('adding.user.user_macs') }}
                                </a>
                            </li>
                        @endcan

                    </ul>

                    <div class="tab-content pb-0">
                        <div class="tab-pane active" id="create_user">
                            @include('backend.admins.users.includes.create')
                        </div>
                        @can('user_addMacs')
                            <div class="tab-pane" id="create_user_macs">
                                <div>
                                    <div class="alert alert-danger hide showMacCountErorr" role="alert">
                                        {{ __('adding.user.mac_count_error') }}
                                    </div>
                                    @livewire('user-macs')
                                </div>
                            </div>
                        @endcan
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
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
    <script src="{{ asset('assets/functions.js') }}"></script>
    <script src="{{ asset('assets/create_user.js') }}"></script>
    <script>
        function addNewUser() {
            localStorage.clear();
            return {
                connection_type: "PPP",
                distributer: 0,
                phone: '',
                phoneIsEnabled: false,
                shared_users: 1,
                togglePhone() {
                    this.phone = togglePhoneInput(this.phoneIsEnabled, this.phone);
                },
                chooseDistributer() {
                    chooseDistributer(this.distributer);
                },
                setMacsCount() {
                    Livewire.dispatch('setTotalMacsCount', this.shared_users);
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        $(document).ready(function(){
            const phoneInput = document.getElementById("phone");
            const iti_contact = window.intlTelInput(phoneInput, {
                initialCountry: getCountryCode(),
                utilsScript:
                    "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });
            $('#FormSubmit').submit(function(e) {
                $("#region").val(iti_contact.getSelectedCountryData().iso2)
            });
        });
        /* تم التعديل: حماية من ad-blockers وانقطاع الشبكة (ERR_BLOCKED_BY_CLIENT) */
        function getCountryCode() {
            try {
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.open("GET", "https://www.cloudflare.com/cdn-cgi/trace", false);
                xmlHttp.send(null);
                var parts = xmlHttp.responseText.replace(/(\r\n|\n|\r)/gm, "").split('loc=');
                var country_code = (parts[1] || '').split('tls=')[0];
                return country_code ? country_code.toLowerCase() : "eg";
            } catch (e) {
                return "eg";
            }
        }
    </script>
@endpush
@push('livewire_scripts')
@endpush
