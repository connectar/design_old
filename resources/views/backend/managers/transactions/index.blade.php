@extends('backend.layouts.manger')

@section('content')
    {{-- @livewire('app-transaction-status') --}}
    @livewire('manager-transactions')
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/livewireDatatableSettings.js') }}"></script>
    <script src="{{ asset('assets/includes/manager_transactions.js') }}"></script>
@endpush
