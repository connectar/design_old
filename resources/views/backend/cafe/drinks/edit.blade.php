@push('liveWire_styles')
@livewireStyles
@endpush
@extends('backend.layouts.livewire.cafe')

@section('content')
@livewire('edit-drink',['drinkId' => $drinkId])
@endsection
@push('livewire_scripts')
@endpush
