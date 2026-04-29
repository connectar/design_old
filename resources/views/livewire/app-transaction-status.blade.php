<div wire:poll.10000ms>
    <span>
        <span class="text-primary"> حالة التطبيق</span>
        @if ($status)
            <span class="text-success">متصل</span>
            <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
        @else
            <span class="text-danger">غير متصل</span>
            <i class="fa fa-circle text-danger"></i>
        @endif
    </span>
</div>
