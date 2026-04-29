<div class="box bt-1 border-success" x-data="changePlan">

    <div class="box-header">
        {{ __('site.admin_change_plan.title') }}
    </div>

    <div class="box-body">
        @if ($step == 1)
            <div class="row justify-content-center">
                @foreach ($usingTypes as $key => $value)
                    <div class="col-md-4 col-12">
                        <div class="box bg-dark">

                            <div class="box-body text-center">
                                <h4>
                                    <span class="text-primary">
                                        {{ $value }}
                                    </span>
                                </h4>
                            </div>
                            <div class="box-footer p-3 bg-dark no-border text-center">
                                <a href="#" wire:click="selectPlanType('{{ $key }}')"
                                    class="waves-effect waves-light btn btn-sm btn-info text-bold">
                                    {{ trans('site.managers_plan_create.select_type') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif($step == 2)
            @include('backend.admins.includes.change_plan.step2')
        @elseif($step == 3)
            <div class="alert text-center text-bold bg-light">
                <h5 class="text-primary">
                    {{ __('site.admin_change_plan.empty_plans.' . $using) }}
                </h5>
                <button class="btn btn-info btn-sm" wire:click="$set('step',1)">
                    {{ __('site.admin_change_plan.back') }}
                </button>
            </div>
        @endif
    </div>
    <!-- /.box-body -->
    <div class="box-footer p-2">
        <div class="pull-right">
            <a href="{{ route('admins.account') }}" class="btn btn-danger">
                {{ __('website.cancel') }}
            </a>
            @if ($step == 2)
                <a href="#" class="btn btn-dark text-primary" wire:click="$set('step','1')">
                    <i class="fa fa-arrow-right"></i>
                    {{ __('website.back') }}
                </a>
            @endif
        </div>
    </div>
</div>

<!-- /.box -->
