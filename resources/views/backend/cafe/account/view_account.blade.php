@extends('backend.layouts.livewire.cafe')

@section('content')
    @livewire('network-account-view', ['route' => 'cafe'])
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/distributor_index.js') }}"></script>
@endpush
