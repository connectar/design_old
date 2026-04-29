@extends('backend.layouts.manger')

@section('content')
<div class="row">
    <div class="col-12">
        <form id="FormSubmit" action="{{ route('managers.countries.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="box bt-3 border-success">
                <div class="box-header with-border">
                    <h4 class="box-title">@lang('adding.country.title')</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">@lang('adding.country.name')</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 form-select" name="countries[code]">
                                        @foreach ($countries as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('managers.countries.index') }}"
                        class="btn btn-dark btn-rounded">@lang('website.cancel')</a>
                    <button type="submit" class="btn btn-success btn-rounded">@lang('website.save')</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
@include('backend.includes.scripts.main_js')
<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>


@endpush
