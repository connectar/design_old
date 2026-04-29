<div>
    <div class="box bt-1 border-success">
        <div class="box-body">
            {{-- Tabs --}}
            <ul class="nav nav-tabs justify-content-start mb-20">
                <li>
                    <a href="" class="main_tab nav-link @if ($tabView == 1) active @endif py-1"
                        wire:click.prevent="$set('tabView',1)">
                        <i class="fa fa-info"></i>
                        {{ __('site.network_account_view.ul_account') }}
                    </a>
                </li>
            </ul>
            {{-- Tab Content --}}

            <div class="tab-content pb-0">
                <div class="text-center mb-3">
                    <div class="text-danger fs-18 bg-white py-2">
                        <x-network-account-view.debt-message :message="__('site.system_distributor_messages.message')" :numbers="false">
                            <div class="text-center fw-bold">
                                م/محسن محمد
                                <span class="fs-20 px-3 text-danger fw-bold">
                                    01026177689
                                </span>
                            </div>
                            <div class="text-center fw-bold">
                                م/حسين عيد
                                <span class="fs-20 px-3 text-danger fw-bold">
                                    01080239650
                                </span>
                            </div>
                        </x-network-account-view.debt-message>
                    </div>
                </div>
                <div class="justify-content-between">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-body pull-up bg-info">
                                <div class="flexbox">
                                    <span class="fa fa-dollar fs-40"></span>
                                    <span class="fw-200 fs-40">
                                        {{ auth('admin')->user()->account ?? 0 }}
                                        <span class="fw-200 fs-22">
                                            {{ __('currencies.' . getCurrencyCodeByCountryCode(auth('admin')->user()->sysdist_country)) }}
                                        </span>
                                    </span>
                                </div>
                                <div class="text-end">
                                    {{ __('new_trans.current_balance') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
