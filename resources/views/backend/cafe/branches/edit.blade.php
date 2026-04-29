@extends('backend.layouts.livewire.cafe')

@section('content')
    <form id="FormSubmit" action="{{ route('cafe.branches.update', ['branch' => $network->id]) }}"
        method="POST" novalidate>
        @method('PUT')
        @csrf
        <div class="box bt-1 border-success">
            <x-box-header back-text="العودة الى كل الكافيهات" title="تعديل كافيه فرعى"
                back-route="{{ route('cafe.branches.index') }}" />

            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <input type="hidden" name="network_id" value="{{ $network->id }}">
                            <input type="hidden" name="admin_id"
                                value="{{ $network->superAdmin->id }}">
                            {{-- col-md-4 --}}
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group row">
                                    <label for="country_id" class="form-label">
                                        {{ __('adding.register.country') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-map-o"></i>
                                            </div>
                                            <select class="selectpicker form-select show-tick p-0"
                                                name="network[country_id]" id="country_id">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country['id'] }}"
                                                        @if ($network->country_id == $country['id']) selected @endif>
                                                        {{ $country['name'] }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- col-md-4 --}}

                            <div class="col-md-4 col-sm-12" id="governorates">
                                <div class="form-group row">
                                    <label for="governorate_id" class="form-label">
                                        {{ __('adding.register.governorate') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-road"></i>
                                            </div>
                                            <select class="selectpicker form-select show-tick p-0"
                                                name="network[governorate_id]" id="governorate_id">
                                                @foreach ($governorates as $governorate)
                                                    <option value="{{ $governorate['id'] }}"
                                                        @if ($network->governorate_id == $governorate['id']) selected @endif>
                                                        {{ $governorate['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- col-md-4 --}}
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="network_name" class="form-label">
                                        {{ __('adding.register.network_name') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-id-badge"></i>
                                            </div>
                                            <input class="form-control" type="text"
                                                name="network[name]" id="network_name"
                                                value="{{ $network->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="admin_name" class="form-label">
                                        {{ __('adding.register.admin_name') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-id-badge"></i>
                                            </div>
                                            <input class="form-control" type="text"
                                                name="admin[fullname]" id="admin_name"
                                                value="{{ $network->superAdmin->fullname }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end of row-->

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="admin_username" class="form-label">
                                        {{ __('adding.register.admin_username') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <input class="form-control" type="text"
                                                name="admin[name]" id="admin_username"
                                                value="{{ $network->superAdmin->name }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="admin_password" class="form-label">
                                        {{ __('adding.register.admin_password') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </div>
                                            <input class="form-control" type="text"
                                                name="admin[password]" id="admin_password">
                                        </div>
                                    </div>
                                    <span class="text-primary">
                                        * لن يتم التعديل اذ كانت فارغة
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="password_confirmation" class="form-label">
                                        {{ __('adding.register.admin_password2') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-key"></i>
                                            </div>
                                            <input class="form-control" type="text"
                                                name="password_confirmation"
                                                id="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="admin_phone" class="form-label">
                                        {{ __('adding.register.admin_phone') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input class="form-control" type="text"
                                                name="admin[phone]" id="admin_phone"
                                                value="{{ $network->superAdmin->phone }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="admin_phone_other" class="form-label">
                                        {{ __('adding.register.admin_phone_other') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input class="form-control" type="text"
                                                name="admin[other_phone]" id="admin_phone_other"
                                                value="{{ $network->superAdmin->other_phone }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <x-box-footer cancelRoute="{{ route('cafe.branches.index') }}"
                submitText="{{ __('website.save') }}" />
        </div>
        <!-- /.box -->
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}">
    </script>
    <script src="{{ asset('assets/main.js') }}"></script>
    <script>
        var country_id = @json($network->country_id);

        if (country_id != 1) {
            $('#governorates').hide();
        }
        $('#country_id').on('change', function() {
            if ($(this).val() == 1) {
                $('#governorates').show();
            } else {
                $('#governorates').hide();
            }
        });
    </script>
@endpush
