@extends('backend.layouts.admin')

@section('content')

    <form id="DistributerForm" action="{{ route('admins.distributors.store') }}" method="POST"
        novalidate>
        @method('POST')
        @csrf
        <div class="box bt-1 border-success">
            <x-box-header back-text="{{ __('adding.distributor.all_title') }}"
                title="{{ __('adding.distributor.create_title') }}"
                back-route="{{ route('admins.distributors.index') }}" />

            <div class="box-body">
                <div class="row">
                    <ul class="nav nav-pills justify-content-start mb-20">
                        <li>
                            <a href="#create_user"
                                class="create_user_button main_tab nav-link active py-1"
                                data-bs-toggle="tab" aria-expanded="false">
                                <i class="fa fa-user"></i>
                                {{ __('adding.distributor.info_title') }}
                            </a>
                        </li>
                        <li>
                            <a href="#create_user_macs"
                                class="create_user_mac_button main_tab nav-link py-1"
                                data-bs-toggle="tab" aria-expanded="false">
                                <i class="fa fa-barcode"></i>
                                {{ __('adding.distributor.per_title') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content pb-0">
                        <div class="tab-pane main_tab active" id="create_user">
                            {{-- distributer information --}}
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label for="fullname" class="form-label">
                                                {{ __('adding.distributor.fullname') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-id-badge"></i>
                                                    </div>
                                                    <input class="form-control" type="text"
                                                        name="data[fullname]" id="fullname">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label for="name" class="form-label">
                                                {{ __('adding.distributor.name') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                    <input class="form-control" type="text"
                                                        name="data[name]" id="name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label for="password" class="form-label">
                                                {{ __('adding.distributor.password') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-key"></i>
                                                    </div>
                                                    <input class="form-control" type="text"
                                                        name="data[password]" id="password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group row">
                                            <label for="phone" class="form-label">
                                                {{ __('adding.distributor.phone') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <input class="form-control" type="text"
                                                           name="data[phone]" id="phone">
                                                    <input type="hidden" name="data[region]" id="region">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- password --}}
                                </div> <!-- end of row-->
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group row">
                                            <label for="distributer" class="form-label">
                                                {{ __('adding.distributor.nas') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                    <select
                                                        class="selectpicker form-select show-tick p-0"
                                                        name="nas[]" multiple id="selectNas">
                                                        @foreach ($nas as $nas)
                                                            <option value="{{ $nas['id'] }}"
                                                                @if ($loop->first) selected @endif>
                                                                {{ $nas['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="cards_count" class="form-label">
                                                {{ __('adding.distributor.cards_count') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-tags text-primary"></i>
                                                    </div>
                                                    <input class="form-control" type="number"
                                                        placeholder="{{ __('adding.distributor.cards_p') }}"
                                                        id="cards_count" name="data[cards]" dir="rtl">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="cards_charging_count" class="form-label">
                                                {{ __('adding.distributor.cards_charging_count') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-tags text-primary"></i>
                                                    </div>
                                                    <input class="form-control" type="number"
                                                        placeholder="{{ __('adding.distributor.cards_p') }}"
                                                        id="cards_charging_count"
                                                        name="data[cards_charging]" dir="rtl">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="profit" class="form-label">
                                                {{ __('adding.distributor.account_type_title') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                    <select
                                                        class="selectpicker form-select show-tick p-0"
                                                        name="data[account_type]" id="account_type">
                                                        @foreach ($account_type as $key => $value)
                                                            <option value="{{ $key }}">
                                                                {{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="account" class="form-label" style="color: #5bce32">
                                                {{ __('adding.distributor.account_future') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <input class="form-control" type="text"
                                                           name="data[account_future]" id="account_future">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="account" class="form-label">
                                                {{ __('adding.distributor.account') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </div>
                                                    <input class="form-control" type="text"
                                                           name="data[account]" id="account">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="active" class="form-label">
                                                @lang('adding.distributor.active')
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-lock"></i>
                                                    </div>
                                                    <select
                                                        class="selectpicker form-select show-tick p-0"
                                                        name="data[active]">
                                                        @foreach ($statuses as $status => $lang)
                                                            <option value="{{ $status }}">
                                                                {{ $lang }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group row">
                                            <label for="profit" class="form-label">
                                                {{ __('adding.distributor.profit') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </div>
                                                    <select
                                                        class="selectpicker form-select show-tick p-0"
                                                        name="data[profit]" id="profit">
                                                        @foreach ($profits as $key => $value)
                                                            <option value="{{ $key }}">
                                                                {{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="profit_price" class="form-label">
                                                {{ __('adding.distributor.profit_price') }}
                                            </label>
                                            <div>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-tags text-primary"></i>
                                                    </div>
                                                    <input class="form-control" type="number"
                                                        placeholder="{{ __('adding.distributor.profit_place') }}"
                                                        id="profit_price" name="data[profit_price]"
                                                        dir="rtl">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="note">
                                            {{ __('adding.user.notes') }}
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-addon vertical-align">
                                                <i class="fa fa-bookmark">
                                                </i>
                                            </span>
                                            <textarea class="form-control" rows="3" id="notes"
                                                name="notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- distributer information --}}
                        </div>
                        <div class="tab-pane main_tab" id="create_user_macs">
                            {{-- permissions --}}
                            <div class="col-12">
                                <div class="box">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <!-- Nav tabs -->
                                        <div class="vtabs">
                                            <ul class="nav nav-tabs tabs-vertical bl-1 border-primary"
                                                role="tablist">

                                                @foreach ($tags as $tag)
                                                    <li class="nav-item">
                                                        <a class="nav-link !active-success py-1 @if ($loop->first) active @endif"
                                                            data-bs-toggle="tab"
                                                            href="#{{ $tag }}" role="tab">
                                                            <span>
                                                                {{ __('adding.distributor.permissions.tags.' . $tag) }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content p-20">
                                                @foreach ($tags as $tag)
                                                    <div class="tab-pane @if ($loop->first) active @endif"
                                                        id="{{ $tag }}" role="tabpanel">
                                                        <div class="row">
                                                            @foreach (config('permissions.distributer.' . $tag) as $key)
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="switch switch-success">
                                                                            <input type="checkbox"
                                                                                name="permissions[]"
                                                                                value="{{ "{$tag}_{$key}" }}" />
                                                                            <span
                                                                                class="switch-indicator"></span>
                                                                        </label>

                                                                        <label for="show_profile"
                                                                            class="form-label">
                                                                            {{ __("adding.distributor.permissions.permissions.{$tag}.{$key}") }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                            {{-- end of permissions --}}
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

            <x-box-footer cancelRoute="{{ route('admins.distributors.index') }}"
                submitText="{{ __('website.save') }}" />
        </div>

    </form>

@endsection
@push('scripts')
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}">
    </script>
    <script src="{{ asset('assets/functions.js') }}"></script>
    <script src="{{ asset('assets/main.js') }}"></script>
    <script defer src="{{ asset('assets/distributer_create.js') }}"></script>
    <script>
        $('#selectNas').on('change', function() {
            if ($(this).val().length == 0) {
                $('#selectNas').selectpicker("val", $(this).find("option:first-child").val());
            }
        });
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
            $('#DistributerForm').submit(function(e) {
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
