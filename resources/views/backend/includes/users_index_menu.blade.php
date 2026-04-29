<div style="min-width: 140px">
    <div class="dropdown" style="white-space: nowrap;">
        <div class="clearfix pull-left">
            <span class="h-20 flex-shrink-0 pull-left">
                <input value="{{ $model->id }}" type="checkbox" id="md_checkbox_{{ $model->id }}"
                    class="filled-in chk-col-success checkedId" x-model="selectedModels">
                <label for="md_checkbox_{{ $model->id }}"></label>
            </span>
            <span class="badge badge-dark">
                @if ($page != 1)
                    {{ $loop->index + 1 + $perPage * ($page - 1) }}
                @else
                    {{ $loop->index + 1 }}
                @endif
            </span>
            <span class="user-type dropdown-toggle px-2 badge badge-{{ $model->getConnectionTypeColor() }}"
                data-bs-toggle="dropdown">
                {{ $model->connection_type }}
            </span>
            <div class="dropdown-menu dropdown-menu-end fw-bold">
                @can('user_edit')
                    <a class="dropdown-item py-2 fw-bold fw-bold" href="{{ route('admins.users.edit', $model->id) }}">
                        <i class="fa fa-pencil"></i>
                        {{ __('site.user_index.option.edit') }}
                    </a>
                @endcan
                @can('user_changeStatus')
                    {{-- @if ($model->showEnableButton) --}}
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        @click="toggleUserStatus('{{ $model->id }}','{{ $model->is_disabled }}')">
                        <i class="{{ $model->renderToggleButton()['icon'] }}"></i>
                        {{ $model->renderToggleButton()['text'] }}
                    </a>
                    {{-- @endif --}}
                @endcan
                @can('user_delete')
                    <a class="dropdown-item py-2 fw-bold" href="#" @click="deleteUser('{{ $model->id }}')">
                        <i class="fa fa-trash-o text-danger"></i>
                        {{ __('site.user_index.option.delete') }}
                    </a>
                @endcan
                {{-- @can('user_sendSms')
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item py-2 fw-bold" href="#">
                        <i class="fa spi fa-comments"></i>
                        {{ __('site.user_index.option.send_sms') }}
                    </a>
                @endcan --}}
                @can('user_renewUser')
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('renewUser', { id: '{{ $model->id }}' })">
                        <i class="fa spi fa-money"></i>
                        {{ __('site.user_index.option.renew') }}
                    </a>
                @endcan
                @can('user_changeOffer')
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('ChangeOfferForUser', { id: '{{ $model->id }}' })">
                        <i class="fa spi fa-retweet"></i>
                        {{ __('site.user_index.option.change_offer') }}
                    </a>
                @endcan
                @can('user_addMacs')
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('ShowAndEditUserMacs', { id: '{{ $model->id }}' })">
                        <i class="fa fa-barcode"></i>
                        {{ __('site.user_index.option.ShowAndEditMacs_title') }}
                    </a>
                @endcan
                @can('user_addQuta')
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('userAddQuta', { id: '{{ $model->id }}' })">
                        <i class="fa spi fa-pie-chart"></i>
                        {{ __('site.user_index.option.add_quta') }}
                    </a>
                @endcan
                {{-- @can('user_editExpiredDate')
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('editExpiredDate', { id: '{{ $model->id }}' })">
                        <i class="fa spi fa-calendar"></i>
                        {{ __('site.user_index.option.change_expired_date') }}
                    </a>
                @endcan --}}
                <a class="dropdown-item py-2 fw-bold" href="#"
                    wire:click="$dispatch('sendAdminMessageToUser', { id: '{{ $model->id }}' })">
                    <i class="fa fa-envelope p-0 mx-1 "></i>
                    {{ __('site.user_index.option.send_message') }}
                </a>
                @can('user_qutaLog')
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('showQutaUsage', { id: '{{ $model->id }}' })">
                        <i class="fa fa-cloud-download"></i>
                        {{ __('site.user_index.option.show_quta_usage') }}
                    </a>
                @endcan
                @can('user_balanceLog')
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('showUserInvoices', { id: '{{ $model->id }}' })">
                        <i class="fa fa-cloud-download"></i>
                        {{ __('site.user_index.option.show_balanceLog') }}
                    </a>
                @endcan
                @can('user_edittingLog')
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('ShowUserLog', { id: '{{ $model->id }}' })">
                        <i class="fa fa-cloud-download"></i>
                        {{ __('site.user_index.option.show_edittingLog') }}
                    </a>
                @endcan
                @can('user_edit')
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('EditUserPanelPassword', { id: '{{ $model->id }}' })">
                        <i class="fa fa-info"></i>
                        {{ __('site.user_index.option.EditUserPanelPassword') }}
                    </a>
                @endcan

                @can('user_edit')
                    <a class="dropdown-item py-2 fw-bold fw-bold"
                        href="{{ route('admins.users.account.index', $model->id) }}">
                        <i class="fa fa-pencil"></i>
                        {{ __('site.user_index.option.account') }}
                    </a>
                @endcan
            </div>

            <span class="badge fs-16 no-padding user-get-status">
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
