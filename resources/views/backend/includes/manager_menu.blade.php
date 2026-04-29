<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav" style="transition: width 0.5s;">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->

                <ul class="sidebar-menu pt-4" data-widget="tree">
                    <li>
                        <a href="{{ route('managers.statistic') }}">
                            <i class="fa fa-bar-chart p-0 mx-2" aria-hidden="true"></i>
                            <span>الإحصائيات العامة</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="{{ route('managers.plans.index') ?? '' }}">
                            <i class="fa fa-bar-chart p-0 mx-2 " aria-hidden="true"></i>
                            <span>@lang('menu.manager_menu.dashboard')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('managers.plans.index') ?? '' }}">
                                    <i class="fa fa-list"></i>@lang('menu.manager_menu.plan.all')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('managers.plans.create') }}">
                                    <i class="fa fa-plus-circle"></i>@lang('menu.manager_menu.plan.create')
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- managers --}}
                    <li class="treeview">
                        <a href="{{ route('managers.index') ?? '' }}">
                            <i class="fa fa-user-circle p-0 mx-2" aria-hidden="true"></i>
                            <span>@lang('menu.manager_menu.managers')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('managers.index') ?? '' }}">
                                    <i class="fa fa-list"></i>@lang('menu.manager_menu.manager.all')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('managers.create') }}">
                                    <i class="fa fa-plus-circle"></i>@lang('menu.manager_menu.manager.create')
                                </a>
                            </li>
                            <x-menu-trashed :route="route('managers.trashed')" />
                        </ul>
                    </li>
                    {{-- managers --}}
                    {{-- managers.plans --}}
                    <li class="treeview">
                        <a href="{{ route('managers.plans.index') }}">
                            <i class="fa fa-handshake-o p-0 mx-2" aria-hidden="true"></i>
                            <span>@lang('menu.manager_menu.plans')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('managers.plans.index') }}">
                                    <i class="fa fa-list"></i>@lang('menu.manager_menu.plan.all')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('managers.plans.create') }}">
                                    <i class="fa fa-plus-circle"></i>@lang('menu.manager_menu.plan.create')
                                </a>
                            </li>
                            <x-menu-trashed :route="route('managers.plans.trashed')" />
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('managers.tasks.index') }}">
                            <i class="fa fa-thumb-tack p-0 mx-2" aria-hidden="true"></i>
                            <span>@lang('menu.manager_menu.tasks')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('managers.message-panel.index') }}">
                            <i class="fa fa-envelope p-0 mx-2" aria-hidden="true"></i>
                            <span>@lang('menu.manager_menu.message_panel')</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-question fa-md p-0 mx-2" aria-hidden="true"></i>
                            <span>
                                @lang('menu.manager_menu.questions')
                            </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('managers.questions.faqs.index') }}">
                                    <i class="fa fa-question-circle"></i>
                                    <span>
                                        @lang('menu.manager_menu.faqs')
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('managers.questions.posts.index') }}">
                                    <i class="fa fa-newspaper-o"></i>
                                    <span>
                                        @lang('menu.manager_menu.posts')
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('managers.scrape.index') }}">
                            <i class="fa fa-database p-0 mx-2" aria-hidden="true"></i>
                            <span>@lang('menu.scrape.index')</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('managers.database.index') }}">
                            <i class="fa fa-table text-info p-0 mx-2" aria-hidden="true"></i>
                            <span>{{ __('database_browser.menu_title') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('managers.legacy-sync.index') }}">
                            <i class="fa fa-exchange text-success p-0 mx-2" aria-hidden="true"></i>
                            <span>{{ __('legacy_sync.menu_link') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('managers.invoices.admins') }}">
                            <i class="fa fa-money p-0 mx-2" aria-hidden="true"></i>
                            <span>@lang('menu.manager_menu.admin_invoices')</span>
                        </a>
                    </li>
                    {{-- managers.setting --}}
                    <li>
                        <a href="{{ route('managers.settings') }}">
                            <i class="fa fa-cogs p-0 mx-2" aria-hidden="true"></i>
                            <span>@lang('menu.manager_menu.settings')</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('managers.install.settings') }}">
                            <i class="fa fa-wrench p-0 mx-2" aria-hidden="true"></i>
                            <span>@lang('menu.manager_menu.install_settings')</span>
                        </a>
                    </li>

                    {{-- site --}}
                    {{-- countries --}}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-globe fa-md fa-spin  p-0 mx-2 " aria-hidden="true"></i>
                            <span>
                                @lang('menu.manager_menu.countries')
                            </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('managers.countries.index') ?? '#' }}">
                                    <i class="fa fa-list"></i>
                                    <span>
                                        @lang('menu.manager_menu.setting.country.all')
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('managers.countries.create') ?? '#' }}">
                                    <i class="fa fa-plus-circle"></i>
                                    <span>
                                        @lang('menu.manager_menu.setting.country.create')
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- countries --}}
                    <li class="treeview">
                        <a href="{{ route('managers.networks.index') }}">
                            <i class="fa fa-tasks p-0 mx-2" aria-hidden="true"></i>
                            <span>@lang('menu.manager_menu.networks')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('managers.networks.index') }}">
                                    <i class="fa fa-list"></i>@lang('menu.manager_menu.network.all')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('managers.networks.create') }}">
                                    <i class="fa fa-plus-circle"></i>@lang('menu.manager_menu.network.create')
                                </a>
                            </li>
                    </li>
                    <x-menu-trashed :route="route('managers.networks.trashed')" />
                </ul>
                </li>
                <li class="treeview">
                    <a href="{{ route('managers.networks.index') }}">
                        <i class="fa fa-coffee p-0 mx-2" aria-hidden="true"></i>
                        <span>@lang('menu.manager_menu.cafe_title')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('managers.cafe.index') }}">
                                <i class="fa fa-list"></i>@lang('menu.manager_menu.cafe.all')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('managers.cafe.create') }}">
                                <i class="fa fa-plus-circle"></i>@lang('menu.manager_menu.cafe.create')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('managers.old_cafe') }}">
                                <i class="fa fa-archive"></i>
                                <span>
                                    {{ __('menu.manager_menu.old_cafes') }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('managers.servers.index') }}">
                        <i class="fa fa-server p-0 mx-2" aria-hidden="true"></i>
                        <span>@lang('menu.manager_menu.servers')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('managers.transactions') }}">
                        <i class="fa fa-university p-0 mx-2" aria-hidden="true"></i>
                        <span>
                            {{ __('menu.manager_menu.transactions') }}
                        </span>
                    </a>
                </li>
                @if(config('paypal.enabled'))
                <li>
                    <a href="{{ route('managers.transactions.paypal') }}">
                        <i class="fa fa-paypal p-0 mx-2" aria-hidden="true"></i>
                        <span>
                            {{ __('menu.manager_menu.transactions_paypal') }}
                        </span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('managers.admins.transactions') }}">
                        <i class="fa fa-credit-card p-0 mx-2" aria-hidden="true"></i>
                        <span>
                            {{ __('menu.manager_menu.admin_transactions') }}
                        </span>
                    </a>
                </li>
                {{-- managers.networks --}}

                {{-- Tickets Tab --}}
                <li class="treeview">
                    <a href="{{ route('managers.tickets.index') ?? '' }}">
                        <i class="fa fa-ticket mx-2 p-0" aria-hidden="true"></i>
                        <span>@lang('menu.tickets.index')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('managers.tickets.index') ?? '' }}">
                                <i class="fa fa-envelope px-2"></i>
                                @lang('menu.tickets.tickets_received')</a>
                        </li>
                    </ul>
                </li>
                {{-- Tickets Tab --}}

                {{-- General Chat Tab --}}
                <li>
                    <a href="{{ route('managers.chat.index') }}">
                        <i class="fa fa-comments mx-2 p-0" aria-hidden="true"></i>
                        <span>{{ __('general_chat.menu_title') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('managers.chat.blocks') }}">
                        <i class="fa fa-ban mx-2 p-0" aria-hidden="true"></i>
                        <span>{{ __('general_chat.blocks_menu_title') }}</span>
                    </a>
                </li>
                {{-- General Chat Tab --}}

                </ul>
            </div>
        </div>
    </section>
</aside>
