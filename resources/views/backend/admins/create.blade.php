@extends('backend.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="FormSubmit" action="{{ route('admins.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="box bt-3 border-success">
                    <x-box-header back-text="{{ __('adding.admin.back_to_all') }}"
                        title="{{ __('adding.admin.create_title') }}"
                        back-route="{{ route('admins.index') }}" />
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="active"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.active')
                                    </label>
                                    <div class="col-sm-10">
                                        <label class="switch switch-success">
                                            <input name="active" type="checkbox" checked>
                                            <span class="switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fullname"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.fullname')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            placeholder="@lang('adding.admin.fullname_placeholder')"
                                            name="adminData[fullname]" id="fullname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.name')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="adminData[name]"
                                            placeholder="@lang('adding.admin.name_placeholder')"
                                            id="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.password')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" min="1"
                                            placeholder="@lang('adding.admin.password_placeholder')"
                                            name="adminData[password]" id="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.email')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email"
                                            name="adminData[email]"
                                            placeholder="@lang('adding.admin.email_placeholder')"
                                            id="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.phone')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            name="adminData[phone]"
                                            placeholder="@lang('adding.admin.phone_placeholder')"
                                            id="phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="other_phone"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.other_phone')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            name="adminData[other_phone]"
                                            placeholder="@lang('adding.admin.other_phone_placeholder')"
                                            id="other_phone">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->
                        <x-box-footer cancelRoute="{{ route('admins.index') }}"
                            submitText="{{ __('website.save') }}" />
                    </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    @include('backend.includes.scripts.main_js')
@endpush
