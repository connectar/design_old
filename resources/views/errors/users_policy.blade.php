@extends('backend.layouts.admin')

@section('content')
    <div class="box mt-50">
        <div class="box-body">
            <div class="text-center">
                <span class="text-danger h4">
                    {{ $error ?? __('admin_policy.expire_nas_count') }}
                </span>
            </div>
            @if (authIsAdmin())
                <div class="text-center mt-2">
                    <a href="{{ route('admins.account.change_plan') }}" class="btn btn-sm btn-primary">
                        الترقيه الى خطة اعلى
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
