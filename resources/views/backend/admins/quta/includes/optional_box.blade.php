<div class="dropdown">
    <div class="clearfix pull-left">
        <span
            class="badge badge-dark b-1 @if ($model->cards_count > 0) border-success
        @else border-warning @endif">
            {{ $loop->index + 1 }}
        </span>
        <span class="dropdown-toggle badge badge-success badge-pill" data-bs-toggle="dropdown">
            <span dir="auto">
                {{ $model->renderQuta() }}
            </span>
        </span>

        <div class="dropdown-menu dropdown-menu-end fw-bold">
            @can('quta_edit')
                <a class="dropdown-item py-2 fw-bold fw-bold"
                    href="{{ route('admins.quta.edit', $model->id) }}">
                    <i class="fa fa-pencil"></i>
                    {{ __('site.edit') }}
                </a>
            @endcan
            @can('quta_delete')
                <a class="dropdown-item py-2 fw-bold" href="#"
                    wire:click="showDeletedBox('{{ $model->id }}')">
                    <i class="fa fa-trash-o text-danger"></i>
                    {{ __('site.user_index.option.delete') }}
                </a>
            @endcan
        </div>
    </div>
</div>
