@extends('backend.layouts.manger')

@section('content')
    <livewire:command-template.microtik-install-command-template />
@endsection


@push('scripts')

    <!-- Ace Editor CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ext-language_tools.js"></script>

    <!-- Example: Load a theme (adjust the URL as needed) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/theme-monokai.js"></script>





@endpush
