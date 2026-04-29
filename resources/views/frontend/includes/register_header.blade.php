<div class="plan_header px-10">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div
                class="box {{ __('site.home_index.system_plan_header_color.' . $plan->type) }} shadow p-0">
                <div class="box-body py-2 px-xs-1" dir="rtl">
                    <div class="d-none d-sm-block">
                        <div class="row justify-content-between no-gutters">
                            <div class="box-title text-white col-6">
                                <span class="text-white h2 fw-bold">
                                    {{ __('site.home_index.system_plan_title.' . $plan->type) }}
                                </span>
                            </div>

                            <div class="col-6">
                                <a class="btn btn-primary text-white" style="float: left"
                                    href="{{ route('home.system', ['system' => $plan->type == 1 ? 2 : 1]) }}">
                                    <span class="text-white h3 fw-bold">
                                        {{ __('site.home_index.system_button.' . $plan->type) }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- phone --}}
                    <div class="box-title text-white d-block d-sm-none">

                        <span class="text-white fs-20 fw-bold">
                            {{ __('site.home_index.system_plan_title.' . $plan->type) }}
                        </span>

                        <a class="btn btn-primary text-white" style="float: left"
                            href="{{ route('home.system', ['system' => $plan->type]) }}">
                            <span class="text-white fw-bold">
                                {{ __('site.home_index.system_button_xs.' . $plan->type) }}
                            </span>
                        </a>
                    </div>
                    {{-- phone --}}
                </div>
            </div>
        </div>
    </div>
</div>
