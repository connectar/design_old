@extends('backend.layouts.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <form id="FormSubmit" action="{{ route('admins.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="box bt-3 border-success">
                    <x-box-header back-text="{{ __('adding.admin.back_to_all') }}"
                        title="{{ __('adding.admin.edit_title') }}"
                        back-route="{{ route('admins.index') }}">
                        <x-slot name="username">
                            <span class="text-black">
                                {{ $admin->fullname }}
                            </span>
                        </x-slot>
                    </x-box-header>
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
                                            <input name="active" type="checkbox" @if ($admin->active == 1)
                                            checked @endif>
                                            <span class="switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fullname"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.fullname')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            name="adminData[fullname]" id="fullname"
                                            value="{{ $admin->fullname }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.name')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="adminData[name]"
                                            value="{{ $admin->name }}" id="name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.email')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email"
                                            name="adminData[email]" value="{{ $admin->email }}"
                                            id="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.phone')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            name="adminData[phone]" value="{{ $admin->phone }}"
                                            id="phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="other_phone"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.other_phone')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            name="adminData[other_phone]"
                                            value="{{ $admin->other_phone }}" id="other_phone">
                                    </div>
                                </div>
                                <!-- /.col -->
                                {{-- chanage password --}}
                                <div class="form-group row">
                                    <label for="change_password"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.change_password')
                                    </label>
                                    <div class="col-sm-10">
                                        <label class="switch switch-danger">
                                            <input name="change_password" type="checkbox" />
                                            <span class="switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="managerCangePasswordContent" style="display: none">
                                    <div class="form-group row">
                                        <label for="old_password"
                                            class="col-sm-2 col-form-label">@lang('adding.admin.old_password')</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password"
                                                placeholder="@lang('adding.admin.old_password_placeholder')"
                                                name="old_password" id="old_password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password"
                                            class="col-sm-2 col-form-label">@lang('adding.admin.new_password')</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password"
                                                name="password"
                                                placeholder="@lang('adding.admin.new_password_placeholder')"
                                                id="password">
                                        </div>
                                    </div>
                                </div>
                                {{-- chanage password --}}
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
    <script>
        $(document).on('change', '[name=change_password]', function() {
            if (this.checked) {
                return $('.managerCangePasswordContent').show();
            }
            return $('.managerCangePasswordContent').hide();
        });
    </script>
@endpush
