<div class="box box-bordered border-danger m-0 no-padding">
    <div class="box-header with-border py-3">
        <h4 class="box-title">
            {{ __('site.user_index.quta_usage.title') }}
            <span class="badge text-primary px-2 fs-16">
                {{ $userFullname ?? '' }}
            </span>
        </h4>
    </div>
    <div class="box-body no-padding">

        @if ($qutaUsage)
        <div class="collectionTable">
            @if ($step == 1)
            <table class="table table-striped text-center no-padding">
                <x-table-thead :columns="__('datatable.user_quta_usage')" />
                <tbody>
                    @foreach ($qutaUsage as $model)
                    <tr>
                        <td>
                            <span class="badge badge-success">
                                {{ $model->acctstarttime }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-danger" dir="auto">
                                {{ $model->render()->download() }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-green" dir="auto">
                                {{ $model->render()->upload() }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-warning" dir="auto">
                                {{ $model->render()->total() }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-primary">
                                {{ $model->render()->uptime() }}
                            </span>
                        </td>
                        <td>
                            <a href="#" class="waves-effect waves-light btn btn-sm btn-info text-bold"
                                wire:click="showUsageBerDay('{{ $model['acctstarttime'] }}')">
                                <i class="fa fa-edit"></i>
                                {{ __('site.user_index.quta_usage.info') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <table class="table table-striped text-center no-padding">
                <x-table-thead :columns="__('datatable.user_quta_usage_per_day')" />
                <tbody>
                    @foreach ($qutaUsagePerDay as $model)
                    <tr>
                        <td>
                            <span class="badge badge-success">
                                {{ $model->render()->acctstarttime() }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-info">
                                {{ $model->render()->acctstoptime() }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-danger" dir="auto">
                                {{ $model->render()->download() }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-green" dir="auto">
                                {{ $model->render()->upload() }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-warning" dir="auto">
                                {{ $model->render()->total() }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-primary">
                                {{ $model->render()->uptime() }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        @else
        <div class="text-center">
            <x-datatable.empty-records />
        </div>
        @endif
    </div>
    <!-- /.box-body -->
    <div class="box-footer p-2">
        <div class="pull-right">
            @if ($step == 2)
            <button type="button" wire:click="back()" class="btn btn-success mx-1">
                <i class="fa spi fa-arrow-right"></i>
                {{ __('site.user_index.changeOffer.back') }}
            </button>
            @endif
            <a href="#" data-bs-dismiss="modal" class="btn btn-danger">
                @lang('website.cancel')
            </a>
        </div>
    </div>
</div>
<!-- /.box -->
