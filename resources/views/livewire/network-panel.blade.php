<div class="bg-white">
    <x-modal-html modalId="userOptionalBoxModal" :width="$width">
        @if ($componentName == 'charge-network-account')
            @livewire('charge-network-account')
        @endif
    </x-modal-html>
</div>
