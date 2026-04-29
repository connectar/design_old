@extends('backend.layouts.livewire.cafe')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="FormSubmit" action="{{ route('cafe.nas.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="box bt-3 border-success">
                    <x-box-header back-text="{{ __('adding.nas.all_title') }}"
                        title="{{ __('adding.nas.create_title') }}"
                        back-route="{{ route('admins.nas.index') }}" />
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="offset-md-3 col-md-5">
                                <div class="form-group row">
                                    <label for="name" class="form-label">
                                        {{ __('adding.nas.name') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-tags text-primary"></i>
                                            </div>
                                            <input class="form-control" type="text"
                                                placeholder="@lang('adding.nas.name_placeholder')" name="nasData[name]"
                                                id="name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-md-3 col-md-5">
                                <div class="form-group row">
                                    <label for="name" class="form-label">
                                        {{ __('adding.nas.type') }}
                                    </label>
                                    <div>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-tags text-primary"></i>
                                            </div>

                                            <select class="form-select" name="nasData[type]">
                                                @foreach (trans('adding.nas.types') as $key => $value)
                                                    )
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <x-box-footer cancelRoute="{{ route('cafe.nas.index') }}"
                            submitText="{{ __('website.save') }}" />
                    </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @include('backend.includes.scripts.main_js')
@endpush
