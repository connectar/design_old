<div class="bg-white">
    <x-modal-html modalId="userOptionalBoxModal" :width="$width">
        @if ($componentName == 'show-card-usage')
        @livewire('show-card-usage')
        @elseif ($componentName == 'edit-expired-date-for-card')
        @livewire('edit-expired-date-for-card')
        @endif
    </x-modal-html>
</div>
