@extends('backend.layouts.livewire.admin')

@section('content')
@livewire('users-online')
{{-- @livewire('users-modal-components') --}}
@endsection
@push('livewire_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/ar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
@endpush
