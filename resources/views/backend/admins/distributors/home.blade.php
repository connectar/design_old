@extends('backend.layouts.livewire.admin')

@section('content')
    @livewire('distributor-home', ['distributor_id' => $distributor_id])
@endsection
