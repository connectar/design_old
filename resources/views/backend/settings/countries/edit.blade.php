@extends('backend.layouts.manger')

@section('content')
    <livewire:managers.countries.update-country-services-prices :country="$country" />
@endsection
@push('scripts')
@include('backend.includes.scripts.main_js')
@endpush
