{{-- عناصر خيارات المشترك — قائمة منسدلة (مطابقة سلوك connect_old + Livewire 4 $dispatch) --}}
@can('user_edit')
    <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="{{ route('admins.users.edit', $model->id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
        {{ __('site.user_index.option.edit') }}
    </a>
@endcan
@can('user_changeStatus')
    <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="#"
        @click="toggleUserStatus('{{ $model->id }}','{{ $model->is_disabled }}')">
        <i class="{{ $model->renderToggleButton()['icon'] }}" aria-hidden="true"></i>
        {{ $model->renderToggleButton()['text'] }}
    </a>
@endcan
@can('user_delete')
    @if (authIsSuperAdmin())
        <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="#" @click="deleteUser('{{ $model->id }}')">
            <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
            {{ __('site.user_index.option.delete') }}
        </a>
    @endif
@endcan
@can('user_renewUser')
    <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="#"
        wire:click.prevent="$dispatch('renewUser', { userId: {{ (int) $model->id }} })">
        <i class="fa spi fa-money" aria-hidden="true"></i>
        {{ __('site.user_index.option.renew') }}
    </a>
@endcan
@can('user_changeOffer')
    <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="#"
        wire:click.prevent="$dispatch('ChangeOfferForUser', { userId: {{ (int) $model->id }} })">
        <i class="fa spi fa-retweet" aria-hidden="true"></i>
        {{ __('site.user_index.option.change_offer') }}
    </a>
@endcan
@can('user_addMacs')
    <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="#"
        wire:click.prevent="$dispatch('ShowAndEditUserMacs', { modelId: {{ (int) $model->id }} })">
        <i class="fa fa-barcode" aria-hidden="true"></i>
        {{ __('site.user_index.option.ShowAndEditMacs_title') }}
    </a>
@endcan
@can('user_addQuta')
    <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="#"
        wire:click.prevent="$dispatch('userAddQuta', { userId: {{ (int) $model->id }} })">
        <i class="fa spi fa-pie-chart" aria-hidden="true"></i>
        {{ __('site.user_index.option.add_quta') }}
    </a>
@endcan
<a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="#"
    wire:click.prevent="$dispatch('sendAdminMessageToUser', { userId: {{ (int) $model->id }} })">
    <i class="fa fa-envelope p-0 mx-1" aria-hidden="true"></i>
    {{ __('site.user_index.option.send_message') }}
</a>
@can('user_qutaLog')
    <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="#"
        wire:click.prevent="$dispatch('showQutaUsage', { userId: {{ (int) $model->id }} })">
        <i class="fa fa-cloud-download" aria-hidden="true"></i>
        {{ __('site.user_index.option.show_quta_usage') }}
    </a>
@endcan
@can('user_balanceLog')
    <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="#"
        wire:click.prevent="$dispatch('showUserInvoices', { userId: {{ (int) $model->id }} })">
        <i class="fa fa-cloud-download" aria-hidden="true"></i>
        {{ __('site.user_index.option.show_balanceLog') }}
    </a>
@endcan
@can('user_edittingLog')
    <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="#"
        wire:click.prevent="$dispatch('ShowUserLog', { userId: {{ (int) $model->id }} })">
        <i class="fa fa-cloud-download" aria-hidden="true"></i>
        {{ __('site.user_index.option.show_edittingLog') }}
    </a>
@endcan
@can('user_edit')
    <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2" href="#"
        wire:click.prevent="$dispatch('EditUserPanelPassword', { userId: {{ (int) $model->id }} })">
        <i class="fa fa-info" aria-hidden="true"></i>
        {{ __('site.user_index.option.EditUserPanelPassword') }}
    </a>
@endcan
@can('user_edit')
    <a class="dropdown-item py-2 fw-bold d-flex align-items-center gap-2"
        href="{{ route('admins.users.account.index', $model->id) }}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
        {{ __('site.user_index.option.account') }}
    </a>
@endcan
