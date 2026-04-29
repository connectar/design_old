@extends('backend.layouts.livewire.cafe')

@section('content')
    @livewire('cafe-branches-index')
    @livewire('network-panel')
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/distributor_index.js') }}"></script>
@endpush
