@extends('backend.layouts.livewire.admin')

@section('content')
    <div>
        @livewire('group-of-cards-for-users')
    </div>
    <div class="bg-white">
        <x-modal-html modalId="cardExportModal" width="modal-lg">
            @livewire('card-design-modal')
        </x-modal-html>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

    <script src="{{ asset('assets/includes/cards_print.js') }}?2"></script>
@endpush
