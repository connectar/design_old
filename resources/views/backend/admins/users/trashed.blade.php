@extends('backend.layouts.livewire.admin')
@section('content')
    @livewire('users-trashed')
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/admin_index.js') }}"></script>
@endpush
