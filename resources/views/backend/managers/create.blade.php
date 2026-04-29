@extends('backend.layouts.manger')

@section('content')
<div class="row">
    <div class="col-12">
        <form id="FormSubmit" action="{{ route('managers.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="box bt-3 border-success">
                <div class="box-header with-border">
                    <h4 class="box-title">@lang('adding.admin.manager_create_title')</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="active" class="col-sm-2 col-form-label">@lang('adding.admin.active')
                                </label>
                                <div class="col-sm-10">
                                    <label class="switch switch-success">
                                        <input name="active" type="checkbox" checked>
                                        <span class="switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                    class="col-sm-2 col-form-label">@lang('adding.admin.name')</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="adminData[name]"
                                        placeholder="@lang('adding.admin.name_placeholder')" id="name">
                                </div>
                                @error("adminData.name")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="fullname"
                                    class="col-sm-2 col-form-label">@lang('adding.admin.fullname')</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text"
                                        placeholder="@lang('adding.admin.fullname_placeholder')"
                                        name="adminData[fullname]" id="fullname">
                                </div>
                                @error("adminData.fullname")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="password"
                                    class="col-sm-2 col-form-label">@lang('adding.admin.password')</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" min="1"
                                        placeholder="@lang('adding.admin.password_placeholder')"
                                        name="adminData[password]" id="password">
                                </div>
                                @error("adminData.password")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            @php
                                use App\ENUMS\AdminTypeEnum;
                            @endphp
                            <div x-data="{ adminType: '' }">
                                <div class="form-group row">
                                    <label for="admin_type" class="col-sm-2 col-form-label">
                                        {{ __('adding.register.admin_type') }}
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                            <select x-model="adminType" class="selectpicker form-select show-tick p-0"
                                                    name="adminData[type]" id="admin_type">
                                                @foreach (AdminTypeEnum::getManagerCreateTypes() as $value)
                                                    <option value="{{ $value }}">
                                                        {{ AdminTypeEnum::matchLabelAdminTypes($value) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error("adminData.type")
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                @php
                                    $countries = app(App\Services\Caches\CountriesCacheable::class)->allCounties()
                                @endphp
                                <div class="form-group row" style="display: none" x-show="adminType === 'system_distributor'" x-cloak>
                                    <label for="sysdist_country" class="col-sm-2 col-form-label">
                                        {{ __('adding.register.sysdist_country') }}
                                    </label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-globe "></i>
                                            </div>
                                            <select class="selectpicker form-select show-tick p-0"
                                                    name="adminData[sysdist_country]" id="sysdist_country">
                                                    <option selected disabled value="">
                                                        اختيار دولة الموزع
                                                    </option>
                                                @foreach ($countries as $country)
                                                    {{-- skip Egypt as distributor country --}}
                                                    @if ($country->code == "EG")
                                                        @continue
                                                    @endif
                                                    <option value="{{ $country->code }}">
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error("adminData.sysdist_country")
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('managers.index') }}" class="btn btn-dark btn-rounded">@lang('website.cancel')</a>
                    <button type="submit" class="btn btn-success btn-rounded">@lang('website.save')</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
</script>
<script
    src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}">
</script>
    @include('backend.includes.scripts.main_js')
@endpush
