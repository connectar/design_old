@extends('backend.layouts.admin')

@section('content')
    <form id="FormSubmit" action="{{ route('admins.quta.store') }}" method="POST" novalidate>
        @method('POST')
        @csrf
        <div class="box">
            <x-box-header back-text="{{ __('adding.quta.index_title') }}"
                title="{{ __('adding.quta.title') }}"
                back-route="{{ route('admins.quta.index') }}" />
            <div class="box-body">
                <div class="row" x-data="addNewQuta">
                    <div class="row">


                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="quta" class="form-label">
                                    {{ __('adding.quta.quta_unit_label') }}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-cloud-download text-warning"></i>
                                        </div>
                                        <input class="form-control" type="number" min="0"
                                            placeholder="{{ __('adding.offer.quta_placeholder') }}"
                                            name="quta">
                                        <div class="input-group-addon p-0">
                                            <select class="form-select" name="quta_unit">
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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="price" class="form-label">
                                    {{ __('adding.offer.price') }}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money text-success"></i>
                                        </div>
                                        <input class="form-control" type="number" min="1"
                                            placeholder="{{ __('adding.offer.price_placeholder') }}"
                                            id="price" name="price">
                                        <div class="input-group-addon">
                                            جنيه
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="filter" class="form-label">
                                    @lang('adding.quta.status')
                                </label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-shield text-danger"></i>
                                    </div>
                                    <select class="selectpickerJs form-select p-0"
                                        data-actions-box="true" name="status">
                                        @foreach ($qutaStatuses as $key => $value)
                                            <option data-content='{{ $value }}'
                                                value="{{ $key }}">
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-box-footer cancelRoute="{{ route('admins.quta.index') }}"
                submitText="{{ __('website.save') }}" />
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.js') }}"></script>
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}">
    </script>
    <script src="{{ asset('assets/main.js') }}"></script>
    <script src="{{ asset('assets/includes/selectPicker.js') }}"></script>
@endpush
