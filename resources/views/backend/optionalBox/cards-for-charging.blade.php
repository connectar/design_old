<div class="dropdown">
    <div class="clearfix pull-left">
        <span class="h-20 flex-shrink-0 pull-left">
            <input value="{{ $model->id }}" type="checkbox" id="md_checkbox_{{ $model->id }}"
                class="filled-in chk-col-success checkedId">
            <label for="md_checkbox_{{ $model->id }}"></label>
        </span>
        <span class="badge badge-dark b-1 border-warning">
            @if ($page != 1)
                {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
                {{ $loop->index + 1 }}
            @endif
        </span>
        <span class="dropdown-toggle badge badge-success badge-pill" data-bs-toggle="dropdown">
            <span dir="auto">
                {{ $model->username }}
            </span>
        </span>
        @can('charging_delete')
            @if (authIsSuperAdmin())
            <div class="dropdown-menu dropdown-menu-end fw-bold">
                <a class="dropdown-item py-2 fw-bold" href="#"
                    wire:click="showDeletedBox('{{ $model->id }}')">
                    <i class="fa fa-trash-o text-danger"></i>
                    {{ __('site.user_index.option.delete') }}
                </a>
            </div>
            @endif
        @endcan
    </div>
</div>
