<div class="dropdown" style="white-space: nowrap;">
    <div class="clearfix pull-left">
        <span class="h-20 flex-shrink-0 pull-left">
            <input value="{{ $model->id }}" type="checkbox" id="md_checkbox_{{ $model->id }}"
                class="filled-in chk-col-success checkedId">
            <label for="md_checkbox_{{ $model->id }}"></label>
        </span>
        <span class="badge badge-dark">
            @if ($page != 1)
                {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
                {{ $loop->index + 1 }}
            @endif
        </span>
        <span class="dropdown-toggle px-2 badge badge-success"
            data-bs-toggle="dropdown">
            {{ $model->id }}
        </span>
        <div class="dropdown-menu dropdown-menu-end fw-bold">

            @can('user_delete')
                <a class="dropdown-item py-2 fw-bold" href="#"
                    wire:click="showDeletedBox('{{ $model->id }}')">
                    <i class="fa fa-trash-o text-danger"></i>
                    {{ __('site.user_index.option.delete') }}
                </a>
            @endcan
        </div>

    </div>
</div>
