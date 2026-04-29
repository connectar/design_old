<div style="min-width: 140px">
    <div class="dropdown" style="white-space: nowrap;">
        <div class="clearfix pull-left">
            <span class="badge badge-dark">
                @if ($page != 1)
                    {{ $loop->index + 1 + $perPage * ($page - 1) }}
                @else
                    {{ $loop->index + 1 }}
                @endif
            </span>
            <span class=" me-2 px-2 badge badge-success">
                PPP
            </span>
            <span class="dropdown-toggle px-2 badge badge-info" data-bs-toggle="dropdown">
                {{ $model->fullname }}
            </span>
            <div class="dropdown-menu dropdown-menu-end fw-bold">

                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('showBroadbandDevice', { id: '{{ $model }}' })">
                        <i class="fa fa-eye text-success"></i>
                        {{ __('site.devices_index.show_device') }}
                    </a>

                    <a class="dropdown-item py-2 fw-bold" href="#"
                    wire:click="$dispatch('showBroadbandDeviceInsideVpn', { id: '{{ $model }}' })">
                    <i class="fa fa-eye text-info"></i>
                    {{ __('site.devices_index.show_device_inside_vpn') }}
                </a>
            </div>
        </div>
    </div>
</div>
