<div class="dropup py-0 text-center">
    <span class="dropdown-toggle btn btn-sm btn-primary" @click="setDropdownId('{{ $model->id }}')"
        x-html="dropDownId == {{ $model->id }} ? dropDownButtonHide : dropDownButtonDefault"
        :class="dropDownId == {{ $model->id }} ? 'btn-danger' : 'btn-primary'">
        خيارات<i class="icon ti-settings"></i>
    </span>
    <div class="dropdown-menu dropdown-grid cols-2 fw-bold b-1 border-primary"
        :class="dropDownId == {{ $model->id }} ? 'show' : ''" @click="dropDownId=null">
        @can('user_edit')
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold"
                href="{{ route('admins.users.edit', $model->id) }}">
                <i class="fa fa-pencil"></i>
                <span class="title">
                    {{ __('site.user_index.option.edit') }}
                </span>
            </a>
        @endcan
        @can('user_changeStatus')
            {{-- @if ($model->showEnableButton) --}}
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold" href="#"
                @click="toggleUserStatus('{{ $model->id }}','{{ $model->is_disabled }}')">
                <i class="{{ $model->renderToggleButton()['icon'] }}"></i>
                {{ $model->renderToggleButton()['text'] }}
            </a>
            {{-- @endif --}}
        @endcan
        @can('user_delete')
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold" href="#"
                @click="deleteUser('{{ $model->id }}')">
                <i class="fa fa-trash-o text-danger"></i>
                {{ __('site.user_index.option.delete') }}
            </a>
        @endcan
        @can('user_renewUser')
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold" href="#"
                wire:click="$dispatch('renewUser', { id: '{{ $model->id }}' })">
                <i class="fa spi fa-money"></i>
                {{ __('site.user_index.option.renew') }}
            </a>
        @endcan
        @can('user_changeOffer')
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold" href="#"
                wire:click="$dispatch('ChangeOfferForUser', { id: '{{ $model->id }}' })">
                <i class="fa spi fa-retweet"></i>
                {{ __('site.user_index.option.change_offer') }}
            </a>
        @endcan
        @can('user_addMacs')
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold" href="#"
                wire:click="$dispatch('ShowAndEditUserMacs', { id: '{{ $model->id }}' })">
                <i class="fa fa-barcode"></i>
                {{ __('site.user_index.option.ShowAndEditMacs_title') }}
            </a>
        @endcan
        @can('user_addQuta')
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold" href="#"
                wire:click="$dispatch('userAddQuta', { id: '{{ $model->id }}' })">
                <i class="fa spi fa-pie-chart"></i>
                {{ __('site.user_index.option.add_quta') }}
            </a>
        @endcan
        @can('user_qutaLog')
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold" href="#"
                wire:click="$dispatch('showQutaUsage', { id: '{{ $model->id }}' })">
                <i class="fa fa-cloud-download"></i>
                {{ __('site.user_index.option.show_quta_usage') }}
            </a>
        @endcan
        @can('user_balanceLog')
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold" href="#"
                wire:click="$dispatch('showUserInvoices', { id: '{{ $model->id }}' })">
                <i class="fa fa-cloud-download"></i>
                {{ __('site.user_index.option.show_balanceLog') }}
            </a>
        @endcan
        @can('user_edittingLog')
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold" href="#"
                wire:click="$dispatch('ShowUserLog', { id: '{{ $model->id }}' })">
                <i class="fa fa-cloud-download"></i>
                {{ __('site.user_index.option.show_edittingLog') }}
            </a>
        @endcan
        @can('user_edit')
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold" href="#"
                wire:click="$dispatch('EditUserPanelPassword', { id: '{{ $model->id }}' })">
                <i class="fa fa-info"></i>
                {{ __('site.user_index.option.EditUserPanelPassword') }}
            </a>
        @endcan

        @can('user_edit')
            <a style="min-height: 50px;" class="dropdown-item px-1 py-0 fw-bold fw-bold"
                href="{{ route('admins.users.account.index', $model->id) }}">
                <i class="fa fa-pencil"></i>
                {{ __('site.user_index.option.account') }}
            </a>
        @endcan
    </div>
</div>
