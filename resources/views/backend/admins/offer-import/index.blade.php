@extends('backend.layouts.admin')
<style>
    label span{
        font-size: 12px;
        display: block;
        margin-top: 3px;
    }
    .box-body ul li{
        line-height: 30px !important;
        font-size: 15px;
    }
    .alert strong{
        font-weight: bold;
        font-size: 25px;
        text-align: center;
    }
    .ex_btn a{
        width: 100%;
    }
</style>
@section('content')
    <div class="box box-slided-up ex_btn">
        <div class="box-header with-border">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <a href="{{asset('assets/import-offer-template.xlsx')}}" class="btn btn-primary">
                        <i class="fa fa-download"></i>
                        {{ trans('user-import.btn_excel') }}
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" target="_blank" class="btn btn-danger">
                        <i class="fa fa-youtube"></i>
                        {{ trans('user-import.btn_explain') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="box border-success m-0">
        <div class="box-body px-5">
            <form action="{{ route('admins.offer-import.upload') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('import_results'))
                    <div class="row text-center">
                        <div class="col-sm-4">
                            <div class="alert alert-info">
                                {{ trans('user-import.result_all') }}
                                <strong class="d-block">{{session('import_results')['totalRows']}}</strong>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="alert alert-success">
                                {{ trans('user-import.result_success') }}
                                <strong class="d-block">{{session('import_results')['addedRows']}}</strong>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="alert alert-danger">
                                {{ trans('user-import.result_failed') }}
                                <strong class="d-block">{{session('import_results')['skippedRows']}}</strong>
                            </div>
                        </div>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled m-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="fa fa-times"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="formFile" class="form-label">
                                {{ trans('user-import.file') }}
                                <span class="text-primary">{{ trans('user-import.supported_format', ['formats' => implode(',', $mimes), 'size' => $max_size]) }}</span>
                            </label>
                            <input class="form-control" type="file" name="file">
                            @error('file')
                            <span class="error text-danger">
                                * {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group text-center mt-10">
                            <button class="btn ripple btn-danger btn-block" type="submit">
                                {{ trans('user-import.upload') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
