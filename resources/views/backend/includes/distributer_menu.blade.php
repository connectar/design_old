<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav" style="transition: width 0.5s;">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li>
                        <a href="{{ route('admins.home') }}">
                          <i class="fa fa-desktop p-0 mx-1"></i>
                            <span>
                                {{ __('menu.admin_menu.home2_title') }}
                            </span>
                        </a>
                    </li>
                    {{-- statistic --}}
                    <li class="treeview">
                        <a href="">
                          <i class="fa fa-bar-chart p-0 mx-1"></i>
                            <span>
                                {{ __('menu.admin_menu.statistic_title') }}
                            </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.statistic.users') }}">
                                    <i class="fa fa-users"></i>
                                    {{ __('menu.admin_menu.statistic.users') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- statistic --}}
                    <li class="treeview">
                        <a href="{{ route('admins.nas.index') }}">
                          <i class="fa fa-server p-0 mx-1" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.servers_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.nas.index') }}">
                                    <i class="fa fa-list"></i>
                                    {{ __('menu.admin_menu.servers.all') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.nas.create') }}">
                                    <i class="fa fa-plus-circle"></i>
                                    {{ __('menu.admin_menu.servers.create') }}
                                </a>
                            </li>
                            <x-menu-trashed :route="route('admins.nas.trashed')" />
                        </ul>
                    </li>
                    {{-- admins servers --}}
                    {{-- admins offers --}}
                    <li class="treeview">
                        <a href="{{ route('admins.offers.index') }}">
                          <i class="fa fa-handshake-o p-0 mx-1" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.offers_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.offers.index') }}">
                                    <i class="fa fa-list"></i>{{ __('menu.admin_menu.offers.all') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.offers.create') }}">
                                    <i class="fa fa-plus-circle"></i>
                                    {{ __('menu.admin_menu.offers.create') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.quta.index') }}">
                                    <i class="fa fa-tachometer"></i>
                                    {{ __('menu.admin_menu.offers.quta') }}
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- admins offers --}}
                    {{-- admins users --}}
                    <li class="treeview">
                        <a href="{{ route('admins.users.index') }}">
                          <i class="fa fa-user-circle p-0 mx-1" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.users_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.users.online') }}">
                                    <i class="fa fa-wifi"></i>{{ __('menu.admin_menu.users.online') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.users.index') }}">
                                    <i class="fa fa-list"></i>{{ __('menu.admin_menu.users.all') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.users.create') }}">
                                    <i class="fa fa-plus-circle"></i>
                                    {{ __('menu.admin_menu.users.create') }}
                                </a>
                            </li>
                            <x-menu-trashed :route="route('admins.users.trashed')" />
                        </ul>
                    </li>

                    {{-- سجل المدفوعات --}}
                    <li class="treeview">
                        <a href="{{ route('admins.users.index') }}">
                          <i class="fa fa-file-text p-0 mx-1" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.invoices_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.invoices.users') }}">
                                    <i class="fa fa-file-text-o"></i>{{ __('menu.admin_menu.invoices.users') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.statistic.expenses') }}">
                                    <i class="fa fa-money"></i>
                                    {{ __('menu.admin_menu.statistic.expenses') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- سجل التعديلات --}}
                    <li class="treeview">
                        <a href="{{ route('admins.logs.users') }}">
                          <i class="fa fa-history p-0 mx-1" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.logs_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.logs.users') }}">
                                    <i class="fa fa-users"></i>{{ __('menu.admin_menu.logs.users') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.logs.distributors') }}">
                                    <i class="fa fa-address-book-o"></i>{{ __('menu.admin_menu.logs.distributors') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="{{ route('admins.users.index') }}">
                          <i class="fa fa-id-card p-0 mx-1" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.cards.title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="#">
                                    <i class="fa fa-wifi"></i>
                                    {{ __('menu.admin_menu.cards.online_cards') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.cards.groups.index') }}">
                                    <i class="fa fa-th-list"></i>
                                    {{ __('menu.admin_menu.cards.all_groups') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.cards.users.index') }}">
                                    <i class="fa fa-list"></i>
                                    {{ __('menu.admin_menu.cards.all_cards') }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admins.cards.create') }}">
                                    <i class="fa fa-plus-circle"></i>
                                    {{ __('menu.admin_menu.cards.create') }}
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="treeview">
                        <a href="{{ route('admins.charging.index') }}">
                          <i class="fa fa-money p-0 mx-1" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.charging.title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.charging.index') }}">
                                    <i class="fa fa-th-list"></i>
                                    {{ __('menu.admin_menu.charging.all_groups') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.cards.charging.index') }}">
                                    <i class="fa fa-list"></i>
                                    {{ __('menu.admin_menu.cards.all_cards') }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admins.charging.create') }}">
                                    <i class="fa fa-plus-circle"></i>
                                    {{ __('menu.admin_menu.cards.create') }}
                                </a>
                            </li>
                        </ul>
                    </li>


					{{-- Tickets Tab --}}
					<li class="treeview">
                        <a href="{{ route('admins.tickets.create') ?? '' }}">
						<i class="fa fa-ticket m-0 p-1" aria-hidden="true"></i>
                            <span>@lang('menu.tickets.index')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
							<a href="{{ route('admins.tickets.index') ?? '' }}">
							<i class="fa fa-envelope px-2"></i>
							@lang('menu.tickets.mytickets')</a>
                            </li>
                            <li><a href="{{ route('admins.tickets.create') }}">
								<i class="fa fa-paper-plane px-2" aria-hidden="true"></i>
								@lang('menu.tickets.create')</a>
                            </li>
                        </ul>
                    </li>
					{{-- Tickets Tab --}}

					{{-- General Chat Tab --}}
					<li>
						<a href="{{ route('admins.chat.index') }}">
							<i class="fa fa-comments m-0 p-1" aria-hidden="true"></i>
							<span>{{ __('general_chat.menu_title') }}</span>
						</a>
					</li>
					{{-- General Chat Tab --}}

                </ul>
            </div>
        </div>
    </section>
</aside>
