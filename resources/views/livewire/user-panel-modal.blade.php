<div class="bg-white">
    <x-modal-html modalId="userOptionalBoxModal" :width="$width">
        @if ($componentName == 'charge-user-account')
            @livewire('charge-user-account')
        @elseif($componentName == 'show-and-add-quta-by-user')
            @livewire('show-and-add-quta-by-user')
        @elseif($componentName == 'renew-from-panel')
            @livewire('renew-from-panel')
        @elseif($componentName == 'users.show-quta-usage')
            @livewire('users.show-quta-usage')
        @elseif($componentName == 'show-user-invoices')
            @livewire('show-user-invoices')
        @elseif($componentName == 'show-user-log')
            @livewire('show-user-log')
        @elseif($componentName == 'change-offer-by-user')
            @livewire('change-offer-by-user')
        @endif
    </x-modal-html>
</div>
