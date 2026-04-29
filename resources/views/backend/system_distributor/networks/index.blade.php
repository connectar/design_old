@extends('backend.layouts.system_distributor')

@section('content')
    @livewire('system-distributor.networks.system-distributor-network-index')

    @livewire('system-distributor.networks.modals.network-panel')
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/distributor_index.js') }}"></script>
@endpush
