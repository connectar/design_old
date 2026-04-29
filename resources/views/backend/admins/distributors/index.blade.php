@extends('backend.layouts.livewire.admin')

@section('content')
    @livewire('distributer-index')
    @livewire('distributor-panel')
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/distributor_index.js') }}"></script>
@endpush
