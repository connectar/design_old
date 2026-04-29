@extends('backend.layouts.livewire.admin')
@section('content')
    @livewire('devices-modal')
    @livewire('devices-index')
@endsection
@push('livewire_scripts')
    <script src="{{ asset('assets/includes/devices_index.js') }}"></script>
@endpush
