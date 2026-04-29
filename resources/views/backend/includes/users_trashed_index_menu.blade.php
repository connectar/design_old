<div class="dropdown" style="white-space: nowrap;">
    <div class="clearfix pull-left">
        @if (session()->has('manager_login_key'))
        <span class="h-20 flex-shrink-0 pull-left">
            <input
                type="checkbox"
                id="md_checkbox_{{ $model->id }}"
                value="{{ $model->id }}"
                class="filled-in chk-col-success deleted_users_table_checkbox"
                x-model="multiselect">
            <label for="md_checkbox_{{ $model->id }}"></label>
        </span>
        @endif
        <span class="badge badge-dark">
            @if ($page != 1)
                {{ $loop->index + 1 + $perPage * ($page - 1) }}
            @else
                {{ $loop->index + 1 }}
            @endif
        </span>
        <span class="dropdown-toggle px-2 badge badge-{{ $model->getConnectionTypeColor() }}" data-bs-toggle="dropdown">
            {{ $model->connection_type }}
        </span>
        <div class="dropdown-menu dropdown-menu-end fw-bold">

            <a class="dropdown-item py-2 fw-bold fw-bold" wire:click="restore('{{ $model->id }}')">
                <i class="fa fa-pencil"></i>
                {{ __('site.user_index.option.restore') }}
            </a>
        </div>
    </div>
</div>
