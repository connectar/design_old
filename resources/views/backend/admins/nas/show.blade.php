@extends('backend.layouts.admin')
@push('liveWire_styles')
    @livewireStyles
@endpush
@section('content')
    @livewire('nas-install', ['nasSerial' => $nasSerial])
@endsection
@push('livewire_scripts')
    <script src="{{ asset('assets/includes/nas_connect.js') }}"></script>
@endpush
