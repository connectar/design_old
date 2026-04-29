@extends('backend.layouts.dashboard')

@push('livewire_styles')
    @livewireStyles
@endpush

@section('header')
    @include('backend.includes.manager_header')
@endsection

@section('menu')
    @auth('admin')
        @if (authIsManager())
            {{-- Unified floating launcher: Support Chat + General Chat --}}
            @livewire('floating.floating-launcher', ['side' => 'manager'])
        @endif
    @endauth

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
