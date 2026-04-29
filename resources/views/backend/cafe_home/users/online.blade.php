@extends('backend.layouts.livewire.admin')

@section('content')
    <div>
        @livewire('users-online')
    </div>
@endsection
@push('livewire_scripts')
    <script src="{{ asset('assets/includes/swal_modal.js') }}"></script>
@endpush
