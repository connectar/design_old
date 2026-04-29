@extends('backend.layouts.dashboard')

@section('header')
    @include('backend.includes.manager_header')
@endsection

@section('menu')
    @if (isManagerTechSupport())
        @include('backend.includes.manager_menu_soft')
    @else
        @include('backend.includes.manager_menu')
    @endif
@endsection

@push('livewire_scripts')
    <script src="{{ asset('assets/includes/livewireDatatableSettings.js') }}"></script>
    <script src="{{ asset('assets/includes/manager_transactions.js') }}"></script>
@endpush
