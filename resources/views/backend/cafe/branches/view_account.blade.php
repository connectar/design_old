@extends('backend.layouts.livewire.admin')

@section('content')
    @livewire('network-account-view')
    {{-- @livewire('network-panel') --}}
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/distributor_index.js') }}"></script>
@endpush
