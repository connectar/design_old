@extends('backend.layouts.admin')
@push('liveWire_styles')
    @livewireStyles
@endpush
<style>
    .iti{
        direction: ltr;
        text-align: left;
        width: 100%;
    }
</style>
@section('content')
    @livewire('admin-profile')
@endsection
@push('livewire_scripts')

@endpush
