<div class="clearfix pull-left">
    <span class="badge badge-dark">
        @if ($page != 1)
            {{ $loop->index + 1 + $perPage * ($page - 1) }}
        @else
            {{ $loop->index + 1 }}
        @endif
    </span>
    <span class="badge badge-{{ $model->getConnectionTypeColor() }}">
        {{ $model->connection_type }}
    </span>
    <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
    <span dir="auto">
        @if ($model->defined_macs !== null &&
            array_key_exists($model->macaddress, $model->defined_macs) &&
            strlen($model->defined_macs[$model->macaddress]) > 0)
            <i class="fa fa-laptop text-primary"></i>
            <span class="badge">
                {{ $model->defined_macs[$model->macaddress] }}
            </span>
        @else
            <span class="badge">
                {{ $model->fullname }}
            </span>
        @endif
    </span>
    @if ($model->renderStatusIsQutaExpired())
        <span class="badge fs-16 p-0">
            <i class="fa fa-tachometer text-primary"></i>
        </span>
    @endif
    @if ($model->renderStatusIsTimeExpired())
        <span class="badge fs-16 p-0">
            <i class="fa fa-clock-o text-warning"></i>
        </span>
    @endif
</div>
