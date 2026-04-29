<div class="bg-white">
    <x-modal-html modalId="NasOptionalBoxModal" :width="''">
        @if ($componentName == 'edit-nas-admin-password')
        @livewire('edit-nas-admin-password')
        @elseif ($componentName == 'edit-cafe-wifi-name')
        @livewire('edit-cafe-wifi-name')
        @else
        @livewire('edit-cafe-nas-password')
        @endif
    </x-modal-html>
</div>
