<div>
    <div x-data="online">
        <div class="d-none d-md-block">
            <span class="swalMessage d-none">{{ $removeMessage ?? '' }}</span>
            <x-datatable :paginated-data="$paginatedData">
                <x-slot name="navBar">
                    <div class="col-md-6">
                        <span class="badge badge-lg badge-green">
                            <i class="fa spi fa-snowflake-o fa-spin" style="color:aquamarine"></i>
                            {{ __('datatable.users_online_title') }}
                        </span>

                    </div>
                    <div class="col-sm-12 col-md-6">
                        <x-datatable.table-search />
                    </div>
                    @isset($filters)
                        <x-datatable.filters :filters="$filters" :nas="$nas" />
                    @endisset
                    <div class="row">
                        <div class="col">
                            <span class="badge badge-warning">
                                {{ __('site.user_index.statistic.online_total') }}
                                <span class="pe-2 fw-bold">
                                    {{ $onlineCount ?? 0 }}
                                </span>
                            </span>
                            @foreach ($statistic as $key => $data)
                                <span class="badge badge-{{ $data['color'] }}">
                                    <span class="pe-2">
                                        {{ $key }}
                                    </span>
                                    <span class="fw-bold">
                                        {{ $data['value'] }}
                                    </span>
                                </span>
                            @endforeach
                        </div>
                    </div>
                </x-slot>
                <x-slot name="thead">
                    <x-table-thead-user-online :columns="__('datatable.admin_user_online_index')">
                        <th>
                            <span class="ps-5">#</span>
                            <span style="padding-right: 5px;">
                                {{ __('datatable.users_online_key') }}
                            </span>
                        </th>
                    </x-table-thead-user-online>
                </x-slot>
                <x-slot name="tbody">
                    @if ($paginatedData && count($paginatedData) > 0)
                        @foreach ($paginatedData as $index => $model)
                            <tr class="fw-bold bs-3">
                                <td width="190px">
                                    @include('backend.includes.users_online_index_menu')
                                </td>
                                <td class="px-1">
                                    <span dir="auto">
                                        <a href="{{ route('admins.users.edit', $model->id) }}">
                                            @if (
                                                $model->defined_macs !== null &&
                                                    array_key_exists($model->macaddress, $model->defined_macs) &&
                                                    strlen($model->defined_macs[$model->macaddress]) > 0)
                                                <i class="fa fa-laptop text-primary"></i>
                                                <span class="badge badge-green">
                                                    {{ $model->defined_macs[$model->macaddress] }}
                                                </span>
                                            @else
                                                <span class="badge badge-green">
                                                    {{ $model->fullname }}
                                                </span>
                                            @endif
                                        </a>
                                    </span>
                                </td>
                                <td class="no-padding">
                                    <span class="badge badge-info">
                                        {{ Str::substr($model->username, 0, 4) . '***' . Str::substr($model->username, -2) }}
                                    </span>
                                </td>
                                <td class="no-padding">
                                    <span class="badge badge-lightcoral">
                                        {{ $model->macaddress ?? '---' }}
                                    </span>
                                </td>
                                <td class="no-padding">
                                    <a href="{{ route('admins.offers.edit', $model->offer_id) }}">
                                        <span class="badge badge-info">
                                            {{ $model->offer_name ?? '' }}
                                        </span>
                                    </a>
                                </td>
                                <td class="no-padding">
                                    <span class="badge badge-primary fw-bold">
                                        {{ $model->onlineRender()->expiredAt() }}
                                    </span>
                                </td>
                                <td class="px-1 py-0" dir="auto">
                                    <span class="badge badge-success">
                                        {{ $model->onlineRender()->total() }}
                                    </span>
                                </td>
                                <td class="no-padding">
                                    <span class="badge badge-danger">
                                        {{ $model->onlineRender()->uptime() }}
                                    </span>
                                </td>
                                <td class="no-padding">
                                    <span class="badge badge-warning">
                                        {{ $model->city }}
                                    </span>
                                </td>
                                <td class="no-padding">
                                    <span class="badge badge-warning">
                                        {{ $model->framedipaddress ?? '' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <x-datatable.empty-records />
                    @endif
                </x-slot>
                <div>
                </div>
            </x-datatable>
        </div>
        <div>
            @include('backend.admins.users.includes.online.mobile')
        </div>
    </div>
</div>
