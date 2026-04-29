@push('liveWire_styles')
    @livewireStyles
@endpush
@extends('backend.layouts.admin')

@section('content')
    @livewire('cards-new')
@endsection
@push('livewire_scripts')
@endpush
