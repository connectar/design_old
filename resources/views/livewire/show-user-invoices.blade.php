<div class="box  m-0 box-bordered border-danger no-padding collectionTable">
    <div class="box-header with-border py-3">
        <h4 class="box-title">
            {{ __('site.user_index.invoices_log.title') }}
            <span class="badge text-primary px-2 fs-16">
                {{ $userFullname }}
            </span>
        </h4>
    </div>
    <div class="box-body no-padding no-border">
        <div style="padding-right: 20px">
            <span class="mr-2">
                {{ __('site.invoices.by_type') }} :
            </span>
            <span>
                <span class="mx-2">
                    <span class="badge badge-secondary p-2">
                    </span>
                    {{ __('site.invoices.by_admin') }}
                </span>
                <span class="mx-2">
                    <span class="badge badge-success p-2">
                    </span>
                    {{ __('site.invoices.by_distributor') }}
                </span>
                <span class="mx-2">
                    <span class="badge badge-danger p-2">
                    </span>
                    {{ __('site.invoices.by_user') }}
                </span>
            </span>
        </div>
        @if ($invoices)
            <div class="table-responsive">
                <table class="table table-striped text-center no-padding">
                    <x-table-thead :columns="__('datatable.user_invoices')">
                    </x-table-thead>
                    <tbody>
                        @foreach ($invoices as $index => $model)
                            <tr class="fw-bold">

                                <td class="px-2">
                                    <span class="badge badge-lightcoral">
                                        {{ __("site.invoices_events.{$model->event_name}") }}
                                    </span>
                                </td>
                                <td class="px-2">
                                    <span class="badge badge-info">
                                        @if ($model->status == App\Enums\InvoiceTypeEnum::STATUS_NOT_PAITD)
                                            {{ $model->paied_price }}
                                        @else
                                            {{ $model->price }}
                                        @endif
                                    </span>
                                </td>
                                <td class="px-2">
                                    <span class="badge text-primary fw-bold">
                                        {{ now()->parse($model->printed_at)->format('Y-m-d') }}
                                    </span>
                                </td>
                                <td class="px-2">
                                    <span class="badge badge-warning">
                                        {{ now()->parse($model->started_at)->format('Y-m-d') ?? __('site.invoices.action_not_performed') }}
                                    </span>
                                </td>
                                <td class="px-2">
                                    <span
                                        class="badge badge-{{ __("site.invoices_action_color.{$model->action}") }}">
                                        {{ __("site.invoices_action.{$model->action}") }}
                                    </span>
                                </td>
                                <td class="px-2 py-0">
                                    <span
                                        class="badge badge-{{ __("site.invoices_status_color.{$model->status}") }}">
                                        @if ($model->status == App\Enums\InvoiceTypeEnum::STATUS_NOT_PAITD)
                                            <span>باقى</span>
                                            <span>{{ $model->price - $model->paied_price }}</span>
                                            <span>جنيه</span>
                                        @else
                                            {{ __("site.invoices_status.{$model->status}") }}
                                        @endif
                                    </span>
                                </td>
                                <td class="px-2">
                                    <span
                                        class="badge badge-{{ $model->renderActionBy()['color'] }}">
                                        @if ($model->renderActionBy()['by'] == 'system')
                                            {{ __('site.invoices.bu_system') }}
                                        @elseif ($model->renderActionBy()['by'] == 'user')
                                            {{ __('site.invoices.by_user') }}
                                        @else
                                            {{ $model->admin_name ?? ($model->content['admin_name'] ?? 'المدير') }}
                                        @endif
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
