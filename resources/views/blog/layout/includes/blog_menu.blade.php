<aside class="main-sidebar main-sidebar-custom">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav" style="transition: width 0.5s;" style="width: 300px!important;">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    {{-- home --}}
                    <li class="treeview active">
                        <a href="">
                            <i class="fa fa-cube p-0 mx-1"></i>
                            <span>
                                {{ __('احدث الأسئلة') }}
                            </span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @foreach ($latestFaqs as $faq)
                                <li>
                                    <a href="{{ route('questions.faqs.show', $faq->id) }}">
                                        <i
                                            class="fa {{ $faq->is_answered ? 'fa-check text-success' : 'fa-circle text-danger' }} p-0 mx-1"></i>
                                        <span
                                            class="{{ route('questions.faqs.show', $faq->id) == url()->current() ? 'text-primary' : '' }}">
                                            {{ Str::limit($faq->question, 50, '...') }}
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>

<style>
    .main-sidebar-custom {
        width: 19.29rem;
    }
</style>
