@extends('backend.layouts.livewire.cafe')

@section('content')
    <div class="box mt-50">
        <div class="box-body">
            <div class="text-center">
                <span class="text-danger h4">
                    {{ $error ?? __('admin_policy.cafe_nas_reched') }}
                </span>
            </div>
            @if (authIsCafeAdmin())
                <div class="text-center mt-2">
                    <a href="{{ route('cafe.branches.create') }}" class="btn btn-sm btn-primary">
                        شراء كافيه جديد
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
