@extends('backend.layouts.livewire.admin')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .flatpickr-day.inRange{
        background: #569ff7 !important;
        border-color: #569ff7 !important;
        color: #fff !important;
        box-shadow: none !important;
    }
</style>
@endpush
@section('content')

   <livewire:statistics.admin.invoices-statistics />
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/ar.js"></script>

<script>
    flatpickr('#date-range', {
            dateFormat: 'Y-m-d', // Set your desired date format
            enableTime: false,   // Enable or disable time selection
            mode: 'range',       // Enable date range selection
            locale: 'ar',        // Set the locale to Arabic
            shorthandCurrentMonth: true
       });
       flatpickr('#date-rangetwo', {
            dateFormat: 'Y-m-d', // Set your desired date format
            enableTime: false,   // Enable or disable time selection
            mode: 'range',       // Enable date range selection
            locale: 'ar',        // Set the locale to Arabic
            shorthandCurrentMonth: true
          });
</script>

@endpush
