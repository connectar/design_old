@extends('backend.layouts.livewire.admin')

@section('content')
@livewire('nas-trashed')
@endsection

@push('scripts')
<script src="{{ asset('assets/includes/nas_index.js') }}"></script>
@endpush
