<div class="p-0 mt-0">
    <p class="mb-0 quta-usage" dir="auto">
        {{ $usage }}
    </p>
    <div class="progress progress-sm m-0">
        <div class="progress-bar bg-{{ $progress_color }}" role="progressbar"
            style="width: {{ $remain }}%; height: 1x;" aria-valuenow="{{ $remain }}"
            aria-valuemin="0" aria-valuemax="100">
        </div>
    </div>
    <div class="quta-total" dir="auto">
        @if ($total == 0)
            {{ __('site.quta_label.UNLIMITED') }}
        @else
            {{ $total ?? __('site.quta_label.UNLIMITED') }}
        @endif
    </div>
</div>
