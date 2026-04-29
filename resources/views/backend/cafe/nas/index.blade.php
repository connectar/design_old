@extends('backend.layouts.livewire.cafe')

@section('content')
    @livewire('cafe-nas-index')
    @livewire('nas-modal-components')
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/nas_index.js') }}"></script>
@endpush
