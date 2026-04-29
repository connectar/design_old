@extends('backend.layouts.manger')

@section('content')
    @livewire('manager-new-transaction')
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/distributor_index.js') }}"></script>
@endpush
