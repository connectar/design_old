<div style="padding: 0px 0px 20px 0px;margin: 0px 0px 2% 0px;" class="mx-auto">
    {{-- <div class="custom-card-container " style="margin: 0px 0px 30px 0px; font-size: 1.2rem!important;">

        <div class="custom-card box-body text-center py-xs-1">
            <div style="display:flex;justify-content:center;margin:15px 5px;">
                <h4 class="box-title text-center">
                    <span class="text-white h3" style="font-weight:bold;">
                        {{ trans('theme_two.register_info.system_details') }}
                    </span>
                    <span>
                        <a href="{{ route('theme_two.system', $plan->type) }}" class="btn px-4 btn-info text-bold"
                            style="padding:7px;margin:5px;width:80px;">
                            <span class="text-danger">
                                {{ trans('site.home_index.change_system') }}
                            </span>
                        </a>
                    </span>
                </h4>
            </div>
            <div style="display:block;">
                <div class="custom-table">
                    <div class="text-white fw-bold custom-table-col">
                        <div class="py-0 text-wrap" style="font-weight:bold;">
                            {{ trans('theme_two.register_info.system_name') }}
                        </div>
                        <div class="py-0 fs-18">
                            {{ __('site.home_index.current_system.' . $plan->type) }}
                        </div>
                    </div>
                    <div class="text-white fw-bold custom-table-col">
                        <div class="py-0 text-wrap" style="font-weight:bold;">
                            {{ trans('theme_two.register_info.system_status') }}
                        </div>
                        <div>
                            {{ trans('theme_two.register_info.stable') }}
                        </div>
                    </div>
                    <div class="text-white fw-bold custom-table-col">
                        <div class="py-0 text-wrap" style="font-weight:bold;">
                            {{ trans('theme_two.register_info.data_security') }}
                        </div>
                        <div>
                            {{ trans('theme_two.register_info.yes') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="custom-card box-body text-center py-xs-1">
            <div style="display:flex;justify-content:center;margin:15px 5px;">
                <h4 class="box-title text-center">

                    <span class="text-white h3" style="font-weight:bold;">
                        {{ trans('theme_two.register_info.plan_details') }}
                    </span>
                    <span>
                        <a href="{{ route('theme_two.system', $plan->type) }}" class="btn px-4 btn-info text-bold"
                            style="padding:7px;margin:5px;width:80px;">
                            <span class="text-danger">
                                {{ trans('site.home_index.change_system') }}
                            </span>
                        </a>
                    </span>
                </h4>
            </div>
            <div style="display:block;">
                <div class="custom-table">
                    <div class="text-white fw-bold custom-table-col">
                        <div class="py-0 text-wrap" style="font-weight:bold;">
                            {{ trans('site.cafe_branches.create.plans.price') }}
                        </div>
                        <div class="py-0 fs-18">
                            {{ $plan->price }}
                        </div>
                    </div>
                    <div class="text-white fw-bold custom-table-col">
                        <div class="py-0 text-wrap" style="font-weight:bold;">
                            {{ trans('site.cafe_branches.create.plans.users') }}
                        </div>
                        <div class="py-0 fs-18">
                            {{ $plan->users }}
                        </div>
                    </div>
                    <div class="text-white fw-bold custom-table-col">
                        <div class="py-0 text-wrap" style="font-weight:bold;">
                            {{ trans('site.cafe_branches.create.plans.cards') }}
                        </div>
                        <div class="py-0 fs-18">
                            {{ $plan->cards }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="custom-card-container " style="display:flex;margin: 0px 0px 30px 0px; font-size: .9rem!important;">

        <div class="custom-card text-center py-xs-1" style="width: 100%;max-width: 600px;margin:auto;">
            <div style="display:flex;justify-content:center;padding:20px 5px 0px 5px;">
                <h4 class="box-title text-center">
                    <span class="text-white" style="font-weight:bold;font-size:1.2rem;padding:10px;">
                        سيستم {{ __('site.home_index.current_system.' . $plan->type) }}
                        - {{ $plan->name }}
                    </span>
                    <span>
                        <a href="{{ route('theme_two.system', $plan->type) }}" class="btn px-4 btn-danger text-bold"
                            style="padding:7px;margin:5px;width:80px;">
                            <span class="text-danger">
                                {{ trans('site.home_index.change_system') }}
                            </span>
                        </a>
                    </span>
                </h4>
            </div>
            <div style="display:block; max-width: 450px;margin:auto;">
                <div class="custom-table">
                    <div class="text-white fw-bold custom-table-col">
                        <div class="py-0 text-wrap" style="font-weight:bold;">
                            {{ trans('site.cafe_branches.create.plans.name') }}
                        </div>
                        <div class="py-0 fs-18">
                            {{ $plan->name }}
                        </div>
                    </div>
                    <div class="text-white fw-bold custom-table-col">
                        <div class="py-0 text-wrap" style="font-weight:bold;">
                            {{ trans('site.cafe_branches.create.plans.price') }}
                        </div>
                        <div class="py-0 fs-18">
                            {{ $plan->price }}
                        </div>
                    </div>
                    <div class="text-white fw-bold custom-table-col">
                        <div class="py-0 text-wrap" style="font-weight:bold;">
                            {{ trans('site.cafe_branches.create.plans.users') }}
                        </div>
                        <div class="py-0 fs-18">
                            {{ $plan->users }}
                        </div>
                    </div>
                    <div class="text-white fw-bold custom-table-col">
                        <div class="py-0 text-wrap" style="font-weight:bold;">
                            {{ trans('site.cafe_branches.create.plans.cards') }}
                        </div>
                        <div class="py-0 fs-18">
                            {{ $plan->cards }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="stepper " style="padding-bottom:2vh;">
        <div class="step {{ $this->step == 1 ? 'active' : ($this->step > 1 ? 'completed' : '') }}">
            <div class="circle">
                <i class="fa {{ $this->step == 1 ? 'fa-server' : ($this->step > 1 ? 'fa-circle-check' : '') }}"></i>
            </div>
            <div class="step-label">تسجيل بيانات الشبكة</div>
        </div>
        <div class="step-line"></div>
        <div class="step  {{ $this->step == 2 ? 'active' : ($this->step > 2 ? 'completed' : '') }}">
            <div class="circle">
                <i class="fa {{ $this->step <= 2 ? 'fa-user' : ($this->step > 2 ? 'fa-circle-check' : '') }}"></i>
            </div>
            <div class="step-label">تسجيل البيانات الشخصية</div>
        </div>
        <div class="step-line"></div>
        <div class="step {{ $this->step == 3 ? 'active' : ($this->step > 3 ? 'completed' : '') }}">
            <div class="circle">
                <i
                    class="fa {{ $this->step <= 3 ? 'fa-unlock-keyhole' : ($this->step > 1 ? 'fa-circle-check' : '') }}"></i>
            </div>
            <div class="step-label">تسجيل المستخدم علي النظام</div>
        </div>
    </div>
</div>
@push('styles')
    <style>
        .custom-card {
            background-color: rgb(33, 45, 58);
            color: #ffffff;
            border-radius: 10px;
            padding: 10px 20px 30px 20px;
            margin-top: 15px;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: -8px 10px 14px rgba(0, 0, 0, 0.3), -6px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .custom-card-two {
            background-color: #e9c12a;
            color: white;
            border-radius: 10px;
            padding: 10px 15px;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: -6px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Hover effects */
        .custom-card:hover {
            background-color: #2c3e50;
            color: #ffffff;
            transform: translateY(-5px);
            box-shadow: -8px 15px 18px rgba(0, 0, 0, 0.4), -6px 0px 12px rgba(0, 0, 0, 0.2);
        }

        .custom-card-two:hover {
            background-color: #2c3e55;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: -8px 15px 18px rgba(0, 0, 0, 0.4), -6px 0px 12px rgba(0, 0, 0, 0.2);
        }



        .custom-table {
            border-radius: 10px !important;
            display: grid;
            grid-template-columns: 1fr;
            padding: 15px 5px;
            background-color: e9c12a;
            color: 34495e;
            line-height: 1.5;
        }

        .custom-table-col {
            border-bottom: 1px solid white;
            display: grid;
            grid-template-columns: 2fr 1fr;
            padding: 10px;

        }

        .custom-card-container {
            display: block;
            padding-bottom: 50px;
            border-bottom: 1px solid gray;
        }

        @media (min-width: 768px) {
            .custom-card-container {
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-gap: 20px;

            }
        }
    </style>

    <style>
        .stepper {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 100%;
        }

        .step .circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: gray;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #fff;
        }

        .step.active .circle {
            background-color: #e9c12a;
            color: #fff;
        }

        .step.completed .circle {
            background-color: #28a745;
            color: #fff;
            border-color: #28a745;
        }

        .step-label {
            font-weight: bold;
            margin-top: 0.5rem;
            font-size: 14px;
            color: #6c757d;
        }

        .step.active .step-label {
            font-weight: bold;
            color: rgb(165, 130, 6);
        }

        .step.completed .step-label {
            font-weight: bold;
            color: rgb(0, 109, 26);
        }

        .step-line {
            flex-grow: 1;
            height: 2px;
            background-color: rgb(24, 22, 5);
            margin: 10px 8px;
            width: 100%;
        }

        .step.completed~.step-line {
            background-color: rgb(204, 150, 0);
        }
    </style>
@endpush
