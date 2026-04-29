<div class="dropdown" style="white-space: nowrap;" wire:ignore>
    <div class="clearfix pull-left">
        <button class="px-2 btn btn-info btn-xs" x-on:click="showModalOptions('options')">
            <i class="icon ti-settings"></i>
            {{ __('site.user_index.option.menu_all') }}
        </button>
        <a class="btn btn-xs btn-primary" href="#" wire:click="$dispatch('editViewColumns', { id: '' })"
            data-bs-dismiss="modal">
            <i class="fa fa-exchange"></i>
            ترتيب الاعمدة
        </a>
        {{-- <div class="dropdown-menu dropdown-menu-end fw-bold">

            @can('user_delete')
                <a class="dropdown-item py-2 fw-bold" href="#" @click="doAction('deleteAll')">
                    <i class="fa fa-trash-o text-danger"></i>
                    {{ __('site.user_index.option.delete') }}
                </a>
            @endcan

            @can('user_renewUser')
                <a class="renewCollectionOfUsers dropdown-item py-2 fw-bold" href="#">
                    <i class="fa spi fa-money"></i>
                    {{ __('site.user_index.option.renew') }}
                </a>
            @endcan

            @can('user_editExpiredDate')
                <a class="editExpiredDateForCollection dropdown-item py-2 fw-bold" href="#">
                    <i class="fa spi fa-calendar"></i>
                    {{ __('site.user_index.option.change_expired_date') }}
                </a>
            @endcan
            <a class="editQutaForCollection dropdown-item py-2 fw-bold" href="#">
                <i class="fa spi fa-cloud-download"></i>
                {{ __('site.user_index.option.change_quta') }}
            </a>
            @can('user_changeStatus')
                <div class="dropdown-divider"></div>
                <a class="moveToNas dropdown-item py-2 fw-bold text-primary" href="#"
                    data-status="0">
                    <i class="fa fa-rocket"></i>
                    {{ __('site.user_index.option.move_to_nas') }}
                </a>
                <a class="toggleStatusForCollection dropdown-item py-2 fw-bold text-success"
                    href="#" data-status="0">
                    <i class="fa fa-check"></i>
                    {{ __('site.user_index.option.enabled_all') }}
                </a>
                <a class="toggleStatusForCollection dropdown-item py-2 fw-bold text-danger"
                    href="#" data-status="1">
                    <i class="fa fa-lock"></i>
                    {{ __('site.user_index.option.disabled_all') }}
                </a>
            @endcan
            <a class="dropdown-item py-2 fw-bold" href="#"
                wire:click="$dispatch('editViewColumns', { id: '' })">
                <i class="fa  fa-exchange text-primary"></i>
                اظهار وترتيب الاعمدة
            </a>
        </div> --}}
    </div>
</div>
