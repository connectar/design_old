@extends('backend.layouts.livewire.admin')
@section('content')
    @livewire('admin-devices-dnat.dnat-device-modal')

    @livewire('admin-devices-dnat.dnat-broadband-devices.dnat-broad-band-devices-table')

@endsection
@push('livewire_scripts')
    <script src="{{ asset('assets/includes/devices_index.js') }}"></script>
    <script>
        window.addEventListener("checkBroadbandDnatConnection", (event) => {
            Livewire.dispatch(
                event.detail.eventName,
                event.detail.nas_address,
                event.detail.device_ip,
                event.detail.device_port,
                event.detail.device_schema
            );
        });
    </script>
@endpush
