@extends('backend.layouts.livewire.cafe')

@section('content')
    @livewire($componenetName, ['nasSerial' => $nasSerial])
@endsection
@push('livewire_scripts')
    <script src="{{ asset('assets/includes/nas_connect.js') }}"></script>
@endpush
