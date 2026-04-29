<div class="box bt-1 border-success">
    <x-box-header back-text="{{ __('site.managers_plan_create.back') }}"
        title="{{ __('site.managers_plan_create.title') }}"
        back-route="{{ route('system.distributor.plans.index') }}" />
    <div class="box-body">
        @if ($step == 1)
            <div class="row justify-content-center">
                @foreach ($usingTypes as $key => $value)
                    <div class="col-md-4 col-12">
                        <div class="box bg-dark">

                            <div class="box-body text-center">
                                <h3>
                                    <span class="text-primary">
                                        {{ $value }}
                                    </span>
                                </h3>
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
            @include('backend.manager.plans.includes.create')
        @endif
    </div>
    <!-- /.box-body -->

    <div class="box-footer p-2">
        <div class="pull-right">
            <a href="{{ route('system.distributor.plans.index') }}" class="btn btn-danger">
                {{ __('website.cancel') }}
            </a>

            @if ($step == 2)
                <a href="#" class="btn btn-dark text-primary" wire:click="$set('step','1')">
                    <i class="fa fa-arrow-right"></i>
                    {{ __('website.back') }}
                </a>
                <button type="button" class="btn btn-success" wire:click="validateData"
                    wire:loading.attr="disabled">
                    @lang('website.save')
                </button>
            @endif

        </div>
    </div>

</div>

<!-- /.box -->
