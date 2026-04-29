@extends('backend.layouts.manger')

@section('content')
    <div class="box bt-3 border-primary text-center">
        <div class="box-body py-50">
            <span class="fw-bold text-danger fs-18">
                👀 {{ __('site.permission_errors.default') }}
            </span>
            <div class="text-center py-3">
                <a class="btn btn-sm btn-primary" href="{{ route('managers.servers.index') }}">الذهاب الى
                    صفحة
                    السيرفرات</a>
            </div>
        </div>
    </div>
@endsection
