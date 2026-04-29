<div class="dropdown">
    <div class="clearfix pull-left">
        @if (authIsSuperAdmin())
            <span class="h-20 flex-shrink-0 pull-left">
                <input
                    type="checkbox"
                    id="offer_checkbox_{{ $model->id }}"
                    value="{{ $model->id }}"
                    class="filled-in chk-col-success offer-select-item">
                <label for="offer_checkbox_{{ $model->id }}"></label>
            </span>
        @endif
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
            @can('offer_edit')
                <a class="dropdown-item py-2 fw-bold fw-bold"
                    href="{{ route('admins.offers.edit', $model->id) }}">
                    <i class="fa fa-pencil"></i>
                    {{ __('site.user_index.option.edit') }}
                </a>
            @endcan
            @can('offer_delete')
                <a class="dropdown-item py-2 fw-bold" href="#"
                    wire:click="showDeletedBox('{{ $model->id }}')">
                    <i class="fa fa-trash-o text-danger"></i>
                    {{ __('site.user_index.option.delete') }}
                </a>
            @endcan
        </div>
    </div>
</div>
