@extends('backend.layouts.livewire.admin')

@section('content')
@livewire('nas-index')
@livewire('nas-modal-components')
@endsection

@push('scripts')
<script src="{{ asset('assets/includes/nas_index.js') }}"></script>
@endpush
