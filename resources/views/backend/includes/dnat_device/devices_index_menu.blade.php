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
            <div x-data="DeviceDropdownComponent()" class="dropdown-menu dropdown-menu-end fw-bold">
                    {{-- <a class="dropdown-item py-2 fw-bold fw-bold"
                        href="{{ route('admins.users.edit', $model->id) }}">
                        <i class="fa fa-pencil"></i>
                        {{ __('site.user_index.option.edit') }}
                    </a> --}}
                    {{-- <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('showDevice', { id: '{{ $model->id }}' })">
                        <i class="fa fa-eye text-success"></i>
                        {{ __('site.devices_index.show_device') }}
                    </a> --}}
                    <a class="dropdown-item py-2 fw-bold" href="#"  @click="openDevice('{{  $model->id }}')">
                        <i class="fa fa-eye text-success"></i>
                        {{ __('site.devices_index.show_device') }}
                    </a>
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="$dispatch('updateDevice', { id: '{{ $model->id }}' })">
                        <i class="fa fa-pencil text-primary"></i>
                        {{ __('site.devices_index.update_device') }}
                    </a>
                    <a class="dropdown-item py-2 fw-bold" href="#"
                        wire:click="showDeletedBox('{{ $model->id }}')">
                        <i class="fa fa-trash-o text-danger"></i>
                        {{ __('site.user_index.option.delete') }}
                    </a>
            </div>


        </div>
    </div>
</div>
@push('scripts')
    <script>
        function DeviceDropdownComponent() {
            return {
                openDevice(deviceId) {
                    Livewire.dispatch('openDevice', deviceId);

                    const loadingDivs = document.querySelectorAll('.datatable-blur');
                    loadingDivs.forEach(div => {
                        div.style.visibility = 'hidden'; // hide x-datatable-loading component
                    });

                    var content = '<h4 class="text-lg-center text-primary py-2" >جاري الاتصال بالسيرفر وتجهيز الرولات</h4><span class="spinner-border text-success my-2"></span>';
                    Swal.fire({
                        html: content,
                        showCancelButton: false,
                        showConfirmButton: false,
                        focusConfirm: false,
                        allowOutsideClick: false,
                        background: "#0c1b32"
                    });
                }
            }
        }
    </script>
@endpush
