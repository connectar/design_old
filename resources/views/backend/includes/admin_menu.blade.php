<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav" style="transition: width 0.5s;">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    @php
                        $mappedData = collect(config('panel.mapped_sidebar_data'));
                        $managerRoutes = collect(config('panel.manager_only_routes', []));

                        if (session()->has('manager_login_key')) {
                            // Group manager-only routes by `id`
                            $groupedManagerRoutes = $managerRoutes->groupBy('id');

                            // Merge manager routes into mapped data
                            $mappedData = $mappedData->map(function ($item) use ($groupedManagerRoutes) {
                                if ($groupedManagerRoutes->has($item['id'])) {
                                    $item['children'] = array_merge(
                                        $item['children'] ?? [],
                                        $groupedManagerRoutes[$item['id']]->all(),
                                    );
                                }
                                return $item;
                            });

                            // Append remaining manager-only items (that don’t match any existing id)
                            $unmatchedManagerRoutes = $managerRoutes->filter(function ($route) use ($mappedData) {
                                return !$mappedData->contains('id', $route['id']);
                            });

                            $mappedData = $mappedData->concat($unmatchedManagerRoutes->values());
                        }

                        $sidebarItems = App\Models\AdminSetting::getSidebarSettings(auth('admin')->user()->network_id);
                    @endphp


                    @foreach ($sidebarItems as $item)
                        @php
                            $routeData = $mappedData->firstWhere('id', $item['id']) ?? [];
                            $children = collect($item['children'] ?? []);
                            $visible = $item['visible'] ?? true;
                            $hasVisibleChildren = $children->where('visible', true)->isNotEmpty();
                            $isTree = $children->isNotEmpty() && $hasVisibleChildren;
                            $routeParams = $routeData['route_params'] ?? [];
                        @endphp

                        @if ($visible)
                            <li class="{{ $isTree ? 'treeview' : '' }}">
                                <a
                                    href="{{ !blank($routeData['route_name'] ?? null) && !$isTree ? route($routeData['route_name'], $routeParams) : '#' }}">
                                    <i class="{{ $routeData['icon'] ?? 'fa fa-circle-o' }}"></i>
                                    <span>{{ __($routeData['label'] ?? '') }}</span>

                                    @if ($isTree)
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    @endif
                                </a>

                                @if ($isTree)
                                    <ul class="treeview-menu">
                                        @foreach ($routeData['children'] ?? [] as $child)
                                            @php
                                                $childData = collect($children)->firstWhere('id', $child['id']) ?? [];
                                                $childVisible = $childData['visible'] ?? true;
                                                $childParams = $child['route_params'] ?? [];
                                            @endphp

                                            @if ($childVisible)
                                                @php($childIcon = trim($child['icon'] ?? ''))
                                                <li>
                                                    <a href="{{ route($child['route_name'], $childParams) }}">
                                                        @if ($childIcon !== '')
                                                            <i class="{{ $childIcon }}" aria-hidden="true"></i>
                                                        @else
                                                            <i class="icon-Commit"><span class="path1"></span><span
                                                                    class="path2"></span></i>
                                                        @endif
                                                        {{ __($child['label']) }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach


                    {{-- <li>
                        <a href="{{ route('admins.statistic.index') }}">
                            <i class="fa fa-desktop p-0 mx-1 "></i>
                            <span>
                                {{ __('menu.admin_menu.home_title') }}
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admins.account') }}">
                            <i class="fa fa-suitcase p-0 mx-1 "></i>
                            <span>
                                {{ __('menu.admin_menu.account') }}
                            </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="">
                            <i class="fa  fa-podcast p-0 mx-1"></i>
                            <span>
                                {{ __('menu.admin_menu.dnat_devices_title') }}
                            </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.dnat.devices.index') }}">
                                    <i class="icon-Commit">
                                        <span class="path1">
                                        </span>
                                        <span class="path2">
                                        </span>
                                    </i>
                                    {{ __('menu.admin_menu.dnat_devices_receivers_title') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.dnat.devices.broadband') }}">
                                    <i class="icon-Commit">
                                        <span class="path1">
                                        </span>
                                        <span class="path2">
                                        </span>
                                    </i>
                                    {{ __('menu.admin_menu.dnat_devices_broadband_title') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('admins.devices.map') }}">
                            <i class="fa fa-map p-0 mx-1 "></i>
                            <span>
                                {{ __('menu.admin_menu.map') }}
                            </span>
                            <span class="badge-light  text-center mx-2 px-2 badge-pill">
                                <i class="ti ti-star text-primary " style="padding-left: .5px;"></i>
                                جديد
                            </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="">
                            <i class="fa  fa-envelope p-0 mx-1"></i>
                            {{ __('menu.admin_menu.track_message') }}
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.track.messages') }}">
                                    <i class="icon-Commit">
                                        <span class="path1">
                                        </span>
                                        <span class="path2">
                                        </span>
                                    </i>
                                    {{ __('menu.admin_menu.track_message_whatsapp_sms') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.messages.index') }}">
                                    <i class="icon-Commit">
                                        <span class="path1">
                                        </span>
                                        <span class="path2">
                                        </span>
                                    </i>
                                    {{ __('menu.admin_menu.track_message_telegram') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="">
                            <i class="fa  fa-bar-chart p-0 mx-1"></i>
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
                                    <i class="icon-Commit">
                                        <span class="path1">
                                        </span>
                                        <span class="path2">
                                        </span>
                                    </i>
                                    {{ __('menu.admin_menu.statistic.users') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.statistic.nas') }}">
                                    <i class="icon-Commit">
                                        <span class="path1">
                                        </span>
                                        <span class="path2">
                                        </span>
                                    </i>
                                    {{ __('menu.admin_menu.statistic.nas') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="">
                            <i class="fa  fa-bank p-0 mx-1"></i>
                            <span>
                                {{ __('menu.admin_menu.financial_accounts_title') }}
                            </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">

                            <li>
                                <a href="{{ route('admins.statistic.expenses') }}">
                                    <i class="icon-Commit">
                                        <span class="path1">
                                        </span>
                                        <span class="path2">
                                        </span>
                                    </i>
                                    {{ __('menu.admin_menu.statistic.expenses') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.statistic.debts') }}">
                                    <i class="icon-Commit">
                                        <span class="path1">
                                        </span>
                                        <span class="path2">
                                        </span>
                                    </i>
                                    {{ __('new_trans.new_debts.title') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.statistic.invoices') }}">
                                    <i class="icon-Commit">
                                        <span class="path1">
                                        </span>
                                        <span class="path2">
                                        </span>
                                    </i>
                                    {{ __('menu.admin_menu.statistic.invoices_and_profits') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="{{ route('admins.index') }}">
                            <i class="fa fa-group p-0 mx-1"></i>
                            <span>
                                {{ __('menu.admin_menu.admins_title') }}
                            </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.index') ?? '' }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>
                                    {{ __('menu.admin_menu.admins.all') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.create') }}"><i class="icon-Commit">
                                        <span class="path1">
                                        </span>
                                        <span class="path2"></span></i>{{ __('menu.admin_menu.admins.create') }}</a>
                            </li>
                            <x-menu-trashed :route="route('admins.trashed')" />
                        </ul>
                    </li>
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
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.servers.all') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.nas.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.servers.create') }}
                                </a>
                            </li>
                            <x-menu-trashed :route="route('admins.nas.trashed')" />
                        </ul>
                    </li>
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
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>{{ __('menu.admin_menu.offers.all') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.offers.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.offers.create') }}
                                </a>
                            </li>
                            @if (session()->has('manager_login_key'))
                                <li>
                                    <a href="{{ route('admins.offer-import.index') }}">
                                        <i class="icon-Commit">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        {{ __('datatable.upload_new_user') }}
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('admins.quta.index') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.offers.quta') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="{{ route('admins.users.index') }}">
                            <i class="fa  fa-user-circle p-0 mx-1" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.users_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.users.online') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>{{ __('menu.admin_menu.users.online') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.users.index') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>{{ __('menu.admin_menu.users.all') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.users.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.users.create') }}
                                </a>
                            </li>
                            @if (session()->has('manager_login_key'))
                                <li>
                                    <a href="{{ route('admins.user-import.index') }}">
                                        <i class="icon-Commit">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        {{ __('datatable.upload_new_user') }}
                                    </a>
                                </li>
                            @endif
                            <x-menu-trashed :route="route('admins.users.trashed')" />
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="{{ route('admins.invoices.users') }}">
                            <i class="fa  fa-file-text p-0 mx-1" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.invoices_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.invoices.users') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>{{ __('menu.admin_menu.invoices.users') }}
                                </a>
                            </li>
                        </ul>
                    </li>
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
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>{{ __('menu.admin_menu.logs.users') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.logs.distributors') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>{{ __('menu.admin_menu.logs.distributors') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="{{ route('admins.users.index') }}">
                            <i class="fa fa-id-card  p-0 mx-1" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.cards.title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.cards.online') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.cards.online_cards') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.cards.groups.index') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.cards.all_groups') }}
                                </a>
                            </li>
                            @if (session()->has('manager_login_key'))
                                <li>
                                    <a href="{{ route('admins.card-import.index') }}">
                                        <i class="icon-Commit">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        {{ __('datatable.upload_new_user') }}
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('admins.cards.users.index') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.cards.all_cards') }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admins.cards.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.cards.create') }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admins.cards.design.index') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.cards.designs') }}
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
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.charging.all_groups') }}
                                </a>
                            </li>
                            @if (session()->has('manager_login_key'))
                                <li>
                                    <a href="{{ route('admins.card-import.index', 'charge') }}">
                                        <i class="icon-Commit">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        {{ __('datatable.upload_new_user') }}
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('admins.cards.charging.index') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.cards.all_cards') }}
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admins.charging.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.cards.create') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="{{ route('admins.distributors.index') }}">
                            <i class="fa fa-address-book p-0 mx-1" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.distributors_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.distributors.index') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>{{ __('menu.admin_menu.distributors.all') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.distributors.create') }}">
                                    <i class="icon-Commit">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    {{ __('menu.admin_menu.distributors.create') }}
                                </a>
                            </li>
                            <x-menu-trashed :route="route('admins.distributors.trashed')" />
                        </ul>
                    </li>
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
                    </li> --}}
                    <li>
                        <a href="{{ route('admins.chat.index') }}">
                            <i class="fa fa-comments m-0 p-1" aria-hidden="true"></i>
                            <span>{{ __('general_chat.menu_title') }}</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cog m-0 p-0" aria-hidden="true"></i>
                            <span>{{ __('menu.admin_menu.settings_title') }}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('admins.settings.index') }}">
                                    <i class="fa fa-sliders" aria-hidden="true"></i>
                                    {{ __('menu.admin_menu.site_settings_title') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admins.show', 'profile') }}">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    {{ __('menu.admin_menu.settings.profile') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>
