


@extends('backend.layouts.livewire.user')

@section('content')

<livewire:notifications.user.notification-settings />

@endsection
@push('styles')
  <link rel="stylesheet" href="{{ asset('css/vendors_css.css') }}">
  <style>
  @media (max-width: 768px) {
    .custom-grid-mobile {
      display: grid!important;
      grid-template-columns: 1fr;
    }
  }
  </style>
@endpush
