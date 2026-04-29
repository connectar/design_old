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
            <span class="dropdown-toggle px-2 badge badge-success" data-bs-toggle="dropdown">
                {{ $model->name }}
            </span>
            <div class="dropdown-menu dropdown-menu-end fw-bold">
                @can('user_edit')
                    {{-- <a class="dropdown-item py-2 fw-bold fw-bold"
                        href="{{ route('admins.users.edit', $model->id) }}">
                        <i class="fa fa-pencil"></i>
                        {{ __('site.user_index.option.edit') }}
                    </a> --}}
                @endcan
                @can('user_delete')
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="showDeletedBox('{{ $model->id }}')">
                        <i class="fa fa-trash-o text-danger"></i>
                        {{ __('site.user_index.option.delete') }}
                    </a>
                @endcan
                @can('user_delete')
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('showDevice', { id: '{{ $model->id }}' })">
                        <i class="fa fa-eye text-success"></i>
                        {{ __('site.devices_index.show_device') }}
                    </a>
                @endcan
            </div>


        </div>
    </div>
</div>
