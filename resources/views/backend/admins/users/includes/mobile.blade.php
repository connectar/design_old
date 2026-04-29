<div class="d-block d-md-none">
    <div class="px-2 py-0">
        <x-datatable.loading />
        <div class="serach_box_overlay">
            <input type="search" class="form-control form-control-md bg-lightest text-black"
                wire:model.live.debounce.500ms="search" placeholder="ابحث" dir="auto">
        </div>
        @foreach ($paginatedData as $index => $model)
            <div class="box box-bordered" :class="setCardBorder('{{ $model->id }}')">
                <div class="box-header py-1 px-2">
                    @include('backend.includes.users_mobile_index_menu')
                </div>
                <div class="box-body py-1 px-2">
                    @if (in_array('usage_quta', $tableColumns))
                        <div class="row">
                            <div class="offset-4 col-4 bg-dark text-center"
                                style="border-radius: 10px;">
                                <x-quta-progress-render :quta-info="$model->getQutaInfo()" />
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        @foreach ($tableColumns as $key)
                            @if ($key != 'usage_quta')
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label class="form-label">
                                            {{ __('datatable.admin_user_index.' . $key) }}
                                        </label>
                                        <div>
                                            <span class="badge badge-dark text-primary d-block"
                                                dir="auto">
                                                @switch($key)
                                                    @case('username')
                                                        {{ $model->username }}
                                                        <i class="fa fa-clock-o"></i>
                                                    @break

                                                    @case('shared_users')
                                                        <a
                                                            href="{{ route('admins.offers.edit', $model->offer_id) }}">
                                                            <span
                                                                class="badge badge-dark text-primary bg-dark fs-15 fw-bold">
                                                                {{ $model->shared_users }}
                                                            </span>
                                                        </a>
                                                    @break

                                                    @case('is_active')
                                                        @if ($model->is_active)
                                                            <i
                                                                class="fa spi fa-snowflake-o fa-spin text-success"></i>
                                                            <span class="text-white px-1">
                                                                {{ $model->is_active }}
                                                            </span>
                                                        @else
                                                            <i class="fa fa-circle text-danger"></i>
                                                        @endif
                                                    @break

                                                    @case('expired_at')
                                                        <span
                                                            class="badge badge-dark badge-{{ $model->statusClass }} badge-pill fw-bold">
                                                            {{ $model->expiredDate }}
                                                        </span>
                                                    @break

                                                    @case('offer_name')
                                                        <a
                                                            href="{{ route('admins.offers.edit', $model->offer_id) }}">
                                                            <span class="text-primary">
                                                                {{ $model->offer_name }}
                                                            </span>
                                                        </a>
                                                    @break

                                                    @case('account')
                                                        <span class="text-primary">
                                                            @if ($model->account == 0)
                                                                لا يوجد
                                                            @else
                                                                {{ $model->account . ' جنيه' }}
                                                            @endif
                                                        </span>
                                                    @break

                                                    @case('debt_price')
                                                        @if ($model->debt_price > 0)
                                                            <span class="text-primary fs-17">
                                                                {{ number_format((float) $model->debt_price, 2) . ' ' . __('site.currncy.ar') }}
                                                            </span>
                                                        @else
                                                            <span class="text-primary fs-17">
                                                                لا يوجد
                                                            </span>
                                                        @endif
                                                    @break

                                                    @case('nas_name')
                                                        <span class="text-primary">
                                                            {{ $model->nas_name }}
                                                        </span>
                                                    @break
                                                @endswitch
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="col12">
                            @include('backend.includes.users_index_phone_menu')
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-12 d-flex flex-row justify-content-center">
        {{ $paginatedData->onEachSide(1)->links('vendor.pagination.livewire.crypto_paginate') }}
    </div>
    @include('backend.admins.users.includes.mobile_overlay')
</div>
