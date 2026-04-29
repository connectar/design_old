@extends('backend.layouts.livewire.cafe')

@section('content')
    <div class="box">
        <form id="userStatistic" action="" method="GET">
            <div class="box-header py-2">
                <span class="text-primary px-1">
                    <i class="fa fa-area-chart text-primary px-1"></i>
                    {{ __('site.user_statistics.title') }}
                </span>
            </div>
        </form>
        <div class="box-body">
            <div class="row">
                <div class="col-xl-4 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon push-bottom rounded">
                            <i class="fa fa-users"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">
                                {{ __('site.user_statistics.all') }}
                            </span>
                            <span class="info-box-number">
                                {{ $statistic['userCount'] ?? 0 }}
                            </span>

                            <div class="progress">
                                <div class="progress-bar"
                                    style="width: {{ countProgress($statistic['planUserCount'], $statistic['devicesCount']) }}%">
                                </div>
                            </div>
                            <span class="progress-description">
                                {{ __('site.user_statistics.plan_size', ['count' => $statistic['planUserCount']]) }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-4 col-12">
                    <div class="info-box bg-success">
                        <span class="info-box-icon push-bottom rounded">
                            <i class="fa fa-user-plus"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">
                                {{ __('site.user_statistics.new') }}
                            </span>
                            <span class="info-box-number">
                                {{ $statistic['new'] ?? 0 }}
                            </span>

                            <div class="progress">
                                <div class="progress-bar"
                                    style="width: {{ countProgress($statistic['userCount'], $statistic['new'] ?? 0) }}%">
                                </div>
                            </div>
                            <span class="progress-description">
                                {{ __('site.user_statistics.new_in_last_month', ['user' => $statistic['newINLastMonth'] ?? 0]) }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-4 col-12">
                    <div class="info-box bg-lightest text-white">
                        <span class="info-box-icon push-bottom rounded">
                            <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">
                                {{ __('site.user_statistics.online') }}
                            </span>
                            <span class="info-box-number">
                                {{ $statistic['online']['total'] }}
                            </span>

                            <div class="progress bg-success">
                                <div class="progress-bar bg-success-light"
                                    style="width: {{ countProgress($statistic['userCount'], $statistic['online']['total']) }}%">
                                </div>
                            </div>
                            <span class="progress-description">
                                {{ __('site.user_statistics.online_count', [
                                    'CARD' => $statistic['online']['CARD'] ?? 0,
                                    'USER' => $statistic['online']['USER'] ?? 0,
                                ]) }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-xl-4 col-12">
                    <div class="box box-body bg-success">
                        <h6 class="text-uppercase">
                            {{ __('site.user_statistics.active') }}
                        </h6>
                        <div class="flexbox mt-2">
                            <i class="fa fa-check fs-40"></i>
                            <span class=" fs-30">
                                {{ $statistic['avilable'] ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-xl-4 col-12">
                    <div class="box box-body bg-danger bg-bubbles-dark">
                        <h6 class="text-uppercase">
                            {{ __('site.user_statistics.stopped') }}
                        </h6>
                        <div class="flexbox mt-2">
                            <span class=" fs-30">
                                {{ $statistic['disabled'] ?? 0 }}
                            </span>
                            <i class="fa fa-ban fs-40"></i>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xl-4 col-12">
                    <div class="box box-body bg-primary">
                        <h6 class="text-uppercase">
                            {{ __('site.user_statistics.expired') }}
                        </h6>
                        <div class="flexbox mt-2">
                            <i class="fa fa-user-times fs-40"></i>
                            <span class=" fs-30">
                                {{ $statistic['time_expired'] ?? 0 }}
                            </span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-xl-4 col-12">
                    <div class="box box-body text-center bg-warning bg-brick-dark">
                        <div class="">
                            {{ __('site.user_statistics.end_now') }}
                        </div>
                        <div class="
                            fs-30">
                            {{ $statistic['expiredToday'] ?? 0 }}
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xl-4 col-12">
                    <div class="box box-body text-center bg-info">
                        <div>
                            {{ __('site.user_statistics.end_3days') }}
                        </div>
                        <div class="fs-30">
                            {{ $statistic['expiredAfter3Days'] }}
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xl-4 col-12">
                    <div class="box box-body text-center bg-gradient-danger-dark text-white">
                        <div>
                            {{ __('site.user_statistics.end_5days') }}
                        </div>
                        <div class="fs-30">
                            {{ $statistic['expiredAfter5Days'] }}
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        {{ __('site.user_statistics.quta_day') }}
                    </h4>
                </div>
                <div class="box-body p-0">
                    <div class="media-list media-list-hover media-list-divided inner-user-div">
                        @forelse ($statistic['greatestToday'] as $index => $data)
                            <div class="media media-single">
                                <div class="media-body px-0">
                                    <h6>
                                        <i class="fa fa-cloud-download fs-20 px-1 text-danger"></i>
                                        {{ $data['fullname'] }}
                                    </h6>
                                </div>
                                <div class="media-right">
                                    <span class="badge badge-info badge-lg" dir="auto">
                                        {{ $data['total'] }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="p-4">
                                <x-datatable.empty-records />
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xl-4 col-12">
            <div class="box b-1 border-success">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        {{ __('site.user_statistics.quta_week') }}
                    </h4>
                </div>
                <div class="box-body p-0">
                    <div class="media-list media-list-hover media-list-divided inner-user-div">
                        @forelse($statistic['greatestWeek'] as $index => $data)
                            <div class="media media-single px-0">
                                <div class="media-body">
                                    <h6>
                                        <i class="fa fa-cloud-download fs-20 px-1 text-success"></i>
                                        {{ $data['fullname'] }}
                                    </h6>
                                </div>

                                <div class="media-right">
                                    <span class="badge badge-success badge-lg" dir="auto">
                                        {{ $data['total'] }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="p-4">
                                <x-datatable.empty-records />
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-xl-4 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        {{ __('site.user_statistics.quta_month') }}
                    </h4>
                </div>
                <div class="box-body p-0">
                    <div class="media-list media-list-hover media-list-divided inner-user-div">
                        @forelse ($statistic['greatestMonth'] as $index => $data)
                            <div class="media media-single px-0">
                                <div class="media-body">
                                    <h6>
                                        <i class="fa fa-cloud-download fs-20 px-1 text-warning"></i>
                                        {{ $data['fullname'] }}
                                    </h6>
                                </div>

                                <div class="media-right">
                                    <span class="badge badge-warning badge-lg" dir="auto">
                                        {{ $data['total'] }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="p-4">
                                <x-datatable.empty-records />
                            </div>
                        @endforelse
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

        });
    </script>
@endpush
