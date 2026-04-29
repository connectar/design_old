<div class="d-noned-sm-block">
    <x-datatable :paginated-data="$paginatedData">
        <x-slot name="navBar">
            <x-datatable.add-new :route="route('cafe_home.users.create')" :title="__('datatable.add_new_user')" />
            <div class="col-sm-12 col-md-6">
                <x-datatable.table-search />
            </div>
            <div class="row">
                <div class="col">
                    <div class="btn-group" role="group">

                        <div class="mx-2">
                            <span>
                                <i class="fa fa-clock-o text-warning"></i>
                                {{ __('site.user_index.statistic.expired') }}
                            </span>
                        </div>
                        <div class="mx-2">
                            <span>
                                <i class="fa fa-tachometer text-primary "></i>
                                {{ __('site.user_index.statistic.quta_expired') }}
                            </span>
                        </div>
                        <div class="mx-2">
                            <span>
                                <i class="fa fa-lock text-danger "></i>
                                {{ __('site.user_index.statistic.stopped') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
        <x-slot name="thead">
            <th>
                <span class="badge" wire:click="orderBy('fullname')">
                    <span class="ps-5">#</span>
                    <span style="padding-right: -10px">
                        اسم المشترك
                    </span>
                </span>
                @if ($orderByColumn == 'fullname')
                    <span>
                        <i class="fa {{ $sortIcon }} text-primary"></i>
                    </span>
                @endif
            </th>

            @foreach ($tableColumns as $column)
                @if ($column != 'fullname')
                    <th wire:click="orderBy('{{ $column }}')" class="text-center">
                        <span class="badge">
                            {{ __('datatable.cafe_user_index.' . $column) }}
                        </span>
                        @if ($column == $orderByColumn)
                            <span>
                                <i class="fa {{ $sortIcon }} text-primary"></i>
                            </span>
                        @endif
                    </th>
                @endif
            @endforeach
        </x-slot>

        <x-slot name="tbody">
            @if ($paginatedData && count($paginatedData) > 0)
                @foreach ($paginatedData as $index => $model)
                    <tr class="fw-bold">
                        <td class="w-auto">
                            @include('backend.includes.cafe_users_index_menu')
                        </td>
                        @foreach ($tableColumns as $key)
                            @switch($key)
                                @case('username')
                                    <td class="no-padding" dir="auto">
                                        {{ $model->username }}
                                    </td>
                                @break

                                @case('shared_users')
                                    <td class="no-padding">
                                        <a href="{{ route('admins.offers.edit', $model->offer_id) }}">
                                            <span class="badge text-primary bg-dark fs-15 fw-bold">
                                                {{ $model->shared_users }}
                                            </span>
                                        </a>
                                    </td>
                                @break

                                @case('is_active')
                                    <td class="no-padding">
                                        @if ($model->is_active)
                                            <i class="fa spi fa-snowflake-o fa-spin text-success"></i>
                                            <span class="text-white px-1">
                                                {{ $model->is_active }}
                                            </span>
                                        @else
                                            <i class="fa fa-circle text-danger"></i>
                                        @endif

                                    </td>
                                @break

                                @case('usage_quta')
                                    <td class="px-1 py-0">
                                        <x-quta-progress-render :quta-info="$model->getQutaInfo()" />
                                    </td>
                                @break

                                @case('expired_at')
                                    <td class="no-padding">
                                        <span
                                            class="badge badge-{{ $model->statusClass }} badge-pill fw-bold">
                                            {{ $model->expiredDate }}
                                        </span>
                                    </td>
                                @break

                                @case('offer_name')
                                    <td class="no-padding">
                                        <a href="{{ route('admins.offers.edit', $model->offer_id) }}">
                                            <span class="badge badge-info badge-pill">
                                                {{ $model->offer_name }}
                                            </span>
                                        </a>
                                    </td>
                                @break
                            @endswitch
                        @endforeach

                    </tr>
                @endforeach
            @else
                <x-datatable.empty-records />
            @endif
        </x-slot>
    </x-datatable>
</div>
