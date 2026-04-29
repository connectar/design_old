@extends('backend.layouts.dashboard')

@push('livewire_styles')
    @livewireStyles
@endpush

@section('header')
    @include('backend.includes.admin_header')
@endsection
@section('menu')
    @if (authIsCafeAdmin())
        @include('backend.includes.cafe_menu')
    @elseif(authIsCafeHomeAdmin())
        @include('backend.includes.cafe_home_menu')
    @else
        @include('backend.includes.cafe_branch_menu')
    @endif
@endsection

@push('livewire_scripts')
    <script src="{{ asset('assets/includes/livewireDatatableSettings.js') }}"></script>
    <script src="{{ asset('assets/includes/events_index.js') }}"></script>
@endpush
