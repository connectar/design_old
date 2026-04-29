@extends('backend.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="FormSubmit" action="{{ route('admins.nas.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="box bt-3 border-success">
                    <x-box-header back-text="{{ __('adding.nas.all_title') }}"
                        title="{{ __('adding.nas.create_title') }}"
                        back-route="{{ route('admins.nas.index') }}" />
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="name"
                                        class="col-sm-2 col-form-label">@lang('adding.nas.name')</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            placeholder="@lang('adding.nas.name_placeholder')"
                                            name="nasData[name]" id="name">
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->
                        <x-box-footer cancelRoute="{{ route('admins.nas.index') }}"
                submitText="{{ __('website.save') }}" />
                    </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    @include('backend.includes.scripts.main_js')
@endpush
