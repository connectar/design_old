@extends('backend.layouts.admin')

@section('content')
<div class="row">
    <form id="FormSubmit" action="{{ route('admins.offers.store') }}" method="POST" novalidate>
        @csrf
        @method('POST')
        <div class="box bt-3 border-success">
            <div class="box-header with-border p-2 px-4">
                <h4 class="box-title">@lang('adding.offer.create_title')</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="row">
                        {{-- offer name input --}}
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="name" class="form-label">@lang('adding.offer.name')</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tags"></i>
                                        </div>
                                        <input class="form-control" type="text"
                                            placeholder="@lang('adding.offer.name_placeholder')" name="offerData[name]"
                                            id="name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- offer price input --}}
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="price" class="form-label">@lang('adding.offer.price')</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <input class="form-control" type="number"
                                            placeholder="@lang('adding.offer.price_placeholder')"
                                            name="offerData[price]" id="price">
                                        <div class="input-group-addon">
                                            جنيه
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- offer speed input  --}}
                        @include('backend.includes.offers.speed_input',['name' =>
                        'speed','class'=>'col-md-8'])
                        {{-- duration --}}
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="duration" class="form-label">@lang('adding.offer.duration')</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input class="form-control" type="number" min="1" value="1"
                                        placeholder="@lang('adding.offer.duration_placeholder')" name="duration"
                                        id="duration">
                                    <div class="input-group-addon p-0">
                                        <select class="form-control" name="duration_label">
                                            <option value="MONTH">@lang('adding.offer.duration_label_hour')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="quta" class="form-label">@lang('adding.offer.quta')</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-cloud-download"></i>
                                        </div>
                                        <input class="form-control" type="number" min="0"
                                            placeholder="@lang('adding.offer.quta_placeholder')" name="quta" id="quta">
                                        <div class="input-group-addon p-0">
                                            <select class="form-select" name="quta_type">
                                                <option value="GIGA">@lang('adding.offer.quta_GIGA') </option>
                                                <option value="MEGA">@lang('adding.offer.quta_MEGA')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="after_expired_quta"
                                    class="form-label">@lang('adding.offer.after_expired_quta')</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tachometer"></i>
                                        </div>
                                        <select class="selectpicker form-select show-tick p-0"
                                            name="offerData[expire_quta]">
                                            <option value="NOTHING">@lang('adding.offer.nothing') </option>
                                            <option class="mb-10" value="END_USER">
                                                @lang('adding.offer.closed')
                                            </option>
                                            @foreach ($offers as $id => $name )
                                            <option value="{{$id}}">{{ __('adding.offer.goto') .  $name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="filter" class="form-label">@lang('adding.offer.filter')</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-shield"></i>
                                    </div>
                                    <select class="selectpicker form-select p-0" name="filters[]" multiple
                                        data-actions-box="true">
                                        @foreach (config('offers.filters') as $filter)
                                        <option data-content='{{ __("adding.offer.{$filter}_content") }}'
                                            value="{{ $filter }}">{{ __("adding.offer.{$filter}") }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    {{--  enable_daily_quta --}}

                    {{-- enable_daily_quta --}}
                    {{--  enable_peak_time --}}
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group row">
                                <label for="enable_peak_time" class="form-label">@lang('adding.offer.enable_peak_time')
                                </label>
                                <div class="col-sm-9">
                                    <label class="switch switch-danger">
                                        <input name="offerData[peak_time]" type="checkbox"
                                            data-class=".peakTimeContent" />
                                        <span class="switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @include('backend.includes.offers.speed_input',['name' =>
                        'peak_time_speed','class'=>'col-md-6 visibility_hidden peakTimeContent'])
                        {{-- peak time duration --}}
                        <div class="col-md-4 visibility_hidden peakTimeContent">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="after_expired_quta"
                                            class="form-label">@lang('adding.offer.time_from')</label>
                                        <div>
                                            <div class="input-group bootstrap-timepicker">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input class="form-control timepicker" type="text"
                                                    name="peak_time_start"
                                                    placeholder="@lang('adding.offer.name_placeholder')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="after_expired_quta"
                                            class="form-label">@lang('adding.offer.time_to')</label>
                                        <div>
                                            <div class="input-group bootstrap-timepicker">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input class="form-control timepicker" type="text" name="peak_time_end"
                                                    placeholder="@lang('adding.offer.name_placeholder')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- peak time duration --}}
                        </div>
                        {{-- enable_daily_quta --}}
                        <!-- /.row -->
                    </div>
                    {{--  enable_peak_time --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="after_expired_quta"
                                    class="form-label">@lang('adding.offer.after_expired_time')</label>
                                <div>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-tachometer"></i>
                                        </div>
                                        <select class="selectpicker form-select show-tick p-0"
                                            name="offerData[expire_time]">
                                            <option value="END_USER">@lang('adding.offer.closed')</option>
                                            <option value="RENEW_USER">
                                                @lang('adding.offer.after_expired_time_renew')
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer pb-0">
                        <a href="{{ route('admins.nas.index') }}"
                            class="btn btn-dark btn-rounded">@lang('website.cancel')</a>
                        <button type="submit" class="btn btn-success btn-rounded">@lang('website.save')</button>
                    </div>
                </div>
    </form>
</div>
@endsection
@push('scripts')
<script src="{{asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.js')}}"></script>
<script src="{{asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js')}}"></script>
<script src="{{asset('assets/main.js')}}"></script>
<script src="{{asset('assets/create_offer.js')}}"></script>
@endpush
