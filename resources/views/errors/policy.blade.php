@if (authIsAdmin())
@extends('backend.layouts.admin')
@endif

@section('content')
<div class="box bt-3 border-primary text-center">
    <div class="box-body py-50">
        <span class="fw-bold text-danger fs-18">
            👀 {{ __('site.permission_errors.default') }}
        </span>
    </div>
</div>
@endsection
