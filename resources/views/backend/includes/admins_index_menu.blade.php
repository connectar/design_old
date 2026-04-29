<div class="dropdown">
    <div class="clearfix pull-left">
        <span class="badge badge-dark pull-left">
            @if ($page != 1)
                {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
                {{ $loop->index + 1 }}
            @endif
        </span>
        <span class="dropdown-toggle badge badge-{{ $model->statusClass }} badge-pill" data-bs-toggle="dropdown">
            {{ $model->fullname }}
        </span>
        <div class="dropdown-menu dropdown-menu-end fw-bold">
            <a class="dropdown-item py-2 fw-bold fw-bold" href="{{ route('admins.edit', $model->id) }}">
                <i class="fa fa-pencil"></i>
                {{ __('site.user_index.option.edit') }}
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item py-2 fw-bold" href="#" wire:click="showDeletedBox('{{ $model->id }}')">
                <i class="fa fa-trash-o text-danger"></i>
                {{ __('site.user_index.option.delete') }}
            </a>
        </div>
    </div>
</div>
