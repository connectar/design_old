@extends('backend.layouts.livewire.cafe')

@section('content')
    <form id="FormSubmit" action="{{ route('cafe.offers.update', $offer->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="box">
            <x-box-header back-text="{{ __('adding.offer.offers_title') }}"
                title="{{ __('adding.offer.edit_title') }}"
                back-route="{{ route('cafe.offers.index') }}" />
            <div class="box-body">
                <div class="row" x-data="editOffer">
                    <div class="row">
                        <div class="col-md-8">
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
                                            placeholder="{{ __('adding.offer.name_placeholder') }}"
                                            id="name" name="name" x-model="offer.name">
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
                                            placeholder="{{ __('adding.offer.price_placeholder') }}"
                                            id="price" name="price" x-model="offer.price">
                                        <div class="input-group-addon">
                                            جنيه
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="quta" class="form-label">
                                            {{ __('adding.offer.speed_down') }}
                                        </label>
                                        <div>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-cloud-download text-warning"></i>
                                                </div>
                                                <input class="form-control" type="number"
                                                    min="0"
                                                    placeholder="{{ __('adding.offer.quta_placeholder') }}"
                                                    name="speed_down"
                                                    value="{{ $speed['down_original'] }}">
                                                <div class="input-group-addon p-0">
                                                    <select class="form-select" name="speed_down_unit">
                                                        @foreach (__('site.speed_units') as $unit => $lang)
                                                            <option value="{{ $unit }}"
                                                                @if ($unit == $speed['down_unit']) selected @endif>
                                                                {{ $lang }}
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
                                        <label for="quta" class="form-label">
                                            {{ __('adding.offer.speed_up') }}
                                        </label>
                                        <div>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-cloud-download text-warning"></i>
                                                </div>
                                                <input class="form-control" type="number"
                                                    min="0"
                                                    placeholder="{{ __('adding.offer.quta_placeholder') }}"
                                                    name="speed_up"
                                                    value="{{ $speed['up_original'] }}">
                                                <div class="input-group-addon p-0">
                                                    <select class="form-select" name="speed_up_unit">
                                                        @foreach (__('site.speed_units') as $unit => $lang)
                                                            <option value="{{ $unit }}"
                                                                @if ($unit == $speed['up_unit']) selected @endif>
                                                                {{ $lang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <input class="form-control" type="number" min="1"
                                        value="1"
                                        placeholder="{{ __('adding.offer.duration_placeholder') }}"
                                        name="duration" id="duration" x-model="offer.duration">
                                    <div class="input-group-addon p-0">
                                        <select class="form-select" name="duration_unit"
                                            x-model="offer.duration_unit">
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
                                    {{ __('adding.offer.quta_unit_label') }}
                                </label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-cloud-download text-warning"></i>
                                        </div>
                                        <input class="form-control" type="number" min="0"
                                            placeholder="{{ __('adding.offer.quta_placeholder') }}"
                                            name="quta" x-model="offer.quta">
                                        <div class="input-group-addon p-0">
                                            <select class="form-select" name="quta_unit"
                                                x-model="offer.quta_unit">
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
                                <label for="filter" class="form-label">
                                    @lang('adding.offer.filter')
                                </label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-shield text-danger"></i>
                                    </div>
                                    <select class="selectpickerJs form-select p-0" multiple
                                        data-actions-box="true" name="filters[]">
                                        @foreach (config('offers.filters') as $index => $filter)
                                            <option
                                                data-content='{{ __("adding.offer.{$filter}_content") }}'
                                                value="{{ $filter }}"
                                                @isset($offer->filters[$filter]) selected @endisset>
                                                {{ __("adding.offer.{$filter}") }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-box-footer cancelRoute="{{ route('cafe.offers.index') }}"
                submitText="{{ __('website.save') }}" />
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}">
    </script>
    <script src="{{ asset('assets/main.js') }}"></script>
    <script src="{{ asset('assets/includes/selectPicker.js') }}"></script>
    <script src="{{ asset('assets/create_offer.js') }}"></script>
    <script>
        function editOffer() {
            var offer = @json($offer);

            return {
                offer: offer,
                changeSpeed(input, value) {
                    $('[name="' + input + '"]').val(value);
                }
            }
        }
    </script>
@endpush
