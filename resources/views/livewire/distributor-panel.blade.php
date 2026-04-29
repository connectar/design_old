<div class="bg-white">
    <x-modal-html modalId="userOptionalBoxModal" :width="$width">
        @if ($componentName == 'charge-distributor-account')
            @livewire('charge-distributor-account')
        @endif
    </x-modal-html>
</div>
