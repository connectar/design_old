@extends('backend.layouts.livewire.cafe')

@section('content')
    <div class="box bt-3 border-primary text-center">
        <div class="box-body py-50">
            <span class="d-block text-center text-success">
                <i class="fa fa-check fs-30"></i>
            </span>
            <span class="fw-bold text-primary fs-18">
                {{ __('site.replay_messages.errors.first_install', [
                    'price' => request('invoicePrice'),
                ]) }}
            </span>
            <span class="d-block mt-3">
                <a href="{{ route('cafe.nas.create') }}" class="btn btn-success btn-round">
                    {{ __('site.errors_pages.cafe_install') }}
                </a>
            </span>
        </div>
    </div>
@endsection
