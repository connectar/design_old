<div class="box-header with-border px-4">
    <h4 class="box-title">
        <a href="" class="btn btn-sm btn-success">
            <i class="fa spi fa-plus px-2"></i>
            {{ $title ?? '' }}
            {{ $username ?? '' }}
        </a>

        <a href="{{ $backRoute }}" class="btn btn-sm btn-warning">
            <i class="fa spi fa-arrow-right px-2"></i>
            <span class="hidden-sm-down">
                {{ $backText ?? __('website.cancel') }}
            </span>
        </a>
    </h4>
    {{ $slot }}
</div>
