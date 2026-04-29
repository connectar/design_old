<div class="bg-white">
    <x-modal-html modalId="userOptionalBoxModal" :width="$width">
        @if ($componentName == 'cafe-change-offer-for-user')
            @livewire('cafe-change-offer-for-user')
        @elseif($componentName == 'cafe-user-renew')
            @livewire('cafe-user-renew')
        @elseif($componentName == 'users.show-quta-usage')
            @livewire('users.show-quta-usage')
        @elseif($componentName == 'edit-user-panel-password')
            @livewire('edit-user-panel-password')
        @elseif($componentName == 'edit-view-columns')
            @livewire('edit-view-columns')
        @endif
    </x-modal-html>
</div>
