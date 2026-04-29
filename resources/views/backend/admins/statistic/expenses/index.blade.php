@extends('backend.layouts.livewire.admin')

@section('content')
   @livewire('statistics.admin.expenses-table', ['admin_id' => $admin_id])
@endsection

@push('scripts')

@endpush
