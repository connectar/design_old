<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav" style="transition: width 0.5s;">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu pt-4" data-widget="tree">
                    <li>
                        <a href="{{ route('system.distributor.balance.index') }}">
                            <i class="fa  fa-bank p-0 mx-1"></i>
                            <span>
                                @lang('menu.admin_menu.account')</a>
                        </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('system.distributor.settings.profile') }}">
                            <i class="fa fa-user-circle p-0 mx-2" aria-hidden="true"></i>
                            <span>
                                @lang('website.navbar.admin_menu.profile')</a>
                        </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="{{ route('system.distributor.plans.index') }}">
                            <i class="fa fa-handshake-o p-0 mx-2" aria-hidden="true"></i>
                            <span>@lang('menu.manager_menu.plans')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('system.distributor.plans.index') }}">
                                    <i class="fa fa-list"></i>@lang('menu.manager_menu.plan.all')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('system.distributor.plans.create') }}">
                                    <i class="fa fa-plus-circle"></i>@lang('menu.manager_menu.plan.create')
                                </a>
                            </li>
                            <x-menu-trashed :route="route('system.distributor.plans.trashed')" />
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="{{ route('system.distributor.networks.index') }}">
                            <i class="fa fa-tasks p-0 mx-2" aria-hidden="true"></i>
                            <span>@lang('menu.manager_menu.networks')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('system.distributor.networks.index') }}">
                                    <i class="fa fa-list"></i>@lang('menu.manager_menu.network.all')
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('system.distributor.networks.create') }}">
                                    <i class="fa fa-plus-circle"></i>@lang('menu.manager_menu.network.create')
                                </a>
                            </li>
                    </li>
                </ul>
                </li>
                <li>
                    <a href="{{ route('system.distributor.servers.index') }}">
                        <i class="fa fa-server p-0 mx-2" aria-hidden="true"></i>
                        <span>@lang('menu.manager_menu.servers')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('system.distributor.invoices.index') }}">
                        <i class="fa fa-money p-0 mx-2" aria-hidden="true"></i>
                        <span>@lang('menu.manager_menu.admin_invoices')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('system.distributor.notifications.view.notifications') }}">
                        <i class="fa fa-bell p-0 mx-2"></i>
                        <span>
                            {{ __('menu.user_menu.notification') }}
                        </span>
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </section>
</aside>
