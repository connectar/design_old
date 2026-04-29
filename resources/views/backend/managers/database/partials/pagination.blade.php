@php
    $baseQs = request()->query();
    $linkFor = function (int $p) use ($baseQs, $table) {
        $qs = http_build_query(array_merge($baseQs, ['page' => $p]));
        return route('managers.database.show', $table).'?'.$qs;
    };
@endphp
<nav class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
    <small class="text-muted">
        {{ __('database_browser.page_of', ['page' => $page, 'total' => $totalPages]) }}
        — {{ __('database_browser.rows_count', ['n' => number_format($totalRows)]) }}
    </small>
    <ul class="pagination pagination-sm mb-0">
        <li class="page-item @disabled($page <= 1)">
            <a class="page-link" href="{{ $page <= 1 ? '#' : $linkFor(1) }}">{{ __('database_browser.first_page') }}</a>
        </li>
        <li class="page-item @disabled($page <= 1)">
            <a class="page-link" href="{{ $page <= 1 ? '#' : $linkFor($page - 1) }}">{{ __('database_browser.prev_page') }}</a>
        </li>
        <li class="page-item active">
            <span class="page-link">{{ $page }}</span>
        </li>
        <li class="page-item @disabled($page >= $totalPages)">
            <a class="page-link" href="{{ $page >= $totalPages ? '#' : $linkFor($page + 1) }}">{{ __('database_browser.next_page') }}</a>
        </li>
        <li class="page-item @disabled($page >= $totalPages)">
            <a class="page-link" href="{{ $page >= $totalPages ? '#' : $linkFor($totalPages) }}">{{ __('database_browser.last_page') }}</a>
        </li>
    </ul>
</nav>
