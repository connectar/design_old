@extends('backend.layouts.dashboard')

@push('livewire_styles')
    @livewireStyles
@endpush

@section('header')
    @include('backend.includes.user_header')
@endsection

@section('menu')
    @include('backend.includes.user_menu')
@endsection

@push('livewire_scripts')
    <script src="{{ asset('assets/includes/livewireDatatableSettings.js') }}"></script>
@endpush
