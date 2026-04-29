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
                {{ $model->username }}
            </span>
        </span>

        <div class="dropdown-menu dropdown-menu-end fw-bold">


            <a class="dropdown-item py-2 fw-bold" href="#"
                wire:click="showDeletedBox('{{ $model->id }}')">
                <i class="fa fa-trash-o text-danger"></i>
                {{ __('site.user_index.option.delete') }}
            </a>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item py-2 fw-bold" href="#"
                wire:click="$dispatch('editExpiredDate','{{ $model->id }}')">
                <i class="fa spi fa-calendar"></i>
                {{ __('site.user_index.option.change_expired_date') }}
            </a>

            <a class="dropdown-item py-2 fw-bold" href="#"
                wire:click="$dispatch('showQutaUsage','{{ $model->id }}')">
                <i class="fa fa-cloud-download"></i>
                {{ __('site.user_index.option.show_quta_usage') }}
            </a>

        </div>
    </div>
</div>
