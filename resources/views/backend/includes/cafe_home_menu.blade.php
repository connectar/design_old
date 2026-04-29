<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav" style="transition: width 0.5s;">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    {{-- statistic --}}
                    <li class="treeview">
                        <a href="">
                            <i class="fa fa-bar-chart p-0 mx-2" aria-hidden="true"></i>
                            <span>
                                {{ __('menu.admin_menu.statistic_title') }}
                            </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('cafe_home.statistic.users') }}">
                                    <i class="fa fa-users"></i>
                                    {{ __('menu.admin_menu.statistic.users') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cafe_home.statistic.nas') }}">
                                    <i class="fa fa-server"></i>
                                    {{ __('menu.admin_menu.statistic.nas') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- statistic --}}
                    <li class="treeview">
                        <a href="{{ route('cafe_home.nas.index') }}">
                            <i class="fa fa-server p-0 mx-2" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.servers_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('cafe_home.nas.index') }}">
                                    <i class="fa fa-list"></i>
                                    {{ __('menu.admin_menu.servers.all') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cafe_home.nas.create') }}">
                                    <i class="fa fa-plus-circle"></i>
                                    {{ __('menu.admin_menu.servers.create') }}
                                </a>
                            </li>
                            <x-menu-trashed :route="route('cafe_home.nas.trashed')" />
                        </ul>
                    </li>
                    {{-- admins servers --}}
                    {{-- admins offers --}}
                    <li class="treeview">
                        <a href="{{ route('cafe_home.offers.index') }}">
                            <i class="fa fa-handshake-o p-0 mx-2" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.offers_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('cafe_home.offers.index') }}">
                                    <i class="fa fa-list"></i>{{ __('menu.admin_menu.offers.all') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cafe_home.offers.create') }}">
                                    <i class="fa fa-plus-circle"></i>
                                    {{ __('menu.admin_menu.offers.create') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- admins offers --}}

                    {{-- سجل المدفوعات --}}
                    {{-- <li>
                        <a href="{{ route('cafe_home.invoices.users') }}">
                            <i class="fa fa-file-text p-0 mx-2" aria-hidden="true"></i>
                            <span>
                                {{ __('menu.admin_menu.invoices_title') }}
                            </span>
                        </a>
                    </li> --}}
					{{-- Tickets Tab --}}
					<li class="treeview">
                        <a href="{{ route('cafe_home.tickets.create') ?? '' }}">
						<i class="fa fa-ticket m-0 p-0" aria-hidden="true"></i>
                            <span>@lang('menu.tickets.index')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
							<a href="{{ route('cafe_home.tickets.index') ?? '' }}">
							<i class="fa fa-envelope px-2"></i>
							@lang('menu.tickets.mytickets')</a>
                            </li>
                            <li><a href="{{ route('cafe_home.tickets.create') }}">
								<i class="fa fa-paper-plane px-2" aria-hidden="true"></i>
								@lang('menu.tickets.create')</a>
                            </li>
                        </ul>
                    </li>
					{{-- Tickets Tab --}}

                    {{-- General Chat Tab --}}
                    <li>
                        <a href="{{ route('cafe_home.chat.index') }}">
                            <i class="fa fa-comments mx-2 p-0" aria-hidden="true"></i>
                            <span>{{ __('general_chat.menu_title') }}</span>
                        </a>
                    </li>
                    {{-- General Chat Tab --}}

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cog p-0 mx-2" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.settings_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('cafe_home.settings.index') }}">
                                    <i class="fa fa-sliders"></i>{{ __('menu.admin_menu.site_settings_title') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="{{ route('cafe_home.users.index') }}">
                            <i class="fa fa-user-circle p-0 mx-2" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.users_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            {{-- <li>
                                <a href="{{ route('cafe_home.users.online') }}">
                                    <i class="fa fa-wifi"></i>{{ __('menu.admin_menu.users.online') }}
                                </a>
                            </li> --}}
                            <li>
                                <a href="{{ route('cafe_home.users.index') }}">
                                    <i class="fa fa-list"></i>{{ __('menu.admin_menu.users.all') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cafe_home.users.create') }}">
                                    <i class="fa fa-plus-circle"></i>
                                    {{ __('menu.admin_menu.users.create') }}
                                </a>
                            </li>
                            <x-menu-trashed :route="route('cafe_home.users.trashed')" />
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </section>
</aside>
