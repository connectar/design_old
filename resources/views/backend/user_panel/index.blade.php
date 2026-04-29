@extends('backend.layouts.livewire.user')

@section('content')
    @livewire('user-panel-index')
    @livewire('user-panel-modal')
@endsection
@push('scripts')
    <script src="{{ asset('assets/vendor_components/jquery-knob/js/jquery.knob.js') }}"></script>
    <script src="{{ asset('js/pages/widget-inline-charts.js') }}"></script>
    <script src="{{ asset('assets/includes/users_panel_index.js') }}"></script>
@endpush
