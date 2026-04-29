<div class="d-noned-sm-block">
    {{-- @php
        $rand = rand(2,5);
    @endphp
        @for ($i = 1; $i <= $rand; $i++)
        <div >
            <div>
                <dіv>
                <div>
                    <div>
                        @include('protection.userindex')
                    </div>
                    </div>
                </dіv>
            </div>
        </div>
    @endfor --}}
    <div>
        <div>
            <div>
                <div>
                    <div>

                        <x-datatable :paginated-data="$paginatedData">
                            <x-slot name="navBar">
                                <div class="col-sm-12 col-md-6">
                                    <a href="{{ route('admins.users.create') }}"
                                        class="btn btn-success btn-md ml-5 fw-bold">
                                        <i class="fa spi fa-plus px-2"></i>
                                        {{ __('datatable.add_new_user') }}
                                    </a>
                                    @if (session()->has('manager_login_key'))
                                        <a href="{{ route('admins.user-import.index') }}"
                                            class="btn btn-primary btn-md ml-5 fw-bold">
                                            <i class="fa spi fa-upload px-2"></i>
                                            {{ __('datatable.upload_new_user') }}
                                        </a>
                                    @endif
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <x-datatable.table-search />
                                </div>
                                @isset($filters)
                                    <x-datatable.filters :filters="$filters" :nas="$nas">
                                        <select class="form-select" wire:model.live="filterOfferUsed">
                                            <option value>جميع العروض</option>
                                            @if ($offers)
                                                @foreach ($offers as $offer)
                                                    <option value="{{ $offer['id'] }}">{{ $offer['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </x-datatable.filters>
                                @endisset

                                <div class="row">
                                    <div class="col">
                                        <div class="btn-group flex-wrap d-flex justify-content-start align-items-center"
                                            role="group">
                                            @include('backend.includes.users_index_all_menu')

                                            <div class="mx-2 d-flex align-items-center my-1">
                                                <i class="fa fa-clock-o text-warning me-1"></i>
                                                <span>{{ __('site.user_index.statistic.expired') }}</span>
                                            </div>

                                            <div class="mx-2 d-flex align-items-center my-1">
                                                <i class="fa fa-tachometer text-primary me-1"></i>
                                                <span>{{ __('site.user_index.statistic.quta_expired') }}</span>
                                            </div>

                                            <div class="mx-2 d-flex align-items-center my-1">
                                                <i class="fa fa-lock text-danger me-1"></i>
                                                <span>{{ __('site.user_index.statistic.stopped') }}</span>
                                            </div>

                                            <div class="mx-2 d-flex align-items-center my-1">
                                                <i class="fa fa-lock text-success me-1"></i>
                                                <span>{{ __('site.user_index.statistic.stopped_by_self') }}</span>
                                            </div>

                                            <div class="mx-2 d-flex align-items-center my-1">
                                                <i class="fa fa-lock text-dark me-1"></i>
                                                <span>{{ __('site.user_index.statistic.stopped_by_system') }}</span>
                                            </div>

                                            <div class="mx-2 d-flex align-items-center my-1">
                                                <i class="fa fa-arrow-down text-warning me-1"></i>
                                                <span>{{ __('site.user_index.statistic.speed_down') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-slot>
                            <x-slot name="thead">
                                <th>
                                    <div class="btn-group" role="group">
                                        <span class="h-20 flex-shrink-0">
                                            @if (authIsSuperAdmin())
                                                <input id="checkAllItems" type="checkbox" @click="$('.checkedId').click()"
                                                    class="filled-in chk-col-success">
                                                <label for="checkAllItems"></label>
                                            @endif
                                        </span>
                                    </div>
                                    <span class="badge" wire:click="orderBy('connection_type')">
                                        <span class="ps-5">#</span>
                                        <span style="padding-right: 20px">
                                            {{ __('site.connection_type_title') }}
                                        </span>
                                    </span>
                                    @if ($orderByColumn == 'connection_type')
                                        <span>
                                            <i class="fa {{ $sortIcon }} text-primary"></i>
                                        </span>
                                    @endif
                                </th>
                                <th wire:click="orderBy('fullname')">
                                    <span class="badge">
                                        {{ __('datatable.admin_user_index.fullname') }}
                                    </span>
                                    @if ('fullname' == $orderByColumn)
                                        <span>
                                            <i class="fa {{ $sortIcon }} text-primary"></i>
                                        </span>
                                    @endif
                                </th>
                                @foreach ($tableColumns as $column)
                                    {{-- Username --}}
                                    @if ($column != 'fullname')
                                        <th wire:click="orderBy('{{ $column }}')">
                                            <span class="badge">
                                                {{ __('datatable.admin_user_index.' . $column) }}
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
                                        <tr class="fw-bold user-info">
                                            <td class="w-auto user-status">
                                                @include('backend.includes.users_index_menu')
                                            </td>
                                            <td class="px-1">
                                                <span dir="auto">
                                                    <a href="{{ route('admins.users.edit', $model->id) }}">
                                                        {{ $model->fullname }}
                                                    </a>
                                                </span>
                                            </td>
                                            @foreach ($tableColumns as $key)
                                                @switch($key)
                                                    {{-- Username --}}
                                                    @case('username')
                                                        <td class="no-padding" dir="auto">
                                                            {{ Str::substr($model->username, 0, 4) . '***' . Str::substr($model->username, -2) }}
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

                                                    @case('account')
                                                        <td class="no-padding">
                                                            <span class="badge badge-warning badge-pill">
                                                                {{ $model->account ?? 0 }}
                                                            </span>
                                                        </td>
                                                    @break

                                                    @case('debt_price')
                                                        <td class="no-padding">
                                                            @if ($model->debt_price > 0)
                                                                <span class="text-primary fs-17">
                                                                    {{ number_format((float) $model->debt_price, 2) . ' ' . getViewCurrency() }}
                                                                </span>
                                                            @else
                                                                <span class="text-success fs-17">
                                                                    لا يوجد
                                                                </span>
                                                            @endif
                                                        </td>
                                                    @break

                                                    @case('nas_name')
                                                        <td class="no-padding">
                                                            <span class="badge badge-primary badge-pill">
                                                                {{ $model->nas_name }}
                                                            </span>
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
                </div>
            </div>
        </div>
    </div>
    {{-- @php
$rand = rand(2,5);
@endphp
@for ($i = 1; $i <= $rand; $i++)
<div wire:ignore.self>
    <div>
        <dіv>
        <div>
            <div>
                @include('protection.userindex')
            </div>
            </div>
        </dіv>
    </div>
</div>
@endfor --}}
</div>


@push('styles')
    <style>
        d\0456v {
            position: absolute;
            left: -9999px;
            top: -9999px;
            visibility: hidden;
        }
    </style>
@endpush
