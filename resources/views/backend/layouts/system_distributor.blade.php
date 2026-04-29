@extends('backend.layouts.dashboard')


@section('header')
    @include('backend.includes.system_distributor_header')
@endsection

@section('menu')
        @include('backend.includes.system_distributor_menu')
@endsection

@push('livewire_scripts')
    <script src="{{ asset('assets/includes/livewireDatatableSettings.js') }}"></script>
@endpush
