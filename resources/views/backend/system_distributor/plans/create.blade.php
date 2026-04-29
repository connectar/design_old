@extends('backend.layouts.system_distributor')

@section('content')
    @livewire('system-distributor.plans.system-distributor-plan-create')
@endsection

@push('scripts')
    @include('backend.includes.scripts.main_js')
@endpush
