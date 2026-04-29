<div class="bg-white">
    <x-modal-html modalId="userOptionalBoxModal" :width="$width">
        @if ($componentName == 'system-distributor.networks.modals.charge-network-account')
            @livewire('system-distributor.networks.modals.charge-network-account')
        @endif
    </x-modal-html>
</div>
