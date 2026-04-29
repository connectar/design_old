@extends('backend.layouts.admin')
@push('liveWire_styles')
    @livewireStyles
@endpush
@section('content')
    @livewire('show-messages-index', ['page' => $page])
@endsection
@push('livewire_scripts')
@endpush
