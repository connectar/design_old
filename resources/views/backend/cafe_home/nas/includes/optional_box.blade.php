<div class="dropdown">
    <div class="clearfix pull-left">
        <span class="badge badge-dark b-1 border-warning">
            @if ($page != 1)
                {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
                {{ $loop->index + 1 }}
            @endif
        </span>
        <span
            class="dropdown-toggle badge @if ($model->cards_count > 0) badge-success
        @else badge-warning @endif badge-pill"
            data-bs-toggle="dropdown">
            <span dir="auto">
                {{ $model->name }}
            </span>
        </span>

        <div class="dropdown-menu dropdown-menu-end fw-bold">

            <a class="dropdown-item py-2 fw-bold fw-bold"
                href="{{ route('cafe_home.nas.edit', $model->id) }}">
                <i class="fa fa-pencil"></i>
                {{ __('site.user_index.option.edit') }}
            </a>

            <a class="dropdown-item py-2 fw-bold"
                href="{{ route('cafe_home.nas.show', $model->serial) }}">
                <i class="fa fa-plus text-success"></i>
                {{ __('site.nas_index.option.install') }}
            </a>

            <a class="dropdown-item py-2 fw-bold fw-bold" href="#"
                wire:click="$dispatch('EditCafeNasPassword','{{ $model->id }}')">
                <i class="fa fa-pencil"></i>
                {{ __('site.nas_index.option.editCafeNasPassword') }}
            </a>

            <a class="dropdown-item py-2 fw-bold fw-bold text-warning" href="#"
                wire:click="$dispatch('EditCafeWifiName','{{ $model->id }}')">
                <i class="fa fa-wifi"></i>
                {{ __('site.nas_index.option.EditCafeWifiName') }}
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item py-2 fw-bold text-primary" href="#"
                wire:click="reboot('{{ $model->id }}')">
                <i class="fa fa-refresh text-primary"></i>
                {{ __('site.nas_index.option.reboot') }}
            </a>
        </div>
    </div>
</div>
