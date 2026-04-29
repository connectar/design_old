<div class="dropdown">
    <div class="clearfix pull-left">
        <span class="badge badge-dark">
            @if ($page != 1)
                {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
                {{ $loop->index + 1 }}
            @endif
        </span>
        <span class="dropdown-toggle px-2 badge badge-{{ $model->getConnectionTypeColor() }}"
            data-bs-toggle="dropdown">
            {{ $model->connection_type }}
        </span>
        <div class="dropdown-menu dropdown-menu-end fw-bold">
            <a class="dropdown-item py-2 fw-bold" href="#"
                x-on:click="removeFromActive('{{ $model->username }}','{{ $model->nas_ip_address }}','{{ $model->connection_type }}')">
                <i class="fa spi fa-comments"></i>
                {{ __('site.user_index.option.remove_from_active') }}
            </a>
        </div>

        <span class="badge">
            <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
        </span>
        <span class="badge fs-16 p-0">
            @if ($model->renderStatusIsQutaExpired())
                <i class="fa fa-tachometer text-primary"></i>
            @endif
            @if ($model->renderStatusIsTimeExpired())
                <i class="fa fa-clock-o text-warning"></i>
            @endif
        </span>
    </div>

</div>
