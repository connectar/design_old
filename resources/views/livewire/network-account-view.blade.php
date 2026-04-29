<div>
    <div class="box bt-1 border-success">
        <div class="box-body">
            @if ($adminIsDistributor)
                @if ($debtInvoices > 0 && $createdAtIsGreaterThanNow == true)
                    <div class="text-center mb-3">
                        <p class="text-primary fs-18">
                            {{ __('site.network_account_view.debt_message_distirutor') }}
                        </p>
                        <span class="text-warning fs-20">
                            {{ $setting['phone' ?? ''] }}
                        </span>
                        -
                        <span class="fs-20">
                            {{ $setting['other_phone' ?? ''] }}
                        </span>
                    </div>
                @endif
            @else


            {{-- if user is Network Admin --}}
            {{-- Tabs --}}
                <ul class="nav nav-tabs justify-content-start mb-20">
                    <li>
                        <a href=""
                            class="main_tab nav-link @if ($tabView == 1) active @endif py-1"
                            wire:click.prevent="$set('tabView',1)">
                            <i class="fa fa-info"></i>
                            {{ __('site.network_account_view.ul_account') }}
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="main_tab nav-link py-1 @if ($tabView == 3) active @endif"
                            wire:click.prevent="$set('tabView',3)">
                            <i class="fa fa-money"></i>
                            {{ __('site.network_account_view.ul_transactions') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route($route . '.account.change_plan') }}"
                            class="main_tab nav-link py-1 text-primary">
                            <i class="fa fa-pencil"></i>
                        {{ __('new_trans.change_plan') }}
                        </a>
                    </li>
                </ul>
            {{-- Tab Content --}}

                <div class="tab-content pb-0">
                {{-- Network Admin Payment Messages --}}
                    @if ($this->networkHasDebtInvoices())
                        {{-- new networks debt message --}}
                            @if ($network->status == 'new')
                                @include('backend.managers.networks.includes.account_messages.new_account_debt_message')
                            @else
                        {{-- disabled networks debt message--}}
                            @if ($dayOfMonth >= 10)
                                @include('backend.managers.networks.includes.account_messages.disabled_network_debt_message')
                            @else
                        {{-- networks debt message --}}
                                @include('backend.managers.networks.includes.account_messages.network_debt_message')
                            @endif
                        @endif
                    @else
                        {{-- if Network Admin has no debt invoices --}}
                        @include('backend.managers.networks.includes.account_messages.network_without_debt_message')
                    @endif

                    @if ($tabView == 1)
                        <div class="tab-pane main_tab active" id="account">
                            @include('backend.managers.networks.includes.account')
                        </div>
                    @elseif ($tabView == 2)
                        <div class="tab-pane main_tab active" id="invoices">
                            invoices
                        </div>
                    @else
                        <div class="tab-pane main_tab active" id="transactions">
                            <div>
                                @if (isAuthAdminNetworkInEgypt())
                                    @livewire('admin-transactions')
                                @elseif (isAuthAdminBillingCurrencyIsDollar())
                                    @livewire('paypal.admin-transaction-paypal-table')
                                @else
                                    @livewire('system-distributor.admins.admin-transaction')
                                @endif
                            </div>
                        </div>
                    @endif
                    <!-- end of tab-pane-->
                </div>
            @endif
        </div>
    </div>
</div>
