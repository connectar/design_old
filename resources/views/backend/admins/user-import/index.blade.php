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
    <div class="box box-slided-up">
        <div class="box-header with-border">
            <h4 class="box-title">
                {{ trans('user-import.instructions') }}
                <span class="text-danger">{{ trans('user-import.important') }}</span>
            </h4>
        </div>
        <ul class="box-controls pull-right my-2">
            <li><a class="box-btn-slide" href="#"></a></li>
            <li><a class="box-btn-fullscreen" href="#"></a></li>
        </ul>

        <div class="box-body pt-0">
            <ul>
                <li>
                    {{ trans('user-import.file_extension') }}:
                    <span class="text-danger">{{ implode(',', $mimes) }}</span>
                </li>
                <li>
                    {{ trans('user-import.max_size') }}:
                    <span class="text-danger">{{ $max_size }} {{trans('user-import.mega')}}</span>
                </li>
                <li>
                    {{ trans('user-import.max_subscribers') }}:
                    <span class="text-danger">{{ $max_rows }}</span>
                </li>
                <li>
                    <span class="text-danger">{{ trans('user-import.dont_change_columns') }}</span>
                </li>
                <li>
                    {{ trans('user-import.download_file') }}
                    <a href="{{asset('assets/import-sheet-template.xlsx')}}" class="text-danger">
                        {{ trans('user-import.here') }}
                    </a>
                    {{ trans('user-import.add_subscribers') }}
                </li>
                <li>
                    {{ trans('user-import.error_handling') }}
                </li>
                <li>
                    <bdi>{{ trans('user-import.subscriber_name') }}</bdi> :
                    <span class="text-danger">{{ trans('user-import.required_unique_25') }}</span>
                </li>
                <li>
                    <bdi>{{ trans('user-import.username') }}</bdi> :
                    <span class="text-danger">{{ trans('user-import.required_unique_35') }}</span>
                </li>
                <li>
                    <bdi>{{ trans('user-import.password') }}</bdi> :
                    <span class="text-danger">{{ trans('user-import.optional_20') }}</span>
                </li>
                <li>
                    <bdi>{{ trans('user-import.phone') }}</bdi> :
                    <span class="text-danger">{{ trans('user-import.optional_11') }}</span>
                </li>
                <li>
                    <bdi>{{ trans('user-import.city') }}</bdi> :
                    <span class="text-danger">{{ trans('user-import.optional_30') }}</span>
                </li>
                <li>
                    <bdi>{{ trans('user-import.usage') }}</bdi> :
                    <span class="text-danger">{{ trans('user-import.usage_validate') }} <bdi>10 GB , 10 MB, 10 KB</bdi>)</span>
                </li>
                <li>
                    <span class="text-danger">{{ trans('user-import.must_usage_start_at') }}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="box box-slided-up ex_btn">
        <div class="box-header with-border">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <a href="{{asset('assets/import-sheet-template.xlsx')}}" class="btn btn-primary">
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
            <form action="{{ route('admins.user-import.upload') }}" method="post" enctype="multipart/form-data">
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
                <div class="row">
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password" class="form-label">
                                {{ trans('user-import.default_password') }}
                                <span class="text-primary">{{ trans('user-import.default_password_hint') }}</span>
                            </label>
                            <div>
                                <input value="{{ old('password') }}" name="password" placeholder="{{ trans('user-import.password') }}" class="form-control" type="text" id="password">
                                @error('password')
                                <span class="error text-danger">
                                    * {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mt-10">
                            <label for="nas" class="form-label">
                                {{ trans('user-import.server') }}
                                <span class="text-primary">{{ trans('user-import.server_hint') }}</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-server text-success"></i>
                                </div>
                                <select class="selectpickerJs form-select" name="nas">
                                    @foreach($nases as $item)
                                        @if(old('nas') and old('nas') == $item->serial)
                                            <option value="{{ $item->serial }}" selected="selected">{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->serial }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('nas')
                                <span class="error text-danger">
                                    * {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mt-10">
                            <label for="offer" class="form-label">
                                {{ trans('user-import.offer') }}
                                <span class="text-primary">{{ trans('user-import.offer_hint') }}</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-database text-success"></i>
                                </div>
                                <select class="selectpickerJs form-select" name="offer">
                                    @foreach($offers as $item)
                                        @if(old('offer') and old('offer') == $item->id)
                                            <option value="{{ $item->id }}" selected="selected">{{ $item->name }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('offer')
                                <span class="error text-danger">
                                    * {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mt-10">
                            <label for="connection" class="form-label">
                                {{ trans('user-import.connection_type') }}
                                <span class="text-primary">{{ trans('user-import.connection_type_hint') }}</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-wifi text-danger"></i>
                                </div>
                                <select class="selectpickerJs form-select" name="connection">
                                    @foreach($connection_type_arr as $item)
                                        @if(old('connection') and old('connection') == $item)
                                            <option value="{{ $item }}" selected="selected">{{ trans('networks.user.connection_type.' . $item) }}</option>
                                        @else
                                            <option value="{{ $item }}">{{ trans('networks.user.connection_type.' . $item) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('connection')
                                <span class="error text-danger">
                                    * {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group text-center mt-10">
                            <button class="btn ripple btn-danger" type="submit">
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
