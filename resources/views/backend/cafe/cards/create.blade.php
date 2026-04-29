@push('liveWire_styles')
    @livewireStyles
@endpush
@extends('backend.layouts.livewire.cafe')

@section('content')
    @livewire('cafe-cards-new')
@endsection
@push('livewire_scripts')
@endpush
