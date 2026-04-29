<div class="dropdown">
    <div class="clearfix pull-left">
        <span class="badge badge-dark">
            @if ($page != 1)
            {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
            {{ $loop->index + 1 }}
            @endif
        </span>
        <span class="dropdown-toggle px-2 badge badge-success" data-bs-toggle="dropdown">
            {{ $model->username }}
        </span>
        <div class="dropdown-menu dropdown-menu-end fw-bold">
            <a class="dropdown-item py-2 fw-bold" href="#"
                wire:click="removeFromActive('{{ $model->framedipaddress }}','{{ $model->nas_ip_address }}')">
                <i class="fa spi fa-comments"></i>
                {{ __('site.user_index.option.remove_from_active') }}
            </a>
        </div>

        <span class="badge">
            <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
        </span>
    </div>

</div>
