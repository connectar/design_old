<div class="bg-white">
    <x-modal-html modalId="userOptionalBoxModal" :width="$width">
        @if ($componentName == 'add-task')
            @livewire('add-task')
        @elseif ($componentName == 'edit-task')
            @livewire('edit-task')
        @endif
    </x-modal-html>
</div>
