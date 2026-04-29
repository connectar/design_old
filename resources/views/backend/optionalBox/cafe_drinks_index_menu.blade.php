<div class="dropdown">
    <div class="clearfix pull-left">
        <span class="badge badge-dark b-1 border-warning">
            @if ($page != 1)
            {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
            {{ $loop->index + 1 }}
            @endif
        </span>
        <span class="dropdown-toggle badge badge-warning  badge-pill" data-bs-toggle="dropdown">
            <span dir="auto">
                {{ $model->name }}
            </span>
        </span>
        <div class="dropdown-menu dropdown-menu-end fw-bold">

            <a class="dropdown-item py-2 fw-bold fw-bold" href="{{ route('cafe.drinks.edit', $model->id) }}">
                <i class="fa fa-pencil"></i>
                {{ __('site.user_index.option.edit') }}
            </a>

            <a class="dropdown-item py-2 fw-bold" href="#" wire:click="showDeletedBox('{{ $model->id }}')">
                <i class="fa fa-trash-o text-danger"></i>
                {{ __('site.user_index.option.delete') }}
            </a>
        </div>
    </div>
</div>
