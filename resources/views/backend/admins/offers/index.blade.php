@extends('backend.layouts.livewire.admin')

@section('content')
@livewire('offers-index')
@endsection

@push('livewire_scripts')
<script src="{{ asset('assets/includes/offers_index.js') }}"></script>
@endpush
