<div class="dropdown">
    <div class="clearfix pull-left">
        <span class="badge badge-dark b-1 border-warning">
            @if ($page != 1)
                {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
                {{ $loop->index + 1 }}
            @endif
        </span>
        <span class="dropdown-toggle badge @if ($model->cards_count > 0) badge-success
        @else badge-warning @endif badge-pill" data-bs-toggle="dropdown">
            <span dir="auto">
                {{ $model->name }}
            </span>
        </span>

        <div class="dropdown-menu dropdown-menu-end fw-bold">
            <a class="dropdown-item py-4 fw-bold" href="#" wire:click="restore('{{ $model->id }}')">
                <i class="fa fa-trash-o text-danger"></i>
                {{ __('site.admins_index.restore.button') }}
            </a>
        </div>
    </div>
</div>
