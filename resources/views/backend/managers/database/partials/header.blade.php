<div class="db-header">
    <div class="db-header-main">
        <h2 class="db-title">
            <i class="fa fa-database me-2"></i>
            {{ __('database_browser.page_title') }}
        </h2>
        <p class="db-subtitle">{{ __('database_browser.subtitle') }}</p>
    </div>
    <div class="db-header-stats">
        <div class="db-stat">
            <span class="db-stat-label">{{ __('database_browser.driver') }}</span>
            <span class="db-stat-value" dir="ltr">{{ strtoupper($driver) }}</span>
        </div>
        <div class="db-stat">
            <span class="db-stat-label">{{ __('database_browser.database') }}</span>
            <span class="db-stat-value" dir="ltr">{{ $database }}</span>
        </div>
        <div class="db-stat">
            <span class="db-stat-label">{{ __('database_browser.tables_total') }}</span>
            <span class="db-stat-value">{{ number_format($tablesCount) }}</span>
        </div>
        <div class="db-stat">
            <span class="db-stat-label">{{ __('database_browser.rows_total') }}</span>
            <span class="db-stat-value">{{ number_format($totalRows) }}</span>
        </div>
    </div>
</div>
