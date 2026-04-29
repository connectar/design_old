@if (authIsAdmin())
    @extends('backend.layouts.admin')
@endif

@section('content')
    <div class="box bt-3 border-primary text-center">
        <div class="box-body py-50">
            <span class="fw-bold text-danger fs-18">
                👀 {{ __('site.empty.offer') }}
            </span>
            @isset($route)
                <a href="{{ route('cafe.offers.create') }}" class="btn btn-success">
                    {{ __('site.empty.from_here') }}
                </a>
            @else
                <a href="{{ route('admins.offers.create') }}" class="btn btn-success">
                    {{ __('site.empty.from_here') }}
                </a>
            @endisset
        </div>
    </div>
@endsection
