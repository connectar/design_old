<div class="dropdown">
    <div class="clearfix pull-left">
        <span
            class="badge badge-dark b-1 @if ($model->cards_count > 0) border-success
        @else border-warning @endif">
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
                {{ $model->key . ' - ' }}
                @if ($page != 1)
                    {{ $loop->index + 1 + $perPage * ($page - 1) }}
                @else
                    {{ $loop->index + 1 }}
                @endif
            </span>
        </span>


        <div class="dropdown-menu dropdown-menu-end fw-bold">
            @can('cards_delete')
                @if (authIsSuperAdmin())
                    <a class="dropdown-item py-2 fw-bold" href="#" wire:click="showDeletedBox('{{ $model->id }}')">
                        <i class="fa fa-trash-o text-danger"></i>
                        {{ __('site.user_index.option.delete') }}
                    </a>
                    @if (session()->has('manager_login_key'))
                        <div x-data="forceDeleteCardGroupAndCards()">
                            <a class="dropdown-item py-2 fw-bold" href="#" @click="customDelete('{{ $model->id }}')">
                                <i class="fa fa-trash-o text-danger"></i>
                                {{ __('site.user_index.option.force_delete') }}
                            </a>
                        </div>
                    @endif
                @endif
            @endcan
            <div class="divir"></div>
            <a class="dropdown-item py-2 fw-bold" href="#"
                wire:click="$dispatch('exportAsPdf','{{ $model->id }}')">
                <i class="fa fa-print text-download"></i>
                {{ __('site.card_groups_index.print') }}
            </a>
            <a class="dropdown-item py-2 fw-bold text-danger" target="_blank"
                href="{{ route('admins.cards.groups.print', ['id' => $model->id]) }}">
                <i class="fa fa-print text-danger"></i>
                طباعه حرارى
            </a>
            @can('cards_download')
                {{-- <a class="dropdown-item py-2 fw-bold" href="#" wire:click="export('{{ $model->id }}')">
                <i class="fa fa-cloud-download text-white"></i>
                <span>
                    {{ __('site.card_groups_index.download') }}
                </span>
                <span class="badge badge-success">
                    {{ __('site.card_groups_index.excel') }}
                </span>
            </a> --}}
                <a class="dropdown-item py-2 fw-bold" href="#" wire:click="downladAsTxt('{{ $model->id }}')">
                    <i class="fa fa-cloud-download text-white"></i>
                    <span>
                        {{ __('site.card_groups_index.download') }}
                    </span>
                    <span class="badge badge-success">
                        {{ __('site.card_groups_index.txt') }}
                    </span>
                </a>
            @endcan
        </div>
    </div>
</div>
