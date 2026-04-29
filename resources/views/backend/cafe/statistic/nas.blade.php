@extends('backend.layouts.livewire.cafe')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header py-2">
                    <form id="userStatistic" action="" method="GET">
                        <span class="text-primary px-1">
                            <i class="fa fa-area-chart text-primary px-1"></i>
                            {{ __('site.nas_statistics.title') }}
                        </span>
                        <select id="selectedNas" class="form-select d-inline bg-lightest text-white"
                            style="max-width: 250px" name="filter">
                            @foreach ($nas as $index => $nas)
                                <option value="{{ $nas['serial'] }}"
                                    @if ($filter == $nas) selected @endif>
                                    {{ $nas['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <a class="box box-link-pop text-center b-1 border-danger"
                                href="javascript:void(0)">
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
                            <a class="box box-link-pop text-center b-1 border-info"
                                href="javascript:void(0)">
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
                            <a class="box box-link-pop text-center b-1 border-success"
                                href="javascript:void(0)">
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
