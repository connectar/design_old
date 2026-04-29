@extends('backend.layouts.livewire.admin')

@section('content')
    @livewire('network-design-create')
@endsection
@push('scripts')
    <script src="https://unpkg.com/interactjs/dist/interact.min.js"></script>
    <script src="{{ asset('assets/includes/cafe_cards_create.js') }}?2"></script>
@endpush
