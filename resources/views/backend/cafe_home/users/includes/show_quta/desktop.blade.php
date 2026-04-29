<div class="d-none d-md-block">
    <div class="table-responsive">
        @if ($tabActive == 1)
            @if (count($qutaUsage) > 0)
                @if ($step == 1)
                    <table class="table table-striped text-center">
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
                                        <a href="#"
                                            class="waves-effect waves-light btn btn-sm btn-info text-bold"
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
                                        <span class="badge badge-lightcoral" dir="auto">
                                            {{ $model->macaddress ?? '---' }}
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
            @else
                <div class="text-center py-4">
                    <x-datatable.empty-records />
                </div>
            @endif
        @else
            @if (count($olderUsage) > 0)
                <table class="table table-striped text-center no-padding">
                    <x-table-thead :columns="__('datatable.user_quta_usage_older_months')" />
                    <tbody>
                        @foreach ($olderUsage as $model)
                            <tr>
                                <td>
                                    <span class="badge badge-success">
                                        {{ $model->render()->from() }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-info">
                                        {{ $model->render()->to() }}
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
            @else
                <div class="text-center py-4">
                    <x-datatable.empty-records />
                </div>
            @endif
        @endif
    </div>
</div>
