@extends('backend.layouts.livewire.cafe')

@section('content')
    @livewire('cafe-offers-index')
@endsection

@push('livewire_scripts')
    <script src="{{ asset('assets/includes/offers_index.js') }}"></script>
@endpush
