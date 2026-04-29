<div class="text-center mb-3" >
    <div class="text-danger fs-18 bg-white py-2" >
        <div class="mx-auto" style="max-width: 50%;line-height:1.6">
            @if (isAuthAdminNetworkInEgypt())
                <x-network-account-view.debt-message
                    :message="__('site.network_account_view.debt_message')"
                    :messageTwo="__('site.network_account_view.debt_message_2')"
                    actionUrl="https://youtu.be/WHebz6FIeig"/>
            @elseif(isAuthAdminBillingCurrencyIsDollar())
                <p class="pt-2" style="font-weight:600!important; ">
                    {{ __('site.network_account_view.debt_message_paypal') }}
                </p>
                @livewire('charge-network-admin-account')
            @elseif ($adminHasSystemDistributor)
                <x-network-account-view.debt-message
                    :message="__('site.network_account_view.debt_message_system_distributor')"
                    :messageTwo="__('site.network_account_view.debt_message_2')"
                    :systemDistributor="$systemDistributor"
                    />
            @else
                <x-network-account-view.debt-message
                    :message="__('site.network_account_view.debt_message')"
                    :messageTwo="__('site.network_account_view.debt_message_2')"
                    actionUrl="https://youtu.be/WHebz6FIeig"/>
            @endif
        </div>
    </div>
</div>
