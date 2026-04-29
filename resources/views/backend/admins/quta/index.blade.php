@extends('backend.layouts.admin')

@push('livewire_styles')
    @livewireStyles
@endpush

@section('content')
    @livewire('quta-index')
@endsection

@push('livewire_scripts')
    <script src="{{ asset('assets/includes/offers_index.js') }}"></script>
@endpush
