@extends('backend.layouts.livewire.cafe')

@section('content')
    <div>
        @livewire('cafe-group-of-cards-for-users')
    </div>
    <div class="bg-white">
        <x-modal-html modalId="cardExportModal" width="modal-lg">
            @livewire('cafe-card-design-modal')
        </x-modal-html>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

    <script src="{{ asset('assets/includes/cafe_cards_print.js') }}?2"></script>
@endpush
