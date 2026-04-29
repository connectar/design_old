<div class="box  m-0 box-bordered border-danger no-padding">
    <div class="box-header with-border py-3">
        <h4 class="box-title">
            {{ __('site.user_index.user_log.title') }}
            <span class="badge text-primary px-2 fs-16">
                {{ $userFullname }}
            </span>
        </h4>
    </div>
    <div class="box-body no-padding collectionTable">

        @if (count($logs))
            <div class="table-responsive">
                <table class="table table-striped text-center no-padding">
                    <x-table-thead :columns="__('datatable.user_logs')" />
                    <tbody>
                        @foreach ($logs as $index => $model)
                            <tr class="fw-bold">
                                <td class="px-0 py-0">
                                    <span class="badge badge-dark">
                                        {{ $model->admin_name }}
                                    </span>
                                </td>
                                <td class="px-0 py-0">
                                    <span
                                        class="badge badge-{{ __("logs.user_logs_events_color.{$model->event_name}") }}">
                                        {{ __("logs.user_logs_events.{$model->event_name}") }}
                                    </span>
                                </td>
                                <td>
                                    {!! $model->render() !!}
                                </td>
                                <td class="px-0 py-0">
                                    <span class="badge badge-warning">
                                        {{ $model->created_at }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
            <a href="#" data-bs-dismiss="modal" class="btn btn-danger">
                @lang('website.cancel')
            </a>
        </div>
    </div>
</div>

<!-- /.box -->
