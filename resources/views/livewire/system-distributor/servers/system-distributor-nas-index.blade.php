<x-datatable :paginated-data="$paginatedData">

    <x-slot name="navBar">
        <div class="col-md-6">
            <span class="btn btn-sm btn-warning">
                {{ __('datatable.servers_title') }}
            </span>
        </div>
        <div class="col-sm-12 col-md-6">
            <x-datatable.table-search />
        </div>
    </x-slot>

    <x-slot name="thead">
        <x-table-thead :columns="__('datatable.manager_nas_index')">
            <th>
                <span class="ps-5">#</span>
                <span style="padding-right: 20px">
                    {{ __('datatable.manager_nas_name') }}
                </span>
            </th>
        </x-table-thead>
    </x-slot>

    <x-slot name="tbody">
        @if ($paginatedData && count($paginatedData) > 0)
            @foreach ($paginatedData as $index => $model)
                <tr>
                    <td class="py-2">
                        <div class="dropdown">
                            <div class="clearfix pull-left">
                                <span class="badge badge-dark b-1 border-warning">
                                    @if (($page ?? 1) != 1)
                                        {{ $loop->index + 1 + $perPage * (($page ?? 1) - 1) }}
                                    @else
                                        {{ $loop->index + 1 }}
                                    @endif
                                </span>
                                <span class="dropdown-toggle badge badge-warning" data-bs-toggle="dropdown">
                                    <span dir="auto">
                                        {{ $model->nas_name }}
                                    </span>
                                </span>
                                <div class="dropdown-menu dropdown-menu-end fw-bold">
                                    <a class="dropdown-item py-2 fw-bold fw-bold text-primary"
                                        wire:click="loginAsAdmin('{{ $model->admin_id }}')">
                                        <i class="fa fa-hand-lizard-o"></i>
                                        {{ __('site.manager_nas.login') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="p-0" width="25px">
                        <span class="badge text-primary">
                            {{ $model->fullname }}
                        </span>
                    </td>
                    <td class="p-0" width="25px">
                        <span class="badge badge-info">
                            {{ $model->serial }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <a class="badge" target="_blank" href="{{ 'http://' . $model->ip_address }}">
                            {{ $model->ip_address }}
                        </a>
                        <button class="btn btn-sm btn-danger"
                            onclick="copyNasIp('{{ $model->ip_address }}')">نسخ</button>
                    </td>
                    <td class="no-padding">
                        <div x-data="{ showPassword: false }">
                            <span x-show="showPassword" class="badge badge-danger px-2" style="display: none;">
                                {{ $model->is_pass_changed ? $model->api_password : \App\Models\Nas::getApiPassword() }}
                            </span>
                            <button @click="showPassword = !showPassword" class="badge btn-danger">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </td>
                    <td class="no-padding">
                        <button type="button" class="btn btn-info fw-bold btn-rounded btn-sm"
                            wire:click="copyScript('{{ $model->serial }}')">
                            نسخ كود التركيب
                        </button>
                    </td>
                    <td class="no-padding">
                        <span class="badge bg-dark text-primary" dir="auto">
                            {{ $model->mikro_version ?? '---' }}
                        </span>
                    </td>
                    <td class="no-padding">
                        <span class="badge badge-success">
                            {{-- {{ $model->users_count }} --}}
                            {{ $model->users_count + $model->cards_count }}
                        </span>
                    </td>
                    <td class="no-padding">
                        @if ($model->online_count > 0)
                            <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                        @else
                            <i class="fa fa-circle text-danger"></i>
                        @endif
                        <span class="badge badge-secondary">
                            {{ $model->online_count }}

                        </span>
                    </td>
                    <td class="no-padding">
                        <span
                            class="badge badge-pill @if ($model->is_connected == 1) badge-success @else badge-danger @endif">
                            {{ __('site.nas_is_connected_' . $model->is_connected) }}
                        </span>
                    </td>

                    {{-- <td class="no-padding">
                        <span
                            class="@if ($model->is_installed == 1) text-success
                        @else text-danger @endif">
                            {{ __('site.nas_is_installed_' . $model->is_installed) }}
                        </span>
                    </td> --}}
                </tr>
            @endforeach
        @else
            <x-datatable.empty-records />
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
    </script>
@endpush
