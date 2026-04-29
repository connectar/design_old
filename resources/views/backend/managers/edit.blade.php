@extends('backend.layouts.manger')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="FormSubmit" action="{{ route('managers.update', $manager->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="box bt-3 border-success">
                    <div class="box-header with-border">
                        <h4 class="box-title">@lang('adding.admin.manager_edit_title')</h4>
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
                                            <input name="active" type="checkbox"
                                                @if ($manager->active == 1 || old('active')) checked @endif>
                                            <span class="switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fullname" class="col-sm-2 col-form-label">@lang('adding.admin.fullname')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control " type="text" placeholder="@lang('adding.admin.fullname_placeholder')"
                                            name="adminData[fullname]" id="fullname" value="{{ $manager->fullname }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">@lang('adding.admin.name')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control " type="text" name="adminData[name]"
                                            placeholder="@lang('adding.admin.name_placeholder')" id="name" value="{{ $manager->name }}">
                                    </div>
                                </div>

                                {{-- chanage password --}}
                                <div class="form-group row">
                                    <label for="change_password" class="col-sm-2 col-form-label">@lang('adding.admin.change_password')
                                    </label>
                                    <div class="col-sm-10">
                                        <label class="switch switch-danger">
                                            <input name="change_password" type="checkbox" />
                                            <span class="switch-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="managerCangePasswordContent" style="display: none">
                                    {{-- <div class="form-group row">
                                    <label for="old_password"
                                        class="col-sm-2 col-form-label">@lang('adding.admin.old_password')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password"
                                            placeholder="@lang('adding.admin.old_password_placeholder')"
                                            name="old_password" id="old_password">
                                    </div>
                                </div> --}}
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-2 col-form-label">@lang('adding.admin.new_password')</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password" name="password"
                                                placeholder="@lang('adding.admin.new_password_placeholder')" id="password">
                                        </div>
                                    </div>
                                </div>
                                {{-- chanage password --}}
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ route('managers.index') }}" class="btn btn-dark btn-rounded">@lang('website.cancel')</a>
                        <button type="submit" class="btn btn-success btn-rounded">@lang('website.update')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- @include('backend.includes.show_errors') --}}
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
