@extends('backend.layouts.livewire.admin')

@section('content')
    <div class="box mt-50">
        <div class="box-body">
            <div class="text-center">
                <span class="text-success h2">
                    سوف تتاح هذة الميزة اليوم
                </span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/includes/distributor_index.js') }}"></script>
@endpush
