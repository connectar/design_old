@extends('backend.layouts.livewire.admin')

@section('content')
<div class="box">
    <form id="userStatistic" action="" method="GET">
        <div class="box-header py-2">
            <span class="text-primary px-1">
                <i class="fa fa-area-chart text-primary px-1"></i>
                {{ __('site.user_statistics.title') }}
            </span>
            <select id="selectedNas" class="form-select d-inline bg-lightest text-white"
                style="max-width: 250px" name="filter">
                @foreach ($nas as $index => $nas)
                    <option value="{{ $nas['serial'] }}" @if ($filter == $nas) selected @endif>
                        {{ $nas['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
    <div class="box-body">
        <div class="row">
            <!-- /.col -->
            <div class="col-xl-4 col-12">
                <div class="info-box bg-lightest text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.invoices_count') }}
                        </span>
                        <span class="info-box-number">
                            {{ $statistic['invoicesCount'] }}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['invoicesCount'], $statistic['invoicesCount']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_price', ['count' => $statistic['invoicesCount']]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-4 col-12">
                <div class="info-box bg-success text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.invoices_paid_count') }}
                        </span>
                        <span class="info-box-number">
                            {{ $statistic['invoicesPaidCount'] }}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['invoicesCount'], $statistic['invoicesPaidCount']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_size', ['count' => $statistic['invoicesCount']]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-4 col-12">
                <div class="info-box bg-danger text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.invoices_unpaid_count') }}
                        </span>
                        <span class="info-box-number">
                            {{ $statistic['invoicesUnPaidCount'] }}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['invoicesCount'], $statistic['invoicesUnPaidCount']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_size', ['count' => $statistic['invoicesCount']]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
            <div class="col-xl-4 col-12">
                <div class="info-box bg-lightest text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.invoices_total') }}
                        </span>
                        <span class="info-box-number">
                            {{ number_format($statistic['invoicesPrice'], 2) }} {{__('site.user_panel.add_quta.bound')}}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['invoicesPrice'], $statistic['invoicesPrice']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_price', ['count' => number_format($statistic['invoicesPrice'], 2)]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-4 col-12">
                <div class="info-box bg-success text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.invoices_paid_total') }}
                        </span>
                        <span class="info-box-number">
                            {{ number_format($statistic['invoicesPaidPrice'], 2) }} {{__('site.user_panel.add_quta.bound')}}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['invoicesPrice'], $statistic['invoicesPaidPrice']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_price', ['count' => number_format($statistic['invoicesPaidPrice'], 2)]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-4 col-12">
                <div class="info-box bg-danger text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.invoices_unpaid_total') }}
                        </span>
                        <span class="info-box-number">
                            {{ number_format($statistic['invoicesUnPaidPrice'], 2) }} {{__('site.user_panel.add_quta.bound')}}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['invoicesPrice'], $statistic['invoicesUnPaidPrice']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_price', ['count' => number_format($statistic['invoicesUnPaidPrice'], 2)]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            {{-- <div class="col-xl-4 col-12">
                <div class="info-box bg-light text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.debits') }}
                        </span>
                        <span class="info-box-number">
                            {{ number_format($statistic['debits'], 2) }} {{__('site.user_panel.add_quta.bound')}}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['debits'], $statistic['debits']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_price', ['count' => number_format($statistic['debits'], 2)]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-xl-4 col-12">
                <div class="info-box bg-success text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.debits_paid') }}
                        </span>
                        <span class="info-box-number">
                            {{ number_format($statistic['debits_paid'], 2) }} {{__('site.user_panel.add_quta.bound')}}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['debits'], $statistic['debits_paid']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_price', ['count' => number_format($statistic['debits'], 2)]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-4 col-12">
                <div class="info-box bg-danger text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.debits_unpaid') }}
                        </span>
                        <span class="info-box-number">
                            {{ number_format($statistic['debits_unpaid'], 2) }} {{__('site.user_panel.add_quta.bound')}}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['debits'], $statistic['debits_unpaid']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_price', ['count' => number_format($statistic['debits'], 2)]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-4 col-12">
                <div class="info-box bg-light text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.debits_by_month') }}
                        </span>
                        <span class="info-box-number">
                            {{ number_format($statistic['debitsByMonth'], 2) }} {{__('site.user_panel.add_quta.bound')}}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['debitsByMonth'], $statistic['debitsByMonth']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_price', ['count' => number_format($statistic['debitsByMonth'], 2)]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-xl-4 col-12">
                <div class="info-box bg-success text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.debits_paid_by_month') }}
                        </span>
                        <span class="info-box-number">
                            {{ number_format($statistic['debitsPaidByMonth'], 2) }} {{__('site.user_panel.add_quta.bound')}}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['debitsByMonth'], $statistic['debitsPaidByMonth']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_price', ['count' => number_format($statistic['debitsByMonth'], 2)]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-xl-4 col-12">
                <div class="info-box bg-danger text-white">
                    <span class="info-box-icon push-bottom rounded">
                        <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ __('site.debits_unpaid_by_month') }}
                        </span>
                        <span class="info-box-number">
                            {{ number_format($statistic['debitsUnPaidByMonth'], 2) }} {{__('site.user_panel.add_quta.bound')}}
                        </span>

                        <div class="progress">
                            <div class="progress-bar"
                                style="width: {{ countProgress($statistic['debitsByMonth'], $statistic['debitsUnPaidByMonth']) }}%">
                            </div>
                        </div>
                        <span class="progress-description">
                            {{ __('site.user_statistics.plan_price', ['count' => number_format($statistic['debitsByMonth'], 2)]) }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col --> --}}
        </div>
    </div>
</div>
<!-- /.col -->
<div class="row">
    <div class="col-xl-4 col-4">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">
                    {{ __('site.details_for_prev_month_invoices') }}
                </h4>
            </div>
            <div class="box-body p-0">
                <div class="media-list media-list-hover media-list-divided inner-user-div">
                    <div class="media media-single px-0">
                        <div class="media-body">
                            <h6>
                                <i class="fa fa-cloud-download fs-20 px-1 text-warning"></i>
                                {{ __('site.total_invouces_for_prev_month') }}
                            </h6>
                        </div>

                        <div class="media-right">
                            <span class="badge badge-warning badge-lg" dir="auto">
                                {{ number_format($statistic['debitsByPrevMonth'], 2) ?? 0 }} {{__('site.user_panel.add_quta.bound')}}
                            </span>
                        </div>
                    </div>
                    <div class="media media-single px-0">
                        <div class="media-body">
                            <h6>
                                <i class="fa fa-cloud-download fs-20 px-1 text-warning"></i>
                                {{ __('site.total_paid_invouces_for_prev_month') }}
                            </h6>
                        </div>

                        <div class="media-right">
                            <span class="badge badge-warning badge-lg" dir="auto">
                                {{ number_format($statistic['debitsPaidByPrevMonth'], 2) ?? 0 }} {{__('site.user_panel.add_quta.bound')}}
                            </span>
                        </div>
                    </div>
                    <div class="media media-single px-0">
                        <div class="media-body">
                            <h6>
                                <i class="fa fa-cloud-download fs-20 px-1 text-warning"></i>
                                {{ __('site.total_unpaid_invouces_for_prev_month') }}
                            </h6>
                        </div>

                        <div class="media-right">
                            <span class="badge badge-warning badge-lg" dir="auto">
                                {{ number_format($statistic['debitsUnPaidByPrevMonth'], 2) ?? 0 }} {{__('site.user_panel.add_quta.bound')}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#selectedNas').val({{ $filter }});
            $('#selectedNas').on('change', function() {
                $('#userStatistic').submit();
            });

        }); // End of use strict
    </script>
@endpush
