@extends('backend.layouts.system_distributor')

@section('content')
    <div class="row">
        <div class="col-12">
            <form id="FormSubmit" action="{{ route('system.distributor.plans.update', $plan->id) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="box bt-3 border-success">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            @lang('adding.plan.edit_title')
                        </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('backend.manager.plans.includes.edit')
                    </div>
                    <!-- /.box-body -->
                    <x-box-footer cancelRoute="{{ route('system.distributor.plans.index') }}"
                        submitText="{{ __('website.save') }}" />
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    @include('backend.includes.scripts.main_js')
@endpush
