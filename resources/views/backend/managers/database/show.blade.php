@extends('backend.layouts.manger')

@section('content')
    <div class="db-browser-wrap">
        @include('backend.managers.database.partials.header', [
            'driver' => $driver,
            'database' => $database,
            'tablesCount' => 1,
            'totalRows' => $totalRows,
        ])

        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <a href="{{ route('managers.database.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fa fa-arrow-{{ App::getLocale() === 'ar' ? 'right' : 'left' }} me-1"></i>
                    {{ __('database_browser.back_to_tables') }}
                </a>
            </div>
            <h3 class="m-0" dir="ltr">
                <i class="fa fa-table text-primary me-1"></i>
                {{ $table }}
                <small class="text-muted ms-2">
                    {{ __('database_browser.rows_count', ['n' => number_format($totalRows)]) }}
                </small>
            </h3>
        </div>

        <ul class="nav nav-tabs db-tabs" id="db-table-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-data-btn" data-bs-toggle="tab" data-bs-target="#tab-data"
                    type="button" role="tab">
                    <i class="fa fa-list me-1"></i> {{ __('database_browser.data_tab') }}
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-cols-btn" data-bs-toggle="tab" data-bs-target="#tab-cols"
                    type="button" role="tab">
                    <i class="fa fa-columns me-1"></i> {{ __('database_browser.columns_tab') }}
                    <span class="badge bg-secondary ms-1">{{ count($columns) }}</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-idx-btn" data-bs-toggle="tab" data-bs-target="#tab-idx"
                    type="button" role="tab">
                    <i class="fa fa-key me-1"></i> {{ __('database_browser.indexes_tab') }}
                    <span class="badge bg-secondary ms-1">{{ count($indexes) }}</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-sql-btn" data-bs-toggle="tab" data-bs-target="#tab-sql"
                    type="button" role="tab">
                    <i class="fa fa-terminal me-1"></i> {{ __('database_browser.console_tab') }}
                </button>
            </li>
        </ul>

        <div class="tab-content card" style="border-top-{{ App::getLocale() === 'ar' ? 'right' : 'left' }}-radius:0; border-top-{{ App::getLocale() === 'ar' ? 'left' : 'right' }}-radius:0;">
            {{-- DATA TAB --}}
            <div class="tab-pane fade show active p-3" id="tab-data" role="tabpanel">
                <form method="get" action="{{ route('managers.database.show', $table) }}" class="db-toolbar">
                    <select name="filter_column" class="form-select form-select-sm">
                        <option value="">— {{ __('database_browser.filter_column') }} —</option>
                        @foreach ($columns as $col)
                            <option value="{{ $col }}" @selected($filterColumn === $col)>{{ $col }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="filter_value" value="{{ $filterValue }}"
                        class="form-control form-control-sm"
                        placeholder="{{ __('database_browser.filter_value') }}" style="min-width:180px;">
                    <select name="per_page" class="form-select form-select-sm">
                        @foreach ([25, 50, 100, 200] as $pp)
                            <option value="{{ $pp }}" @selected($perPage === $pp)>{{ $pp }}/{{ __('database_browser.per_page') }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="order_by" value="{{ $orderBy }}">
                    <input type="hidden" name="order_dir" value="{{ $orderDir }}">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-filter"></i> {{ __('database_browser.filter_apply') }}
                    </button>
                    <a href="{{ route('managers.database.show', $table) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fa fa-times"></i> {{ __('database_browser.filter_reset') }}
                    </a>
                </form>

                @if (count($rows) === 0)
                    <div class="text-center py-5 text-muted">
                        <i class="fa fa-inbox fa-3x mb-3 d-block opacity-50"></i>
                        {{ __('database_browser.no_rows') }}
                    </div>
                @else
                    <div class="db-row-scroll">
                        <table class="table table-sm table-striped table-hover db-row-table mb-0">
                            <thead>
                                <tr>
                                    @foreach ($columns as $col)
                                        @php
                                            $isSorted = $orderBy === $col;
                                            $nextDir = $isSorted && $orderDir === 'asc' ? 'desc' : 'asc';
                                            $sortQs = http_build_query(array_merge(request()->query(), [
                                                'order_by' => $col,
                                                'order_dir' => $nextDir,
                                                'page' => 1,
                                            ]));
                                        @endphp
                                        <th>
                                            <a href="{{ route('managers.database.show', $table) }}?{{ $sortQs }}"
                                                title="{{ $isSorted && $orderDir === 'asc' ? __('database_browser.sort_desc') : __('database_browser.sort_asc') }}">
                                                <span dir="ltr">{{ $col }}</span>
                                                @if ($isSorted)
                                                    <i class="fa fa-sort-{{ $orderDir === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                                @endif
                                            </a>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)
                                    <tr>
                                        @foreach ($columns as $col)
                                            @php
                                                $val = $row[$col] ?? null;
                                                $cls = '';
                                                $display = $val;
                                                if ($val === null) {
                                                    $cls = 'cell-null';
                                                    $display = 'NULL';
                                                } elseif (is_bool($val)) {
                                                    $cls = 'cell-bool';
                                                    $display = $val ? 'true' : 'false';
                                                } elseif (is_numeric($val) && ! is_string($val)) {
                                                    $cls = 'cell-num';
                                                    $display = (string) $val;
                                                } elseif (is_array($val) || is_object($val)) {
                                                    $display = json_encode($val, JSON_UNESCAPED_UNICODE);
                                                } else {
                                                    $display = (string) $val;
                                                }
                                                $needsTruncate = is_string($display) && mb_strlen($display) > 80;
                                            @endphp
                                            <td class="{{ $cls }}" dir="auto">
                                                @if ($needsTruncate)
                                                    <span class="cell-trunc" title="{{ $display }}">{{ mb_substr($display, 0, 80) }}…</span>
                                                @else
                                                    {{ $display }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @include('backend.managers.database.partials.pagination')
                @endif
            </div>

            {{-- COLUMNS TAB --}}
            <div class="tab-pane fade p-3" id="tab-cols" role="tabpanel">
                <table class="table table-sm table-striped db-meta-table">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('database_browser.col_name') }}</th>
                            <th>{{ __('database_browser.col_type') }}</th>
                            <th>{{ __('database_browser.col_nullable') }}</th>
                            <th>{{ __('database_browser.col_default') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($columns as $col)
                            @php $d = $columnDetails[$col] ?? []; @endphp
                            <tr>
                                <td dir="ltr"><strong>{{ $col }}</strong></td>
                                <td dir="ltr"><code>{{ $d['type'] ?? '—' }}</code></td>
                                <td>
                                    @if (! isset($d['nullable']))
                                        —
                                    @elseif ($d['nullable'])
                                        <span class="badge bg-secondary">{{ __('database_browser.yes') }}</span>
                                    @else
                                        <span class="badge bg-success">{{ __('database_browser.no') }}</span>
                                    @endif
                                </td>
                                <td dir="ltr"><code>{{ $d['default'] ?? '—' }}</code></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- INDEXES TAB --}}
            <div class="tab-pane fade p-3" id="tab-idx" role="tabpanel">
                @if (count($indexes) === 0)
                    <p class="text-muted m-0">—</p>
                @else
                    <table class="table table-sm table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>{{ __('database_browser.idx_name') }}</th>
                                <th>{{ __('database_browser.idx_columns') }}</th>
                                <th>{{ __('database_browser.idx_unique') }}</th>
                                <th>{{ __('database_browser.idx_primary') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($indexes as $idx)
                                <tr>
                                    <td dir="ltr"><strong>{{ $idx['name'] }}</strong></td>
                                    <td dir="ltr">
                                        @foreach ($idx['columns'] as $c)
                                            <span class="badge bg-info me-1">{{ $c }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if ($idx['unique'])
                                            <span class="badge bg-warning text-dark">{{ __('database_browser.yes') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('database_browser.no') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($idx['primary'])
                                            <span class="badge bg-danger">{{ __('database_browser.yes') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('database_browser.no') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            {{-- SQL CONSOLE TAB --}}
            <div class="tab-pane fade p-3" id="tab-sql" role="tabpanel">
                @include('backend.managers.database.partials.console', ['table' => $table])
            </div>
        </div>
    </div>

    @include('backend.managers.database.partials.styles')
@endsection
