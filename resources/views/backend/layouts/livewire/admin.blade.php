@extends('backend.layouts.dashboard')

@section('header')
    @include('backend.includes.admin_header')
@endsection
@section('menu')
    @if (authIsAdmin())
        {{-- Unified floating launcher: Support Chat + General Chat + WhatsApp --}}
        @livewire('floating.floating-launcher', ['side' => 'customer', 'showWhatsapp' => true])

        @include('backend.includes.admin_menu')
    @else
        @include('backend.includes.distributer_menu')
    @endif
@endsection

@push('livewire_scripts')
    <script src="{{ asset('assets/includes/livewireDatatableSettings.js') }}"></script>
    <script src="{{ asset('assets/includes/events_index.js') }}"></script>
@endpush
