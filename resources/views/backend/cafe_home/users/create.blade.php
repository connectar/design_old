@push('liveWire_styles')
    @livewireStyles
@endpush
@extends('backend.layouts.livewire.cafe')

@section('content')
    <form id="FormSubmit" action="{{ route('cafe_home.users.store') }}" method="POST" novalidate>
        @method('POST')
        @csrf
        <div class="box bt-1 border-success">
            <x-box-header back-text="{{ __('adding.user.users_title') }}"
                title="{{ __('adding.user.create_title') }}"
                back-route="{{ route('cafe_home.users.index') }}" />

            <div class="box-body pt-0" x-data="addNewUser">
                <div class="col-12">
                    @include('backend.cafe_home.users.includes.create')
                </div>

            </div>
            <!-- /.box-body -->

            <x-box-footer cancelRoute="{{ route('cafe_home.users.index') }}"
                submitText="{{ __('website.save') }}" />
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}">
    </script>
    <script
        src="{{ asset('assets/vendor_components/bootstrap-select/dist/js/i18n/defaults-ar_AR.js') }}">
    </script>
    <script src="{{ asset('assets/main.js') }}"></script>
    <script src="{{ asset('assets/functions.js') }}"></script>
    <script src="{{ asset('assets/create_user.js') }}"></script>
@endpush
@push('livewire_scripts')
@endpush
