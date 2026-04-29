<aside class="main-sidebar" >
    <!-- sidebar-->
    <section class="sidebar position-relative" >
        <div class="multinav" style="transition: width 0.5s;">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">

                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-home fa-lg"  style="margin-right:0px!important;"></i>
                            <span>
                                {{ __('menu.user_menu.index') }}
                            </span>
                            <span class="pull-right-container">

                            </span>
                        </a>
                    </li><!-- index -->
                    <li>
                        <a href="{{ route('users.profile') }}">
                            <i class="fa fa-user fa-lg"  style="margin-right:0px!important;"></i>
                            <span>
                                {{ __('menu.user_menu.profile') }}
                            </span>
                            <span class="pull-right-container">

                            </span>
                        </a>
                    </li><!-- index -->
                    <li>
                        <a href="{{ route('users.log') }}">
                            <i class="fa fa-history fa-lg"  style="margin-right:0px!important;"></i>
                            <span>
                                {{ __('menu.user_menu.log') }}
                            </span>
                            <span class="pull-right-container">

                            </span>
                        </a>
                    </li><!-- index -->
                    @if(auth('user')->check())
                    <li>
                        <a href="{{ route('users.notification.settings.index') }}">
                            <i class="fa fa-bell fa-lg "  style="margin-right:0px!important;"></i>
                            <span>
                                {{ __('menu.user_menu.notification_settings') }}
                            </span>
                            <span class="pull-right-container">

                            </span>
                        </a>
                    </li><!-- index -->
                    @endif

                </ul>
            </div>
        </div>
    </section>
</aside>
