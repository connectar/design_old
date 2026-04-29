<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav" style="transition: width 0.5s;">>
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li>
                        <a href="{{ route('managers.statistic') }}">
                            <i data-feather="bar-chart-2"></i>
                            <span>الإحصائيات العامة</span>
                        </a>
                    </li>
                  <li>
                      <a href="{{ route('managers.admins.subscription.index') }}">
                          <i data-feather="monitor"></i>
                          <span>@lang('menu.manager_menu.admins_subscription')</span>
                      </a>
                  </li>
                    <li>
                        <a href="{{ route('managers.servers.index') }}">
                            <i data-feather="monitor"></i>
                            <span>@lang('menu.manager_menu.servers')</span>
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
