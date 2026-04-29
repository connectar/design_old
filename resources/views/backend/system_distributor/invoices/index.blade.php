
@extends('backend.layouts.system_distributor')

@section('content')

<livewire:system-distributor.invoices.system-distributor-invoices-index />

@endsection


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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/l10n/ar.js"></script>
<script>
flatpickr('#date-range', {
    dateFormat: 'Y-m-d',
    enableTime: false,
    mode: 'range',
    locale: 'ar',
    showMonths: 1,
    shorthandCurrentMonth: true,
});
</script>
@endpush
