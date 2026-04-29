<div class="alert text-center text-bold bg-light">
    <span class="badge badge-warning">
        {{ __('site.admin_change_plan.action') }}
    </span>
    {{ __('site.admin_change_plan.change_types.' . $using) }}
</div>
<div class="row">
    @foreach ($plans as $model)
        <div class="col-md-4 col-12">
            <div class="box bg-dark">
                <div class="box-header no-border py-2 text-center">
                    <h4 class="box-title">
                        <span class="text-primary">
                            {{ $model->name }}
                        </span>
                    </h4>
                </div>
                <div class="box-body py-0">
                    <table class="table no-border">
                        <tr class="text-success">
                            <td class="py-0 text-wrap">
                                {{ trans('site.admin_change_plan.plan_info.users') }}
                            </td>
                            <td class="py-0 fs-18">
                                {{ $model->users }}
                            </td>
                        </tr>
                        <tr class="text-danger">
                            <td class="py-0 text-wrap text-danger">
                                {{ trans('site.admin_change_plan.plan_info.cards') }}
                            </td>
                            <td class="py-0 fs-18">
                                {{ $model->cards }}
                            </td>
                        </tr>
                        <tr class="text-primary">
                            <td class="py-0 text-wrap">
                                {{ trans('site.admin_change_plan.plan_info.price') }}
                            </td>
                            <td class="py-0 fs-18">
                                @if (isAuthAdminBillingCurrencyIsDollar())
                                    {{ $model->price_dollar . ' ' . getCurrencyNameByCurrencyCode(auth('admin')->user()->network->billing_currency) }}
                                @else
                                    {{ $model->price . ' ' . getCurrencyNameByCurrencyCode(auth('admin')->user()->network->billing_currency) }}
                                @endif
                            </td>
                        </tr>

                    </table>
                </div>
                <div class="box-footer p-3 bg-dark no-border text-center">
                    <a href="#" x-on:click="selectPlan('{{ $model->id }}')"
                        class="waves-effect waves-light btn btn-sm btn-info text-bold">
                        {{ trans('site.admin_change_plan.plan_info.select_plan') }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
