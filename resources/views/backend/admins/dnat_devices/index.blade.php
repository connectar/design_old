@extends('backend.layouts.livewire.admin')
@section('content')

    @livewire('admin-devices-dnat.dnat-device-modal')

    @livewire('admin-devices-dnat.dnat-device')

@endsection
@push('livewire_scripts')
    <script src="{{ asset('assets/includes/devices_index.js') }}"></script>
    <script>
        window.addEventListener("checkDnatConnectionV2", (event) => {
            Livewire.dispatch(
                event.detail.eventName,
                event.detail.nas_serial,
                event.detail.nas_address,
                event.detail.device_uuid,
                event.detail.device_type,
                event.detail.device_ip,
                event.detail.device_port,
                event.detail.device_schema
            );
        });
    </script>
@endpush
