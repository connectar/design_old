<div style="min-width: 140px">
    <div class="dropdown" style="white-space: nowrap;">
        <div class="clearfix pull-left">
            <span class="badge badge-dark">
                @if ($page != 1)
                    {{ $loop->index + 1 + $perPage * ($page - 1) }}
                @else
                    {{ $loop->index + 1 }}
                @endif
            </span>
            <span class="dropdown-toggle px-2 badge badge-info" data-bs-toggle="dropdown">
                {{ $model->fullname }}
            </span>
            <div class="dropdown-menu dropdown-menu-end fw-bold">

                <a class="dropdown-item py-2 fw-bold fw-bold"
                    href="{{ route('cafe_home.users.edit', $model->id) }}">
                    <i class="fa fa-pencil"></i>
                    {{ __('site.user_index.option.edit') }}
                </a>


                <a class="dropdown-item py-2 fw-bold" href="#"
                    @click="toggleUserStatus('{{ $model->id }}','{{ $model->is_disabled }}')">
                    <i class="{{ $model->renderToggleButton()['icon'] }}"></i>
                    {{ $model->renderToggleButton()['text'] }}
                </a>


                <a class="dropdown-item py-2 fw-bold" href="#"
                    @click="deleteUser('{{ $model->id }}')">
                    <i class="fa fa-trash-o text-danger"></i>
                    {{ __('site.user_index.option.delete') }}
                </a>



                <a class="dropdown-item py-2 fw-bold" href="#"
                    wire:click="$dispatch('renewUser', { id: '{{ $model->id }}' })">
                    <i class="fa spi fa-money"></i>
                    {{ __('site.user_index.option.renew') }}
                </a>

                <a class="dropdown-item py-2 fw-bold" href="#"
                    wire:click="$dispatch('ChangeOfferForUser', { id: '{{ $model->id }}' })">
                    <i class="fa spi fa-retweet"></i>
                    {{ __('site.user_index.option.change_offer') }}
                </a>

                <a class="dropdown-item py-2 fw-bold" href="#"
                    wire:click="$dispatch('showQutaUsage', { id: '{{ $model->id }}' })">
                    <i class="fa fa-cloud-download"></i>
                    {{ __('site.user_index.option.show_quta_usage') }}
                </a>

                {{-- <a class="dropdown-item py-2 fw-bold" href="#"
                    wire:click="$dispatch('EditUserPanelPassword', { id: '{{ $model->id }}' })">
                    <i class="fa fa-info"></i>
                    {{ __('site.user_index.option.EditUserPanelPassword') }}
                </a> --}}

            </div>

            <span class="badge fs-16 no-padding">
                @if ($model->is_disabled > 0)
                    <i class="fa fa-lock text-{{ $model->renderIsDisabledColor() }} px-1"></i>
                @endif
                @if ($model->is_active)
                    <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                @else
                    <i class="fa fa-circle text-danger"></i>
                @endif

                @if ($model->renderStatusIsQutaExpired())
                    <i class="fa fa-tachometer text-primary"></i>
                @endif

                @if ($model->renderStatusIsTimeExpired())
                    <i class="fa fa-clock-o text-warning"></i>
                @endif

                @if ($model->renderStatusIsSpeedDown())
                    <i class="fa fa-arrow-down text-warning"></i>
                @endif

            </span>

        </div>
    </div>
</div>
