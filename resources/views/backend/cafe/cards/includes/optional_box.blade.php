<div class="dropdown">
    <div class="clearfix pull-left">
        <span
            class="badge badge-dark b-1 @if ($model->cards_count > 0) border-success
        @else border-warning @endif">
            {{ $loop->index + 1 }}
        </span>
        <span
            class="dropdown-toggle badge @if ($model->cards_count > 0) badge-success
        @else badge-warning @endif badge-pill"
            data-bs-toggle="dropdown">
            <span dir="auto">
                {{ $model->key . ' - ' . ($loop->index + 1) }}
            </span>
        </span>


        <div class="dropdown-menu dropdown-menu-end fw-bold">

            <a class="dropdown-item py-2 fw-bold" href="#"
                wire:click="showDeletedBox('{{ $model->id }}')">
                <i class="fa fa-trash-o text-danger"></i>
                {{ __('site.user_index.option.delete') }}
            </a>

            <div class="divir"></div>
            <a class="dropdown-item py-2 fw-bold" href="#"
                wire:click="$dispatch('exportAsPdf','{{ $model->id }}')">
                <i class="fa fa-print text-success"></i>
                {{ __('site.card_groups_index.print') }}
            </a>

            {{-- <a class="dropdown-item py-2 fw-bold" href="#" wire:click="export('{{ $model->id }}')">
                <i class="fa fa-cloud-download text-white"></i>
                <span>
                    {{ __('site.card_groups_index.download') }}
                </span>
                <span class="badge badge-success">
                    {{ __('site.card_groups_index.excel') }}
                </span>
            </a> --}}
            <a class="dropdown-item py-2 fw-bold" href="#"
                wire:click="downladAsTxt('{{ $model->id }}')">
                <i class="fa fa-cloud-download text-white"></i>
                <span>
                    {{ __('site.card_groups_index.download') }}
                </span>
                <span class="badge badge-success">
                    {{ __('site.card_groups_index.txt') }}
                </span>
            </a>

        </div>
    </div>
</div>
