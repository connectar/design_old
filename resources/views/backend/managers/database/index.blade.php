@extends('backend.layouts.manger')

@section('content')
    <div class="db-browser-wrap">
        @include('backend.managers.database.partials.header', [
            'driver' => $driver,
            'database' => $database,
            'tablesCount' => count($tables),
            'totalRows' => $totalRows,
        ])

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card db-card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3 gap-2">
                    <a href="{{ route('managers.database.indexes.index') }}" class="btn btn-outline-info">
                        <i class="fa fa-bolt me-1"></i>
                        {{ __('database_browser.indexes_button') }}
                    </a>
                    <a href="{{ route('managers.database.orphans.index') }}" class="btn btn-outline-warning">
                        <i class="fa fa-bug me-1"></i>
                        {{ __('database_browser.orphans_button') }}
                    </a>
                </div>

                <form method="get" action="{{ route('managers.database.index') }}" class="row g-2 mb-3">
                    <div class="col-md-8">
                        <input type="text" name="q" value="{{ $search }}"
                            class="form-control form-control-lg"
                            placeholder="{{ __('database_browser.search_tables') }}" autofocus>
                    </div>
                    <div class="col-md-4 d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa fa-search me-1"></i> {{ __('database_browser.filter_apply') }}
                        </button>
                    </div>
                </form>

                @if (count($tables) === 0)
                    <div class="text-center py-5 text-muted">
                        <i class="fa fa-database fa-3x mb-3 d-block opacity-50"></i>
                        {{ __('database_browser.no_tables') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle db-tables-list">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width:50px">#</th>
                                    <th>{{ __('database_browser.col_table') }}</th>
                                    <th class="text-end" style="width:130px">{{ __('database_browser.col_rows') }}</th>
                                    <th class="text-end" style="width:120px">{{ __('database_browser.col_size') }}</th>
                                    <th class="text-center" style="width:140px">{{ __('database_browser.col_indexed') }}</th>
                                    <th class="text-end" style="width:160px">{{ __('database_browser.col_actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tables as $i => $t)
                                    @php
                                        $idxTotal = $t['index_total'] ?? 0;
                                        $idxExtra = $t['index_extra'] ?? 0;
                                        if ($idxExtra > 0) {
                                            $idxBadge = 'success';
                                            $idxLabel = __('database_browser.indexed_yes', ['n' => $idxTotal]);
                                            $idxIcon = 'fa-check-circle';
                                        } elseif ($idxTotal > 0) {
                                            $idxBadge = 'warning';
                                            $idxLabel = __('database_browser.indexed_pk_only');
                                            $idxIcon = 'fa-key';
                                        } else {
                                            $idxBadge = 'danger';
                                            $idxLabel = __('database_browser.indexed_none');
                                            $idxIcon = 'fa-times-circle';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-muted">{{ $i + 1 }}</td>
                                        <td>
                                            <a href="{{ route('managers.database.show', $t['name']) }}"
                                                class="db-table-name">
                                                <i class="fa fa-table text-primary me-1"></i>
                                                <span dir="ltr">{{ $t['name'] }}</span>
                                            </a>
                                            @if (! empty($t['comment']))
                                                <small class="d-block text-muted ms-3">{{ $t['comment'] }}</small>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <span class="badge bg-{{ $t['rows'] > 0 ? 'info' : 'secondary' }}">
                                                {{ number_format($t['rows']) }}
                                            </span>
                                        </td>
                                        <td class="text-end text-muted" dir="ltr">
                                            {{ $t['size'] ?? '—' }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $idxBadge }}"
                                                title="{{ __('database_browser.indexed_total', ['n' => $idxTotal]) }}">
                                                <i class="fa {{ $idxIcon }} me-1"></i>{{ $idxLabel }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('managers.database.show', $t['name']) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i>
                                                {{ __('database_browser.open') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('backend.managers.database.partials.styles')
@endsection
