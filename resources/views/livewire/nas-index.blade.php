<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <x-datatable.add-new :route="route('admins.nas.create')" :title="__('datatable.add_new_nas')" />
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.admin_nas_index')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 20px">
                    {{ __('datatable.nas_name') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr>
                    <td class="py-2">
                        @include('backend.admins.nas.includes.optional_box')
                    </td>
                    <td class="p-0" width="25px">
                        <span class="badge badge-info badge-pill">
                            {{ $model->serial }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <a class="badge badge-primary badge-pill" wire:click="openDevice('{{ $model->id }}')"
                            target="_blank" href="#">
                            {{ $model->ip_address }}
                        </a>
                        <button class="btn btn-success btn-sm" wire:click="openDevice('{{ $model->id }}')">فتح
                            الجهاز</button>
                        {{-- <span class="">
                    {{ $model->ip_address }}
                </span> --}}

                    </td>
                    <td class="no-padding">
                        <button type="button" class="btn btn-info fw-bold btn-rounded btn-sm"
                            wire:click="copyScript('{{ $model->serial }}')">
                            نسخ كود التركيب
                        </button>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-secondary badge-pill">
                            {{ $model->users_count }}
                        </span>
                    </td>
                    <td>
                        @if ($model->online_count)
                            <span class="text-success">
                                <i class="fa spi fa-snowflake-o fa-spin text-success px-1"></i>
                                <span class="badge badge-light">
                                    {{ $model->online_count }}
                                </span>
                            </span>
                        @elseif ($model->is_connected && $model->online_count === 0)
                            <span class="text-success">
                                <i class="fa spi fa-snowflake-o text-light px-1"></i>
                                <span class="badge badge-light">
                                    {{ $model->online_count }}
                                </span>
                            </span>
                        @else
                            <span class="text-danger">
                                <span class="badge badge-dark">
                                    <i class="fa fa-circle text-danger px-1"></i>
                                    لا يوجد متصلين
                                </span>
                            </span>
                        @endif
                    </td>
                    <td class="no-padding">
                        <span class="badge bg-dark text-primary" dir="auto">
                            {{ $model->mikro_version ?? '---' }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span
                            class="badge badge-pill @if ($model->is_connected == 1) badge-success @else badge-danger @endif">
                            {{ __('site.nas_is_connected_' . $model->is_connected) }}
                        </span>
                    </td>

                    <td class="no-padding">
                        <span
                            class="@if ($model->is_installed == 1) text-success
                        @else text-danger @endif">
                            {{ __('site.nas_is_installed_' . $model->is_installed) }}
                        </span>
                    </td>

                    {{-- <td class="no-padding">
                @if ($model->is_connected == 0 && $model->last_connect)
                <span class="">
                    <span class="badge badge-danger">
                    <i class="fa spi fa-snowflake-o fa-spin text-success px-1"></i>
                        {{ $model->last_connect }}
                    </span>
                </span>
                @else
                <span class="">
                    -
                </span>
                @endif
            </td> --}}
                    {{-- <td class="no-padding">
                <span class="text-success">
                    50 Gib
                </span>
            </td> --}}
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records colspan="7" />
        @endif

    </x-slot>
</x-datatable>
@push('scripts')
    <script>
        window.addEventListener("copyScript", (event) => {
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = event.detail.script;
            document.body.appendChild(tempInput);
            tempInput.select();
            try {
                var successful = document.execCommand("copy", false, null);
                if (successful) {
                    Swal.fire(event.detail.alert.success);
                }
            } catch (err) {
                Swal.fire(event.detail.alert.error);
                alert("Oops, unable to copy to clipboard");
            }
        });

        function componentNasOptionalBox() {
            return {
                confirmReinstallOnline(nasId) {
                    let title = "هل أنت متأكد من اعادة تركيب السيستم اونلاين؟";
                    let text = "سيتم اعادة تركيب السيستم مع الحفاظ على البيانات الحالية";
                    confirmWarningAlert(title, text, 'تأكيد').then((result) => {
                        if (result.isConfirmed) {
                            @this.call('reinstallOnline', nasId);
                        }
                    });
                },
            };
        }
    </script>
@endpush
