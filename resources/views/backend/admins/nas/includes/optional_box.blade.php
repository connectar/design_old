<div class="dropdown">
    <div class="clearfix pull-left">
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

        <div class="dropdown-menu dropdown-menu-end fw-bold" x-data="componentNasOptionalBox()">
            @can('nas_edit')
                <a class="dropdown-item py-2 fw-bold fw-bold" href="{{ route('admins.nas.edit', $model->id) }}">
                    <i class="fa fa-pencil"></i>
                    {{ __('site.user_index.option.edit') }}
                </a>
            @endcan
            @can('nas_delete')
                <a class="dropdown-item py-2 fw-bold" href="#" wire:click="showDeletedBox('{{ $model->id }}')">
                    <i class="fa fa-trash-o text-danger"></i>
                    {{ __('site.user_index.option.delete') }}
                </a>
            @endcan
            @can('nas_reinstall')
                <a class="dropdown-item py-2 fw-bold" href="{{ route('admins.nas.show', $model->serial) }}">
                    <i class="fa fa-plus text-info"></i>
                    {{ __('site.nas_index.option.install') }}
                </a>
                <a class="dropdown-item py-2 fw-bold" @click="confirmReinstallOnline('{{ $model->id }}')">
                    <i class="fa fa-plus text-info"></i>
                    {{ __('site.nas_index.option.install_online') }}
                </a>
                <a class="dropdown-item py-2 fw-bold" href="#" wire:click="openDevice('{{ $model->id }}')">
                    <i class="fa fa-eye text-success"></i>
                    {{ __('site.devices_index.show_device') }}
                </a>
            @endcan
            @can('nas_edit')
                <a class="dropdown-item py-2 fw-bold fw-bold" href="#"
                    wire:click="$dispatch('editAdminPassword','{{ $model->id }}')">
                    <i class="fa fa-pencil"></i>
                    {{ __('site.nas_index.option.editUserAdmin') }}
                </a>
            @endcan

            @can('nas_reboot')
                <div class="dropdown-divider"></div>
                <a class="dropdown-item py-2 fw-bold text-primary" href="#"
                    wire:click="reboot('{{ $model->id }}')">
                    <i class="fa fa-refresh text-primary"></i>
                    {{ __('site.nas_index.option.reboot') }}
                </a>
            @endcan
        </div>
    </div>
</div>
