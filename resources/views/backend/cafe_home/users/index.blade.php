@extends('backend.layouts.livewire.cafe')

@section('content')
    <div x-data="userIndex">
        @livewire('cafe-users-modal')
        @livewire('cafe-users-index')
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
