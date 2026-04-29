@extends('backend.layouts.manger')

@section('content')
    @livewire('manager-cafe-index')
    @livewire('manager-cafe-panel')
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/distributor_index.js') }}"></script>
@endpush
