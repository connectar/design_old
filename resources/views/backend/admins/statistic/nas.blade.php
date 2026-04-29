@extends('backend.layouts.livewire.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header py-2">
                    <form id="userStatistic" action="" method="GET" class="d-flex flex-wrap align-items-end gap-2">
                        <span class="text-primary px-1">
                            <i class="fa fa-area-chart text-primary px-1"></i>
                            {{ __('site.nas_statistics.title') }}
                        </span>
                        <select id="selectedNas" class="form-select d-inline bg-lightest text-white"
                            style="max-width: 250px" name="filter">
                            @foreach ($nas as $index => $nas)
                                <option value="{{ $nas['serial'] }}" @if ($filter == $nas) selected @endif>
                                    {{ $nas['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <div class="d-flex flex-wrap gap-2 align-items-end">
                            <div>
                                <label class="small d-block mb-0">{{ __('site.nas_statistics.date_from') }}</label>
                                <input type="date" name="date_from" class="form-control form-control-sm"
                                    value="{{ $consumption_date_from ?? '' }}">
                            </div>
                            <div>
                                <label class="small d-block mb-0">{{ __('site.nas_statistics.date_to') }}</label>
                                <input type="date" name="date_to" class="form-control form-control-sm"
                                    value="{{ $consumption_date_to ?? '' }}">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">{{ __('site.nas_statistics.apply') }}</button>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    @php($fmt = app(\App\Models\NasAcounting::class))
                    @if (!empty($statistic['ledgerNas']))
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="box box-body bg-dark p-3 text-center">
                                    <div class="small text-white-50">{{ __('site.nas_statistics.five_month_total_traffic') }}</div>
                                    <div class="fs-24 text-white" dir="auto">
                                        {{ $fmt->formatBytes($statistic['fiveMonthNasTraffic']['total_bytes'] ?? 0, 2) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box box-body bg-secondary p-3 text-center">
                                    <div class="small">{{ __('site.nas_statistics.range_total_traffic') }}</div>
                                    <div class="fs-24" dir="auto">
                                        {{ $fmt->formatBytes($statistic['rangeNasTraffic']['total_bytes'] ?? 0, 2) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <a class="box box-link-pop text-center b-1 border-danger" href="javascript:void(0)">
                                <div class="box-body">
                                    <p class="fs-30 text-white" dir="auto">
                                        <strong>
                                            {{ $statistic['totalQuta'] }}
                                        </strong>
                                    </p>
                                </div>
                                <div class="box-body py-25 bg-danger btsr-0 bter-0">
                                    <p class="fw-600 fs-20">
                                        <i class="fa fa-cloud-download"></i>
                                        {{ __('site.nas_statistics.quta') }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a class="box box-link-pop text-center b-1 border-info" href="javascript:void(0)">
                                <div class="box-body">
                                    <p class="fs-30 text-white">
                                        <strong>
                                            {{ $statistic['userCount'] ?? 0 }}
                                        </strong>
                                    </p>
                                </div>
                                <div class="box-body py-25 bg-info btsr-0 bter-0">
                                    <p class="fw-600 fs-20">
                                        <i class="fa fa-users"></i>
                                        {{ __('site.user_statistics.all') }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a class="box box-link-pop text-center b-1 border-success" href="javascript:void(0)">
                                <div class="box-body">
                                    <p class="fs-30 text-white">
                                        <strong>
                                            {{ $statistic['online']['total'] }}
                                        </strong>
                                    </p>
                                </div>
                                <div class="box-body py-25 bg-success btsr-0 bter-0">
                                    <p class="fw-600 fs-20">
                                        <i class="fa spi fa-snowflake-o fa-spin text-primary"></i>
                                        {{ __('site.user_statistics.online') }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        {{ __('site.nas_statistics.quta_info') }}
                    </h4>
                </div>
                <div class="box-body p-0">
                    <div class="collectionTable">
                        @if (!empty($statistic['ledgerNas']) && isset($statistic['qutaUsageDaily']) && $statistic['qutaUsageDaily']->isNotEmpty())
                            <table class="table table-striped text-center no-padding mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('site.nas_statistics.daily_col_day') }}</th>
                                        <th>{{ __('site.nas_statistics.daily_col_down') }}</th>
                                        <th>{{ __('site.nas_statistics.daily_col_up') }}</th>
                                        <th>{{ __('site.nas_statistics.daily_col_total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($statistic['qutaUsageDaily'] as $row)
                                        <tr>
                                            <td><span class="badge badge-success">{{ $row->day }}</span></td>
                                            <td dir="auto">{{ $fmt->formatBytes($row->download_bytes, 2) }}</td>
                                            <td dir="auto">{{ $fmt->formatBytes($row->upload_bytes, 2) }}</td>
                                            <td dir="auto"><span class="badge badge-warning">{{ $fmt->formatBytes($row->total_bytes, 2) }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p class="small text-muted px-2 py-1 mb-0">{{ __('site.nas_statistics.daily_table_hint') }}</p>
                        @else
                            <table class="table table-striped text-center no-padding">
                                <x-table-thead :columns="__('datatable.nas_quta')" />
                                <tbody>
                                    @foreach ($statistic['qutaUsage'] as $model)
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p class="small text-warning px-2">{{ __('site.nas_statistics.legacy_session_grouping_hint') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
@push('scripts')
    <script>
        $(function() {
            $('#selectedNas').val({{ $filter }});
            $('#selectedNas').on('change', function() {
                $('#userStatistic').submit();
            });


            $(".collectionTable").slimScroll({
                color: "#0bb2d4",
                size: "10px",
                height: "420px",
                alwaysVisible: true,
            });

        }); // End of use strict
    </script>
@endpush
