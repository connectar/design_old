<div class="box bt-1 border-success">
    <x-box-header back-text="{{ __('site.cafe_branches.create.back_to_all') }}"
        title="{{ __('site.cafe_branches.create.title') }}"
        back-route="{{ route('cafe.branches.index') }}" />
    <div class="box-body">
        @if ($step == 1)
            <div class="row">
                @foreach ($plans as $model)
                    <div class="col-md-4 col-12">
                        <div class="box bg-dark">
                            <div class="box-header no-border py-2 text-center">
                                <h4 class="box-title">
                                    <span class="text-primary">
                                        {{ $model['name'] }}
                                    </span>
                                </h4>
                            </div>
                            <div class="box-body py-0">
                                <table class="table no-border">
                                    <tr class="text-success">
                                        <td class="py-0 text-wrap">
                                            {{ trans('site.cafe_branches.create.plans.users') }}
                                        </td>
                                        <td class="py-0 fs-18">
                                            {{ $model['users'] }}
                                        </td>
                                    </tr>
                                    <tr class="text-danger">
                                        <td class="py-0 text-wrap text-danger">
                                            {{ trans('site.cafe_branches.create.plans.cards') }}
                                        </td>
                                        <td class="py-0 fs-18">
                                            {{ $model['cards'] }}
                                        </td>
                                    </tr>
                                    <tr class="text-warning">
                                        <td class="py-0 text-wrap">
                                            {{ trans('site.cafe_branches.create.plans.card_desgins') }}
                                        </td>
                                        <td class="py-0 fs-18">
                                            {{ $model['card_desgins'] }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-0 text-wrap">
                                            {{ trans('site.cafe_branches.create.plans.fee') }}
                                        </td>
                                        <td class="py-0 fs-18">
                                            {{ $subscriptionFeePrice ?? 0 }}
                                        </td>
                                    </tr>
                                    <tr class="text-primary">
                                        <td class="py-0 text-wrap">
                                            {{ trans('site.cafe_branches.create.plans.price') }}
                                        </td>
                                        <td class="py-0 fs-18">
                                            {{ $model['price'] }}
                                        </td>
                                    </tr>

                                </table>
                            </div>
                            <div class="box-footer p-3 bg-dark no-border text-center">
                                <a href="#" wire:click="selectPlan('{{ $model['id'] }}')"
                                    class="waves-effect waves-light btn btn-sm btn-info text-bold">
                                    {{ trans('site.cafe_branches.create.plans.select_plan') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        @elseif($step == 2)
            @include('backend.cafe.branches.includes.create')
        @elseif($step == 3)
            <div class="px-4 mt-4">
                <div class="alert text-center text-bold bg-light">
                    <div>
                        <span class="text-primary">
                            رصيدك الحالى <span
                                class="fs-18 text-warning">{{ $content['account'] ?? '0' }}</span>
                            جنيه
                            لا يكفى
                            للاشتراك فى
                            هذة الخطة البالغ تكلفتها <span
                                class="fs-18 text-warning">{{ $content['price'] ?? 0 }}</span>
                            جنيه
                        </span>
                        <div>
                            <span class="text-primary">
                                قم بتحويل المبلغ كاملا اولا
                            </span>
                        </div>

                    </div>

                    <div class="mt-4">
                        <a href="" class="btn btn-sm btn-info">
                            <i class="fa fa-arrow-right"></i>
                            {{ __('website.back') }}
                        </a>
                        <a href="{{ route('cafe.branches.index') }}" data-bs-dismiss="modal"
                            class="btn btn-sm btn-danger">
                            {{ __('website.close') }}
                        </a>
                    </div>
                </div>
            </div>
        @elseif($step == 4)
            @include(
                'backend.cafe.branches.includes.create_step_4'
            )
        @endif
    </div>
    <!-- /.box-body -->
    @if ($step == 1 || $step == 2)
        <div class="box-footer p-2">
            <div class="pull-right">
                <a href="{{ route('admins.nas.index') }}" class="btn btn-danger">
                    {{ __('website.cancel') }}
                </a>

                @if ($step == 2)
                    <a href="#" class="btn btn-dark text-primary" wire:click="$set('step','1')">
                        <i class="fa fa-arrow-right"></i>
                        {{ __('website.back') }}
                    </a>
                    <button type="button" class="btn btn-warning" wire:click="validateData"
                        wire:loading.attr="disabled">
                        @lang('website.next')
                        <i class="fa fa-arrow-left"></i>
                    </button>
                @endif

            </div>
        </div>
    @endif
</div>

<!-- /.box -->
