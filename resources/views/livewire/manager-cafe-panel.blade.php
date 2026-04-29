<div class="bg-white">
    <x-modal-html modalId="userOptionalBoxModal" :width="$width">
        @if ($componentName == 'charge-cafe-account')
            @livewire('charge-cafe-account')
        @endif
    </x-modal-html>
</div>
