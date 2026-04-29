@extends('backend.layouts.livewire.admin')

@push('livewire_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pickaday.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/assets/vendor_components/nestable/nestable.css') }}">
@endpush
@section('content')
    <div x-data="userIndex">
        @livewire('users-modal-components')
        @livewire('users-index')
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/ar.js"></script>
    <script src="{{ asset('assets/pickaday.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/nestable/jquery.nestable.js') }}"></script>
    <script src="{{ asset('assets/includes/users_index.js') }}"></script>
    <script>
        var messages = @json($messages);
    </script>
@endpush
