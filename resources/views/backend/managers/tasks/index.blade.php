@extends('backend.layouts.manger')

@section('content')
    <div>
        @livewire('task-panel')
        @livewire('manager-task-index')
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/distributor_index.js') }}"></script>
@endpush
