<div class="clearfix pull-left">
    <span class="h-20 flex-shrink-0 pull-left">
        <input value="{{ $model->id }}" type="checkbox" id="mobile_checkbox_{{ $model->id }}"
            class="filled-in" x-model="selectedModels">
        <label for="mobile_checkbox_{{ $model->id }}"></label>
    </span>
    <span class="badge badge-dark">
        @if ($page != 1)
            {{ $loop->index + 1 + $perPage * ($page - 1) }}
        @else
            {{ $loop->index + 1 }}
        @endif
    </span>
    <span class="px-2 badge badge-{{ $model->getConnectionTypeColor() }}">
        {{ $model->connection_type }}
    </span>
    <span class="badge">
        {{ $model->fullname }}
    </span>
    <span class="badge fs-16 no-padding">
        @if ($model->is_disabled > 0)
            <i class="fa fa-lock text-{{ $model->renderIsDisabledColor() }} px-1"></i>
        @endif
        @if ($model->is_active)
            <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
        @else
            <i class="fa fa-circle text-danger"></i>
        @endif

        @if ($model->renderStatusIsQutaExpired())
            <i class="fa fa-tachometer text-primary"></i>
        @endif

        @if ($model->renderStatusIsTimeExpired())
            <i class="fa fa-clock-o text-warning"></i>
        @endif

        @if ($model->renderStatusIsSpeedDown())
            <i class="fa fa-arrow-down text-warning"></i>
        @endif

    </span>
</div>
